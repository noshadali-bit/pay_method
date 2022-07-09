/*
SQLyog Ultimate v12.5.0 (64 bit)
MySQL - 10.4.24-MariaDB : Database - link_generator
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `customers` */

DROP TABLE IF EXISTS `customers`;

CREATE TABLE `customers` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `customer_email` varchar(255) NOT NULL,
  `billing_firstname` varchar(255) DEFAULT NULL,
  `billing_lastname` varchar(255) DEFAULT NULL,
  `billing_address` text DEFAULT NULL,
  `billing_city` varchar(255) DEFAULT NULL,
  `billing_state` varchar(255) DEFAULT NULL,
  `postal_code` varchar(255) DEFAULT NULL,
  `billing_country` varchar(255) DEFAULT NULL,
  `billing_email` varchar(255) DEFAULT NULL,
  `billing_phonenumber` varchar(255) DEFAULT NULL,
  `sales_email` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `customer_email` (`customer_email`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

/*Data for the table `customers` */

insert  into `customers`(`id`,`customer_email`,`billing_firstname`,`billing_lastname`,`billing_address`,`billing_city`,`billing_state`,`postal_code`,`billing_country`,`billing_email`,`billing_phonenumber`,`sales_email`,`created_at`,`updated_at`) values 
(1,'customer@gmail.com','John','Doe','Delhi','Delhi','Delhi','09000','India','customer@gmail.com','1234567891','sales@gmail.com','2022-07-06 21:44:07','2022-07-07 00:50:41'),
(2,'customer1@gmail.com','User1','user1last','add','c','pp','123456','con','customer1@gmail.com','1234567891','sale1@gmail.com','2022-07-07 00:55:58','2022-07-07 00:55:58'),
(3,'customer2@gmail.com','F','L','A','C','P','Z','C','customer2@gmail.com','1234567891','sales2@gmail.com','2022-07-07 01:31:33','2022-07-07 01:31:33'),
(4,'customer3@gmail.com','Jack','Reacher','New York','New York','New York','123456','USA','customer3@gmail.com','1234567891','sales3@gmail.com','2022-07-07 01:35:32','2022-07-07 01:35:32');

/*Table structure for table `failed_jobs` */

DROP TABLE IF EXISTS `failed_jobs`;

CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `failed_jobs` */

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `migrations` */

insert  into `migrations`(`id`,`migration`,`batch`) values 
(1,'2014_10_12_000000_create_users_table',1),
(2,'2014_10_12_100000_create_password_resets_table',1),
(3,'2019_08_19_000000_create_failed_jobs_table',1),
(4,'2019_12_14_000001_create_personal_access_tokens_table',1);

/*Table structure for table `packages` */

DROP TABLE IF EXISTS `packages`;

CREATE TABLE `packages` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `package_name` varchar(255) DEFAULT NULL,
  `payment_id` bigint(20) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `packages` */

/*Table structure for table `password_resets` */

DROP TABLE IF EXISTS `password_resets`;

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `password_resets` */

/*Table structure for table `payment_logs` */

DROP TABLE IF EXISTS `payment_logs`;

CREATE TABLE `payment_logs` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `transaction_id` varchar(255) DEFAULT NULL,
  `amount` float DEFAULT NULL,
  `currency` varchar(255) DEFAULT NULL,
  `payment_status` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `payment_logs` */

/*Table structure for table `payments` */

DROP TABLE IF EXISTS `payments`;

CREATE TABLE `payments` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `payment_id` varchar(255) DEFAULT NULL,
  `payer_id` varchar(255) DEFAULT NULL,
  `payment_status` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `payment_gateway` varchar(255) DEFAULT NULL,
  `sale_amount` float DEFAULT NULL,
  `sale_currency` varchar(255) DEFAULT NULL,
  `customer_id` bigint(20) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `customer_id` (`customer_id`),
  CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

/*Data for the table `payments` */

insert  into `payments`(`id`,`payment_id`,`payer_id`,`payment_status`,`description`,`payment_gateway`,`sale_amount`,`sale_currency`,`customer_id`,`created_at`,`updated_at`) values 
(1,'PAYID-MLDAD4I17670379XT617481D','8MMM86DXG54R8','Completed','Description','paypal',1,'USD',1,'2022-07-06 21:44:07','2022-07-06 21:44:07'),
(2,'PAYID-MLDAF3Y6MM5549340692105N','8MMM86DXG54R8','Completed','Desc','paypal',2,'USD',1,'2022-07-06 21:47:50','2022-07-06 21:47:50'),
(3,NULL,NULL,NULL,'Description','stripe',2,'USD',1,'2022-07-07 00:50:41','2022-07-07 00:50:41'),
(4,NULL,NULL,NULL,'My Description','stripe',12,'USD',2,'2022-07-07 00:56:13','2022-07-07 00:56:13'),
(5,'PAYID-MLDDQMI1L223659TV4463142','8MMM86DXG54R8','Completed','Desc','paypal',2,'USD',4,'2022-07-07 01:35:32','2022-07-07 01:35:32'),
(6,'PAYID-MLDNTQY58B40035BN163235N','8MMM86DXG54R8','Completed','Desc','paypal',1,'USD',1,'2022-07-07 13:05:00','2022-07-07 13:05:00');

/*Table structure for table `personal_access_tokens` */

DROP TABLE IF EXISTS `personal_access_tokens`;

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `personal_access_tokens` */

/*Table structure for table `stripe_payments` */

DROP TABLE IF EXISTS `stripe_payments`;

CREATE TABLE `stripe_payments` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `payment_gateway` varchar(255) DEFAULT NULL,
  `stripeToken` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `sale_amount` float DEFAULT NULL,
  `sale_currency` varchar(255) DEFAULT NULL,
  `name_oncard` varchar(255) DEFAULT NULL,
  `card_number` varchar(255) DEFAULT NULL,
  `cvv` varchar(255) DEFAULT NULL,
  `expiration_month` varchar(255) DEFAULT NULL,
  `expiration_year` varchar(255) DEFAULT NULL,
  `customer_id` bigint(20) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

/*Data for the table `stripe_payments` */

insert  into `stripe_payments`(`id`,`payment_gateway`,`stripeToken`,`description`,`sale_amount`,`sale_currency`,`name_oncard`,`card_number`,`cvv`,`expiration_month`,`expiration_year`,`customer_id`,`created_at`,`updated_at`) values 
(1,'stripe','tok_1LIjZ1IJM8g1wMASZ3DZEKZH','Dess',35,'USD','Jack','4242424242424242','321','05','2025',3,'2022-07-07 01:31:34','2022-07-07 01:31:34'),
(2,'stripe','tok_1LIuSSIJM8g1wMASrdB923Mc','desc',2,'USD','John Doe','4242424242424242','321','01','2027',1,'2022-07-07 13:09:28','2022-07-07 13:09:28'),
(3,'authorize',NULL,'Desc',3,'USD','John Doe','4242424242424242','321','01','2025',1,'2022-07-07 15:58:55','2022-07-07 15:58:55'),
(4,'authorize',NULL,'Description',23,'USD','Simon','4111111111111111','123','08','2025',1,'2022-07-07 16:17:39','2022-07-07 16:17:39');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'User',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`name`,`email`,`email_verified_at`,`password`,`role_type`,`remember_token`,`created_at`,`updated_at`) values 
(1,'Admin','admin@gmail.com',NULL,'$2y$10$f/NKiihjo4hihT5t3AyIFeque7mOy7LKbiHZIpVEYshrXpojE6vcq','Admin',NULL,'2022-07-07 23:36:40','2022-07-07 23:36:40');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
