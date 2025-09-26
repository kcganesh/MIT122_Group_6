<?php
// index.php - login
require_once 'inc/functions.php';
if (is_logged_in()) header('Location: dashboard.php');

$err = '';
if (isset($_GET['error'])) $err = $_GET['error'];
?>
<?php include 'inc/header.php'; ?>
<section class="card">
  <h2>Sign in</h2>
  <?php if ($err): ?><div class="error"><?= sanitize($err) ?></div><?php endif; ?>
  <form method="post" action="auth.php" id="loginForm">
    <label>Email<input type="email" name="email" required></label>
    <label>Password<input type="password" name="password" required></label>
    <button type="submit">Login</button>
  </form>
  <p class="muted">Use <strong>admin@cyberguard.local</strong> / <strong>Admin123!</strong> (after setup)</p>
</section>
<?php include 'inc/footer.php'; ?>
