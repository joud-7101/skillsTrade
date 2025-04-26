<?php
session_start();
require 'db.php';

// Ensure user is logged in
if (!isset($_SESSION['user_id'])) {
    die(json_encode(['error' => 'You must be logged in.']));
}

$user_id = $_SESSION['user_id'];

// Fetch trades with video paths joined from the skills table
$stmt = $pdo->prepare("
    SELECT tr.id, u1.name AS requesterName, u2.name AS receiverName, 
           tr.skill_offered, tr.skill_wanted, tr.status,
           s.id as videoID
    FROM trade_requests tr
    JOIN users u1 ON tr.requester_id = u1.id
    JOIN users u2 ON tr.receiver_id = u2.id
    LEFT JOIN skills s ON tr.skill_offered = s.skillTitle
    WHERE tr.requester_id = :user_id OR tr.receiver_id = :user_id
");
$stmt->execute(['user_id' => $user_id]);

$trades = $stmt->fetchAll();

header('Content-Type: application/json');
echo json_encode($trades);
?>
