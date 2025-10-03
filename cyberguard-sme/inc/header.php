<?php
// inc/header.php
require_once __DIR__.'/functions.php';
$user = current_user();
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8" />
<link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@500;700&family=Source+Code+Pro:wght@400;600&display=swap" rel="stylesheet">
<meta name="viewport" content="width=device-width,initial-scale=1" />
<title>CyberGuard SME</title>
<link rel="stylesheet" href="assets/css/style.css" />
<script src="assets/js/app.js" defer></script>
</head>
<body>
<header class="topbar">
  <div class="container">
    <h1 class="logo">
    <svg xmlns="http://www.w3.org/2000/svg" fill="#1E90FF" viewBox="0 0 24 24" width="28" height="28" class="logo-icon">
    <path d="M12 2l8 4v6c0 5.25-3.5 10-8 11-4.5-1-8-5.75-8-11V6l8-4z"/>
    </svg>
    <a href="dashboard.php">CyberGuard SME</a>
    </h1>

    <nav>
      <?php if ($user): ?>
        <a href="dashboard.php">Dashboard</a>
        <a href="training.php">Awareness Center</a>
        <a href="report_incident.php">Report Incident</a>
        <a href="cases.php">Incident Tracker</a>
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
