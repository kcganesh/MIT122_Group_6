<?php
require_once 'inc/functions.php';
require_login();
if (!is_admin()) die("Unauthorized");

// Add User
if (isset($_POST['add_user'])) {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $pass = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = ($_POST['role'] === 'admin') ? 'admin' : 'staff';

    $stmt = $mysqli->prepare("INSERT INTO users (name,email,password,role) VALUES (?,?,?,?)");
    $stmt->bind_param('ssss', $name, $email, $pass, $role);
    $stmt->execute();
    $stmt->close();
    header("Location: admin.php?msg=user+added");
    exit;
}

// Add Training
if (isset($_POST['add_training'])) {
    $title = trim($_POST['title']);
    $desc = trim($_POST['description']);
    $url = trim($_POST['url']);

    $stmt = $mysqli->prepare("INSERT INTO training_modules (title,description,url) VALUES (?,?,?)");
    $stmt->bind_param('sss', $title, $desc, $url);
    $stmt->execute();
    $stmt->close();
    header("Location: admin.php?msg=training+added");
    exit;
}

// Add Resource
if (isset($_POST['add_resource'])) {
    $title = trim($_POST['title']);
    $url = trim($_POST['file_url']);

    $stmt = $mysqli->prepare("INSERT INTO resources (title,file_url) VALUES (?,?)");
    $stmt->bind_param('ss', $title, $url);
    $stmt->execute();
    $stmt->close();
    header("Location: admin.php?msg=resource+added");
    exit;
}

// Add Announcement
if (isset($_POST['add_announcement'])) {
    $title = trim($_POST['title']);
    $content = trim($_POST['content']);
    $importance = in_array($_POST['importance'], ['low','medium','high']) ? $_POST['importance'] : 'low';

    $stmt = $mysqli->prepare("INSERT INTO announcements (title,content,importance) VALUES (?,?,?)");
    $stmt->bind_param('sss', $title, $content, $importance);
    $stmt->execute();
    $stmt->close();
    header("Location: admin.php?msg=announcement+added");
    exit;
}

// Fetch Data
$users = $mysqli->query("SELECT * FROM users ORDER BY id DESC");
$trainings = $mysqli->query("SELECT * FROM training_modules ORDER BY id DESC");
$resources = $mysqli->query("SELECT * FROM resources ORDER BY id DESC");
$announcements = $mysqli->query("SELECT * FROM announcements ORDER BY created_at DESC");

include 'inc/header.php';
?>
<section class="card">
  <h2>Admin Panel</h2>
  <?php if (isset($_GET['msg'])): ?>
    <div class="notice"><?= sanitize($_GET['msg']) ?></div>
  <?php endif; ?>

  <!-- Users -->
  <h3>Users</h3>
  <form method="post">
    <input type="hidden" name="add_user" value="1">
    <label>Name<input name="name" required></label>
    <label>Email<input name="email" type="email" required></label>
    <label>Password<input name="password" type="password" required></label>
    <label>Role
      <select name="role">
        <option value="staff">Staff</option>
        <option value="admin">Admin</option>
      </select>
    </label>
    <button class="btn" type="submit">Add User</button>
  </form>
  <table class="table">
    <thead><tr><th>ID</th><th>Name</th><th>Email</th><th>Role</th></tr></thead>
    <tbody>
      <?php while($u=$users->fetch_assoc()): ?>
      <tr><td><?= $u['id'] ?></td><td><?= sanitize($u['name']) ?></td><td><?= sanitize($u['email']) ?></td><td><?= $u['role'] ?></td></tr>
      <?php endwhile; ?>
    </tbody>
  </table>

  <!-- Trainings -->
  <h3>Training Modules</h3>
  <form method="post">
    <input type="hidden" name="add_training" value="1">
    <label>Title<input name="title" required></label>
    <label>Description<textarea name="description" required></textarea></label>
    <label>YouTube URL<input name="url" required></label>
    <button class="btn" type="submit">Add Training</button>
  </form>
  <table class="table">
    <thead><tr><th>ID</th><th>Title</th><th>Description</th></tr></thead>
    <tbody>
      <?php while($t=$trainings->fetch_assoc()): ?>
      <tr><td><?= $t['id'] ?></td><td><?= sanitize($t['title']) ?></td><td><?= sanitize($t['description']) ?></td></tr>
      <?php endwhile; ?>
    </tbody>
  </table>

  <!-- Resources -->
  <h3>Resources</h3>
  <form method="post">
    <input type="hidden" name="add_resource" value="1">
    <label>Title<input name="title" required></label>
    <label>File URL<input name="file_url" required></label>
    <button class="btn" type="submit">Add Resource</button>
  </form>
  <table class="table">
    <thead><tr><th>ID</th><th>Title</th><th>Link</th></tr></thead>
    <tbody>
      <?php while($r=$resources->fetch_assoc()): ?>
      <tr><td><?= $r['id'] ?></td><td><?= sanitize($r['title']) ?></td><td><a href="<?= sanitize($r['file_url']) ?>" target="_blank">View</a></td></tr>
      <?php endwhile; ?>
    </tbody>
  </table>

    <!-- Announcements -->
  <h3>Announcements</h3>
  <form method="post">
    <input type="hidden" name="add_announcement" value="1">
    <label>Title<input name="title" required></label>
    <label>Content<textarea name="content" required></textarea></label>
    <label>Importance
      <select name="importance">
        <option value="low">Low</option>
        <option value="medium">Medium</option>
        <option value="high">High</option>
      </select>
    </label>
    <button class="btn" type="submit">Add Announcement</button>
  </form>

  <table class="table">
    <thead><tr><th>ID</th><th>Title</th><th>Importance</th><th>Created At</th><th>Read Status</th></tr></thead>
    <tbody>
      <?php while($a=$announcements->fetch_assoc()): ?>
      <tr>
        <td><?= $a['id'] ?></td>
        <td><?= sanitize($a['title']) ?></td>
        <td><?= $a['importance'] ?></td>
        <td><?= $a['created_at'] ?></td>
        <td>
          <a href="admin.php?view_announcement=<?= $a['id'] ?>">View Readers</a>
        </td>
      </tr>
      <?php endwhile; ?>
    </tbody>
  </table>

  <?php
  // If admin clicked "View Readers"
  if (isset($_GET['view_announcement'])) {
      $aid = intval($_GET['view_announcement']);

      // Fetch all users
      $usersRes = $mysqli->query("SELECT id, name, email FROM users ORDER BY id ASC");
      echo "<h4>Read Status for Announcement #$aid</h4>";
      echo "<table class='table'><thead><tr><th>User</th><th>Email</th><th>Status</th><th>Read At</th></tr></thead><tbody>";

      while($u = $usersRes->fetch_assoc()) {
          $stmt = $mysqli->prepare("SELECT read_at FROM announcement_reads WHERE announcement_id=? AND user_id=?");
          $stmt->bind_param('ii', $aid, $u['id']);
          $stmt->execute();
          $res = $stmt->get_result();
          $row = $res->fetch_assoc();
          $stmt->close();

          if ($row) {
              echo "<tr><td>".sanitize($u['name'])."</td><td>".sanitize($u['email'])."</td><td style='color:green;font-weight:bold'>Read</td><td>".$row['read_at']."</td></tr>";
          } else {
              echo "<tr><td>".sanitize($u['name'])."</td><td>".sanitize($u['email'])."</td><td style='color:red;font-weight:bold'>Unread</td><td>-</td></tr>";
          }
      }
      echo "</tbody></table>";
  }
  ?>

</section>
<?php include 'inc/footer.php'; ?>
