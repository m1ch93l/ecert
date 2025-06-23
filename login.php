<?php
session_start();
include 'includes/conn.php';
require_once 'model/user.php';

if (isset($_POST['login'])) {
    $participant = $_POST['participant'];
    $password    = $_POST['password'];

    $user = new User();
    $row  = $user->getUser($participant);

    if ($password == $row['password']) {
        $_SESSION['participant'] = $row['id'];
        $_SESSION['fullname']    = $row['fullname'];
        header('location: home');
    } else {
        $_SESSION['error'] = 'Incorrect password';
    }

    $row = $user->getUserAdmin($participant);

    if (password_verify($password, $row['password'])) {
        $_SESSION['admin'] = $row['id'];
        header('location: admin/home');
    } else {
        $_SESSION['error'] = 'Incorrect password';
    }

} else {
    $_SESSION['error'] = 'Input voter credentials first';
}

header('location: index');

?>