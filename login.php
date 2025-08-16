<?php
session_start();

require_once __DIR__ . '/model/user.php';

if (isset($_POST['login'])) {

    $participant = $_POST['participant'];
    $password    = $_POST['password'];

    $user    = new User();
    $student = $user->getUser($participant);
    $admin   = $user->getUserAdmin($participant);

    if ($student && $password == $student['password']) {
        $_SESSION['participant'] = $student['id'];
        $_SESSION['fullname']    = $student['fullname'];
        header('location: home');
        exit();
    } else {
        $_SESSION['error'] = 'Incorrect Credentials';
    }

    if ($admin && password_verify($password, $admin['password'])) {
        $_SESSION['admin'] = $admin['id'];
        header('location: admin/home');
        exit();
    } else {
        $_SESSION['error'] = 'Incorrect Credentials';
    }
}

header('location: index');
exit();