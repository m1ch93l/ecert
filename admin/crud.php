<?php

require_once __DIR__ . '/includes/session.php';

function createCertificate($conn)
{
    $sql  = "INSERT INTO certificate (type, event) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $_POST['type'], $_POST['event']);
    $stmt->execute();
}

function readCertificate($conn)
{
    $sql  = "SELECT * FROM certificate";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $certificates = $stmt->get_result();
    require_once __DIR__ . "/views/read-certificate.php";
    return $certificates;
}

function editCertificate($conn)
{
    $sql  = "SELECT * FROM certificate WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $_GET['id']);
    $stmt->execute();
    $result      = $stmt->get_result();
    $certificate = $result->fetch_assoc(); // fetch as associative array
    require_once __DIR__ . "/views/edit-certificate.php";
    return $certificate;
}

function updateCertificate($conn)
{
    $sql  = "UPDATE certificate SET type = ?, event = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $_POST['type'], $_POST['event'], $_POST['id']);
    $stmt->execute();
}

function deleteCertificate($conn)
{
    $sql  = "DELETE FROM certificate WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $_GET['id']);
    $stmt->execute();
}

function editFullname($conn)
{
    $sql  = "SELECT * FROM participant WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $_GET['id']);
    $stmt->execute();
    $result      = $stmt->get_result();
    $participant = $result->fetch_assoc(); // fetch as associative array
    require_once __DIR__ . "/views/edit-fullname.php";
    return $participant;
}

function updateFullname($conn)
{
    $sql  = "UPDATE participant SET fullname = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $_POST['fullname'], $_POST['id']);
    $stmt->execute();
}

// Mapping actions to functions
$actions = [
    'create' => 'createCertificate',
    'read'   => 'readCertificate',
    'edit'   => 'editCertificate',
    'update' => 'updateCertificate',
    'delete' => 'deleteCertificate',
    'editFullname' => 'editFullname',
    'updateFullname' => 'updateFullname',
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