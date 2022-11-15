/*
SQLyog Ultimate v12.5.1 (64 bit)
MySQL - 10.4.17-MariaDB : Database - sia_biws
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`sia_biws` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `sia_biws`;

/*Table structure for table `akses_menu_user` */

DROP TABLE IF EXISTS `akses_menu_user`;

CREATE TABLE `akses_menu_user` (
  `akses_id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) DEFAULT NULL,
  `menu_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`akses_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

/*Data for the table `akses_menu_user` */

insert  into `akses_menu_user`(`akses_id`,`role_id`,`menu_id`) values 
(1,1,1),
(2,1,2),
(3,4,2),
(4,1,3);

/*Table structure for table `menu_user` */

DROP TABLE IF EXISTS `menu_user`;

CREATE TABLE `menu_user` (
  `menu_id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_menu` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`menu_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

/*Data for the table `menu_user` */

insert  into `menu_user`(`menu_id`,`nama_menu`) values 
(1,'Tool'),
(2,'User'),
(3,'Menu'),
(5,'Test');

/*Table structure for table `role_user` */

DROP TABLE IF EXISTS `role_user`;

CREATE TABLE `role_user` (
  `role_id` int(11) NOT NULL AUTO_INCREMENT,
  `role` varchar(128) NOT NULL,
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

/*Data for the table `role_user` */

insert  into `role_user`(`role_id`,`role`) values 
(1,'Owner'),
(2,'Manajer'),
(3,'Kasir'),
(4,'Staf');

/*Table structure for table `sub_menu_user` */

DROP TABLE IF EXISTS `sub_menu_user`;

CREATE TABLE `sub_menu_user` (
  `sub_menu_id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_id` int(11) DEFAULT NULL,
  `nama_sub_menu` varchar(128) DEFAULT NULL,
  `url` varchar(128) DEFAULT NULL,
  `icon` varchar(128) DEFAULT NULL,
  `is_active` int(1) DEFAULT NULL,
  PRIMARY KEY (`sub_menu_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

/*Data for the table `sub_menu_user` */

insert  into `sub_menu_user`(`sub_menu_id`,`menu_id`,`nama_sub_menu`,`url`,`icon`,`is_active`) values 
(1,1,'Dashboard','admin','fas fa-fw fa-tachometer-alt',1),
(2,2,'Profil','user','fas fa-fw fa-user',1),
(3,2,'Edit Profil','user/edit','fas fa-fw fa-user-edit',1),
(4,3,'Kelola Menu','menu','fas fa-fw fa-bars',1),
(5,3,'Kelola Submenu','submenu','fas fa-fw fa-ellipsis-v',1),
(6,3,'Kelola User Role','admin/role','fas fa-fw fa-user-cog',1),
(7,1,'Pemasukan','admin/pemasukan','fas fa-fw fa-wallet',1);

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(128) NOT NULL,
  `alamat` varchar(256) NOT NULL,
  `telepon` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `profile_image` varchar(128) NOT NULL,
  `username` varchar(128) NOT NULL,
  `password` varchar(256) NOT NULL,
  `role_id` int(11) NOT NULL,
  `is_active` int(1) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

/*Data for the table `user` */

insert  into `user`(`user_id`,`nama`,`alamat`,`telepon`,`email`,`profile_image`,`username`,`password`,`role_id`,`is_active`,`created_at`,`updated_at`) values 
(1,'Lateefa','Abc','12345678','tpd@tpd.com','image.jpg','lateefa','lateefa69',4,1,NULL,NULL),
(2,'Jane','Jl. Jalan','081999123456','jane@tpd.com','images.jpg','janedoe123','$2y$10$8o77tPq6Ys36R4FWimerqOSkgqUL1LLVBhqpg8bqYFNLxEb2b29N2',4,1,'2021-07-07 03:14:35','2021-07-07 03:14:35'),
(3,'Lateefa Hermans','Jl. Jalan No. 1 Jakarta','081999111222','lateefahermans@tpd.id','image.jpg','lateefahermans','$2y$10$uG.5IlJ/WjudRMUBD4bvseRTuzJk/gUoyU.4Y0tUNrudOzOWIE7hy',4,1,'2021-07-07 09:01:15','2021-07-07 09:01:15'),
(4,'123145','Jl. Jalan No. 123','12345678890','tpd@mail.com','image.jpg','test1234','$2y$10$.0CzJmbPEJYVmUz03kLOtO8HtFLLm3HtGh6UX8FldeF6BKqR/Kuc2',4,1,'2021-07-09 07:22:03','2021-07-09 07:22:03'),
(5,'Bali Indah Admin','Jl. Segara Windu No.102, Tj. Benoa, Kec. Kuta Sel., Kabupaten Badung, Bali','0361778161','admin@baliindah.com','image.jpg','administrator','$2y$10$QHTchm3rsh9s1Wz.pFhFpeM4esURrSYvB2NBbwdUEBs9hkVjyRQXK',1,1,'2021-07-09 07:27:58','2021-07-09 07:27:58'),
(6,'Admin','Jl. Jalan Yuk no. 123','081234567890','mail@test.com','img.jpg','prastdije23','$2y$10$z/8zGBIhqsXNDuBLhygTee.ZY8FQNy7VlHC6o5K0MiE49TZr8UAeW',4,1,'2021-07-12 01:44:48','2021-07-12 01:44:48'),
(7,'Test','Jl. Aja Dulu No. 4','089999111222','test@tpd.com','1626236693_5c9924d5ceb070287cb4.jpg','test5678','$2y$10$rWNuEJlV9cLt4F2wqEOB9eUUR7UCksYnM0Em3VHb9L6Frud0463J6',4,1,'2021-07-13 23:24:53','2021-07-13 23:24:53');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
