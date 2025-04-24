<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    echo json_encode([]); // Return empty if not logged in
    exit();
}

$user_id = $_SESSION['user_id'];

$stmt = $pdo->prepare("SELECT tr.*, u.name AS requester_name 
                       FROM trade_requests tr 
                       JOIN users u ON tr.requester_id = u.id 
                       WHERE tr.receiver_id = :receiver_id AND tr.status = 'pending'");
$stmt->execute(['receiver_id' => $user_id]);
$requests = $stmt->fetchAll();

echo json_encode($requests);
?>


