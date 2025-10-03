<?php
require_once 'inc/db.php';
$email = 'admin@cyberguard.local';
$stmt = $mysqli->prepare("SELECT id, email, password FROM users WHERE email=? LIMIT 1");
$stmt->bind_param('s',$email);
$stmt->execute();
$res = $stmt->get_result();
$row = $res->fetch_assoc();
echo "Found: ".$row['email']."<br>";
echo "Password verify(password): ".(password_verify('password', $row['password']) ? 'OK' : 'FAIL');
