<?php
// setup.php
// Run this once to create tables + seed example data.
// IMPORTANT: After success delete or rename this file.

require_once 'config.php'; // you must create config.php from config-sample.php

$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if ($mysqli->connect_errno) {
    die("DB connection failed: " . $mysqli->connect_error);
}

// Helper to run queries
function run($mysqli, $sql) {
    if ($mysqli->query($sql) === TRUE) { return true; }
    else { die("SQL error: " . $mysqli->error . "\nQuery: $sql"); }
}

// Drop if exists (safe for repeated runs)
$tables = ['user_trainings','resources','training_modules','incidents','users'];
foreach ($tables as $t) {
    $mysqli->query("DROP TABLE IF EXISTS `$t`");
}

// Create tables
run($mysqli, "CREATE TABLE `users` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(120) NOT NULL,
    `email` VARCHAR(150) NOT NULL UNIQUE,
    `password` VARCHAR(255) NOT NULL,
    `role` ENUM('admin','staff') NOT NULL DEFAULT 'staff',
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;");

run($mysqli, "CREATE TABLE `incidents` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `user_id` INT NOT NULL,
    `title` VARCHAR(255) NOT NULL,
    `description` TEXT,
    `severity` ENUM('low','medium','high') DEFAULT 'low',
    `status` ENUM('open','in_progress','closed') DEFAULT 'open',
    `assigned_to` INT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP NULL ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
) ENGINE=InnoDB;");

run($mysqli, "CREATE TABLE `training_modules` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `title` VARCHAR(255) NOT NULL,
    `youtube_url` VARCHAR(255) NOT NULL,
    `description` TEXT,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;");

run($mysqli, "CREATE TABLE `user_trainings` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `user_id` INT NOT NULL,
    `training_id` INT NOT NULL,
    `completed` TINYINT(1) DEFAULT 0,
    `completed_at` DATETIME NULL,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (training_id) REFERENCES training_modules(id) ON DELETE CASCADE
) ENGINE=InnoDB;");

run($mysqli, "CREATE TABLE `resources` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `title` VARCHAR(255) NOT NULL,
    `url` VARCHAR(255) NOT NULL,
    `description` TEXT,
    `uploaded_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;");

// Seed users (admin + staff). Passwords hashed.
$adminPass = password_hash('Admin123!', PASSWORD_DEFAULT);
$staffPass = password_hash('Staff123!', PASSWORD_DEFAULT);

$stmt = $mysqli->prepare("INSERT INTO users (name,email,password,role) VALUES (?,?,?,?)");
$stmt->bind_param('ssss', $n,$e,$p,$r);

$n='Admin User'; $e='admin@cyberguard.local'; $p=$adminPass; $r='admin'; $stmt->execute();
$n='Staff Member'; $e='staff@cyberguard.local'; $p=$staffPass; $r='staff'; $stmt->execute();
$stmt->close();

// Seed training modules (YouTube microlearning links)
$trainings = [
    ["What is Phishing? - Crash Course", "https://www.youtube.com/watch?v=RqWxEAPkwes", "Short explanation of phishing."],
    ["Phishing Explained in 5 Minutes", "https://www.youtube.com/watch?v=Yj3bBlEhtyg", "Recognize and avoid phishing."],
    ["Don't Get Hacked: Cybersecurity in 5 mins", "https://www.youtube.com/watch?v=oFesx-7mDmA", "Quick cybersecurity tips."]
];

$stmt = $mysqli->prepare("INSERT INTO training_modules (title,youtube_url,description) VALUES (?,?,?)");
$stmt->bind_param('sss',$t,$u,$d);
foreach ($trainings as $tr) {
    [$t,$u,$d] = $tr;
    $stmt->execute();
}
$stmt->close();

// Seed resources
$stmt = $mysqli->prepare("INSERT INTO resources (title,url,description) VALUES (?,?,?)");
$stmt->bind_param('sss',$rt,$ru,$rd);
$rt='Incident Response Checklist'; $ru='https://example.com/checklist.pdf'; $rd='Step-by-step incident checklist.';
$stmt->execute();
$rt='Password Policy'; $ru='https://example.com/password-policy.pdf'; $rd='Password best practices.'; $stmt->execute();
$stmt->close();

// Seed sample incidents
// Get staff user id
$res = $mysqli->query("SELECT id FROM users WHERE email='staff@cyberguard.local' LIMIT 1");
$row = $res->fetch_assoc();
$staff_id = $row['id'];

$stmt = $mysqli->prepare("INSERT INTO incidents (user_id,title,description,severity,status) VALUES (?,?,?,?,?)");
$stmt->bind_param('issss',$uid,$tit,$desc,$sev,$stat);
$uid = $staff_id;
$tit = "Phishing email received";
$desc = "Suspicious email claiming to be payroll. User clicked link but did not enter credentials.";
$sev = "medium";
$stat = "open";
$stmt->execute();

$tit = "Lost company laptop";
$desc = "Employee lost a laptop containing company data. Location unknown.";
$sev = "high";
$stat = "in_progress";
$stmt->execute();

echo "Setup complete. Admin login: admin@cyberguard.local / Admin123!\n";
echo "Staff login: staff@cyberguard.local / Staff123!\n";
echo "IMPORTANT: delete or rename setup.php after running it.\n";
