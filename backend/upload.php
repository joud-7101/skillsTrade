<?php
require 'db.php';
session_start();
$userId = $_SESSION['user_id'] ?? 1; // fallback for testing without login

$skillTitle = $_POST['skillTitle'];
$description = $_POST['description'];
$wantSkill = $_POST['wantSkill'];
$videoPath = "";

if (!empty($_FILES['videoFile']['name'])) {
    $targetDir = "../MEDIA/uploads/";
    $videoPath = $targetDir . basename($_FILES["videoFile"]["name"]);
    move_uploaded_file($_FILES["videoFile"]["tmp_name"], $videoPath);
}

$stmt = $pdo->prepare("INSERT INTO skills (user_id, skillTitle, description, wantSkill, videoPath) VALUES (?, ?, ?, ?, ?)");
if ($stmt->execute([$userId, $skillTitle, $description, $wantSkill, $videoPath])) {
    echo "Skill shared successfully!";
} else {
    echo "Error sharing skill.";
}
?>
