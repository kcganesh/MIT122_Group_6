<?php
require_once 'inc/functions.php';
require_login();

$sql = "SELECT i.id, i.title, i.description, i.status, i.severity, u.name AS reporter, i.created_at
        FROM incidents i
        JOIN users u ON i.user_id = u.id
        ORDER BY i.created_at DESC";

$res = $mysqli->query($sql);

include 'inc/header.php';
?>
<section class="card">
  <h2>Incident Tracker</h2>
  <?php if (isset($_GET['msg'])): ?>
    <div class="notice"><?= sanitize($_GET['msg']) ?></div>
  <?php endif; ?>
  <table class="table">
    <thead>
      <tr>
        <th>ID</th><th>Title</th><th>Reporter</th><th>Severity</th><th>Status</th><th>Description</th>
      </tr>
    </thead>
    <tbody>
      <?php while ($row = $res->fetch_assoc()): ?>
        <tr>
          <td><?= $row['id'] ?></td>
          <td><?= sanitize($row['title']) ?></td>
          <td><?= sanitize($row['reporter']) ?></td>
          <td><?= sanitize($row['severity']) ?></td>
          <td>
            <?php if (is_admin()): ?>
              <form method="post" action="actions/update_status.php" style="display:inline">
                <input type="hidden" name="id" value="<?= $row['id'] ?>">
                <select name="status" onchange="this.form.submit()">
                  <option value="open" <?= $row['status']=='open'?'selected':'' ?>>Open</option>
                  <option value="in_progress" <?= $row['status']=='in_progress'?'selected':'' ?>>In Progress</option>
                  <option value="closed" <?= $row['status']=='closed'?'selected':'' ?>>Closed</option>
                </select>
              </form>
            <?php else: ?>
              <?= sanitize($row['status']) ?>
            <?php endif; ?>
          </td>
          <td><?= sanitize($row['description']) ?></td>
        </tr>
      <?php endwhile; ?>
    </tbody>
  </table>
</section>
<?php include 'inc/footer.php'; ?>
