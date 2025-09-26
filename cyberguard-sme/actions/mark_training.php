<?php
// actions/mark_training.php
require_once '../inc/functions.php';
header('Content-Type: application/json');
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['error'=>'invalid']); exit;
}
require_login();
$tid = intval($_POST['training_id'] ?? 0);
if (!$tid) { echo json_encode(['error'=>'no training']); exit; }

// upsert user_trainings
$stmt = $mysqli->prepare("SELECT id FROM user_trainings WHERE user_id=? AND training_id=?");
$stmt->bind_param('ii', $_SESSION['user_id'], $tid);
$stmt->execute(); $res = $stmt->get_result();
if ($res->num_rows) {
    $stmt->close();
    $stmt2 = $mysqli->prepare("UPDATE user_trainings SET completed=1, completed_at=NOW() WHERE user_id=? AND training_id=?");
    $stmt2->bind_param('ii', $_SESSION['user_id'], $tid);
    $stmt2->execute(); $stmt2->close();
} else {
    $stmt->close();
    $stmt2 = $mysqli->prepare("INSERT INTO user_trainings (user_id,training_id,completed,completed_at) VALUES (?,?,1,NOW())");
    $stmt2->bind_param('ii', $_SESSION['user_id'], $tid);
    $stmt2->execute(); $stmt2->close();
}
echo json_encode(['ok'=>1]);
