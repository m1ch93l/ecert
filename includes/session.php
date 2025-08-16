<?php

session_start();

if (!isset($_SESSION['participant'])) {
    header('location: index');
    exit();
}