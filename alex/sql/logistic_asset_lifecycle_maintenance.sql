CREATE DATABASE IF NOT EXISTS `logistic_asset_lifecycle_maintenance`;
USE `logistic_asset_lifecycle_maintenance`;

CREATE TABLE `assets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `asset_name` varchar(255) NOT NULL,
  `asset_tag` varchar(100) NOT NULL UNIQUE,
  `category` varchar(100) DEFAULT NULL,
  `purchase_date` date NOT NULL,
  `purchase_cost` decimal(10,2) NOT NULL,
  `warranty_expiry` date DEFAULT NULL,
  `status` enum('Operational','Under Maintenance','Decommissioned') DEFAULT 'Operational',
  `location` varchar(255) DEFAULT NULL,
  `assigned_to` varchar(255) DEFAULT NULL,
  `created_at` timestamp DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `maintenance_schedule` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `asset_id` int(11) NOT NULL,
  `maintenance_type` enum('Preventive','Corrective','Predictive') DEFAULT 'Preventive',
  `scheduled_date` date NOT NULL,
  `completed_date` date DEFAULT NULL,
  `technician` varchar(255) DEFAULT NULL,
  `cost` decimal(10,2) DEFAULT NULL,
  `status` enum('Scheduled','In Progress','Completed','Cancelled') DEFAULT 'Scheduled',
  `notes` text DEFAULT NULL,
  `created_at` timestamp DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  FOREIGN KEY (`asset_id`) REFERENCES `assets`(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `depreciation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `asset_id` int(11) NOT NULL,
  `calculation_date` date NOT NULL,
  `current_value` decimal(10,2) NOT NULL,
  `depreciation_rate` decimal(5,2) NOT NULL,
  `method` enum('Straight Line','Declining Balance') DEFAULT 'Straight Line',
  `created_at` timestamp DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  FOREIGN KEY (`asset_id`) REFERENCES `assets`(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `assets` VALUES
(1, 'Forklift Truck #1', 'FL-001', 'Heavy Equipment', '2023-01-20', 2500000.00, '2026-01-20', 'Operational', 'Warehouse A', 'Operator A', '2023-01-20 10:00:00'),
(2, 'Conveyor Belt System', 'CV-SYS-A', 'Processing Equipment', '2022-11-10', 1800000.00, '2025-11-10', 'Under Maintenance', 'Sorting Area', NULL, '2022-11-10 09:00:00');

INSERT INTO `maintenance_schedule` VALUES
(1, 1, 'Preventive', '2025-09-15', NULL, 'Tech Team A', 15000.00, 'Scheduled', 'Regular quarterly maintenance', '2025-09-01 08:00:00'),
(2, 2, 'Corrective', '2025-09-05', '2025-09-06', 'Tech Team B', 45000.00, 'Completed', 'Belt replacement and motor repair', '2025-09-04 14:30:00');

INSERT INTO `depreciation` VALUES
(1, 1, '2025-09-01', 1875000.00, 10.00, 'Straight Line', '2025-09-01 09:00:00');