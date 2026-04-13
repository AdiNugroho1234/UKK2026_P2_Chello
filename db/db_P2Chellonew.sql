/*
SQLyog Professional v13.1.1 (64 bit)
MySQL - 8.0.30 : Database - parkir
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`parkir` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;

USE `parkir`;

/*Table structure for table `cache` */

DROP TABLE IF EXISTS `cache`;

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `cache` */

/*Table structure for table `cache_locks` */

DROP TABLE IF EXISTS `cache_locks`;

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `cache_locks` */

/*Table structure for table `failed_jobs` */

DROP TABLE IF EXISTS `failed_jobs`;

CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `failed_jobs` */

/*Table structure for table `job_batches` */

DROP TABLE IF EXISTS `job_batches`;

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `job_batches` */

/*Table structure for table `jobs` */

DROP TABLE IF EXISTS `jobs`;

CREATE TABLE `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `jobs` */

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `migrations` */

insert  into `migrations`(`id`,`migration`,`batch`) values 
(1,'0001_01_01_000000_create_users_table',1),
(2,'0001_01_01_000001_create_cache_table',1),
(3,'0001_01_01_000002_create_jobs_table',1);

/*Table structure for table `password_reset_tokens` */

DROP TABLE IF EXISTS `password_reset_tokens`;

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `password_reset_tokens` */

/*Table structure for table `sessions` */

DROP TABLE IF EXISTS `sessions`;

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text,
  `payload` longtext NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `sessions` */

insert  into `sessions`(`id`,`user_id`,`ip_address`,`user_agent`,`payload`,`last_activity`) values 
('BjYDgDulK2gmp3wpk9SvsecMLQBj670lsJ8ukpdh',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiYmNtdGtEU1pjZFFack9jc0FEWWpYS2YyZjhnR3duVEdMemY1RGdVdyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fX0=',1776056342);

/*Table structure for table `t_area` */

DROP TABLE IF EXISTS `t_area`;

CREATE TABLE `t_area` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama_area` varchar(50) DEFAULT NULL,
  `kapasitas` int DEFAULT '0',
  `terisi` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `t_area` */

insert  into `t_area`(`id`,`nama_area`,`kapasitas`,`terisi`) values 
(4,'Area A',2,NULL);

/*Table structure for table `t_kendaraan` */

DROP TABLE IF EXISTS `t_kendaraan`;

