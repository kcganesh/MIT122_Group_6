<?php
require_once 'inc/functions.php';
require_login();

$res = $mysqli->query("SELECT * FROM resources ORDER BY uploaded_at DESC");

include 'inc/header.php';
?>
<section class="card">
  <h2>Resources</h2>
  <ul>
    <?php while ($r = $res->fetch_assoc()): ?>
      <li>
        <a href="<?= sanitize($r['file_url']) ?>" target="_blank"><?= sanitize($r['title']) ?></a>
      </li>
    <?php endwhile; ?>
  </ul>
</section>
<?php include 'inc/footer.php'; ?>
