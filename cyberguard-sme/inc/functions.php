<?php
// inc/functions.php
session_start();
require_once __DIR__.'/db.php';

function is_logged_in() {
    return isset($_SESSION['user_id']);
}

function require_login() {
    if (!is_logged_in()) {
        header('Location: index.php');
        exit;
    }
}

function current_user() {
    if (!is_logged_in()) return null;
    global $mysqli;
    $id = intval($_SESSION['user_id']);
    $stmt = $mysqli->prepare("SELECT id,name,email,role FROM users WHERE id=? LIMIT 1");
    $stmt->bind_param('i',$id);
    $stmt->execute();
    $res = $stmt->get_result();
    $row = $res->fetch_assoc();
    $stmt->close();
    return $row;
}

function is_admin() {
    $u = current_user();
    return $u && $u['role'] === 'admin';
}

function sanitize($s) {
    return htmlspecialchars($s, ENT_QUOTES, 'UTF-8');
}
