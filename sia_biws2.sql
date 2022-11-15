/*
SQLyog Ultimate v12.5.1 (64 bit)
MySQL - 10.4.20-MariaDB : Database - sia_biws2
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`sia_biws2` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `sia_biws2`;

/*Table structure for table `akumulasi_penyusutan` */

DROP TABLE IF EXISTS `akumulasi_penyusutan`;

CREATE TABLE `akumulasi_penyusutan` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `akun_akumulasi_penyusutan_id` int(11) DEFAULT NULL,
  `penyusutan_aset_id` int(11) DEFAULT NULL,
  `nilai_akumulasi_penyusutan` decimal(15,2) DEFAULT NULL,
  `tahun_akumulasi_penyusutan` year(4) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `akun_akumulasi_penyusutan_id` (`akun_akumulasi_penyusutan_id`),
  KEY `penyusutan_aset_id` (`penyusutan_aset_id`),
  CONSTRAINT `akumulasi_penyusutan_ibfk_1` FOREIGN KEY (`akun_akumulasi_penyusutan_id`) REFERENCES `akun` (`id`),
  CONSTRAINT `akumulasi_penyusutan_ibfk_2` FOREIGN KEY (`penyusutan_aset_id`) REFERENCES `penyusutan_aset` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

/*Data for the table `akumulasi_penyusutan` */

insert  into `akumulasi_penyusutan`(`id`,`akun_akumulasi_penyusutan_id`,`penyusutan_aset_id`,`nilai_akumulasi_penyusutan`,`tahun_akumulasi_penyusutan`) values 
(1,3,1,0.00,2022),
(2,1,2,0.00,2022),
(4,1,4,0.00,2022);

/*Table structure for table `akun` */

DROP TABLE IF EXISTS `akun`;

CREATE TABLE `akun` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kategori_akun_id` int(11) DEFAULT NULL,
  `nama_akun` varchar(50) DEFAULT NULL,
  `kode_akun` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `kategori_akun_id` (`kategori_akun_id`),
  CONSTRAINT `akun_ibfk_1` FOREIGN KEY (`kategori_akun_id`) REFERENCES `kategori_akun` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

/*Data for the table `akun` */

insert  into `akun`(`id`,`kategori_akun_id`,`nama_akun`,`kode_akun`) values 
(1,1,'Kas Kecil','1001'),
(3,4,'Pendapatan Penjualan Jasa','4001'),
(4,4,'Diskon Penjualan Jasa','4002'),
(5,5,'Gaji Staf','5001'),
(6,5,'Pajak Pertambahan Nilai','5002');

/*Table structure for table `aset` */

DROP TABLE IF EXISTS `aset`;

CREATE TABLE `aset` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `akun_aset_id` int(11) DEFAULT NULL,
  `nama_aset` varchar(255) DEFAULT NULL,
  `kode_aset` varchar(30) DEFAULT NULL,
  `deskripsi_aset` text DEFAULT NULL,
  `tgl_perolehan` date DEFAULT NULL,
  `harga_perolehan` decimal(15,2) DEFAULT NULL,
  `status_aset` tinyint(1) DEFAULT NULL,
  `dapat_disusutkan` enum('y','n') DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `akun_aset_id` (`akun_aset_id`),
  CONSTRAINT `aset_ibfk_1` FOREIGN KEY (`akun_aset_id`) REFERENCES `akun` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

/*Data for the table `aset` */

insert  into `aset`(`id`,`akun_aset_id`,`nama_aset`,`kode_aset`,`deskripsi_aset`,`tgl_perolehan`,`harga_perolehan`,`status_aset`,`dapat_disusutkan`) values 
(1,1,'Mobil pickup','PU001','Mobil pickup operasional PT. BSI (B 9999 BSI)','2022-01-01',125000000.00,1,'y'),
(2,1,'Contoh','B119','','2022-02-24',150000.00,2,'y'),
(3,1,'Test Aset','B129','','2022-02-24',250000.00,1,'n'),
(5,1,'Komputer','PC001','','2022-03-10',10725000.00,1,'y');

/*Table structure for table `aset_dibeli` */

DROP TABLE IF EXISTS `aset_dibeli`;

CREATE TABLE `aset_dibeli` (
  `pembelian_aset_id` int(11) DEFAULT NULL,
  `aset_id` int(11) DEFAULT NULL,
  KEY `pembelian_aset_id` (`pembelian_aset_id`),
  KEY `aset_id` (`aset_id`),
  CONSTRAINT `aset_dibeli_ibfk_1` FOREIGN KEY (`pembelian_aset_id`) REFERENCES `pembelian_aset` (`id`),
  CONSTRAINT `aset_dibeli_ibfk_2` FOREIGN KEY (`aset_id`) REFERENCES `aset` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `aset_dibeli` */

insert  into `aset_dibeli`(`pembelian_aset_id`,`aset_id`) values 
(2,5);

/*Table structure for table `auth_activation_attempts` */

DROP TABLE IF EXISTS `auth_activation_attempts`;

CREATE TABLE `auth_activation_attempts` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(255) NOT NULL,
  `user_agent` varchar(255) NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `auth_activation_attempts` */

/*Table structure for table `auth_groups` */

DROP TABLE IF EXISTS `auth_groups`;

CREATE TABLE `auth_groups` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

/*Data for the table `auth_groups` */

insert  into `auth_groups`(`id`,`name`,`description`) values 
(1,'Super admin','Akses sistem secara menyeluruh'),
(2,'Staf','Akses sistem secara terbatas'),
(3,'Manajer','Akses khusus manajer perusahaan'),
(6,'Kasir','Akses sistem untuk keuangan'),
(7,'Owner','Akses khusus pemilik');

/*Table structure for table `auth_groups_permissions` */

DROP TABLE IF EXISTS `auth_groups_permissions`;

CREATE TABLE `auth_groups_permissions` (
  `group_id` int(11) unsigned NOT NULL DEFAULT 0,
  `permission_id` int(11) unsigned NOT NULL DEFAULT 0,
  KEY `auth_groups_permissions_permission_id_foreign` (`permission_id`),
  KEY `group_id_permission_id` (`group_id`,`permission_id`),
  CONSTRAINT `auth_groups_permissions_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `auth_groups` (`id`) ON DELETE CASCADE,
  CONSTRAINT `auth_groups_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `auth_permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `auth_groups_permissions` */

/*Table structure for table `auth_groups_users` */

DROP TABLE IF EXISTS `auth_groups_users`;

