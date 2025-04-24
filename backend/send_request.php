<?php
session_start();
if (file_exists('db.php')) {
    include 'db.php';
} else {
    die("❌ db connection file not found");
}


if (!isset($_SESSION['user_id'])) {
    die("You must be logged in to send a request.");
}

$requester_id = $_SESSION['user_id'];
$receiver_id = $_POST['receiver_id'];
$skill_offered = $_POST['skill_offered'];
$skill_wanted = $_POST['skill_wanted'];

$stmt = $pdo->prepare("INSERT INTO trade_requests (skill_offered, skill_wanted, requester_id, receiver_id)
VALUES (:skill_offered, :skill_wanted, :requester_id, :receiver_id)");

$stmt->execute([
    ':skill_offered' => $skill_offered,
    ':skill_wanted'  => $skill_wanted,
    ':requester_id'  => $requester_id,
    ':receiver_id'   => $receiver_id
]);

header("Location: ../HTML/Skills.html?message=Request Sent!");
exit();
?>
