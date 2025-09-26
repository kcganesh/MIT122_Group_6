<?php
require_once 'inc/functions.php';
require_login();
$user = current_user();
include 'inc/header.php';
?>
<section class="card">
  <h2>Your Profile</h2>
  <p><strong>Name:</strong> <?= sanitize($user['name']) ?></p>
  <p><strong>Email:</strong> <?= sanitize($user['email']) ?></p>
  <p><strong>Role:</strong> <?= sanitize($user['role']) ?></p>
</section>
<?php include 'inc/footer.php'; ?>
