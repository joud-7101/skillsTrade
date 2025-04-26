<?php
// Show errors (development only)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Database connection
require 'db.php';
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    die("Unauthorized access.");
}
$userId = $_SESSION['user_id'];

// Get form data
$skillTitle = $_POST['skillTitle'] ?? '';
$description = $_POST['description'] ?? '';
$wantSkill = $_POST['wantSkill'] ?? '';
$videoPath = "";

// Validate form data
if (empty($skillTitle) || empty($description) || empty($wantSkill)) {
    die("Missing required form fields.");
}

if (isset($_FILES['videoFile']) && $_FILES['videoFile']['error'] == 0) {

    // Allowed MIME types
    $allowedTypes = ['video/mp4', 'video/webm', 'video/ogg'];
    $fileName = $_FILES['videoFile']['name'];
    $fileType = $_FILES['videoFile']['type'];;
    $fileData = file_get_contents($_FILES['videoFile']['tmp_name']);

    if (!in_array($fileType, $allowedTypes)) {
        die("Invalid file type. Only MP4, WebM, and OGG are allowed.");
    }

}

// Insert into the database
$stmt = $pdo->prepare("INSERT INTO skills (user_id, skillTitle, description, wantSkill, video) VALUES (?, ?, ?, ?, ?)");

if ($stmt->execute([$userId, $skillTitle, $description, $wantSkill, $fileData])) {
    header("Location: ../HTML/Skills.html");
    exit();
} else {
    $errorInfo = $stmt->errorInfo();
    echo "❌ Database error: " . $errorInfo[2];
}
?>
