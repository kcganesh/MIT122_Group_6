<?php
require_once 'inc/functions.php';
require_login();
$res = $mysqli->query("SELECT * FROM resources ORDER BY uploaded_at DESC");
include 'inc/header.php';
?>
<section class="card">
  <h2>Resource Repository</h2>
  <ul>
    <?php while ($r = $res->fetch_assoc()): ?>
      <li><a target="_blank" href="<?= sanitize($r['url']) ?>"><?= sanitize($r['title']) ?></a> — <?= sanitize($r['description']) ?></li>
    <?php endwhile; ?>
  </ul>
  <?php if (is_admin()): ?>
    <p><a href="admin.php#resources">Manage resources (admin)</a></p>
  <?php endif; ?>
</section>
<?php include 'inc/footer.php'; ?>
