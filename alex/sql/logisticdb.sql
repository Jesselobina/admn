-- Main Database: logisticdb
-- Contains: users table for authentication
-- WARNING: Passwords are in plaintext. This is NOT secure for production.

DROP DATABASE IF EXISTS `logisticdb`;
CREATE DATABASE `logisticdb` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `logisticdb`;

--
-- Table structure for table `users`
--
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL UNIQUE,
  `password` varchar(255) NOT NULL COMMENT 'Plaintext password - FOR DEVELOPMENT ONLY',
  `role` enum('admin','user') NOT NULL DEFAULT 'user',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
-- Default passwords are now in plaintext: 'user123' and 'admin123'
--
INSERT INTO `users` (`id`, `full_name`, `email`, `password`, `role`) VALUES
(1, 'Alexander User', 'peraltalex229@gmail.com', 'user123', 'user'),
(2, 'Alexander Admin', 'peraltalex22@gmail.com', 'admin123', 'admin');
  