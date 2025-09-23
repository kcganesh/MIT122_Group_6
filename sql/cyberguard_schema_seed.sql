-- CyberGuard SME schema + seed data
DROP DATABASE IF EXISTS cyberguard_db;
CREATE DATABASE cyberguard_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE cyberguard_db;

-- Users table (id, name, email, password_hash, role, created_at)
CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL,
  email VARCHAR(150) NOT NULL UNIQUE,
  password_hash VARCHAR(255) NOT NULL,
  role ENUM('staff','admin') NOT NULL DEFAULT 'staff',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- Incidents table (id, title, description, reporter_id, status, priority, created_at, updated_at)
CREATE TABLE incidents (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(255) NOT NULL,
  description TEXT,
  reporter_id INT,
  status ENUM('New','Investigating','Resolved','Closed') DEFAULT 'New',
  priority ENUM('Low','Medium','High') DEFAULT 'Medium',
  assigned_to INT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP NULL ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (reporter_id) REFERENCES users(id) ON DELETE SET NULL,
  FOREIGN KEY (assigned_to) REFERENCES users(id) ON DELETE SET NULL
) ENGINE=InnoDB;

-- Trainings / Resources table (id, title, type, url, description, downloads)
CREATE TABLE trainings (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(255) NOT NULL,
  type ENUM('video','document','checklist','policy') DEFAULT 'video',
  url VARCHAR(500),
  description TEXT,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- Seed users (passwords are plain examples; we hash in code using password_hash)
INSERT INTO users (name, email, password_hash, role)
VALUES
('Admin User','admin@example.com', '$2y$10$abcdefghijklmnopqrstuv', 'admin'),
('Staff One','staff1@example.com', '$2y$10$abcdefghijklmnopqrstuv', 'staff'),
('Staff Two','staff2@example.com', '$2y$10$abcdefghijklmnopqrstuv', 'staff');

-- NOTE: above password_hash is placeholder. Replace with real hashes or use register.php to create users.
-- For quick demo: we'll use password "admin123" for admin and "staff123" for staff accounts.
-- To simplify, you can use the following UPDATE to set real hashes:

UPDATE users SET password_hash = '{ADMIN_HASH}' WHERE email='admin@example.com';
UPDATE users SET password_hash = '{STAFF1_HASH}' WHERE email='staff1@example.com';
UPDATE users SET password_hash = '{STAFF2_HASH}' WHERE email='staff2@example.com';

-- Alternatively, run the provided PHP register flow to create accounts.
-- Seed trainings (YouTube videos & docs)
INSERT INTO trainings (title, type, url, description) VALUES
('Phishing 101 - How to Spot a Phish (YouTube)','video','https://www.youtube.com/watch?v=3-LttmZg8vA','Short microlearning: spotting phishing emails.'),
('Password Hygiene (YouTube)','video','https://www.youtube.com/watch?v=7lN1VQxqW9E','Password best practices.'),
('Incident Response Checklist','document','/public/assets/docs/incident_checklist.pdf','Downloadable incident response checklist.');

-- Example incident
INSERT INTO incidents (title, description, reporter_id, status, priority, assigned_to)
VALUES
('Suspicious email reported','User received a credential-stealing email and clicked a link. Not sure what happened.','2','Investigating','High',NULL);
