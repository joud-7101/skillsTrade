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

// File upload handling
$targetDir = "../MEDIA/uploads/";
if (!is_dir($targetDir) || !is_writable($targetDir)) {
    die("Upload directory does not exist or is not writable.");
}

if (!empty($_FILES['videoFile']['name'])) {
    if ($_FILES['videoFile']['error'] !== UPLOAD_ERR_OK) {
        die("File upload error: " . $_FILES['videoFile']['error']);
    }

    // Allowed MIME types
    $allowedTypes = ['video/mp4', 'video/webm', 'video/ogg'];
    $fileType = mime_content_type($_FILES['videoFile']['tmp_name']);

    if (!in_array($fileType, $allowedTypes)) {
        die("Invalid file type. Only MP4, WebM, and OGG are allowed.");
    }

    // Generate unique file name
    $extension = pathinfo($_FILES["videoFile"]["name"], PATHINFO_EXTENSION);
    $newFileName = uniqid('video_', true) . "." . $extension;
    $videoPath = $targetDir . $newFileName;

    if (!move_uploaded_file($_FILES["videoFile"]["tmp_name"], $videoPath)) {
        die("Failed to move uploaded file.");
    }
}

// Insert into the database
$stmt = $pdo->prepare("INSERT INTO skills (user_id, skillTitle, description, wantSkill, videoPath) VALUES (?, ?, ?, ?, ?)");

if ($stmt->execute([$userId, $skillTitle, $description, $wantSkill, $videoPath])) {
    header("Location: ../HTML/Skills.html");
    exit();
} else {
    $errorInfo = $stmt->errorInfo();
    echo "❌ Database error: " . $errorInfo[2];
}
?>
