CREATE DATABASE IF NOT EXISTS `logistic_procurement_sourcing`;
USE `logistic_procurement_sourcing`;

CREATE TABLE `vendors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `vendor_name` varchar(255) NOT NULL,
  `contact_person` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `status` enum('Active','Inactive') DEFAULT 'Active',
  `created_at` timestamp DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `purchase_requests` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `request_number` varchar(100) NOT NULL UNIQUE,
  `item_description` text NOT NULL,
  `quantity` int(11) NOT NULL,
  `estimated_cost` decimal(10,2) DEFAULT NULL,
  `requested_by` varchar(255) NOT NULL,
  `status` enum('Pending','Approved','Rejected') DEFAULT 'Pending',
  `created_at` timestamp DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `purchase_orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_number` varchar(100) NOT NULL UNIQUE,
  `vendor_id` int(11) NOT NULL,
  `order_date` date NOT NULL,
  `expected_delivery` date DEFAULT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `status` enum('Pending','Confirmed','Shipped','Delivered','Cancelled') DEFAULT 'Pending',
  `created_at` timestamp DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  FOREIGN KEY (`vendor_id`) REFERENCES `vendors`(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `vendors` VALUES
(1, 'Steel Structures Co.', 'Juan Dela Cruz', 'juan@steelstructures.com', '+63 912 345 6789', '123 Industrial Park, Manila', 'Active', '2025-01-15 09:00:00'),
(2, 'Office Supplies Inc.', 'Maria Santos', 'maria@officesupplies.com', '+63 917 654 3210', '456 Business Ave, Makati', 'Active', '2025-01-16 10:30:00');

INSERT INTO `purchase_requests` VALUES
(1, 'PR-2025-001', 'Office Chairs - Ergonomic', 50, 250000.00, 'John Smith', 'Approved', '2025-01-20 08:00:00'),
(2, 'PR-2025-002', 'Computer Monitors - 24 inch', 25, 187500.00, 'Sarah Johnson', 'Pending', '2025-01-21 09:15:00');

INSERT INTO `purchase_orders` VALUES
(1, 'PO-2025-001', 1, '2025-01-22', '2025-02-05', 250000.00, 'Confirmed', '2025-01-22 10:00:00');