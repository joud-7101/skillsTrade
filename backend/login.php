
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require 'db.php';
session_start(); // ✅ only once, at the top

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['name'] = $user['name'];

        // ✅ redirect to homepage on success
        header("Location: ../HTML/homePage.html");
        exit();
    } else {
        header("Location: ../HTML/Login.html?error=1");
        exit();
    }
}
?>
