<?php
require_once __DIR__ . '/../model/certificate.php';
session_start();

if (!isset($_SESSION['participant'])) {
    header('location: index');
    exit();
}