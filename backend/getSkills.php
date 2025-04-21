<?php
require 'db.php';
header('Content-Type: application/json');

$stmt = $pdo->query("
  SELECT users.name AS userName, skills.skillTitle, skills.wantSkill
  FROM skills
  JOIN users ON skills.user_id = users.id
");

$skills = $stmt->fetchAll();
echo json_encode($skills);
?>
