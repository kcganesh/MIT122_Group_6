<?php
require_once '../inc/functions.php';
require_login();

// Only admins can update
if (!is_admin()) {
    die("Unauthorized");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['id'] ?? 0);
    $status = $_POST['status'] ?? 'open';

    if ($id > 0 && in_array($status, ['open', 'in_progress', 'closed'])) {
        $stmt = $mysqli->prepare("UPDATE incidents SET status=? WHERE id=?");
        $stmt->bind_param('si', $status, $id);
        $stmt->execute();
        $stmt->close();
    }
}

// Redirect back
header('Location: ../cases.php?msg=status+updated');
exit;
