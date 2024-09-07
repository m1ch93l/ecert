<?php
session_start();
include 'includes/conn.php';

if (isset($_POST['login'])) {
    $participant    = $_POST['participant'];
    $password = $_POST['password'];

    $sql   = "SELECT * FROM participant WHERE id = '$participant'";
    $query = $conn->query($sql);

    if ($query->num_rows < 1) {
        $_SESSION['error'] = 'Cannot find voter with the ID';
    } else {
        $row = $query->fetch_assoc();
        if ($password == $row['password']) {
            $_SESSION['participant'] = $row['id'];
        } else {
            $_SESSION['error'] = 'Incorrect password';
        }
    }

} else {
    $_SESSION['error'] = 'Input voter credentials first';
}

header('location: index.php');

?>