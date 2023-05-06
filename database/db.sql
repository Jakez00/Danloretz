/*
SQLyog Ultimate v12.09 (64 bit)
MySQL - 10.4.28-MariaDB : Database - danloretz
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`danloretz` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;

USE `danloretz`;

/*Table structure for table `failed_jobs` */

DROP TABLE IF EXISTS `failed_jobs`;

CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `failed_jobs` */

/*Table structure for table `items` */

DROP TABLE IF EXISTS `items`;

CREATE TABLE `items` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `item_name` varchar(255) NOT NULL,
  `item_type` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `item_store` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `items` */

/*Table structure for table `itemtypes` */

DROP TABLE IF EXISTS `itemtypes`;

CREATE TABLE `itemtypes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `itemtypename` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `created_by` varchar(255) NOT NULL,
  `store` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `itemtypes` */

insert  into `itemtypes`(`id`,`itemtypename`,`description`,`created_by`,`store`,`created_at`,`updated_at`,`deleted_at`) values (4,'dress',NULL,'3',3,'2023-05-06 07:00:34','2023-05-06 07:00:34',NULL);

/*Table structure for table `logs` */

DROP TABLE IF EXISTS `logs`;

CREATE TABLE `logs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `store` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `logs` */

insert  into `logs`(`id`,`user_id`,`description`,`store`,`created_at`,`updated_at`,`deleted_at`) values (1,1,'Karen Gwapa has been deleted',NULL,'2023-05-06 06:53:50','2023-05-06 06:53:50',NULL),(2,1,'New user Karen Nina has been added',NULL,'2023-05-06 06:54:07','2023-05-06 06:54:07',NULL),(3,1,'New Branch Pc Store has been added',NULL,'2023-05-06 06:55:31','2023-05-06 06:55:31',NULL),(4,1,'Branch Ukay2 updated',NULL,'2023-05-06 06:55:55','2023-05-06 06:55:55',NULL),(5,1,'Jake has been updated',NULL,'2023-05-06 06:56:26','2023-05-06 06:56:26',NULL),(6,3,'New Item Dress has been added',3,'2023-05-06 06:58:13','2023-05-06 06:58:13',NULL),(7,3,'New Item Dress has been added',3,'2023-05-06 06:59:42','2023-05-06 06:59:42',NULL),(8,3,'New Item dress has been added',NULL,'2023-05-06 07:00:21','2023-05-06 07:00:21',NULL),(9,3,'Item  has been deleted',NULL,'2023-05-06 07:00:27','2023-05-06 07:00:27',NULL),(10,3,'New Item dress has been added',NULL,'2023-05-06 07:00:34','2023-05-06 07:00:34',NULL);

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `migrations` */

insert  into `migrations`(`id`,`migration`,`batch`) values (6,'2014_10_12_000000_create_users_table',1),(7,'2014_10_12_100000_create_password_reset_tokens_table',1),(8,'2019_08_19_000000_create_failed_jobs_table',1),(9,'2019_12_14_000001_create_personal_access_tokens_table',1),(10,'2023_05_06_060008_create_items_table',1),(11,'2023_05_06_061801_create_storebranchs_table',2),(12,'2023_05_06_061822_create_logs_table',2),(13,'2023_05_06_061835_create_itemtypes_table',2);

/*Table structure for table `password_reset_tokens` */

DROP TABLE IF EXISTS `password_reset_tokens`;

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `password_reset_tokens` */

/*Table structure for table `personal_access_tokens` */

DROP TABLE IF EXISTS `personal_access_tokens`;

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `personal_access_tokens` */

/*Table structure for table `storebranch` */

DROP TABLE IF EXISTS `storebranch`;

CREATE TABLE `storebranch` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `storename` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `location` varchar(255) NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `storebranch` */

insert  into `storebranch`(`id`,`storename`,`description`,`location`,`created_by`,`created_at`,`updated_at`,`deleted_at`) values (1,'Pc Store','Computer Parts','Alabang',1,'2023-05-06 06:31:28','2023-05-06 06:35:49','2023-05-06 06:35:49'),(2,'Brom',NULL,'Wazap',1,'2023-05-06 06:33:13','2023-05-06 06:34:34','2023-05-06 06:34:34'),(3,'Ukay2',NULL,'Leyte',1,'2023-05-06 06:37:00','2023-05-06 06:55:55',NULL),(4,'dd',NULL,'d',1,'2023-05-06 06:37:20','2023-05-06 06:47:54','2023-05-06 06:47:54'),(5,'ss',NULL,'1',1,'2023-05-06 06:38:59','2023-05-06 06:48:09','2023-05-06 06:48:09'),(6,'Pc Store','Computer Parts','Alabang',1,'2023-05-06 06:55:31','2023-05-06 06:55:31',NULL);

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `firstname` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `store` int(11) DEFAULT NULL,
  `role` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`username`,`firstname`,`lastname`,`store`,`role`,`email`,`password`,`created_by`,`created_at`,`updated_at`,`deleted_at`) values (1,'Jake','Jake','Getil',NULL,1,'jakegetil@gmail.com','$2y$10$DQIXDYcpQl4d3o2UZMFj9.2o3q467VMAYh9RaOBnEiQKJo5vBs58S',NULL,NULL,'2023-05-06 06:56:26',NULL),(2,'Karen','Karen','Gwapa',NULL,1,'karen@gmail.com','$2y$10$8mPTw0eDM8ILhwz0QdX4JeqDKSQ4TJ5Ob9tUoJNIRCuLyrQfiFvwe',1,'2023-05-06 06:53:12','2023-05-06 06:53:50','2023-05-06 06:53:50'),(3,'Karen Nina','Karen Nina','Galia',3,2,'kayekare683@gmail.com','$2y$10$qOqCM8PICuVu2BukEIMp1.QpXjU4MzGlOjg5MfDlSt2nbJGFtnGKa',1,'2023-05-06 06:54:07','2023-05-06 06:54:07',NULL);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
