-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: sql213.infinityfree.com
-- Generation Time: Oct 02, 2025 at 09:59 PM
-- Server version: 11.4.7-MariaDB
-- PHP Version: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `if0_40028085_cyberguard`
--

-- --------------------------------------------------------

--
-- Table structure for table `announcements`
--

CREATE TABLE `announcements` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `importance` enum('low','medium','high') DEFAULT 'low',
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `announcements`
--

INSERT INTO `announcements` (`id`, `title`, `content`, `importance`, `created_at`) VALUES
(15, 'Wi-Fi Guest Network', 'Visitors should use “Company-Guest” SSID. Staff must use the secure SSID only. ??', 'low', '2025-09-30 05:48:12'),
(12, 'USB Device Reminder', 'Unapproved USB drives are not allowed. Use Secure Share for transfers. ??', 'low', '2025-09-30 05:48:12'),
(13, 'Ransomware Awareness', 'Watch the 3-min training in Awareness Center by EOD Friday. ??', 'medium', '2025-09-30 05:48:12'),
(14, 'Incident Response Update', 'New “In Progress” status added. Track your reports in Incident Tracker. ???', 'medium', '2025-09-30 05:48:12'),
(10, 'Mandatory Phishing Drill', 'A simulated phishing email will be sent this week. Do NOT click links—report via the Incident form. ???', 'high', '2025-09-30 05:48:12'),
(11, 'New Password Policy', 'Passphrases now require 12+ characters. Update by Friday via Profile. ??', 'medium', '2025-09-30 05:48:12'),
(9, 'Security Patch Tonight', 'We’ll apply OS & PHP updates at 9:00 PM. Expect a 10–15 min outage. Please save work beforehand. ??', 'high', '2025-09-30 05:48:12'),
(16, 'MFA Rollout', 'Multi-Factor Authentication starts Monday. Check email for setup steps. ??', 'high', '2025-09-30 05:48:12');

-- --------------------------------------------------------

--
-- Table structure for table `announcement_reads`
--