CREATE TABLE `auth_groups_users` (
  `group_id` int(11) unsigned NOT NULL DEFAULT 0,
  `user_id` int(11) unsigned NOT NULL DEFAULT 0,
  KEY `auth_groups_users_user_id_foreign` (`user_id`),
  KEY `group_id_user_id` (`group_id`,`user_id`),
  CONSTRAINT `auth_groups_users_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `auth_groups` (`id`) ON DELETE CASCADE,
  CONSTRAINT `auth_groups_users_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `auth_groups_users` */

insert  into `auth_groups_users`(`group_id`,`user_id`) values 
(1,1),
(2,2);

/*Table structure for table `auth_logins` */

DROP TABLE IF EXISTS `auth_logins`;

CREATE TABLE `auth_logins` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `user_id` int(11) unsigned DEFAULT NULL,
  `date` datetime NOT NULL,
  `success` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `email` (`email`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=105 DEFAULT CHARSET=utf8;

/*Data for the table `auth_logins` */

insert  into `auth_logins`(`id`,`ip_address`,`email`,`user_id`,`date`,`success`) values 
(1,'::1','tpdmailku@superrito.com',1,'2022-02-06 21:05:27',1),
(2,'::1','tpdmailku@superrito.com',1,'2022-02-06 21:24:17',1),
(3,'::1','tpdmailku@superrito.com',1,'2022-02-07 10:34:47',1),
(4,'::1','tpdmailku@superrito.com',1,'2022-02-08 12:19:25',1),
(5,'::1','tpdmailku@superrito.com',1,'2022-02-09 11:19:10',1),
(6,'::1','tpdmailku@superrito.com',1,'2022-02-09 23:26:07',1),
(7,'::1','tpdmailku@superrito.com',1,'2022-02-10 10:50:16',1),
(8,'::1','tpdmailku@superrito.com',1,'2022-02-10 15:11:39',1),
(9,'::1','theprastdije',NULL,'2022-02-11 11:39:40',0),
(10,'::1','tpdmailku@superrito.com',1,'2022-02-11 11:39:53',1),
(11,'::1','tpdmailku@superrito.com',1,'2022-02-11 14:36:36',1),
(12,'::1','tpdmailku@superrito.com',1,'2022-02-11 14:59:53',1),
(13,'::1','tpdmailku@superrito.com',1,'2022-02-12 17:27:11',1),
(14,'::1','tpdmailku@superrito.com',1,'2022-02-13 11:24:40',1),
(15,'::1','tpdmailku@superrito.com',1,'2022-02-13 19:46:18',1),
(16,'::1','tpdmailku@superrito.com',1,'2022-02-14 10:16:57',1),
(17,'::1','tpdmailku@superrito.com',1,'2022-02-15 10:51:22',1),
(18,'::1','tpdmailku@superrito.com',1,'2022-02-16 11:22:15',1),
(19,'::1','tpdmailku@superrito.com',1,'2022-02-17 10:50:17',1),
(20,'::1','tpdmailku@superrito.com',1,'2022-02-17 15:34:14',1),
(21,'::1','tpdmailku@superrito.com',1,'2022-02-18 10:55:34',1),
(22,'::1','tpdmailku@superrito.com',1,'2022-02-19 10:52:25',1),
(23,'::1','tpdmailku@superrito.com',1,'2022-02-20 12:36:29',1),
(24,'::1','tpdmailku@superrito.com',1,'2022-02-20 22:10:31',1),
(25,'::1','tpdmailku@superrito.com',1,'2022-02-21 08:23:16',1),
(26,'::1','tpdmailku@superrito.com',1,'2022-02-21 11:39:35',1),
(27,'::1','tpdmailku@superrito.com',1,'2022-02-22 15:06:50',1),
(28,'::1','tpdmailku@superrito.com',1,'2022-02-23 20:47:34',1),
(29,'::1','tpdmailku@superrito.com',1,'2022-02-24 12:02:19',1),
(30,'::1','tpdmailku@superrito.com',1,'2022-02-25 10:14:58',1),
(31,'::1','tpdmailku@superrito.com',1,'2022-02-26 10:50:38',1),
(32,'::1','tpdmailku@superrito.com',1,'2022-02-26 21:55:49',1),
(33,'::1','tpdmailku@superrito.com',1,'2022-02-27 14:46:52',1),
(34,'::1','tpdmailku@superrito.com',1,'2022-02-28 12:36:49',1),
(35,'::1','tpdmailku@superrito.com',1,'2022-03-01 11:53:20',1),
(36,'::1','tpdmailku@superrito.com',1,'2022-03-02 11:54:52',1),
(37,'::1','tpdmailku@superrito.com',1,'2022-03-03 12:32:07',1),
(38,'::1','tpdmailku@superrito.com',1,'2022-03-04 10:46:19',1),
(39,'::1','tpdmailku@superrito.com',1,'2022-03-05 13:03:03',1),
(40,'::1','tpdmailku@superrito.com',1,'2022-03-06 10:25:46',1),
(41,'::1','tpdmailku@superrito.com',1,'2022-03-07 11:23:54',1),
(42,'::1','tpdmailku@superrito.com',1,'2022-03-07 19:35:05',1),
(43,'::1','tpdmailku@superrito.com',1,'2022-03-08 11:51:19',1),
(44,'::1','tpdmailku@superrito.com',1,'2022-03-09 11:30:10',1),
(45,'::1','tpdmailku@superrito.com',1,'2022-03-10 12:18:37',1),
(46,'::1','tpdmailku@superrito.com',1,'2022-03-11 11:41:04',1),
(47,'::1','tpdmailku@superrito.com',1,'2022-03-11 15:25:39',1),
(48,'::1','tpdmailku@superrito.com',1,'2022-03-11 21:57:16',1),
(49,'::1','tpdmailku@superrito.com',1,'2022-03-12 11:22:49',1),
(50,'::1','tpdmailku@superrito.com',1,'2022-03-12 11:28:59',1),
(51,'::1','tpdmailku@superrito.com',1,'2022-03-12 22:16:35',1),
(52,'::1','tpdmailku@superrito.com',1,'2022-03-13 12:53:13',1),
(53,'::1','tpdmailku@superrito.com',1,'2022-03-14 15:01:08',1),
(54,'::1','tpdmailku@superrito.com',1,'2022-03-15 15:31:48',1),
(55,'::1','tpdmailku@superrito.com',1,'2022-03-16 11:03:05',1),
(56,'::1','tpdmailku@superrito.com',1,'2022-03-16 22:38:08',1),
(57,'::1','tpdmailku@superrito.com',1,'2022-03-17 11:26:07',1),
(58,'::1','tpdmailku@superrito.com',1,'2022-03-18 12:08:36',1),
(59,'::1','tpdmailku@superrito.com',1,'2022-03-19 22:32:28',1),
(60,'::1','tpdmailku@superrito.com',1,'2022-03-20 21:24:33',1),
(61,'::1','tpdmailku@superrito.com',1,'2022-03-21 11:53:00',1),
(62,'::1','tpdmailku@superrito.com',1,'2022-03-21 23:24:23',1),
(63,'::1','tpdmailku@superrito.com',1,'2022-03-22 11:26:43',1),
(64,'::1','staf1@ptbsi.co.id',2,'2022-03-22 17:08:20',1),
(65,'::1','tpdmailku@superrito.com',1,'2022-03-22 17:46:04',1),
(66,'::1','tpdmailku@superrito.com',1,'2022-03-23 15:22:12',1),
(67,'::1','tpdmailku@superrito.com',1,'2022-03-24 12:51:10',1),
(68,'::1','tpdmailku@superrito.com',1,'2022-03-25 12:48:54',1),
(69,'::1','tpdmailku@superrito.com',1,'2022-03-26 11:21:27',1),
(70,'::1','tpdmailku@superrito.com',1,'2022-03-27 13:08:23',1),
(71,'::1','tpdmailku@superrito.com',1,'2022-03-28 15:42:40',1),
(72,'::1','tpdmailku@superrito.com',1,'2022-03-28 19:59:58',1),
(73,'::1','tpdmailku@superrito.com',1,'2022-03-29 11:48:03',1),
(74,'::1','tpdmailku@superrito.com',1,'2022-03-30 12:37:57',1),
(75,'::1','stafbaliindah',NULL,'2022-03-30 14:55:05',0),
(76,'::1','staf1@ptbsi.co.id',2,'2022-03-30 14:55:37',1),
(77,'::1','tpdmailku@superrito.com',1,'2022-03-30 14:57:41',1),
(78,'::1','staf1@ptbsi.co.id',2,'2022-03-31 00:08:17',1),
(79,'::1','tpdmailku@superrito.com',1,'2022-03-31 00:49:18',1),
(80,'::1','tpdmailku@superrito.com',1,'2022-03-31 10:30:35',1),
(81,'::1','staf1@ptbsi.co.id',2,'2022-03-31 11:20:50',1),
(82,'::1','theprastdije',NULL,'2022-03-31 11:23:34',0),
(83,'::1','tpdmailku@superrito.com',1,'2022-03-31 11:23:44',1),
(84,'::1','tpdmailku@superrito.com',1,'2022-04-01 11:22:08',1),
(85,'::1','tpdmailku@superrito.com',1,'2022-04-01 12:34:37',1),
(86,'::1','tpdmailku@superrito.com',1,'2022-04-03 21:42:10',1),
(87,'::1','tpdmailku@superrito.com',1,'2022-04-04 14:56:55',1),
(88,'::1','tpdmailku@superrito.com',1,'2022-04-05 11:58:22',1),
(89,'::1','tpdmailku@superrito.com',1,'2022-04-06 11:25:09',1),
(90,'::1','tpdmailku@superrito.com',1,'2022-04-10 21:18:37',1),
(91,'::1','tpdmailku@superrito.com',1,'2022-04-11 23:31:50',1),
(92,'::1','staf1@ptbsi.co.id',2,'2022-04-12 00:01:45',1),
(93,'::1','tpdmailku@superrito.com',1,'2022-04-12 00:10:50',1),
(94,'::1','tpdmailku@superrito.com',1,'2022-04-12 20:17:39',1),
(95,'::1','staf1@ptbsi.co.id',2,'2022-04-12 21:04:03',1),
(96,'::1','tpdmailku@superrito.com',1,'2022-04-12 21:09:22',1),
(97,'::1','tpdmailku@superrito.com',1,'2022-04-13 11:03:18',1),
(98,'::1','tpdmailku@superrito.com',1,'2022-04-14 13:57:48',1),
(99,'::1','tpdmailku@superrito.com',1,'2022-04-15 12:11:23',1),
(100,'::1','tpdmailku@superrito.com',1,'2022-04-17 20:55:43',1),
(101,'::1','tpdmailku@superrito.com',1,'2022-04-18 11:27:18',1),
(102,'::1','tpdmailku@superrito.com',1,'2022-04-19 23:08:59',1),
(103,'::1','tpdmailku@superrito.com',1,'2022-04-20 11:56:01',1),
(104,'::1','tpdmailku@superrito.com',1,'2022-04-21 12:15:17',1);

/*Table structure for table `auth_permissions` */

DROP TABLE IF EXISTS `auth_permissions`;

CREATE TABLE `auth_permissions` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `auth_permissions` */

insert  into `auth_permissions`(`id`,`name`,`description`) values 
(1,'kelola-menu','Kelola menu');

/*Table structure for table `auth_reset_attempts` */

DROP TABLE IF EXISTS `auth_reset_attempts`;

CREATE TABLE `auth_reset_attempts` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `user_agent` varchar(255) NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `auth_reset_attempts` */

/*Table structure for table `auth_tokens` */

DROP TABLE IF EXISTS `auth_tokens`;

CREATE TABLE `auth_tokens` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `selector` varchar(255) NOT NULL,
  `hashedValidator` varchar(255) NOT NULL,
  `user_id` int(11) unsigned NOT NULL,
  `expires` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `auth_tokens_user_id_foreign` (`user_id`),
  KEY `selector` (`selector`),
  CONSTRAINT `auth_tokens_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

/*Data for the table `auth_tokens` */

/*Table structure for table `auth_users_permissions` */

DROP TABLE IF EXISTS `auth_users_permissions`;

CREATE TABLE `auth_users_permissions` (
  `user_id` int(11) unsigned NOT NULL DEFAULT 0,
  `permission_id` int(11) unsigned NOT NULL DEFAULT 0,
  KEY `auth_users_permissions_permission_id_foreign` (`permission_id`),
  KEY `user_id_permission_id` (`user_id`,`permission_id`),
  CONSTRAINT `auth_users_permissions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `auth_users_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `auth_permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `auth_users_permissions` */

/*Table structure for table `diskon_penjualan` */

DROP TABLE IF EXISTS `diskon_penjualan`;

CREATE TABLE `diskon_penjualan` (
  `diskon_id` int(11) DEFAULT NULL,
  `penjualan_detail_id` int(11) DEFAULT NULL,
  KEY `diskon_id` (`diskon_id`),
  KEY `penjualan_detail_id` (`penjualan_detail_id`),
  CONSTRAINT `diskon_penjualan_ibfk_1` FOREIGN KEY (`diskon_id`) REFERENCES `diskon_produk` (`id`),
  CONSTRAINT `diskon_penjualan_ibfk_2` FOREIGN KEY (`penjualan_detail_id`) REFERENCES `penjualan_produk_detail` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `diskon_penjualan` */

/*Table structure for table `diskon_produk` */

DROP TABLE IF EXISTS `diskon_produk`;

CREATE TABLE `diskon_produk` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `akun_diskon_id` int(11) DEFAULT NULL,
  `nama_diskon` varchar(100) DEFAULT NULL,
  `deskripsi_diskon` text DEFAULT NULL,
  `kode_diskon` varchar(20) DEFAULT NULL,
  `jumlah_diskon` decimal(12,2) DEFAULT NULL,
  `satuan_diskon` enum('persen','jumlah') DEFAULT NULL,
  `periode_awal_diskon` datetime DEFAULT NULL,
  `periode_akhir_diskon` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `akun_diskon_id` (`akun_diskon_id`),
  CONSTRAINT `diskon_produk_ibfk_1` FOREIGN KEY (`akun_diskon_id`) REFERENCES `akun` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

/*Data for the table `diskon_produk` */

insert  into `diskon_produk`(`id`,`akun_diskon_id`,`nama_diskon`,`deskripsi_diskon`,`kode_diskon`,`jumlah_diskon`,`satuan_diskon`,`periode_awal_diskon`,`periode_akhir_diskon`) values 
(1,4,'Diskon Februari','Diskon khusus bulan Februari 2022','FEBDISC20',30.00,'persen','2022-02-13 00:00:00','2022-02-28 23:59:59'),
(3,4,'Diskon Maret','Test','DISCMAR10',10.00,'persen','2022-03-01 00:00:00','2022-03-31 23:59:00'),
(4,4,'Diskon 10K Maret','Diskon','MARDISC10K',10000.00,'jumlah','2022-03-01 00:00:00','2022-03-31 23:59:00'),
(5,4,'Diskon April 10K','Diskon bulan April 10K','APRDISC10K',10000.00,'jumlah','2022-04-01 00:00:00','2022-04-30 23:59:00');

/*Table structure for table `gaji_staf` */

DROP TABLE IF EXISTS `gaji_staf`;

CREATE TABLE `gaji_staf` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `akun_gaji_id` int(11) DEFAULT NULL,
  `jumlah_gaji` decimal(15,2) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `akun_gaji_id` (`akun_gaji_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `gaji_staf_ibfk_1` FOREIGN KEY (`akun_gaji_id`) REFERENCES `akun` (`id`),
  CONSTRAINT `gaji_staf_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

/*Data for the table `gaji_staf` */

insert  into `gaji_staf`(`id`,`user_id`,`akun_gaji_id`,`jumlah_gaji`,`created_at`,`updated_at`) values 
(2,1,5,2500000.00,'2022-02-28 23:06:29','2022-02-28 23:06:29');

/*Table structure for table `jenis_pembayaran` */

DROP TABLE IF EXISTS `jenis_pembayaran`;

CREATE TABLE `jenis_pembayaran` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `akun_jenis_pembayaran_id` int(11) DEFAULT NULL,
  `nama_jenis_pembayaran` varchar(100) DEFAULT NULL,
  `deskripsi_jenis_pembayaran` text DEFAULT NULL,
  `kategori_pembayaran` enum('penjualan','pengeluaran') DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `akun_jenis_pembayaran_id` (`akun_jenis_pembayaran_id`),
  CONSTRAINT `jenis_pembayaran_ibfk_1` FOREIGN KEY (`akun_jenis_pembayaran_id`) REFERENCES `akun` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

/*Data for the table `jenis_pembayaran` */

insert  into `jenis_pembayaran`(`id`,`akun_jenis_pembayaran_id`,`nama_jenis_pembayaran`,`deskripsi_jenis_pembayaran`,`kategori_pembayaran`) values 
(1,1,'Cash','Pembayaran langsung ke kasir',NULL),
(2,1,'Kartu Debit','Pembayaran dengan kartu debit semua bank',NULL);

/*Table structure for table `jenis_tunjangan` */

DROP TABLE IF EXISTS `jenis_tunjangan`;

CREATE TABLE `jenis_tunjangan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `akun_tunjangan_id` int(11) DEFAULT NULL,
  `jenis_tunjangan` varchar(100) DEFAULT NULL,
  `jumlah_tunjangan` decimal(15,2) DEFAULT NULL,
  `periode_tunjangan` enum('harian','bulanan','tahunan','sekali') DEFAULT NULL,
  `status_tunjangan` tinyint(1) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `akun_tunjangan_id` (`akun_tunjangan_id`),
  CONSTRAINT `jenis_tunjangan_ibfk_1` FOREIGN KEY (`akun_tunjangan_id`) REFERENCES `akun` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

/*Data for the table `jenis_tunjangan` */

insert  into `jenis_tunjangan`(`id`,`akun_tunjangan_id`,`jenis_tunjangan`,`jumlah_tunjangan`,`periode_tunjangan`,`status_tunjangan`,`created_at`,`updated_at`) values 
(2,5,'BPJS',250000.00,'bulanan',1,'2022-02-26 22:30:19','2022-03-30 21:07:48'),
(3,5,'Uang Makan',15000.00,'harian',1,'2022-02-28 17:42:59','2022-03-30 15:26:36');

/*Table structure for table `kas_keluar` */

DROP TABLE IF EXISTS `kas_keluar`;

CREATE TABLE `kas_keluar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pengeluaran_id` int(11) DEFAULT NULL,
  `akun_id` int(11) DEFAULT NULL,
  `pajak_id` int(11) DEFAULT NULL,
  `deskripsi` varchar(255) DEFAULT NULL,
  `jumlah` decimal(15,2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pengeluaran_id` (`pengeluaran_id`),
  KEY `akun_id` (`akun_id`),
  KEY `pajak_id` (`pajak_id`),
  CONSTRAINT `kas_keluar_ibfk_1` FOREIGN KEY (`pengeluaran_id`) REFERENCES `pengeluaran` (`id`),
  CONSTRAINT `kas_keluar_ibfk_2` FOREIGN KEY (`akun_id`) REFERENCES `akun` (`id`),
  CONSTRAINT `kas_keluar_ibfk_3` FOREIGN KEY (`pajak_id`) REFERENCES `pajak` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

/*Data for the table `kas_keluar` */

insert  into `kas_keluar`(`id`,`pengeluaran_id`,`akun_id`,`pajak_id`,`deskripsi`,`jumlah`) values 
(1,1,1,1,'Keperluan pribadi pemilik',1200000.00);

/*Table structure for table `kas_masuk` */

DROP TABLE IF EXISTS `kas_masuk`;

CREATE TABLE `kas_masuk` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pendapatan_id` int(11) DEFAULT NULL,
  `akun_id` int(11) DEFAULT NULL,
  `pajak_id` int(11) DEFAULT NULL,
  `deskripsi` varchar(255) DEFAULT NULL,
  `jumlah` decimal(15,2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `akun_id` (`akun_id`),
  KEY `pajak_id` (`pajak_id`),
  KEY `kas_masuk_ibfk_1` (`pendapatan_id`),
  CONSTRAINT `kas_masuk_ibfk_1` FOREIGN KEY (`pendapatan_id`) REFERENCES `pendapatan` (`id`),
  CONSTRAINT `kas_masuk_ibfk_2` FOREIGN KEY (`akun_id`) REFERENCES `akun` (`id`),
  CONSTRAINT `kas_masuk_ibfk_3` FOREIGN KEY (`pajak_id`) REFERENCES `pajak` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

/*Data for the table `kas_masuk` */

insert  into `kas_masuk`(`id`,`pendapatan_id`,`akun_id`,`pajak_id`,`deskripsi`,`jumlah`) values 
(3,6,1,1,'Modal usaha pemilik',1350000.00);

/*Table structure for table `kategori_akun` */

DROP TABLE IF EXISTS `kategori_akun`;

CREATE TABLE `kategori_akun` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kategori_akun` varchar(50) DEFAULT NULL,
  `kode_kategori_akun` int(2) DEFAULT NULL,
  `saldo_normal` enum('d','k') DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

/*Data for the table `kategori_akun` */

insert  into `kategori_akun`(`id`,`kategori_akun`,`kode_kategori_akun`,`saldo_normal`) values 
(1,'Aset/Aktiva',1,'d'),
(2,'Utang/Kewajiban',2,'k'),
(3,'Modal/Ekuitas',3,'k'),
(4,'Pendapatan',4,'k'),
(5,'Beban',5,'d');

/*Table structure for table `kategori_produk` */

DROP TABLE IF EXISTS `kategori_produk`;

CREATE TABLE `kategori_produk` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `akun_produk_id` int(11) DEFAULT NULL,
  `nama_kategori_produk` varchar(50) DEFAULT NULL,
  `kode_kategori_produk` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `akun_produk_id` (`akun_produk_id`),
  CONSTRAINT `kategori_produk_ibfk_1` FOREIGN KEY (`akun_produk_id`) REFERENCES `akun` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

/*Data for the table `kategori_produk` */

insert  into `kategori_produk`(`id`,`akun_produk_id`,`nama_kategori_produk`,`kode_kategori_produk`) values 
(1,3,'Watersport Single','WS-Single1');

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `migrations` */

insert  into `migrations`(`id`,`version`,`class`,`group`,`namespace`,`time`,`batch`) values 
(1,'2017-11-20-223112','Myth\\Auth\\Database\\Migrations\\CreateAuthTables','default','Myth\\Auth',1628593179,1);

/*Table structure for table `pajak` */

DROP TABLE IF EXISTS `pajak`;

CREATE TABLE `pajak` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `akun_pajak_id` int(11) DEFAULT NULL,
  `jenis_pajak` varchar(50) DEFAULT NULL,
  `kategori_pajak` enum('penjualan','pembelian','penghasilan') DEFAULT NULL,
  `deskripsi_pajak` text DEFAULT NULL,
  `tarif_pajak` decimal(5,2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `akun_pajak_id` (`akun_pajak_id`),
  CONSTRAINT `pajak_ibfk_1` FOREIGN KEY (`akun_pajak_id`) REFERENCES `akun` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

/*Data for the table `pajak` */

insert  into `pajak`(`id`,`akun_pajak_id`,`jenis_pajak`,`kategori_pajak`,`deskripsi_pajak`,`tarif_pajak`) values 
(1,4,'Pajak Penjualan','penjualan','Pajak penjualan',10.00),
(5,3,'Bebas Pajak','penjualan','Tarif bebas pajak',0.00),
(6,6,'PPN Pembelian','pembelian','PPN pembelian barang jika dikenakan',10.00);

/*Table structure for table `pajak_jual_aset` */

DROP TABLE IF EXISTS `pajak_jual_aset`;

CREATE TABLE `pajak_jual_aset` (
  `pajak_id` int(11) DEFAULT NULL,
  `penjualan_aset_id` int(11) DEFAULT NULL,
  `tarif_pajak` decimal(15,2) DEFAULT NULL,
  KEY `pajak_id` (`pajak_id`),
  KEY `penjualan_aset_id` (`penjualan_aset_id`),
  CONSTRAINT `pajak_jual_aset_ibfk_1` FOREIGN KEY (`pajak_id`) REFERENCES `pajak` (`id`),
  CONSTRAINT `pajak_jual_aset_ibfk_2` FOREIGN KEY (`penjualan_aset_id`) REFERENCES `penjualan_aset` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `pajak_jual_aset` */

insert  into `pajak_jual_aset`(`pajak_id`,`penjualan_aset_id`,`tarif_pajak`) values 
(5,1,0.00);

/*Table structure for table `pajak_pembelian` */

DROP TABLE IF EXISTS `pajak_pembelian`;

CREATE TABLE `pajak_pembelian` (
  `pajak_id` int(11) DEFAULT NULL,
  `pembelian_aset_id` int(11) DEFAULT NULL,
  `tarif_pajak` decimal(15,2) DEFAULT NULL,
  KEY `pajak_id` (`pajak_id`),
  KEY `pembelian_aset_id` (`pembelian_aset_id`),
  CONSTRAINT `pajak_pembelian_ibfk_1` FOREIGN KEY (`pajak_id`) REFERENCES `pajak` (`id`),
  CONSTRAINT `pajak_pembelian_ibfk_2` FOREIGN KEY (`pembelian_aset_id`) REFERENCES `pembelian_aset` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `pajak_pembelian` */

insert  into `pajak_pembelian`(`pajak_id`,`pembelian_aset_id`,`tarif_pajak`) values 
(6,2,975000.00);

/*Table structure for table `pajak_penjualan` */

DROP TABLE IF EXISTS `pajak_penjualan`;

CREATE TABLE `pajak_penjualan` (
  `pajak_id` int(11) DEFAULT NULL,
  `penjualan_detail_id` int(11) DEFAULT NULL,
  KEY `pajak_id` (`pajak_id`),
  KEY `penjualan_detail_id` (`penjualan_detail_id`),
  CONSTRAINT `pajak_penjualan_ibfk_1` FOREIGN KEY (`pajak_id`) REFERENCES `pajak` (`id`),
  CONSTRAINT `pajak_penjualan_ibfk_2` FOREIGN KEY (`penjualan_detail_id`) REFERENCES `penjualan_produk_detail` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `pajak_penjualan` */

insert  into `pajak_penjualan`(`pajak_id`,`penjualan_detail_id`) values 
(1,1),
(1,2),
(1,3),
(1,4),
(1,5),
(1,6);

/*Table structure for table `pembayaran_gaji` */

DROP TABLE IF EXISTS `pembayaran_gaji`;

CREATE TABLE `pembayaran_gaji` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gaji_staf_id` int(11) DEFAULT NULL,
  `pengeluaran_id` int(11) DEFAULT NULL,
  `jenis_pembayaran_id` int(11) DEFAULT NULL,
  `periode_pembayaran_bulan` tinyint(2) DEFAULT NULL,
  `periode_pembayaran_tahun` year(4) DEFAULT NULL,
  `tgl_pembayaran` date DEFAULT NULL,
  `jumlah_pembayaran` decimal(15,2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `gaji_staf_id` (`gaji_staf_id`),
  KEY `pengeluaran_id` (`pengeluaran_id`),
  KEY `jenis_pembayaran_id` (`jenis_pembayaran_id`),
  CONSTRAINT `pembayaran_gaji_ibfk_1` FOREIGN KEY (`gaji_staf_id`) REFERENCES `gaji_staf` (`id`),
  CONSTRAINT `pembayaran_gaji_ibfk_2` FOREIGN KEY (`pengeluaran_id`) REFERENCES `pengeluaran` (`id`),
  CONSTRAINT `pembayaran_gaji_ibfk_3` FOREIGN KEY (`jenis_pembayaran_id`) REFERENCES `jenis_pembayaran` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

/*Data for the table `pembayaran_gaji` */

insert  into `pembayaran_gaji`(`id`,`gaji_staf_id`,`pengeluaran_id`,`jenis_pembayaran_id`,`periode_pembayaran_bulan`,`periode_pembayaran_tahun`,`tgl_pembayaran`,`jumlah_pembayaran`) values 
(1,2,8,1,3,2022,'2022-03-03',2500000.00),
(5,2,19,1,4,2022,'2022-04-12',2500000.00);

/*Table structure for table `pembayaran_tunjangan` */

DROP TABLE IF EXISTS `pembayaran_tunjangan`;

CREATE TABLE `pembayaran_tunjangan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tunjangan_staf_id` int(11) DEFAULT NULL,
  `pengeluaran_id` int(11) DEFAULT NULL,
  `jenis_pembayaran_id` int(11) DEFAULT NULL,
  `tgl_pembayaran` date DEFAULT NULL,
  `jumlah_pembayaran` decimal(15,2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tunjangan_staf_id` (`tunjangan_staf_id`),
  KEY `pengeluaran_id` (`pengeluaran_id`),
  KEY `jenis_pembayaran_id` (`jenis_pembayaran_id`),
  CONSTRAINT `pembayaran_tunjangan_ibfk_1` FOREIGN KEY (`tunjangan_staf_id`) REFERENCES `tunjangan_staf` (`id`),
  CONSTRAINT `pembayaran_tunjangan_ibfk_2` FOREIGN KEY (`pengeluaran_id`) REFERENCES `pengeluaran` (`id`),
  CONSTRAINT `pembayaran_tunjangan_ibfk_3` FOREIGN KEY (`jenis_pembayaran_id`) REFERENCES `jenis_pembayaran` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

/*Data for the table `pembayaran_tunjangan` */

insert  into `pembayaran_tunjangan`(`id`,`tunjangan_staf_id`,`pengeluaran_id`,`jenis_pembayaran_id`,`tgl_pembayaran`,`jumlah_pembayaran`) values 
(1,3,10,1,'2022-03-06',250000.00),
(2,3,15,1,'2022-04-12',250000.00),
(3,4,16,1,'2022-04-12',15000.00);

/*Table structure for table `pembelian_aset` */

DROP TABLE IF EXISTS `pembelian_aset`;

CREATE TABLE `pembelian_aset` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pengeluaran_id` int(11) DEFAULT NULL,
  `akun_pembelian_id` int(11) DEFAULT NULL,
  `jenis_pembayaran_id` int(11) DEFAULT NULL,
  `status_transaksi` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pengeluaran_id` (`pengeluaran_id`),
  KEY `akun_pembelian_id` (`akun_pembelian_id`),
  KEY `jenis_pembayaran_id` (`jenis_pembayaran_id`),
  CONSTRAINT `pembelian_aset_ibfk_1` FOREIGN KEY (`pengeluaran_id`) REFERENCES `pengeluaran` (`id`),
  CONSTRAINT `pembelian_aset_ibfk_2` FOREIGN KEY (`akun_pembelian_id`) REFERENCES `akun` (`id`),
  CONSTRAINT `pembelian_aset_ibfk_3` FOREIGN KEY (`jenis_pembayaran_id`) REFERENCES `jenis_pembayaran` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

/*Data for the table `pembelian_aset` */

insert  into `pembelian_aset`(`id`,`pengeluaran_id`,`akun_pembelian_id`,`jenis_pembayaran_id`,`status_transaksi`) values 
(2,11,1,1,1);

/*Table structure for table `pendapatan` */

DROP TABLE IF EXISTS `pendapatan`;

CREATE TABLE `pendapatan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tgl_transaksi_pendapatan` datetime DEFAULT NULL,
  `jenis_transaksi_pendapatan` enum('produk','aset','kas') DEFAULT NULL,
  `total_transaksi_pendapatan` decimal(15,2) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4;

/*Data for the table `pendapatan` */

insert  into `pendapatan`(`id`,`tgl_transaksi_pendapatan`,`jenis_transaksi_pendapatan`,`total_transaksi_pendapatan`,`created_at`,`updated_at`) values 
(6,'2022-02-20 13:20:30','kas',1350000.00,'2022-02-20 00:00:00','2022-02-20 00:00:00'),
(8,'2022-03-19 23:46:38','aset',150000.00,'2022-03-19 23:46:38','2022-03-19 23:46:38'),
(12,'2022-03-28 21:20:22','produk',220000.00,'2022-03-28 21:20:22','2022-03-28 21:20:22'),
(13,'2022-03-28 21:21:44','produk',0.00,'2022-03-28 21:21:44','2022-03-28 21:21:44'),
(14,'2022-03-28 21:26:38','produk',198000.00,'2022-03-28 21:26:38','2022-03-28 21:26:38'),
(15,'2022-03-29 00:29:38','produk',126500.00,'2022-03-29 00:29:38','2022-03-29 00:29:38'),
(16,'2022-03-29 00:39:07','produk',350000.00,'2022-03-29 00:39:07','2022-03-29 00:39:07'),
(17,'2022-04-12 20:41:12','produk',500500.00,'2022-04-12 20:41:12','2022-04-12 20:41:12');

/*Table structure for table `pengajuan` */

DROP TABLE IF EXISTS `pengajuan`;

CREATE TABLE `pengajuan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned DEFAULT NULL,
  `akun_id` int(11) DEFAULT NULL,
  `rincian_pengeluaran` varchar(255) DEFAULT NULL,
  `tgl_transaksi` date DEFAULT NULL,
  `harga_satuan` decimal(15,2) DEFAULT NULL,
  `jumlah` int(5) DEFAULT NULL,
  `total_pengeluaran` decimal(15,2) DEFAULT NULL,
  `catatan` text DEFAULT NULL,
  `bukti_pengeluaran` varchar(255) DEFAULT NULL,
  `status_pengajuan` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `akun_id` (`akun_id`),
  CONSTRAINT `pengajuan_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  CONSTRAINT `pengajuan_ibfk_2` FOREIGN KEY (`akun_id`) REFERENCES `akun` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

/*Data for the table `pengajuan` */

insert  into `pengajuan`(`id`,`user_id`,`akun_id`,`rincian_pengeluaran`,`tgl_transaksi`,`harga_satuan`,`jumlah`,`total_pengeluaran`,`catatan`,`bukti_pengeluaran`,`status_pengajuan`) values 
(1,1,1,'Belanja','2022-03-22',15000.00,2,30000.00,'',NULL,1),
(3,2,5,'Beli makan','2022-04-12',20000.00,1,20000.00,NULL,'',1),
(4,2,1,'Beli kopi','2022-04-12',15000.00,3,45000.00,NULL,'',2);

/*Table structure for table `pengeluaran` */

DROP TABLE IF EXISTS `pengeluaran`;

CREATE TABLE `pengeluaran` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tgl_transaksi_pengeluaran` datetime DEFAULT NULL,
  `jenis_transaksi_pengeluaran` enum('harian','aset','gaji','kas') DEFAULT NULL,
  `total_transaksi_pengeluaran` decimal(15,2) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4;

/*Data for the table `pengeluaran` */

insert  into `pengeluaran`(`id`,`tgl_transaksi_pengeluaran`,`jenis_transaksi_pengeluaran`,`total_transaksi_pengeluaran`,`created_at`,`updated_at`) values 
(1,'2022-02-20 15:11:35','kas',1200000.00,'2022-02-20 15:11:35','2022-02-20 23:53:32'),
(8,'2022-03-03 15:21:27','gaji',2500000.00,'2022-03-03 15:21:27','2022-03-03 15:21:27'),
(10,'2022-03-06 22:05:01','gaji',250000.00,'2022-03-06 22:05:01','2022-03-06 22:05:01'),
(11,'2022-03-10 22:50:49','aset',10725000.00,'2022-03-10 22:50:49','2022-03-10 22:50:49'),
(13,'2022-03-22 00:00:00','harian',30000.00,'2022-03-23 16:43:23','2022-03-23 16:43:23'),
(14,'2022-04-12 00:00:00','harian',20000.00,'2022-04-12 00:50:14','2022-04-12 00:50:14'),
(15,'2022-04-12 00:54:41','gaji',250000.00,'2022-04-12 00:54:41','2022-04-12 00:54:41'),
(16,'2022-04-12 00:54:59','gaji',15000.00,'2022-04-12 00:54:59','2022-04-12 00:54:59'),
(19,'2022-04-12 22:59:39','gaji',2500000.00,'2022-04-12 22:59:39','2022-04-12 22:59:39');

/*Table structure for table `pengeluaran_harian` */

DROP TABLE IF EXISTS `pengeluaran_harian`;

CREATE TABLE `pengeluaran_harian` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `akun_id` int(11) DEFAULT NULL,
  `pengeluaran_id` int(11) DEFAULT NULL,
  `jenis_pembayaran_id` int(11) DEFAULT NULL,
  `rincian_pengeluaran` varchar(255) DEFAULT NULL,
  `tgl_transaksi` date DEFAULT NULL,
  `harga_satuan` decimal(15,2) DEFAULT NULL,
  `jumlah` int(10) DEFAULT NULL,
  `total_pengeluaran` decimal(15,2) DEFAULT NULL,
  `catatan` text DEFAULT NULL,
  `bukti_transaksi` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `akun_id` (`akun_id`),
  KEY `pengeluaran_id` (`pengeluaran_id`),
  KEY `jenis_pembayaran_id` (`jenis_pembayaran_id`),
  CONSTRAINT `pengeluaran_harian_ibfk_1` FOREIGN KEY (`akun_id`) REFERENCES `akun` (`id`),
  CONSTRAINT `pengeluaran_harian_ibfk_3` FOREIGN KEY (`pengeluaran_id`) REFERENCES `pengeluaran` (`id`),
  CONSTRAINT `pengeluaran_harian_ibfk_4` FOREIGN KEY (`jenis_pembayaran_id`) REFERENCES `jenis_pembayaran` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

/*Data for the table `pengeluaran_harian` */

insert  into `pengeluaran_harian`(`id`,`akun_id`,`pengeluaran_id`,`jenis_pembayaran_id`,`rincian_pengeluaran`,`tgl_transaksi`,`harga_satuan`,`jumlah`,`total_pengeluaran`,`catatan`,`bukti_transaksi`) values 
(1,1,13,NULL,'Belanja','2022-03-22',15000.00,2,30000.00,'',NULL),
(2,5,14,NULL,'Beli makan','2022-04-12',20000.00,1,20000.00,NULL,'');

/*Table structure for table `penjualan_aset` */

DROP TABLE IF EXISTS `penjualan_aset`;

CREATE TABLE `penjualan_aset` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pendapatan_id` int(11) DEFAULT NULL,
  `akun_id` int(11) DEFAULT NULL,
  `aset_id` int(11) DEFAULT NULL,
  `tgl_penjualan` date DEFAULT NULL,
  `harga_jual` decimal(15,2) DEFAULT NULL,
  `catatan` text DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pendapatan_id` (`pendapatan_id`),
  KEY `aset_id` (`aset_id`),
  KEY `akun_id` (`akun_id`),
  CONSTRAINT `penjualan_aset_ibfk_1` FOREIGN KEY (`pendapatan_id`) REFERENCES `pendapatan` (`id`),
  CONSTRAINT `penjualan_aset_ibfk_2` FOREIGN KEY (`aset_id`) REFERENCES `aset` (`id`),
  CONSTRAINT `penjualan_aset_ibfk_4` FOREIGN KEY (`akun_id`) REFERENCES `akun` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

/*Data for the table `penjualan_aset` */

insert  into `penjualan_aset`(`id`,`pendapatan_id`,`akun_id`,`aset_id`,`tgl_penjualan`,`harga_jual`,`catatan`) values 
(1,8,1,2,'2022-03-19',150000.00,'');

/*Table structure for table `penjualan_produk` */

DROP TABLE IF EXISTS `penjualan_produk`;

CREATE TABLE `penjualan_produk` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pendapatan_id` int(11) DEFAULT NULL,
  `jenis_pembayaran_id` int(11) DEFAULT NULL,
  `nama_customer` varchar(100) DEFAULT NULL,
  `tgl_transaksi` date DEFAULT NULL,
  `subtotal` decimal(15,2) DEFAULT NULL,
  `total_belanja` decimal(15,2) DEFAULT NULL,
  `jumlah_pembayaran` decimal(15,2) DEFAULT NULL,
  `status_pembayaran` enum('order','lunas','selesai') DEFAULT NULL,
  `catatan` text DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pendapatan_id` (`pendapatan_id`),
  KEY `jenis_pembayaran_id` (`jenis_pembayaran_id`),
  CONSTRAINT `penjualan_produk_ibfk_1` FOREIGN KEY (`pendapatan_id`) REFERENCES `pendapatan` (`id`),
  CONSTRAINT `penjualan_produk_ibfk_5` FOREIGN KEY (`jenis_pembayaran_id`) REFERENCES `jenis_pembayaran` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

/*Data for the table `penjualan_produk` */

insert  into `penjualan_produk`(`id`,`pendapatan_id`,`jenis_pembayaran_id`,`nama_customer`,`tgl_transaksi`,`subtotal`,`total_belanja`,`jumlah_pembayaran`,`status_pembayaran`,`catatan`) values 
(3,14,1,'Dilan MS','2022-03-28',180000.00,198000.00,200000.00,'lunas',''),
(4,15,1,'Anne','2022-03-29',115000.00,126500.00,130000.00,'lunas',''),
(5,16,1,'Alit','2022-03-29',365000.00,401500.00,350000.00,'order','Pre-order'),
(6,17,1,'Aldi','2022-04-12',455000.00,500500.00,501000.00,'lunas','Jemput langsung dari bandara');

/*Table structure for table `penjualan_produk_detail` */

DROP TABLE IF EXISTS `penjualan_produk_detail`;

CREATE TABLE `penjualan_produk_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `penjualan_id` int(11) DEFAULT NULL,
  `produk_id` int(11) DEFAULT NULL,
  `diskon_id` int(11) DEFAULT 0,
  `tgl_booking` date DEFAULT NULL,
  `harga_jual_satuan` decimal(15,2) DEFAULT NULL,
  `qty_produk` int(5) DEFAULT NULL,
  `total_harga_jual` decimal(15,2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `penjualan_id` (`penjualan_id`),
  KEY `produk_id` (`produk_id`),
  CONSTRAINT `penjualan_produk_detail_ibfk_2` FOREIGN KEY (`produk_id`) REFERENCES `produk` (`id`),
  CONSTRAINT `penjualan_produk_detail_ibfk_3` FOREIGN KEY (`penjualan_id`) REFERENCES `penjualan_produk` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

/*Data for the table `penjualan_produk_detail` */

insert  into `penjualan_produk_detail`(`id`,`penjualan_id`,`produk_id`,`diskon_id`,`tgl_booking`,`harga_jual_satuan`,`qty_produk`,`total_harga_jual`) values 
(1,3,3,4,'2022-03-28',125000.00,1,115000.00),
(2,3,4,4,'2022-03-28',75000.00,1,65000.00),
(3,4,3,4,'2022-03-29',125000.00,1,115000.00),
(4,5,4,4,'2022-03-29',75000.00,5,365000.00),
(5,6,3,5,'2022-04-16',125000.00,2,240000.00),
(6,6,4,5,'2022-04-16',75000.00,3,215000.00);

/*Table structure for table `penyusutan_aset` */

DROP TABLE IF EXISTS `penyusutan_aset`;

CREATE TABLE `penyusutan_aset` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `aset_id` int(11) DEFAULT NULL,
  `akun_penyusutan_id` int(11) DEFAULT NULL,
  `metode_penyusutan` enum('gl','sm') DEFAULT NULL,
  `masa_manfaat` tinyint(2) DEFAULT NULL,
  `nilai_penyusutan` decimal(5,2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `aset_id` (`aset_id`),
  KEY `akun_penyusutan_id` (`akun_penyusutan_id`),
  CONSTRAINT `penyusutan_aset_ibfk_1` FOREIGN KEY (`aset_id`) REFERENCES `aset` (`id`),
  CONSTRAINT `penyusutan_aset_ibfk_2` FOREIGN KEY (`akun_penyusutan_id`) REFERENCES `akun` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

/*Data for the table `penyusutan_aset` */

insert  into `penyusutan_aset`(`id`,`aset_id`,`akun_penyusutan_id`,`metode_penyusutan`,`masa_manfaat`,`nilai_penyusutan`) values 
(1,1,3,'gl',8,12.50),
(2,2,1,'gl',4,25.00),
(4,5,1,'gl',4,12.50);

/*Table structure for table `produk` */

DROP TABLE IF EXISTS `produk`;

CREATE TABLE `produk` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kategori_produk_id` int(11) DEFAULT NULL,
  `nama_produk` varchar(255) DEFAULT NULL,
  `deskripsi_produk` text DEFAULT NULL,
  `harga_produk` decimal(15,2) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `kategori_produk_id` (`kategori_produk_id`),
  CONSTRAINT `produk_ibfk_1` FOREIGN KEY (`kategori_produk_id`) REFERENCES `kategori_produk` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

/*Data for the table `produk` */

insert  into `produk`(`id`,`kategori_produk_id`,`nama_produk`,`deskripsi_produk`,`harga_produk`,`created_at`,`updated_at`) values 
(3,1,'Paragliding','Test',120000.00,'2022-02-11 21:13:54','2022-04-21 00:05:50'),
(4,1,'Jetski','Test',75000.00,'2022-02-11 21:53:46','2022-02-11 21:53:46');

/*Table structure for table `tunjangan_staf` */

DROP TABLE IF EXISTS `tunjangan_staf`;

CREATE TABLE `tunjangan_staf` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `jenis_tunjangan_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `jenis_tunjangan_id` (`jenis_tunjangan_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `tunjangan_staf_ibfk_2` FOREIGN KEY (`jenis_tunjangan_id`) REFERENCES `jenis_tunjangan` (`id`),
  CONSTRAINT `tunjangan_staf_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tunjangan_staf` */

insert  into `tunjangan_staf`(`id`,`user_id`,`jenis_tunjangan_id`,`created_at`,`updated_at`) values 
(3,1,2,'2022-03-04 17:43:53','2022-03-04 17:43:53'),
(4,1,3,'2022-03-07 12:20:48','2022-03-07 12:20:48'),
(8,2,3,'2022-03-30 23:08:03','2022-03-30 23:08:03');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `username` varchar(30) DEFAULT NULL,
  `full_name` varchar(255) DEFAULT NULL,
  `profile_img` varchar(255) NOT NULL DEFAULT 'default.svg',
  `password_hash` varchar(255) NOT NULL,
  `reset_hash` varchar(255) DEFAULT NULL,
  `reset_at` datetime DEFAULT NULL,
  `reset_expires` datetime DEFAULT NULL,
  `activate_hash` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `status_message` varchar(255) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 0,
  `force_pass_reset` tinyint(1) NOT NULL DEFAULT 0,
  `register_date` date DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `users` */

insert  into `users`(`id`,`email`,`username`,`full_name`,`profile_img`,`password_hash`,`reset_hash`,`reset_at`,`reset_expires`,`activate_hash`,`status`,`status_message`,`active`,`force_pass_reset`,`register_date`,`created_at`,`updated_at`,`deleted_at`) values 
(1,'tpdmailku@superrito.com','theprastdije','Prast Dije','default.svg','$2y$10$uCvYhjdzTamtlLILpwkJnelHDBwvc6rMhD/cefBkpr8XHQu68CmKG',NULL,NULL,NULL,NULL,NULL,NULL,1,0,'2020-01-01','2022-02-06 21:05:10','2022-02-06 21:05:10',NULL),
(2,'staf1@ptbsi.co.id','bsistafftest123','Wayan Satriana','default.svg','$2y$10$mfAOKbGNjD/pG7eCjkwGteIdS6oQl7B8e318EKl0TuDTSbvPdGkTi',NULL,NULL,NULL,NULL,NULL,NULL,1,0,'2020-01-01','2022-03-22 17:08:02','2022-03-30 00:00:00',NULL);

/*Table structure for table `users_detail` */

DROP TABLE IF EXISTS `users_detail`;

CREATE TABLE `users_detail` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `gender` enum('l','p') DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `tempat_lahir` varchar(30) DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `tel` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

/*Data for the table `users_detail` */

insert  into `users_detail`(`id`,`user_id`,`gender`,`alamat`,`tempat_lahir`,`tgl_lahir`,`tel`) values 
(1,2,'l','Jl. Segara Windu No. 102, Tanjung Benoa, Badung','Badung','1983-09-16','081999123645');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
