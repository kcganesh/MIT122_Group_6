<?php
// inc/header.php
require_once __DIR__.'/functions.php';
$user = current_user();
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width,initial-scale=1" />
<title>CyberGuard SME</title>
<link rel="stylesheet" href="assets/css/style.css" />
</head>
<body>
<header class="topbar">
  <div class="container">
    <h1><a href="dashboard.php">CyberGuard SME</a></h1>
    <nav>
      <?php if ($user): ?>
        <a href="dashboard.php">Dashboard</a>
        <a href="training.php">Awareness Center</a>
        <a href="report_incident.php">Report Incident</a>
        <a href="tracker.php">Incident Tracker</a>
        <a href="resources.php">Resources</a>
        <a href="profile.php">Profile</a>
        <?php if (is_admin()): ?><a href="admin.php">Admin</a><?php endif; ?>
        <a href="logout.php" class="btn-logout">Logout</a>
      <?php else: ?>
        <a href="index.php">Login</a>
      <?php endif; ?>
    </nav>
  </div>
</header>
<main class="container">