CREATE TABLE `announcement_reads` (
  `id` int(11) NOT NULL,
  `announcement_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `read_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `announcement_reads`
--

INSERT INTO `announcement_reads` (`id`, `announcement_id`, `user_id`, `read_at`) VALUES
(1, 3, 2, '2025-09-29 06:16:00'),
(2, 2, 2, '2025-09-29 06:11:47'),
(3, 1, 2, '2025-09-29 06:12:00'),
(4, 5, 2, '2025-09-29 06:22:43'),
(5, 8, 2, '2025-09-30 04:58:09'),
(6, 7, 2, '2025-09-30 05:39:24'),
(7, 6, 2, '2025-09-30 05:42:21'),
(8, 15, 2, '2025-09-30 05:48:32');

-- --------------------------------------------------------

--
-- Table structure for table `incidents`
--

CREATE TABLE `incidents` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `severity` enum('low','medium','high') DEFAULT 'low',
  `status` enum('open','in_progress','closed') DEFAULT 'open',
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `incidents`
--

INSERT INTO `incidents` (`id`, `user_id`, `title`, `description`, `severity`, `status`, `created_at`) VALUES
(1, 2, 'Phishing Email Reported', 'User received a suspicious email pretending to be IT support.', 'medium', 'open', '2025-09-27 04:29:24'),
(2, 2, 'Lost Laptop', 'A staff member lost a company laptop in a public place.', 'high', 'in_progress', '2025-09-27 04:29:24'),
(3, 2, 'Malware Infection', 'Workstation infected by unknown malware.', 'high', 'closed', '2025-09-27 04:29:24'),
(4, 1, 'Sample Incident', 'this is just a sample incident reporting', 'medium', 'open', '2025-09-27 05:14:13'),
(5, 2, 'Case 1 Test', 'testing db, and handler', 'medium', 'open', '2025-09-27 05:37:32'),
(6, 2, 'lost laptop', 'lost laptop', 'medium', 'open', '2025-09-27 05:38:52'),
(7, 2, 'test', 'laptop', 'low', 'open', '2025-09-27 05:42:53'),
(8, 2, 'abc', 'abc', 'medium', 'in_progress', '2025-09-27 06:12:31'),
(9, 2, 'xyz', 'xyzlkjl', 'low', 'open', '2025-09-29 01:58:44'),
(10, 2, 'Maleware', 'Maleware', 'high', 'open', '2025-09-29 02:43:54');

-- --------------------------------------------------------

--
-- Table structure for table `resources`
--

CREATE TABLE `resources` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `file_url` varchar(255) NOT NULL,
  `uploaded_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `resources`
--

INSERT INTO `resources` (`id`, `title`, `file_url`, `uploaded_at`) VALUES
(4, 'Cybersecurity Policy (Australia)', 'https://www.cyber.gov.au/business-government/asds-cyber-security-frameworks/ism/cybersecurity-guidelines', '2025-09-27 07:52:34'),
(5, 'ACSC Cyber Incident Readiness Checklist (PDF)', 'https://www.cyber.gov.au/sites/default/files/2023-03/ACSC%20Cyber%20Incident%20Readiness%20Checklist_A4.pdf', '2025-09-27 07:52:34'),
(6, 'Password Policy Guidelines', 'https://www.cyber.gov.au/learn-basics/explore-basics/passphrases', '2025-09-27 07:52:34'),
(7, 'Resources library (by: cyber.gov.au)', 'https://www.cyber.gov.au/learn-basics/view-resources/resources-library', '2025-09-29 02:29:39');

-- --------------------------------------------------------

--
-- Table structure for table `training_modules`
--

CREATE TABLE `training_modules` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `url` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `training_modules`
--

INSERT INTO `training_modules` (`id`, `title`, `description`, `url`, `created_at`) VALUES
(4, 'Phishing Awareness', 'Learn how to detect phishing emails.', 'https://www.youtube.com/watch?v=XIe27xh_N0A&pp=ygURV2hhdCBpcyBQaGlzaGluZz8%3D', '2025-09-27 04:38:00'),
(5, 'Password Security', 'Tips for creating strong and secure passwords.', 'https://www.youtube.com/watch?v=3NjQ9b3pgIg', '2025-09-27 04:38:00'),
(6, 'Ransomware Explained', 'What ransomware is and how to prevent it.', 'https://www.youtube.com/watch?v=-KL9APUjj3E', '2025-09-27 04:38:00'),
(7, 'Ultimate Guide to Cybersecurity for Businesses', 'Detailed guide for businesses to protect against cyber threats.', 'https://www.youtube.com/watch?v=QwRnGJdXGaA', '2025-09-27 08:00:41'),
(8, 'A Brief Explanation of Cybersecurity and its Importance', 'Short explanation on why cybersecurity matters for everyone.', 'https://www.youtube.com/watch?v=1vV0t2XbtuU', '2025-09-27 08:00:41'),
(9, 'Why is Cyber Security Important?', 'Understanding the importance of cybersecurity in modern life.', 'https://www.youtube.com/watch?v=C4h9Uw8HAq0', '2025-09-27 08:00:41'),
(10, 'Top 5 Cyber Security Risks for Businesses', 'An overview of the most common cyber risks businesses face.', 'https://www.youtube.com/watch?v=kbpjwL4jawg', '2025-09-27 08:00:41'),
(11, 'The Five Laws of Cybersecurity', 'Quick overview of 5 essential cybersecurity laws everyone should know.', 'https://www.youtube.com/watch?v=_nVq7f26-Uo', '2025-09-27 08:00:41');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(120) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','staff') NOT NULL DEFAULT 'staff',
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `created_at`) VALUES
(1, 'Admin User', 'admin@cyberguard.local', '$2y$10$cqW9XusjhbJ0Tu7dcLAJe.cTlGwXJ.JY2pn3A17g91sZMMg647YCu', 'admin', '2025-09-27 04:29:24'),
(2, 'Staff User', 'staff@cyberguard.local', '$2y$10$vXAi5kIw0ju7Scd3Xcll..9kcLoleimAXMDnMZoQQzEkQM7O2Coe2', 'staff', '2025-09-27 04:29:24'),
(3, 'Tutor', 'tutor@cyberguard.local', '$2y$10$vejy.vqMkhElgNGU7pLCE.Zq55fF2DBazE1ti606isWtp0GNwfOx.', 'staff', '2025-09-27 09:11:43');

-- --------------------------------------------------------

--
-- Table structure for table `user_trainings`
--

CREATE TABLE `user_trainings` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `training_id` int(11) NOT NULL,
  `completed` tinyint(1) DEFAULT 0,
  `completed_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `user_trainings`
--

INSERT INTO `user_trainings` (`id`, `user_id`, `training_id`, `completed`, `completed_at`) VALUES
(1, 2, 4, 1, '2025-09-26 23:23:31'),
(2, 2, 5, 1, '2025-09-26 23:24:29'),
(3, 2, 6, 1, '2025-09-26 23:36:57'),
(5, 2, 7, 1, '2025-09-27 01:07:57'),
(7, 2, 8, 1, '2025-09-27 05:17:03'),
(9, 2, 9, 1, '2025-09-28 18:58:10'),
(11, 2, 10, 1, '2025-09-28 19:42:41');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `announcements`
--
ALTER TABLE `announcements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `announcement_reads`
--
ALTER TABLE `announcement_reads`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uniq_read` (`announcement_id`,`user_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `incidents`
--
ALTER TABLE `incidents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `resources`
--
ALTER TABLE `resources`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `training_modules`
--
ALTER TABLE `training_modules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `user_trainings`
--
ALTER TABLE `user_trainings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uniq_user_training` (`user_id`,`training_id`),
  ADD KEY `training_id` (`training_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `announcements`
--
ALTER TABLE `announcements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `announcement_reads`
--
ALTER TABLE `announcement_reads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `incidents`
--
ALTER TABLE `incidents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `resources`
--
ALTER TABLE `resources`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `training_modules`
--
ALTER TABLE `training_modules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_trainings`
--
ALTER TABLE `user_trainings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `incidents`
--
ALTER TABLE `incidents`
  ADD CONSTRAINT `incidents_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_trainings`
--
ALTER TABLE `user_trainings`
  ADD CONSTRAINT `user_trainings_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_trainings_ibfk_2` FOREIGN KEY (`training_id`) REFERENCES `training_modules` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
