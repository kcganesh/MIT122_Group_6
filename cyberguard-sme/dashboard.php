<?php
require_once 'inc/functions.php';
require_login();
$user = current_user();

// Counts
$stmt = $mysqli->prepare("SELECT COUNT(*) AS cnt FROM incidents WHERE status='open'");
$stmt->execute(); $open = $stmt->get_result()->fetch_assoc()['cnt']; $stmt->close();

$stmt = $mysqli->prepare("SELECT COUNT(*) AS cnt FROM incidents");
$stmt->execute(); $total = $stmt->get_result()->fetch_assoc()['cnt']; $stmt->close();

$stmt = $mysqli->prepare("SELECT COUNT(*) AS cnt FROM user_trainings WHERE user_id=? AND completed=1");
$stmt->bind_param('i', $_SESSION['user_id']);
$stmt->execute(); $completed = $stmt->get_result()->fetch_assoc()['cnt']; $stmt->close();

$stmt = $mysqli->prepare("SELECT COUNT(*) AS cnt FROM training_modules");
$stmt->execute(); $totalTrain = $stmt->get_result()->fetch_assoc()['cnt']; $stmt->close();

include 'inc/header.php';
?>
<section class="card">
  <h2>Welcome, <?= sanitize($user['name']) ?></h2>
  <div class="grid">
    <div class="stat">Open Incidents<br><strong><?= $open ?></strong></div>
    <div class="stat">Total Incidents<br><strong><?= $total ?></strong></div>
    <div class="stat">Trainings Completed<br><strong><?= $completed ?>/<?= $totalTrain ?></strong></div>
  </div>
  <p>Quick actions:</p>
  <div>
    <a class="btn" href="report_incident.php">Report an incident</a>
    <a class="btn" href="training.php">Go to Awareness Center</a>
    <a class="btn" href="tracker.php">View incident tracker</a>
  </div>
</section>
<?php include 'inc/footer.php'; ?>