CREATE TABLE `t_kendaraan` (
  `id` int NOT NULL AUTO_INCREMENT,
  `plat_kendaraan` varchar(255) DEFAULT NULL,
  `warna` varchar(20) DEFAULT NULL,
  `status` enum('parkir','selesai') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `id_user` int DEFAULT NULL,
  `id_tarif` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `t_kendaraan` */

insert  into `t_kendaraan`(`id`,`plat_kendaraan`,`warna`,`status`,`id_user`,`id_tarif`,`created_at`) values 
(52,'B1234RPM','Hijau','selesai',NULL,11,'2026-04-10 08:52:48'),
(53,'B1901NON','Hijau','selesai',NULL,11,'2026-04-10 09:33:10'),
(54,'ftff','Hijau','selesai',NULL,11,'2026-04-10 13:41:16'),
(55,'B1234RPM','aa',NULL,NULL,11,NULL);

/*Table structure for table `t_log_aktivitas` */

DROP TABLE IF EXISTS `t_log_aktivitas`;

CREATE TABLE `t_log_aktivitas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_user` int DEFAULT NULL,
  `aktivitas` varchar(255) DEFAULT NULL,
  `waktu_aktivitas` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=505 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `t_log_aktivitas` */

insert  into `t_log_aktivitas`(`id`,`id_user`,`aktivitas`,`waktu_aktivitas`) values 
(432,31,'Logout dari sistem','2026-04-12 15:47:51'),
(433,40,'Login ke sistem','2026-04-12 15:47:56'),
(434,40,'Logout dari sistem','2026-04-12 15:48:12'),
(435,31,'Login ke sistem','2026-04-12 15:48:29'),
(436,31,'Edit user: Admin','2026-04-12 15:48:41'),
(437,31,'Logout dari sistem','2026-04-12 15:49:21'),
(438,40,'Login ke sistem','2026-04-12 15:49:28'),
(439,40,'Logout dari sistem','2026-04-12 15:51:06'),
(440,31,'Login ke sistem','2026-04-12 15:51:13'),
(441,31,'Logout dari sistem','2026-04-12 16:15:35'),
(442,31,'Login ke sistem','2026-04-12 17:15:54'),
(443,31,'Logout dari sistem','2026-04-12 17:36:09'),
(444,41,'Login ke sistem','2026-04-12 17:36:17'),
(445,41,'Masuk: ftff','2026-04-12 17:36:32'),
(446,41,'Logout dari sistem','2026-04-12 17:43:39'),
(447,31,'Login ke sistem','2026-04-12 17:43:46'),
(448,31,'Tambah user: Petugas Malam','2026-04-12 17:46:15'),
(449,31,'Edit user: Petugas Malam','2026-04-12 17:46:32'),
(450,31,'Hapus user: Petugas Malam','2026-04-12 17:46:34'),
(451,31,'Login ke sistem','2026-04-13 05:43:24'),
(452,31,'Edit user: Petugas','2026-04-13 05:45:12'),
(453,31,'Logout dari sistem','2026-04-13 05:45:48'),
(454,31,'Login ke sistem','2026-04-13 05:45:53'),
(455,31,'Edit user: Petugas','2026-04-13 05:46:00'),
(456,31,'Logout dari sistem','2026-04-13 05:46:06'),
(457,41,'Login ke sistem','2026-04-13 05:46:15'),
(458,41,'Keluar: ftff','2026-04-13 05:46:21'),
(459,41,'Logout dari sistem','2026-04-13 05:46:38'),
(460,40,'Login ke sistem','2026-04-13 05:46:44'),
(461,40,'Logout dari sistem','2026-04-13 05:46:56'),
(462,31,'Login ke sistem','2026-04-13 05:47:01'),
(463,31,'Edit user: Petugas','2026-04-13 05:54:02'),
(464,31,'Edit user: Petugas','2026-04-13 05:54:07'),
(465,31,'Edit user: Petugas','2026-04-13 05:54:12'),
(466,31,'Tambah user: Claudia','2026-04-13 05:57:29'),
(467,31,'Logout dari sistem','2026-04-13 06:01:24'),
(468,31,'Login ke sistem','2026-04-13 08:32:53'),
(469,31,'Logout dari sistem','2026-04-13 08:33:07'),
(470,43,'Login ke sistem','2026-04-13 08:33:22'),
(471,43,'Logout dari sistem','2026-04-13 08:33:32'),
(472,31,'Login ke sistem','2026-04-13 08:33:40'),
(473,31,'Logout dari sistem','2026-04-13 08:39:50'),
(474,31,'Login ke sistem','2026-04-13 08:44:47'),
(475,31,'Logout dari sistem','2026-04-13 08:44:58'),
(476,43,'Login ke sistem','2026-04-13 08:45:12'),
(477,43,'Keluar: B1901NON','2026-04-13 08:45:18'),
(478,43,'Logout dari sistem','2026-04-13 08:45:32'),
(479,40,'Login ke sistem','2026-04-13 08:45:38'),
(480,40,'Logout dari sistem','2026-04-13 08:46:48'),
(481,31,'Login ke sistem','2026-04-13 08:46:55'),
(482,31,'Tambah user: aa','2026-04-13 10:31:57'),
(483,31,'Edit user: aa','2026-04-13 10:32:32'),
(484,31,'Edit user: aa','2026-04-13 10:35:06'),
(485,31,'Tambah user: aa','2026-04-13 11:13:22'),
(486,31,'Tambah user: aa','2026-04-13 11:16:02'),
(487,31,'Hapus user: aa','2026-04-13 11:16:10'),
(488,31,'Tambah user: aa','2026-04-13 11:17:48'),
(489,31,'Hapus user: aa','2026-04-13 11:19:19'),
(490,31,'Edit user: aa','2026-04-13 11:20:06'),
(491,31,'Edit user: aa','2026-04-13 11:20:12'),
(492,31,'Edit user: Petugas','2026-04-13 11:20:55'),
(493,31,'Hapus user: Petugas','2026-04-13 11:22:25'),
(494,31,'Hapus user: aa','2026-04-13 11:22:29'),
(495,31,'Hapus user: aa','2026-04-13 11:25:13'),
(496,31,'Hapus user: aa','2026-04-13 11:27:57'),
(497,31,'Edit user: admin','2026-04-13 11:51:31'),
(498,31,'Tambah: B1234RPM','2026-04-13 11:55:52'),
(499,31,'Hapus user: aa','2026-04-13 11:58:16'),
(500,31,'Hapus user: Claudia','2026-04-13 11:58:30'),
(501,31,'Edit user: Petugas','2026-04-13 11:58:40'),
(502,31,'Edit user: Owner','2026-04-13 11:58:49'),
(503,31,'Edit user: admin','2026-04-13 11:58:58'),
(504,31,'Logout dari sistem','2026-04-13 11:59:02');

/*Table structure for table `t_riwayat` */

DROP TABLE IF EXISTS `t_riwayat`;

CREATE TABLE `t_riwayat` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_transaksi` int DEFAULT NULL,
  `plat_kendaraan` varchar(100) DEFAULT NULL,
  `jenis_kendaraan` varchar(100) DEFAULT NULL,
  `nama_area` varchar(100) DEFAULT NULL,
  `waktu_masuk` datetime DEFAULT NULL,
  `waktu_keluar` datetime DEFAULT NULL,
  `durasi` varchar(100) DEFAULT NULL,
  `biaya_total` decimal(15,0) DEFAULT NULL,
  `uang_dibayar` decimal(15,2) DEFAULT NULL,
  `kembalian` decimal(15,2) DEFAULT NULL,
  `id_user` int DEFAULT NULL,
  `shift` enum('pagi','siang','malam') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `status_pembayaran` enum('lunas','pending') DEFAULT NULL,
  `metode_pembayaran` enum('midtrans','cash') DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `t_riwayat` */

insert  into `t_riwayat`(`id`,`id_transaksi`,`plat_kendaraan`,`jenis_kendaraan`,`nama_area`,`waktu_masuk`,`waktu_keluar`,`durasi`,`biaya_total`,`uang_dibayar`,`kembalian`,`id_user`,`shift`,`status_pembayaran`,`metode_pembayaran`,`created_at`) values 
(39,72,'B1234RPM','Motor','Area A','2026-04-10 08:53:00','2026-04-10 08:53:26','0 jam 1 menit',167,167.00,0.00,22,'pagi','lunas','midtrans','2026-04-10 08:54:08'),
(40,74,'ftff','Motor','Area A','2026-04-12 17:36:32','2026-04-13 05:46:21','12 jam 10 menit',121667,1000000.00,878333.00,41,'siang','lunas','cash','2026-04-13 05:46:29'),
(41,73,'B1901NON','Motor','Area A','2026-04-10 13:43:50','2026-04-13 08:45:18','67 jam 2 menit',670333,1000000.00,329667.00,33,NULL,'lunas','cash','2026-04-13 08:45:27');

/*Table structure for table `t_tarif` */

DROP TABLE IF EXISTS `t_tarif`;

CREATE TABLE `t_tarif` (
  `id` int NOT NULL AUTO_INCREMENT,
  `jenis_kendaraan` varchar(255) DEFAULT NULL,
  `tarif_per_jam` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `t_tarif` */

insert  into `t_tarif`(`id`,`jenis_kendaraan`,`tarif_per_jam`) values 
(11,'Motor',10000);

/*Table structure for table `t_transaksi` */

DROP TABLE IF EXISTS `t_transaksi`;

CREATE TABLE `t_transaksi` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_kendaraan` int DEFAULT NULL,
  `id_tarif` int DEFAULT NULL,
  `waktu_masuk` datetime DEFAULT NULL,
  `waktu_keluar` datetime DEFAULT NULL,
  `durasi_jam` int DEFAULT NULL,
  `durasi_menit` int DEFAULT NULL,
  `durasi` varchar(255) DEFAULT NULL,
  `biaya_total` int DEFAULT NULL,
  `shift` enum('pagi','siang','malam') DEFAULT NULL,
  `status` enum('parkir','selesai','keluar') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `id_user` int DEFAULT NULL,
  `id_area` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=75 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `t_transaksi` */

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','petugas','owner') DEFAULT NULL,
  `shift` enum('pagi','siang','malam') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `status` enum('aktif','nonaktif') DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`name`,`email`,`email_verified_at`,`password`,`role`,`shift`,`status`,`remember_token`,`created_at`,`updated_at`) values 
(31,'admin','admin@ukk2026.com',NULL,'$2y$12$8Umj4LYNa6CwkJRcuXuXKubS0EDYv8s3R57EaOiEG0MEQCDC5Dl0C','admin',NULL,'aktif',NULL,'2026-04-10 11:03:44','2026-04-13 11:58:58'),
(40,'Owner','owner@ukk2026.com',NULL,'$2y$12$sPhoVp7Gp3bDPUZv4li18.sruD7IUFhbAysgRNz/KD1ivLq0GLWKK','owner',NULL,'aktif',NULL,'2026-04-12 15:07:34','2026-04-13 11:58:49'),
(41,'Petugas','petugas@ukk2026.com',NULL,'$2y$12$oQpUjQqKy8lCKyKgktsde.vqE97Petjx3Fr/onzeAa446oUwmDk3q','petugas','pagi','aktif',NULL,'2026-04-12 15:16:29','2026-04-13 11:58:40');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
