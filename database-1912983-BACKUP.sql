-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.10-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             11.2.0.6213
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for database-1912983
CREATE DATABASE IF NOT EXISTS `database-1912983` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `database-1912983`;

-- Dumping structure for table database-1912983.customers
CREATE TABLE IF NOT EXISTS `customers` (
  `customer_uuid` char(36) NOT NULL DEFAULT uuid(),
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `address` varchar(25) NOT NULL,
  `city` varchar(25) NOT NULL,
  `province` varchar(25) NOT NULL,
  `postal_code` char(7) NOT NULL,
  `username` varchar(12) NOT NULL,
  `password` varchar(255) NOT NULL,
  `create_date` datetime NOT NULL DEFAULT current_timestamp(),
  `last_update_date` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`customer_uuid`) USING BTREE,
  UNIQUE KEY `username` (`username`),
  KEY `city` (`city`),
  KEY `province` (`province`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='04/06/2021 - Danial Gosse\r\nCreated table\r\n04/07/2021 - Danial Gosse\r\nUpdated tables to add create date and update date';

-- Dumping data for table database-1912983.customers: ~7 rows (approximately)
/*!40000 ALTER TABLE `customers` DISABLE KEYS */;
INSERT INTO `customers` (`customer_uuid`, `first_name`, `last_name`, `address`, `city`, `province`, `postal_code`, `username`, `password`, `create_date`, `last_update_date`) VALUES
	('05dd8019-aaf7-11eb-ae44-b06ebfce7bee', 'Test', 'Ing', 'Test drive', 'Montreal', 'Valley', 'h34 9l0', 'Test', '$2y$10$uK1f6OvGvt.eoiLCZ6ooJuuDNg7hzIXj1NCtvXOwzXSf9z6YOBL7G', '2021-05-01 23:32:28', '2021-05-01 23:32:28'),
	('091f8bdf-aaf6-11eb-ae44-b06ebfce7bee', 'Addy', 'Mina', '1200 Green ave', 'Montreal', 'Quebec', 'H3N 1L8', 'Admin', '$2y$10$SwZEwD5HFB/NzGXniLQwh.gCxym2lZIuPRr5th6OWqK07CbruG1xO', '2021-05-01 23:25:24', '2021-05-01 23:25:24'),
	('343db4a7-aaf7-11eb-ae44-b06ebfce7bee', 'Test', 'Ing', 'Test drive', 'Montreal', 'Valley', 'h34 9l0', 'Test1', '$2y$10$qWgEhVuK.PP1OkRuaneyj.vFLpG8wtkM7Z6ILPkfhyPo9YeEIBuoy', '2021-05-01 23:33:46', '2021-05-01 23:33:46'),
	('517547e5-aaf7-11eb-ae44-b06ebfce7bee', 'Test', 'Ing', 'Test drive', 'Montreal', 'Valley', 'h34 9l0', 'Test10', '$2y$10$iRpt1BxNGtOw8r13AxP2ueJ2u9mxDVkSYRyjjQ/RIKVPnp.UTKZte', '2021-05-01 23:34:35', '2021-05-01 23:34:35'),
	('5ac104ff-aaf7-11eb-ae44-b06ebfce7bee', 'Test', 'Ing', 'Test drive', 'Montreal', 'Valley', 'h34 9l0', 'Test101', '$2y$10$Cb5bF9j2.TBnq7Ij6xYzCOTI81G0039.HFN4QJmcJEv3lXZGGQ2cC', '2021-05-01 23:34:51', '2021-05-01 23:34:51'),
	('9a36b006-aacd-11eb-ae44-b06ebfce7bee', 'Bob', 'Ross', '1888 Evergreen Road', 'NewField', 'Toronto', 'M8h 1l9', 'Bob2020', '$2y$10$KKpd..67asE2VEjJrANVDe5FjlxIFPTdZ8SgNa0rpWIF2oAZ9emb6', '2021-05-01 18:35:58', '2021-05-01 23:18:49'),
	('a50a3bb7-aaf6-11eb-ae44-b06ebfce7bee', 'Danial', 'Gosse', 'Everland', 'Montreal', 'Quebec', 'H2N 9L9', 'Danial', '$2y$10$RWsYRaPi0Au/DRGi.AWZput2Htm6uv7XOFWu70tRIHeP1LFbP9Dni', '2021-05-01 23:29:46', '2021-05-01 23:38:38');
/*!40000 ALTER TABLE `customers` ENABLE KEYS */;

-- Dumping structure for procedure database-1912983.delete_customer
DELIMITER //
CREATE PROCEDURE `delete_customer`(
	IN `p_customer_uuid` VARCHAR(36)
)
BEGIN
	#Revision history:
	#Danial Gosse (1912983)
	#04/07/2021
	#Created the stored procedure
	DELETE
	FROM customers
	WHERE customer_uuid = p_customer_uuid;
END//
DELIMITER ;

-- Dumping structure for procedure database-1912983.delete_product
DELIMITER //
CREATE PROCEDURE `delete_product`(
	IN `p_product_uuid` VARCHAR(36)
)
BEGIN
	#Revision history:
	#Danial Gosse (1912983)
	#04/07/2021
	#Created the stored procedure
	DELETE
	FROM products
	WHERE product_uuid = p_product_uuid;
END//
DELIMITER ;

-- Dumping structure for procedure database-1912983.delete_purchase
DELIMITER //
CREATE PROCEDURE `delete_purchase`(
	IN `p_purchase_uuid` CHAR(36)
)
BEGIN
	#Revision history:
	#Danial Gosse (1912983)
	#04/07/2021
	#Created the stored procedure
	DELETE
	FROM purchases
	WHERE purchase_uuid = p_purchase_uuid;
END//
DELIMITER ;

-- Dumping structure for procedure database-1912983.filter_purchase
DELIMITER //
CREATE PROCEDURE `filter_purchase`(
	IN `p_customer_uuid` CHAR(36),
	IN `p_create_date` DATETIME
)
BEGIN
	SELECT products.product_code, customers.first_name, customers.last_name, 
	customers.city, purchases.comments, products.product_price, 
	purchases.purchase_quantity, purchases.subtotal, purchases.tax_amount, purchases.grand_total,
	purchases.purchase_uuid, purchases.customer_uuid, purchases.product_uuid
	FROM purchases 
	INNER JOIN products 
	ON purchases.product_uuid = products.product_uuid
	INNER JOIN customers
	ON purchases.customer_uuid = customers.customer_uuid
	WHERE purchases.create_date >= p_create_date AND 
	purchases.customer_uuid = p_customer_uuid
	ORDER BY purchases.create_date DESC;
END//
DELIMITER ;

-- Dumping structure for procedure database-1912983.get_password
DELIMITER //
CREATE PROCEDURE `get_password`(
	IN `p_username` VARCHAR(12)
)
BEGIN
	#Revision history:
	#Danial Gosse (1912983)
	#04/07/2021
	#Created the stored procedure
	SELECT password
	FROM customers
	WHERE username = p_username;
END//
DELIMITER ;

-- Dumping structure for procedure database-1912983.insert_customer
DELIMITER //
CREATE PROCEDURE `insert_customer`(
	IN `p_first_name` VARCHAR(20),
	IN `p_last_name` VARCHAR(20),
	IN `p_address` VARCHAR(25),
	IN `p_city` VARCHAR(25),
	IN `p_province` VARCHAR(25),
	IN `p_postal_code` CHAR(7),
	IN `p_username` VARCHAR(12),
	IN `p_password` VARCHAR(255)
)
BEGIN
	#Revision history:
	#Danial Gosse (1912983)
	#04/07/2021
	#Created the stored procedure
	###Not recommended to use this procedure
	###because password isn't encrypted
	INSERT INTO customers(first_name, last_name,
	address, city, province, postal_code, 
	username, PASSWORD)
	VALUES(p_first_name, p_last_name, p_address,
	p_city, p_province,p_postal_code, p_username, 
	p_password);
END//
DELIMITER ;

-- Dumping structure for procedure database-1912983.insert_product
DELIMITER //
CREATE PROCEDURE `insert_product`(
	IN `p_product_code` VARCHAR(12),
	IN `p_product_description` VARCHAR(100),
	IN `p_product_price` DECIMAL(5,2),
	IN `p_product_cost_price` DECIMAL(5,2)
)
BEGIN
	#Revision history:
	#Danial Gosse (1912983)
	#04/07/2021
	#Created the stored procedure
	INSERT INTO products(product_code, product_description,
	product_price, product_cost_price )
	VALUES(p_product_code, p_product_description, 
	p_product_price, p_product_cost_price);
END//
DELIMITER ;

-- Dumping structure for procedure database-1912983.insert_purchase
DELIMITER //
CREATE PROCEDURE `insert_purchase`(
	IN `p_customer_uuid` CHAR(36),
	IN `p_product_uuid` CHAR(36),
	IN `p_purchase_quantity` INT,
	IN `p_comments` VARCHAR(200),
	IN `p_subtotal` INT,
	IN `p_tax_amount` INT,
	IN `p_grand_total` INT
)
BEGIN
	#Revision history:
	#Danial Gosse (1912983)
	#04/07/2021
	#Created the stored procedure
	#04/26/2021
	#added comments,subtotal,taxamount,grandtotal
	INSERT INTO purchases(customer_uuid, product_uuid,
	purchase_quantity, comments, subtotal, tax_amount, grand_total)
	VALUES(p_customer_uuid, p_product_uuid, 
	p_purchase_quantity, p_comments, p_subtotal, p_tax_amount, p_grand_total);
END//
DELIMITER ;

-- Dumping structure for table database-1912983.products
CREATE TABLE IF NOT EXISTS `products` (
  `product_uuid` char(36) NOT NULL DEFAULT uuid(),
  `product_code` varchar(12) NOT NULL,
  `product_description` varchar(100) NOT NULL,
  `product_price` decimal(5,2) NOT NULL,
  `product_cost_price` decimal(5,2) DEFAULT NULL,
  `create_date` datetime NOT NULL DEFAULT current_timestamp(),
  `last_update_date` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`product_uuid`),
  UNIQUE KEY `product_code` (`product_code`),
  KEY `product_price` (`product_price`),
  KEY `product_cost_price` (`product_cost_price`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='04/06/2021 - Danial Gosse\r\nCreated table\r\n04/07/2021 - Danial Gosse\r\nUpdated tables to add create date and update date';

-- Dumping data for table database-1912983.products: ~5 rows (approximately)
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` (`product_uuid`, `product_code`, `product_description`, `product_price`, `product_cost_price`, `create_date`, `last_update_date`) VALUES
	('142c1072-aacd-11eb-ae44-b06ebfce7bee', 'PX81', 'Yeezy Slides', 99.99, 43.25, '2021-05-01 18:32:13', '2021-05-01 18:32:13'),
	('2d4a2131-aacd-11eb-ae44-b06ebfce7bee', 'PX82', 'YZY shirt 1549', 60.00, 22.89, '2021-05-01 18:32:54', '2021-05-01 18:32:55'),
	('48dbbd5f-aacd-11eb-ae44-b06ebfce7bee', 'PX83', 'Yeezy boost', 329.99, 108.67, '2021-05-01 18:33:42', '2021-05-01 18:33:42'),
	('5f130df8-aacd-11eb-ae44-b06ebfce7bee', 'PX84', 'Adidas Foam Runner', 167.99, 57.88, '2021-05-01 18:34:19', '2021-05-01 18:34:19'),
	('ee10b18b-aacc-11eb-ae44-b06ebfce7bee', 'PX80', 'Yeezy Calabasas Hoodie', 120.00, 60.00, '2021-05-01 18:31:09', '2021-05-01 18:31:28');
/*!40000 ALTER TABLE `products` ENABLE KEYS */;

-- Dumping structure for table database-1912983.purchases
CREATE TABLE IF NOT EXISTS `purchases` (
  `purchase_uuid` char(36) NOT NULL DEFAULT uuid(),
  `customer_uuid` char(36) NOT NULL,
  `product_uuid` char(36) NOT NULL,
  `purchase_quantity` int(3) NOT NULL,
  `comments` varchar(200) DEFAULT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  `tax_amount` decimal(10,2) NOT NULL,
  `grand_total` decimal(10,2) NOT NULL,
  `create_date` datetime NOT NULL DEFAULT current_timestamp(),
  `last_update_date` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`purchase_uuid`) USING BTREE,
  KEY `FK_purchases_customers` (`customer_uuid`),
  KEY `FK_purchases_products` (`product_uuid`),
  CONSTRAINT `FK_purchases_customers` FOREIGN KEY (`customer_uuid`) REFERENCES `customers` (`customer_uuid`),
  CONSTRAINT `FK_purchases_products` FOREIGN KEY (`product_uuid`) REFERENCES `products` (`product_uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='04/06/2021 - Danial Gosse\r\nCreated table\r\n04/07/2021 - Danial Gosse\r\nUpdated tables to add create date and update date\r\n04/26/2021 - Danial Gosse\r\nUpdated tables to add subtotal,\r\ngrand total, tax amount, and comments';

-- Dumping data for table database-1912983.purchases: ~14 rows (approximately)
/*!40000 ALTER TABLE `purchases` DISABLE KEYS */;
INSERT INTO `purchases` (`purchase_uuid`, `customer_uuid`, `product_uuid`, `purchase_quantity`, `comments`, `subtotal`, `tax_amount`, `grand_total`, `create_date`, `last_update_date`) VALUES
	('026487b8-aaf8-11eb-ae44-b06ebfce7bee', 'a50a3bb7-aaf6-11eb-ae44-b06ebfce7bee', '48dbbd5f-aacd-11eb-ae44-b06ebfce7bee', 1, 'WHITE', 330.00, 50.00, 380.00, '2021-05-01 23:39:32', '2021-05-01 23:39:32'),
	('0be760d0-aaf8-11eb-ae44-b06ebfce7bee', 'a50a3bb7-aaf6-11eb-ae44-b06ebfce7bee', '2d4a2131-aacd-11eb-ae44-b06ebfce7bee', 1, 'BLACK', 60.00, 9.00, 69.00, '2021-05-01 23:39:48', '2021-05-01 23:39:48'),
	('3321cbe0-aaf8-11eb-ae44-b06ebfce7bee', '091f8bdf-aaf6-11eb-ae44-b06ebfce7bee', '5f130df8-aacd-11eb-ae44-b06ebfce7bee', 12, '', 2016.00, 306.00, 2322.00, '2021-05-01 23:40:54', '2021-05-01 23:40:54'),
	('36afed15-aaf8-11eb-ae44-b06ebfce7bee', '091f8bdf-aaf6-11eb-ae44-b06ebfce7bee', '48dbbd5f-aacd-11eb-ae44-b06ebfce7bee', 99, '', 32669.00, 4966.00, 37635.00, '2021-05-01 23:41:00', '2021-05-01 23:41:00'),
	('3e1c27e9-aaf8-11eb-ae44-b06ebfce7bee', '091f8bdf-aaf6-11eb-ae44-b06ebfce7bee', '2d4a2131-aacd-11eb-ae44-b06ebfce7bee', 54, '', 3240.00, 492.00, 3732.00, '2021-05-01 23:41:12', '2021-05-01 23:41:12'),
	('441cb91d-aaf8-11eb-ae44-b06ebfce7bee', '091f8bdf-aaf6-11eb-ae44-b06ebfce7bee', '5f130df8-aacd-11eb-ae44-b06ebfce7bee', 86, '', 14464.00, 2199.00, 16662.00, '2021-05-01 23:41:22', '2021-05-01 23:41:22'),
	('954958d9-aaf9-11eb-ae44-b06ebfce7bee', '091f8bdf-aaf6-11eb-ae44-b06ebfce7bee', '5f130df8-aacd-11eb-ae44-b06ebfce7bee', 55, '', 9239.00, 1404.00, 10644.00, '2021-05-01 23:50:48', '2021-05-01 23:50:48'),
	('a8bef756-aaf5-11eb-ae44-b06ebfce7bee', '9a36b006-aacd-11eb-ae44-b06ebfce7bee', '48dbbd5f-aacd-11eb-ae44-b06ebfce7bee', 4, 'Good shoes', 1320.00, 201.00, 1521.00, '2021-05-01 23:22:42', '2021-05-01 23:22:42'),
	('aa7603a5-aaf8-11eb-ae44-b06ebfce7bee', '091f8bdf-aaf6-11eb-ae44-b06ebfce7bee', '5f130df8-aacd-11eb-ae44-b06ebfce7bee', 77, '', 12918.00, 1964.00, 14882.00, '2021-05-01 23:44:14', '2021-05-01 23:44:14'),
	('ac11ba21-aaea-11eb-ae44-b06ebfce7bee', '9a36b006-aacd-11eb-ae44-b06ebfce7bee', '5f130df8-aacd-11eb-ae44-b06ebfce7bee', 53, '', 8903.00, 1353.00, 10257.00, '2021-05-01 22:04:03', '2021-05-01 22:04:03'),
	('af1feb36-aaf5-11eb-ae44-b06ebfce7bee', '9a36b006-aacd-11eb-ae44-b06ebfce7bee', '2d4a2131-aacd-11eb-ae44-b06ebfce7bee', 1, 'WHITE', 60.00, 9.00, 69.00, '2021-05-01 23:22:53', '2021-05-01 23:22:53'),
	('b5a4f196-aaf5-11eb-ae44-b06ebfce7bee', '9a36b006-aacd-11eb-ae44-b06ebfce7bee', '142c1072-aacd-11eb-ae44-b06ebfce7bee', 2, '', 200.00, 30.00, 230.00, '2021-05-01 23:23:04', '2021-05-01 23:23:04'),
	('c198a0d6-aaf8-11eb-ae44-b06ebfce7bee', '091f8bdf-aaf6-11eb-ae44-b06ebfce7bee', '142c1072-aacd-11eb-ae44-b06ebfce7bee', 77, '', 7699.00, 1170.00, 8870.00, '2021-05-01 23:44:53', '2021-05-01 23:44:53'),
	('fadf2ccd-aaf7-11eb-ae44-b06ebfce7bee', 'a50a3bb7-aaf6-11eb-ae44-b06ebfce7bee', 'ee10b18b-aacc-11eb-ae44-b06ebfce7bee', 1, 'BLACK', 120.00, 18.00, 138.00, '2021-05-01 23:39:19', '2021-05-01 23:39:19');
/*!40000 ALTER TABLE `purchases` ENABLE KEYS */;

-- Dumping structure for view database-1912983.purchases_view
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `purchases_view` (
	`first_name` VARCHAR(20) NOT NULL COLLATE 'utf8mb4_general_ci',
	`last_name` VARCHAR(20) NOT NULL COLLATE 'utf8mb4_general_ci',
	`address` VARCHAR(25) NOT NULL COLLATE 'utf8mb4_general_ci',
	`city` VARCHAR(25) NOT NULL COLLATE 'utf8mb4_general_ci',
	`province` VARCHAR(25) NOT NULL COLLATE 'utf8mb4_general_ci',
	`postal_code` CHAR(7) NOT NULL COLLATE 'utf8mb4_general_ci',
	`username` VARCHAR(12) NOT NULL COLLATE 'utf8mb4_general_ci',
	`password` VARCHAR(255) NOT NULL COLLATE 'utf8mb4_general_ci',
	`product_code` VARCHAR(12) NOT NULL COLLATE 'utf8mb4_general_ci',
	`product_description` VARCHAR(100) NOT NULL COLLATE 'utf8mb4_general_ci',
	`product_price` DECIMAL(5,2) NOT NULL,
	`product_cost_price` DECIMAL(5,2) NULL,
	`purchase_quantity` INT(3) NOT NULL,
	`purchase_uuid` CHAR(36) NOT NULL COLLATE 'utf8mb4_general_ci',
	`customer_uuid` CHAR(36) NOT NULL COLLATE 'utf8mb4_general_ci',
	`product_uuid` CHAR(36) NOT NULL COLLATE 'utf8mb4_general_ci',
	`create_date` DATETIME NOT NULL,
	`last_update_date` DATETIME NOT NULL
) ENGINE=MyISAM;

-- Dumping structure for procedure database-1912983.select_all_customers
DELIMITER //
CREATE PROCEDURE `select_all_customers`()
BEGIN
	#Revision history:
	#Danial Gosse (1912983)
	#04/07/2021
	#Created the stored procedure
	SELECT customer_uuid, first_name, last_name,
	address, city, province, postal_code, 
	username, PASSWORD, create_date, last_update_date
	FROM customers
	ORDER BY last_update_date DESC;
END//
DELIMITER ;

-- Dumping structure for procedure database-1912983.select_all_products
DELIMITER //
CREATE PROCEDURE `select_all_products`()
BEGIN
	#Revision history:
	#Danial Gosse (1912983)
	#04/07/2021
	#Created the stored procedure
	#04/26/2021
	#updated to include product cost price
	SELECT product_uuid, product_code, 
	product_description, product_price,
	product_cost_price,
	create_date, last_update_date
	FROM products
	ORDER BY last_update_date DESC;
END//
DELIMITER ;

-- Dumping structure for procedure database-1912983.select_all_purchases
DELIMITER //
CREATE PROCEDURE `select_all_purchases`()
BEGIN
	#Revision history:
	#Danial Gosse (1912983)
	#04/07/2021
	#Created the stored procedure
	SELECT purchase_uuid, customer_uuid, 
	product_uuid, purchase_quantity, create_date,
	last_update_date
	FROM purchases
	ORDER BY last_update_date DESC;
END//
DELIMITER ;

-- Dumping structure for procedure database-1912983.select_one_customer
DELIMITER //
CREATE PROCEDURE `select_one_customer`(
	IN `p_username` VARCHAR(12)
)
BEGIN
	#Revision history:
	#Danial Gosse (1912983)
	#04/07/2021
	#Created the stored procedure
	#04/21/2021
	#changed uppercase password to lowecase
	#change where to username instead of uuid
	SELECT customer_uuid, first_name, last_name,
	address, city, province, postal_code, 
	username, password, create_date, last_update_date
	FROM customers
	WHERE username = p_username;
END//
DELIMITER ;

-- Dumping structure for procedure database-1912983.select_one_product
DELIMITER //
CREATE PROCEDURE `select_one_product`(
	IN `p_product_uuid` VARCHAR(36)
)
BEGIN
	#Revision history:
	#Danial Gosse (1912983)
	#04/07/2021
	#Created the stored procedure
	SELECT product_uuid, product_code, 
	product_cost_price, product_description, 
	product_price, create_date, last_update_date
	FROM products
	WHERE product_uuid = p_product_uuid
	ORDER BY last_update_date DESC;
END//
DELIMITER ;

-- Dumping structure for procedure database-1912983.select_one_purchase
DELIMITER //
CREATE PROCEDURE `select_one_purchase`(
	IN `p_purchase_uuid` CHAR(36)
)
BEGIN
	SELECT purchase_uuid, customer_uuid, 
		product_uuid, purchase_quantity, create_date,
		last_update_date
	FROM purchases
	WHERE purchase_uuid = p_purchase_uuid
	ORDER BY last_update_date DESC;
END//
DELIMITER ;

-- Dumping structure for procedure database-1912983.update_customer
DELIMITER //
CREATE PROCEDURE `update_customer`(
	IN `p_customer_uuid` VARCHAR(36),
	IN `p_first_name` VARCHAR(20),
	IN `p_last_name` VARCHAR(20),
	IN `p_address` VARCHAR(25),
	IN `p_city` VARCHAR(25),
	IN `p_province` VARCHAR(25),
	IN `p_postal_code` CHAR(7),
	IN `p_username` VARCHAR(12),
	IN `p_password` VARCHAR(255)
)
BEGIN
	#Revision history:
	#Danial Gosse (1912983)
	#04/07/2021
	#Created the stored procedure
	UPDATE customers
	SET first_name = p_first_name, 
	last_name = p_last_name, 
	address = p_address,
	address = p_address, 
	city = p_city,
	province = p_province, 
	postal_code = p_postal_code,
	username = p_username,
	password = p_password
	WHERE customer_uuid = p_customer_uuid; 
END//
DELIMITER ;

-- Dumping structure for procedure database-1912983.update_products
DELIMITER //
CREATE PROCEDURE `update_products`(
	IN `p_product_uuid` CHAR(36),
	IN `p_product_code` VARCHAR(12),
	IN `p_product_description` VARCHAR(100),
	IN `p_product_price` DECIMAL(5,2),
	IN `p_product_cost_price` DECIMAL(5,2)
)
BEGIN
	#Revision history:
	#Danial Gosse (1912983)
	#04/07/2021
	#Created the stored procedure
	UPDATE products
	SET product_code = p_product_code, 
	product_description = p_product_description, 
	product_price = p_product_price,
	product_cost_price = p_product_cost_price
	WHERE product_uuid  = p_product_uuid; 
END//
DELIMITER ;

-- Dumping structure for procedure database-1912983.update_purchases
DELIMITER //
CREATE PROCEDURE `update_purchases`(
	IN `p_purchase_uuid` CHAR(36),
	IN `p_customer_uuid` CHAR(36),
	IN `p_product_uuid` CHAR(36),
	IN `p_purchase_quantity` INT
)
BEGIN
	#Revision history:
	#Danial Gosse (1912983)
	#04/07/2021
	#Created the stored procedure
	UPDATE purchases
	SET customer_uuid = p_customer_uuid, 
	product_uuid = p_product_uuid, 
	purchase_quantity = p_purchase_quantity
	WHERE purchase_uuid  = p_purchase_uuid; 
END//
DELIMITER ;

-- Dumping structure for view database-1912983.purchases_view
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `purchases_view`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `purchases_view` AS select `c`.`first_name` AS `first_name`,`c`.`last_name` AS `last_name`,`c`.`address` AS `address`,`c`.`city` AS `city`,`c`.`province` AS `province`,`c`.`postal_code` AS `postal_code`,`c`.`username` AS `username`,`c`.`password` AS `password`,`prod`.`product_code` AS `product_code`,`prod`.`product_description` AS `product_description`,`prod`.`product_price` AS `product_price`,`prod`.`product_cost_price` AS `product_cost_price`,`p`.`purchase_quantity` AS `purchase_quantity`,`p`.`purchase_uuid` AS `purchase_uuid`,`p`.`customer_uuid` AS `customer_uuid`,`p`.`product_uuid` AS `product_uuid`,`p`.`create_date` AS `create_date`,`p`.`last_update_date` AS `last_update_date` from ((`purchases` `p` join `customers` `c` on(`p`.`customer_uuid` = `c`.`customer_uuid`)) join `products` `prod` on(`p`.`product_uuid` = `prod`.`product_uuid`)) order by `p`.`last_update_date` desc;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
