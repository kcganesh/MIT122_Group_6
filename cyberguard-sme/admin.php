<?php
require_once 'inc/functions.php';
require_login();
if (!is_admin()) { header('Location: dashboard.php'); exit; }

// fetch lists
$users = $mysqli->query("SELECT id,name,email,role,created_at FROM users ORDER BY id");
$trainings = $mysqli->query("SELECT * FROM training_modules ORDER BY created_at DESC");
$resources = $mysqli->query("SELECT * FROM resources ORDER BY uploaded_at DESC");

include 'inc/header.php';
?>
<section class="card">
  <h2>Admin Console</h2>

  <h3 id="users">Users</h3>
  <table class="table"><thead><tr><th>ID</th><th>Name</th><th>Email</th><th>Role</th><th>Action</th></tr></thead><tbody>
  <?php while ($u = $users->fetch_assoc()): ?>
    <tr>
      <td><?= $u['id'] ?></td>
      <td><?= sanitize($u['name']) ?></td>
      <td><?= sanitize($u['email']) ?></td>
      <td><?= sanitize($u['role']) ?></td>
      <td>
        <form method="post" action="actions/admin_actions.php" style="display:inline">
          <input type="hidden" name="user_id" value="<?= $u['id'] ?>">
          <select name="role">
            <option value="staff" <?= $u['role']=='staff'?'selected':'' ?>>staff</option>
            <option value="admin" <?= $u['role']=='admin'?'selected':'' ?>>admin</option>
          </select>
          <button type="submit" name="action" value="update_role">Update</button>
          <button type="submit" name="action" value="delete_user" onclick="return confirm('Delete user?')">Delete</button>
        </form>
      </td>
    </tr>
  <?php endwhile; ?>
  </tbody></table>

  <h3 id="trainings">Training Modules</h3>
  <form method="post" action="actions/admin_actions.php">
    <label>Title<input name="title" required></label>
    <label>YouTube URL<input name="youtube_url" required></label>
    <label>Description<textarea name="description"></textarea></label>
    <button type="submit" name="action" value="add_training">Add training</button>
  </form>

  <h3 id="resources">Resources</h3>
  <form method="post" action="actions/admin_actions.php">
    <label>Title<input name="res_title" required></label>
    <label>URL<input name="res_url" required></label>
    <label>Description<textarea name="res_desc"></textarea></label>
    <button type="submit" name="action" value="add_resource">Add resource</button>
  </form>

</section>
<?php include 'inc/footer.php'; ?>
