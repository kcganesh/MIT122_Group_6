<?php
require_once 'inc/functions.php';
require_login();

// Fetch modules
$res = $mysqli->query("SELECT * FROM training_modules ORDER BY created_at DESC");
$modules = [];
while ($r = $res->fetch_assoc()) $modules[] = $r;

// Get completed modules for user
$stmt = $mysqli->prepare("SELECT training_id FROM user_trainings WHERE user_id=? AND completed=1");
$stmt->bind_param('i', $_SESSION['user_id']);
$stmt->execute(); $rc = $stmt->get_result();
$completed = [];
while ($row = $rc->fetch_assoc()) $completed[] = $row['training_id'];
$stmt->close();

include 'inc/header.php';
?>
<section class="card">
  <h2>Cybersecurity Awareness Center</h2>
  <p>Watch the short microlearning videos and click <em>Mark Complete</em> when finished.</p>

  <?php foreach ($modules as $m): 
      // extract youtube id for embed
      preg_match('/v=([^&]+)/', $m['youtube_url'], $match);
      $vid = $match[1] ?? null;
  ?>
    <article class="training">
      <h3><?= sanitize($m['title']) ?></h3>
      <p><?= sanitize($m['description']) ?></p>
      <?php if ($vid): ?>
        <div class="video">
          <iframe width="560" height="315" src="https://www.youtube.com/embed/<?= sanitize($vid) ?>" frameborder="0" allowfullscreen></iframe>
        </div>
      <?php endif; ?>
      <?php if (in_array($m['id'], $completed)): ?>
        <div class="status done">Completed</div>
      <?php else: ?>
        <button class="btn mark-training" data-id="<?= $m['id'] ?>">Mark Complete</button>
      <?php endif; ?>
    </article>
  <?php endforeach; ?>
</section>
<?php include 'inc/footer.php'; ?>
