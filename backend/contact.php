<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare("INSERT INTO contacts (name, gender, mobile, dob, email, language, message) VALUES (?, ?, ?, ?, ?, ?, ?)");
    if ($stmt->execute([
        $_POST['name'],
        $_POST['gender'],
        $_POST['mobile'],
        $_POST['dob'],
        $_POST['email'],
        $_POST['language'],
        $_POST['message']
    ])) {
        echo "Message received!";
    } else {
        echo "Error saving message.";
    }
}
?>
