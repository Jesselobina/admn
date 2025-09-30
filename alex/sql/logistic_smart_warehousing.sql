CREATE DATABASE IF NOT EXISTS `logistic_smart_warehousing`;
USE `logistic_smart_warehousing`;

CREATE TABLE `inventory` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item_name` varchar(255) NOT NULL,
  `sku` varchar(100) NOT NULL UNIQUE,
  `quantity` int(11) NOT NULL,
  `location` varchar(100) DEFAULT NULL,
  `supplier` varchar(150) DEFAULT NULL,
  `date_received` date NOT NULL,
  `last_updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `inventory` VALUES
(1, 'Coca-Cola Original 1.5L', '4801981123456', 800, 'Bev-02', 'Coca-Cola PH', '2025-08-30', '2025-09-06 11:16:56'),
(2, 'Surf Powder Sun Fresh 2.2kg', '4800888123456', 350, 'Aisle F-08', 'Unilever Philippines', '2025-09-03', '2025-09-06 11:16:56');