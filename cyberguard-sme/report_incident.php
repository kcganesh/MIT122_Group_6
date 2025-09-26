<?php
require_once 'inc/functions.php';
require_login();
include 'inc/header.php';
?>
<section class="card">
  <h2>Report an Incident</h2>
  <form id="incidentForm" method="post" action="actions/submit_incident.php">
    <label>Title<input name="title" id="title" required></label>
    <label>Description<textarea name="description" rows="6"></textarea></label>
    <label>Severity
      <select name="severity">
        <option>low</option>
        <option selected>medium</option>
        <option>high</option>
      </select>
    </label>
    <button type="submit">Submit Incident</button>
  </form>
</section>
<?php include 'inc/footer.php'; ?>
