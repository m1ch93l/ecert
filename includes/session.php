<?php
include 'includes/conn.php';
session_start();

if (isset($_SESSION['participant'])) {
    $sql   = "SELECT * FROM participant WHERE id = '" . $_SESSION['participant'] . "'";
    $query = $conn->query($sql);
    $voter = $query->fetch_assoc();
} else {
    header('location: index.php');
    exit();
}

?>