<?php
require_once 'inc/functions.php';
require_login();
$user = current_user();

// Pull ALL announcements with read flag for this user
$sql = "SELECT a.id, a.title, a.content, a.importance, a.created_at,
        (SELECT COUNT(*) FROM announcement_reads r WHERE r.announcement_id=a.id AND r.user_id=?) AS is_read
        FROM announcements a
        ORDER BY a.created_at DESC";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param('i', $_SESSION['user_id']);
$stmt->execute();
$anns = $stmt->get_result();
$stmt->close();

include 'inc/header.php';
?>
<section class="card">
  <h2>All Announcements</h2>

  <?php if ($anns->num_rows > 0): ?>
    <?php while($a=$anns->fetch_assoc()):
      $isRead = $a['is_read'] > 0;
      $badgeColor = $a['importance'] === 'high' ? 'red' : ($a['importance'] === 'medium' ? 'orange' : 'blue');
    ?>
      <div class="announcement <?= $isRead ? 'read' : 'unread' ?>" data-id="<?= $a['id'] ?>">
        <div class="announcement-header" style="display:flex;align-items:center;gap:10px;justify-content:space-between;">
          <strong><?= sanitize($a['title']) ?></strong>
          <span class="badge" style="background:<?= $badgeColor ?>;color:white;padding:2px 6px;border-radius:4px;font-size:0.8em;">
            <?= ucfirst($a['importance']) ?>
          </span>
        </div>

        <!-- Show FULL content here -->
        <p class="body-text"><?= nl2br(sanitize($a['content'])) ?></p>

        <div class="actions" style="display:flex;gap:8px;align-items:center;margin-top:6px;">
          <button type="button" class="mark-read-btn btn-small" <?= $isRead ? 'disabled' : '' ?>>
            <?= $isRead ? 'Read' : 'Mark as read' ?>
          </button>
          <span class="read-status" style="font-weight:bold;"><?= $isRead ? 'Read' : 'Unread' ?></span>
          <small style="margin-left:auto;color:#666;"><?= $a['created_at'] ?></small>
        </div>
      </div>
    <?php endwhile; ?>
  <?php else: ?>
    <p class="muted">No announcements yet.</p>
  <?php endif; ?>

  <div style="margin-top:10px;">
    <a class="btn" href="dashboard.php">Back to Dashboard</a>
  </div>
</section>
<?php include 'inc/footer.php'; ?>
