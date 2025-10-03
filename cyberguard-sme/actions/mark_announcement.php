<?php
require_once '../inc/functions.php';
require_login();

$id = intval($_POST['id'] ?? 0);
if ($id > 0) {
    $stmt = $mysqli->prepare("INSERT INTO announcement_reads (announcement_id,user_id) VALUES (?,?)
        ON DUPLICATE KEY UPDATE read_at=NOW()");
    $stmt->bind_param('ii', $id, $_SESSION['user_id']);
    $stmt->execute();
    $stmt->close();
    echo "success";
} else {
    echo "error";
}
