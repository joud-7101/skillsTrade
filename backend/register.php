<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $offerSkill = $_POST['offerSkill'];
    $wantSkill = $_POST['wantSkill'];

    $stmt = $pdo->prepare("INSERT INTO users (name, email, password, offerSkill, wantSkill) VALUES (?, ?, ?, ?, ?)");
    if ($stmt->execute([$name, $email, $password, $offerSkill, $wantSkill])) {
        header("Location: ../HTML/Login.html");
        exit();
            } else {
        echo "Error occurred during registration.";
    }
}
?>
