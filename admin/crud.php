<?php

require_once __DIR__ . '/includes/session.php';

function editUser($conn)
{
    $sql  = "SELECT * FROM user WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $_GET['id']);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    require_once __DIR__ . "/views/edit-user.php";
    return $user;
}

// Mapping actions to functions
$actions = [
    'create' => 'createUser',
    'read'   => 'readUser',
    'edit'   => 'editUser',
    'update' => 'updateUser',
    'delete' => 'deleteUser',
];

// Initialize $action as an empty string by default
$action = '';

// Check the request method and get the appropriate parameter
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    $action = $_POST['action'];
} elseif (isset($_GET['action'])) {
    $action = $_GET['action'];
}

// Optionally sanitize the action
$action = htmlspecialchars($action, ENT_QUOTES, 'UTF-8');

// Checks if a function with that name exists
if (array_key_exists($action, $actions)) {
    $function = $actions[$action];
    if (function_exists($function)) {
        $function($conn);
    }
}