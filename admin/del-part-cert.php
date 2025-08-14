<?php include 'includes/session.php';

$id     = $_GET['id'];
$certid = $_GET['certid'] ?? null;

// Delete the participant from the database
$sql  = "DELETE FROM acquired_cert WHERE certificate_id = ? AND participant_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $id, $certid);
$stmt->execute();

$stmt->close();
// Return an empty response for htmx to remove the row
exit;

