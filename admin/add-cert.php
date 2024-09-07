<?php

include 'includes/conn.php';

$add_cert = $_POST['certificate_id'];
$participant_id = $_POST['participant_id'];

$sql = "INSERT INTO acquired_cert (participant_id, certificate_id) VALUES (?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $participant_id, $add_cert);
$stmt->execute();
$stmt->close();
$conn->close();

header('location: home');
