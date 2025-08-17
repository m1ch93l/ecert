<?php
require_once __DIR__ . '/../includes/conn.php';
session_start();

if (!isset($_SESSION['admin'])) {
    header('location: ../index');
    exit();
}