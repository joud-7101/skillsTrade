<?php
include 'db.php';

$receiver_id = $_GET['receiver_id'];

$stmt = $pdo->prepare("SELECT id, skillTitle AS title, description FROM skills WHERE user_id = :receiver_id AND video IS NOT NULL");
$stmt->execute(['receiver_id' => $receiver_id]);
$videos = $stmt->fetchAll();

echo json_encode($videos);
?>
