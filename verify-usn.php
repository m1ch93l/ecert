<?php

require_once __DIR__ . '/model/user.php';

$usn = $_POST['usn'] ?? '';

$user = new User();
// Check if the USN exists and is not already registered
if ($user->verifyUsn($usn)) {
    session_start();
    $_SESSION['usn'] = $usn;
    header('location: verify-usn-register');
    exit();
} else {
    session_start();
    $_SESSION['error'] = 'USN not found or already registered';
    header('location: verify');
    exit();
}