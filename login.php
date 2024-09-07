<?php
session_start();
include 'includes/conn.php';

if (isset($_POST['login'])) {
    $participant    = $_POST['participant'];
    $password = $_POST['password'];

    $sql   = "SELECT * FROM participant WHERE participant_id = '$participant'";
    $query = $conn->query($sql);

    if ($query->num_rows < 1) {
        $_SESSION['error'] = 'Cannot find voter with the ID';
    } else {
        $row = $query->fetch_assoc();
        if ($password == $row['password']) {
            $_SESSION['participant'] = $row['id'];
            $_SESSION['fullname'] = $row['fullname'];
            header('location: home');
        } else {
            $_SESSION['error'] = 'Incorrect password';
        }
    }

    $sql   = "SELECT * FROM admin WHERE username = '$participant'";
    $query = $conn->query($sql);

    if ($query->num_rows < 1) {
        $_SESSION['error'] = 'Cannot find account with the username';
    } else {
        $row = $query->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $_SESSION['admin'] = $row['id'];
            header('location: admin/home');
        } else {
            $_SESSION['error'] = 'Incorrect password';
        }
    }

} else {
    $_SESSION['error'] = 'Input voter credentials first';
}

header('location: index');

?>