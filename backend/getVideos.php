<?php
include 'db.php';

$receiver_id = $_GET['receiver_id'];

$stmt = $pdo->prepare("SELECT skillTitle AS title, description, videoPath FROM skills WHERE user_id = :receiver_id AND videoPath IS NOT NULL");
$stmt->execute(['receiver_id' => $receiver_id]);
$videos = $stmt->fetchAll();

echo json_encode($videos);
?>

