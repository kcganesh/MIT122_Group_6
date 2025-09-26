<?php
require_once '../inc/functions.php';
require_login();
if (!is_admin()) { header('Location: ../tracker.php?error=not_allowed'); exit; }
$id = intval($_POST['id'] ?? 0);
$status = in_array($_POST['status'] ?? '', ['open','in_progress','closed']) ? $_POST['status'] : 'open';
$stmt = $mysqli->prepare("UPDATE incidents SET status=? WHERE id=?");
$stmt->bind_param('si', $status, $id);
$stmt->execute();
$stmt->close();
header('Location: ../tracker.php?msg=status+updated');
exit;
