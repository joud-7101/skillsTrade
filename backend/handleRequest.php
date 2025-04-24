<?php
session_start();
include 'db.php';

$request_id = $_POST['request_id'];
$action = $_POST['action'];  // 'accept' or 'reject'

$status = ($action === 'accept') ? 'accepted' : 'rejected';

$stmt = $pdo->prepare("UPDATE trade_requests SET status = :status WHERE id = :id");
$stmt->execute(['status' => $status, 'id' => $request_id]);

header("Location: ../HTML/ManageRequests.html?message=Request $status!");
exit();
?>
