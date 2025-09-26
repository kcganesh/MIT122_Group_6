<?php
require_once '../inc/functions.php';
require_login();
if (!is_admin()) { header('Location: ../dashboard.php'); exit; }

$action = $_POST['action'] ?? '';
if ($action === 'update_role') {
    $uid = intval($_POST['user_id']);
    $role = ($_POST['role'] === 'admin') ? 'admin' : 'staff';
    $stmt = $mysqli->prepare("UPDATE users SET role=? WHERE id=?");
    $stmt->bind_param('si',$role,$uid); $stmt->execute(); $stmt->close();
    header('Location: ../admin.php?msg=role+updated'); exit;
}
if ($action === 'delete_user') {
    $uid = intval($_POST['user_id']);
    $stmt = $mysqli->prepare("DELETE FROM users WHERE id=?");
    $stmt->bind_param('i',$uid); $stmt->execute(); $stmt->close();
    header('Location: ../admin.php?msg=user+deleted'); exit;
}
if ($action === 'add_training') {
    $title = trim($_POST['title']); $url = trim($_POST['youtube_url']); $desc=trim($_POST['description']);
    $stmt = $mysqli->prepare("INSERT INTO training_modules (title,youtube_url,description) VALUES (?,?,?)");
    $stmt->bind_param('sss',$title,$url,$desc); $stmt->execute(); $stmt->close();
    header('Location: ../admin.php?msg=training+added'); exit;
}
if ($action === 'add_resource') {
    $title = trim($_POST['res_title']); $url = trim($_POST['res_url']); $desc=trim($_POST['res_desc']);
    $stmt = $mysqli->prepare("INSERT INTO resources (title,url,description) VALUES (?,?,?)");
    $stmt->bind_param('sss',$title,$url,$desc); $stmt->execute(); $stmt->close();
    header('Location: ../admin.php?msg=resource+added'); exit;
}

header('Location: ../admin.php');
exit;
