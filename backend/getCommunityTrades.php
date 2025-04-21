<?php
require 'db.php';

$stmt = $pdo->query("SELECT name, offerSkill, wantSkill FROM users");
$trades = $stmt->fetchAll();

header('Content-Type: application/json');
echo json_encode($trades);
?>
