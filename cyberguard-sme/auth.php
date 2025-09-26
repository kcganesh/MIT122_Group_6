<?php
// auth.php
require_once 'inc/functions.php';
if ($_SERVER['REQUEST_METHOD'] !== 'POST') { header('Location: index.php'); exit; }

$email = $_POST['email'] ?? '';
$pass = $_POST['password'] ?? '';

if (!$email || !$pass) {
    header('Location: index.php?error=Missing+credentials'); exit;
}

$stmt = $mysqli->prepare("SELECT id,password FROM users WHERE email=? LIMIT 1");
$stmt->bind_param('s',$email);
$stmt->execute();
$res = $stmt->get_result();
if ($res->num_rows === 0) {
    header('Location: index.php?error=Invalid+login'); exit;
}
$row = $res->fetch_assoc();
if (!password_verify($pass, $row['password'])) {
    header('Location: index.php?error=Invalid+login'); exit;
}

// Login success
session_regenerate_id(true);
$_SESSION['user_id'] = $row['id'];
header('Location: dashboard.php');
exit;
