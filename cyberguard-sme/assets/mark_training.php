<?php
require_once '../inc/functions.php';
require_login();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $training_id = intval($_POST['training_id'] ?? 0);

    if ($training_id > 0) {
        // Insert or update
        $stmt = $mysqli->prepare("INSERT INTO user_trainings (user_id, training_id, completed, completed_at)
            VALUES (?, ?, 1, NOW())
            ON DUPLICATE KEY UPDATE completed=1, completed_at=NOW()");
        $stmt->bind_param('ii', $_SESSION['user_id'], $training_id);
        $stmt->execute();
        $stmt->close();

        echo "success";
        exit;
    }
}

echo "error";
exit;
