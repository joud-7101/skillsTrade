<?php
require 'db.php';

if (!isset($_GET['id'])) {
    die("Missing video ID.");
}

$id = intval($_GET['id']);

$stmt = $pdo->prepare("SELECT video FROM skills WHERE id = ?");
$stmt->execute([$id]);
$video = $stmt->fetch();

if (!$video) {
    die("Video not found.");
}

// header("Content-Type: video/mp4");  // or detect dynamically
echo $video['video'];
?>
