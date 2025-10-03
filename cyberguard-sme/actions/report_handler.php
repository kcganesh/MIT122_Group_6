<?php
require_once '../inc/functions.php';
require_login();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../report_incident.php');
    exit;
}

$title = trim($_POST['title'] ?? '');
$desc = trim($_POST['description'] ?? '');
$severity = in_array($_POST['severity'] ?? 'medium', ['low','medium','high']) ? $_POST['severity'] : 'medium';

if (!$title) {
    header('Location: ../report_incident.php?error=Missing+title');
    exit;
}

$stmt = $mysqli->prepare("INSERT INTO incidents (user_id,title,description,severity) VALUES (?,?,?,?)");
$stmt->bind_param('isss', $_SESSION['user_id'], $title, $desc, $severity);
$stmt->execute();
$stmt->close();

header('Location: ../cases.php?msg=incident+created');
exit;
