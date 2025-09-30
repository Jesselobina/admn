CREATE DATABASE IF NOT EXISTS `logistic_project_logistic_tracker`;
USE `logistic_project_logistic_tracker`;

CREATE TABLE `projects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_name` varchar(255) NOT NULL,
  `client_name` varchar(255) DEFAULT NULL,
  `start_date` date NOT NULL,
  `end_date` date DEFAULT NULL,
  `status` enum('Planning','In Progress','On Hold','Completed','Cancelled') DEFAULT 'Planning',
  `budget` decimal(15,2) DEFAULT NULL,
  `project_manager` varchar(255) DEFAULT NULL,
  `created_at` timestamp DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `shipments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tracking_number` varchar(100) NOT NULL UNIQUE,
  `project_id` int(11) NOT NULL,
  `origin` varchar(255) NOT NULL,
  `destination` varchar(255) NOT NULL,
  `current_location` varchar(255) DEFAULT NULL,
  `status` enum('Preparing','In Transit','Delayed','Delivered') DEFAULT 'Preparing',
  `estimated_delivery` datetime DEFAULT NULL,
  `created_at` timestamp DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  FOREIGN KEY (`project_id`) REFERENCES `projects`(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `routes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `route_name` varchar(255) NOT NULL,
  `start_point` varchar(255) NOT NULL,
  `end_point` varchar(255) NOT NULL,
  `distance_km` decimal(8,2) DEFAULT NULL,
  `estimated_time_hours` decimal(5,2) DEFAULT NULL,
  `optimized` tinyint(1) DEFAULT 0,
  `created_at` timestamp DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `projects` VALUES
(1, 'Manila Port Expansion', 'Philippine Ports Authority', '2025-08-15', '2026-06-30', 'In Progress', 50000000.00, 'Michael Chen', '2025-08-01 08:00:00'),
(2, 'Cebu Retail Hub Delivery', 'SM Prime Holdings', '2025-09-01', '2025-09-22', 'Completed', 15000000.00, 'Anna Rodriguez', '2025-08-20 09:30:00');

INSERT INTO `shipments` VALUES
(1, 'PH-881-2345', 1, 'Manila Port', 'Quezon City Warehouse', 'In Transit - NLEX', 'In Transit', '2025-09-10 14:00:00', '2025-09-05 10:00:00'),
(2, 'CEB-455-9876', 2, 'Cebu Port', 'SM Cebu', 'Delivered', 'Delivered', '2025-09-08 16:30:00', '2025-09-01 08:00:00');

INSERT INTO `routes` VALUES
(1, 'Manila to Cebu Sea Route', 'Manila Port', 'Cebu Port', 584.00, 24.00, 1, '2025-08-15 14:00:00'),
(2, 'NLEX Heavy Transport', 'Manila', 'Clark', 85.00, 2.50, 1, '2025-08-16 09:00:00');