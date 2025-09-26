<?php
require_once 'inc/functions.php';
require_login();

$filter = $_GET['filter'] ?? 'all';

// build query
$sql = "SELECT i.*, u.name as reporter FROM incidents i JOIN users u ON i.user_id=u.id";
$params = [];
if ($filter === 'open') { $sql .= " WHERE i.status='open'"; }
$sql .= " ORDER BY i.created_at DESC";
$res = $mysqli->query($sql);

include 'inc/header.php';
?>
<section class="card">
  <h2>Incident Tracker</h2>
  <p>Filter: <a href="?filter=all">All</a> | <a href="?filter=open">Open</a></p>
  <?php if (isset($_GET['msg'])): ?>
    <div class="notice"><?= sanitize($_GET['msg']) ?></div>
  <?php endif; ?>
  <table class="table">
    <thead><tr><th>ID</th><th>Title</th><th>Reporter</th><th>Severity</th><th>Status</th><th>Actions</th></tr></thead>
    <tbody>
    <?php while ($row = $res->fetch_assoc()): ?>
      <tr>
        <td><?= $row['id'] ?></td>
        <td><?= sanitize($row['title']) ?></td>
        <td><?= sanitize($row['reporter']) ?></td>
        <td><?= sanitize($row['severity']) ?></td>
        <td><?= sanitize($row['status']) ?></td>
        <td>
          <a href="tracker.php?view=<?= $row['id'] ?>">View</a>
          <?php if (is_admin()): ?>
            <form style="display:inline" method="post" action="actions/update_incident_status.php">
              <input type="hidden" name="id" value="<?= $row['id'] ?>">
              <select name="status">
                <option <?= $row['status']=='open'?'selected':'' ?>>open</option>
                <option <?= $row['status']=='in_progress'?'selected':'' ?>>in_progress</option>
                <option <?= $row['status']=='closed'?'selected':'' ?>>closed</option>
              </select>
              <button type="submit">Update</button>
            </form>
          <?php endif; ?>
        </td>
      </tr>
      <?php if (isset($_GET['view']) && intval($_GET['view']) === intval($row['id'])): ?>
        <tr><td colspan="6">
          <h4>Details</h4>
          <p><?= nl2br(sanitize($row['description'])) ?></p>
          <small>Created: <?= $row['created_at'] ?></small>
        </td></tr>
      <?php endif; ?>
    <?php endwhile; ?>
    </tbody>
  </table>
</section>
<?php include 'inc/footer.php'; ?>
