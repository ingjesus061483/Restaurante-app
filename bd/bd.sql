/*
SQLyog Community v12.4.0 (64 bit)
MySQL - 10.4.32-MariaDB : Database - restaurante_app
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`restaurante_app` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;

USE `restaurante_app`;

/*Table structure for table `cabañas` */

DROP TABLE IF EXISTS `cabañas`;

CREATE TABLE `cabañas` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `codigo` varchar(50) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `capacidad_maxima` int(11) NOT NULL,
  `ocupado` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `cabañas_codigo_unique` (`codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `cabañas` */

insert  into `cabañas`(`id`,`codigo`,`nombre`,`descripcion`,`capacidad_maxima`,`ocupado`,`created_at`,`updated_at`,`imagen`) values 
(1,'01','mesa1',NULL,4,0,NULL,'2024-04-27 15:01:49','mesa.png'),
(2,'02','mesa2',NULL,4,0,NULL,'2024-04-27 14:52:45','mesa.png'),
(3,'03','mesa3',NULL,4,0,NULL,'2024-02-23 22:28:16','mesa.png'),
(4,'04','mesa4',NULL,4,0,NULL,'2024-03-01 17:35:42','mesa.png'),
(5,'05','mesa5',NULL,4,0,NULL,'2024-04-17 22:40:08','mesa.png'),
(6,'06','mesa6',NULL,4,0,NULL,'2024-02-23 23:27:33','mesa.png'),
(7,'07','mesa7',NULL,4,0,NULL,'2024-02-23 23:10:54','mesa.png'),
(8,'08','mesa8',NULL,4,0,NULL,'2024-04-17 22:36:50','mesa.png'),
(9,'09','mesa9',NULL,4,0,NULL,'2024-02-24 14:12:05','mesa.png'),
(10,'010','mesa10',NULL,4,0,NULL,'2024-03-01 15:11:07','mesa.png'),
(11,'011','mesa11',NULL,4,0,NULL,'2024-02-24 14:15:53','mesa.png'),
(12,'012','mesa12',NULL,4,0,NULL,'2024-02-24 19:21:59','mesa.png'),
(13,'013','mesa13',NULL,4,0,NULL,'2024-04-17 20:17:10','mesa.png'),
(14,'014','mesa14',NULL,4,0,NULL,NULL,'mesa.png'),
(15,'015','mesa15',NULL,4,0,NULL,NULL,'mesa.png'),
(16,'016','mesa16',NULL,4,0,NULL,'2024-04-17 21:49:59','mesa.png'),
(17,'017','mesa17',NULL,4,0,NULL,NULL,'mesa.png'),
(18,'018','mesa18',NULL,4,0,NULL,'2024-03-01 18:04:18','mesa.png'),
(19,'019','mesa19',NULL,4,0,NULL,'2024-04-27 13:34:52','mesa.png'),
(20,'020','mesa20',NULL,4,0,NULL,'2024-04-27 14:50:32','mesa.png'),
(21,'021','21',NULL,4,0,'2024-04-27 15:06:52','2024-04-27 15:06:52',NULL),
(22,'022','22',NULL,4,0,'2024-04-27 15:07:09','2024-04-27 15:07:09',NULL),
(23,'023','23',NULL,4,0,'2024-04-27 15:07:27','2024-04-27 15:07:27',NULL),
(24,'024','24',NULL,4,0,'2024-04-27 15:07:42','2024-04-27 15:07:42',NULL),
(25,'025','25',NULL,4,0,'2024-04-27 15:07:53','2024-04-27 15:07:53',NULL);

/*Table structure for table `caja_movimientos` */

DROP TABLE IF EXISTS `caja_movimientos`;

CREATE TABLE `caja_movimientos` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `fecha_hora` datetime NOT NULL,
  `concepto` varchar(50) NOT NULL,
  `valor` decimal(8,2) NOT NULL,
  `ingreso` tinyint(4) NOT NULL DEFAULT 1,
  `caja_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `caja_movimientos_caja_id_foreign` (`caja_id`),
  CONSTRAINT `caja_movimientos_caja_id_foreign` FOREIGN KEY (`caja_id`) REFERENCES `cajas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `caja_movimientos` */

insert  into `caja_movimientos`(`id`,`fecha_hora`,`concepto`,`valor`,`ingreso`,`caja_id`,`created_at`,`updated_at`) values 
(1,'2024-02-22 17:20:57','ingreso inicial',50000.00,1,1,'2024-02-22 17:20:57','2024-02-22 17:20:57'),
(2,'2024-02-22 19:04:42','Ingreso de pago',35025.00,1,1,'2024-02-22 19:04:42','2024-02-22 19:04:42'),
(3,'2024-02-23 15:22:07','Ingreso de pago',296025.00,1,1,'2024-02-23 15:22:07','2024-02-23 15:22:07'),
(4,'2024-02-24 19:22:29','Ingreso de pago',143000.00,1,1,'2024-02-24 19:22:29','2024-02-24 19:22:29'),
(5,'2024-03-01 17:35:42','Ingreso de pago',177000.00,1,1,'2024-03-01 17:35:42','2024-03-01 17:35:42'),
(6,'2024-03-01 17:38:18','Ingreso de pago',50000.00,1,1,'2024-03-01 17:38:18','2024-03-01 17:38:18'),
(7,'2024-03-01 17:39:47','Ingreso de pago',85000.00,1,1,'2024-03-01 17:39:47','2024-03-01 17:39:47'),
(8,'2024-03-01 18:04:18','Ingreso de pago',206000.00,1,1,'2024-03-01 18:04:18','2024-03-01 18:04:18'),
(9,'2024-04-15 19:27:58','Ingreso de pago',201000.00,1,1,'2024-04-15 19:27:58','2024-04-15 19:27:58'),
(10,'2024-04-17 13:47:17','Ingreso de pago',180000.00,1,1,'2024-04-17 13:47:17','2024-04-17 13:47:17'),
(11,'2024-04-17 19:40:51','Ingreso de pago',68000.00,1,1,'2024-04-17 19:40:51','2024-04-17 19:40:51'),
(12,'2024-04-17 20:16:54','Ingreso de pago',76000.00,1,1,'2024-04-17 20:16:54','2024-04-17 20:16:54'),
(13,'2024-04-17 20:17:10','Ingreso de pago',208000.00,1,1,'2024-04-17 20:17:10','2024-04-17 20:17:10'),
(14,'2024-04-17 21:49:59','Ingreso de pago',215000.00,1,1,'2024-04-17 21:49:59','2024-04-17 21:49:59'),
(15,'2024-04-17 22:36:50','Ingreso de pago',101000.00,1,1,'2024-04-17 22:36:50','2024-04-17 22:36:50'),
(16,'2024-04-17 22:39:31','Ingreso de pago',212000.00,1,1,'2024-04-17 22:39:31','2024-04-17 22:39:31'),
(17,'2024-04-17 22:40:08','Ingreso de pago',104000.00,1,1,'2024-04-17 22:40:08','2024-04-17 22:40:08'),
(18,'2024-04-26 16:45:30','Ingreso de pago',32000.00,1,1,'2024-04-26 16:45:30','2024-04-26 16:45:30'),
(19,'2024-04-26 16:45:41','Ingreso de pago',40000.00,1,1,'2024-04-26 16:45:41','2024-04-26 16:45:41'),
(20,'2024-04-26 16:46:00','Ingreso de pago',60000.00,1,1,'2024-04-26 16:46:00','2024-04-26 16:46:00'),
(21,'2024-04-26 17:06:10','Ingreso de pago',111000.00,1,1,'2024-04-26 17:06:10','2024-04-26 17:06:10'),
(22,'2024-04-26 17:17:13','Ingreso de pago',101000.00,1,1,'2024-04-26 17:17:13','2024-04-26 17:17:13'),
(23,'2024-04-27 13:34:52','Ingreso de pago',84000.00,1,1,'2024-04-27 13:34:52','2024-04-27 13:34:52'),
(24,'2024-04-27 14:50:32','Ingreso de pago',94000.00,1,1,'2024-04-27 14:50:32','2024-04-27 14:50:32'),
(25,'2024-04-27 14:52:45','Ingreso de pago',20000.00,1,1,'2024-04-27 14:52:45','2024-04-27 14:52:45'),
(26,'2024-04-27 15:01:49','Ingreso de pago',169000.00,1,1,'2024-04-27 15:01:49','2024-04-27 15:01:49');

/*Table structure for table `cajas` */

DROP TABLE IF EXISTS `cajas`;

CREATE TABLE `cajas` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `codigo` varchar(50) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `valor_inicial` decimal(8,2) NOT NULL,
  `abierta` tinyint(4) NOT NULL DEFAULT 0,
  `descripcion` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `cajas_codigo_unique` (`codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `cajas` */

insert  into `cajas`(`id`,`codigo`,`nombre`,`valor_inicial`,`abierta`,`descripcion`,`created_at`,`updated_at`) values 
(1,'001','caja1',50000.00,0,NULL,'2024-02-22 17:20:57','2024-04-27 15:01:49');

/*Table structure for table `categorias` */

DROP TABLE IF EXISTS `categorias`;

CREATE TABLE `categorias` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `categorias` */

insert  into `categorias`(`id`,`nombre`,`descripcion`,`created_at`,`updated_at`) values 
(1,'entrantes',NULL,'2024-02-22 17:25:52','2024-02-22 17:25:52'),
(2,'comidas',NULL,'2024-02-22 17:26:24','2024-02-22 17:34:09'),
(3,'bebidas',NULL,'2024-02-22 17:26:46','2024-02-22 17:34:26'),
(4,'picadas',NULL,'2024-02-22 17:27:30','2024-02-22 17:35:06'),
(5,'coctails',NULL,'2024-02-22 17:27:47','2024-02-22 17:36:02'),
(7,'porciones y extras',NULL,'2024-02-22 17:28:59','2024-02-22 17:28:59');

/*Table structure for table `clientes` */

DROP TABLE IF EXISTS `clientes`;

CREATE TABLE `clientes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `identificacion` varchar(50) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `direccion` varchar(50) NOT NULL,
  `telefono` varchar(50) NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `clientes_identificacion_unique` (`identificacion`),
  KEY `clientes_user_id_foreign` (`user_id`),
  CONSTRAINT `clientes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `clientes` */

/*Table structure for table `configuracions` */

DROP TABLE IF EXISTS `configuracions`;

CREATE TABLE `configuracions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `valor` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `configuracions` */

insert  into `configuracions`(`id`,`nombre`,`valor`,`created_at`,`updated_at`) values 
(1,'ImpoConsumo','0.08',NULL,NULL),
(2,'propina','0.10',NULL,'2024-04-27 13:41:30'),
(3,'descuento','',NULL,NULL),
(4,'Valor_Domicilio','3000',NULL,'2024-04-27 13:41:51'),
(5,'Impresora_cajero','CAJA',NULL,'2024-02-23 11:47:23');

/*Table structure for table `cuentas_cobrar_detalles` */

DROP TABLE IF EXISTS `cuentas_cobrar_detalles`;

CREATE TABLE `cuentas_cobrar_detalles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `fecha` date NOT NULL,
  `valor` decimal(10,2) NOT NULL,
  `cuenta_cobrar_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `cuentas_cobrar_detalles_cuenta_cobrar_id_foreign` (`cuenta_cobrar_id`),
  CONSTRAINT `cuentas_cobrar_detalles_cuenta_cobrar_id_foreign` FOREIGN KEY (`cuenta_cobrar_id`) REFERENCES `cuentas_cobrars` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `cuentas_cobrar_detalles` */

/*Table structure for table `cuentas_cobrars` */

DROP TABLE IF EXISTS `cuentas_cobrars`;

CREATE TABLE `cuentas_cobrars` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `fecha` date NOT NULL,
  `tiempo` int(11) NOT NULL,
  `monto` decimal(10,2) NOT NULL,
  `interes` decimal(10,2) NOT NULL,
  `orden_id` bigint(20) unsigned NOT NULL,
  `tipo_cobro_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `cuentas_cobrars_orden_id_foreign` (`orden_id`),
  KEY `cuentas_cobrars_tipo_cobro_id_foreign` (`tipo_cobro_id`),
  CONSTRAINT `cuentas_cobrars_orden_id_foreign` FOREIGN KEY (`orden_id`) REFERENCES `orden_encabezados` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `cuentas_cobrars_tipo_cobro_id_foreign` FOREIGN KEY (`tipo_cobro_id`) REFERENCES `tipo_cobros` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `cuentas_cobrars` */

/*Table structure for table `empleados` */

DROP TABLE IF EXISTS `empleados`;

CREATE TABLE `empleados` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `identificacion` varchar(50) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `direccion` varchar(50) NOT NULL,
  `telefono` varchar(50) NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `fecha_nacimiento` date NOT NULL DEFAULT '1900-01-01',
  PRIMARY KEY (`id`),
  UNIQUE KEY `empleados_identificacion_unique` (`identificacion`),
  KEY `empleados_user_id_foreign` (`user_id`),
  CONSTRAINT `empleados_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `empleados` */

insert  into `empleados`(`id`,`identificacion`,`nombre`,`apellido`,`direccion`,`telefono`,`user_id`,`created_at`,`updated_at`,`fecha_nacimiento`) values 
(1,'111','administrador','administrador','555','33333',1,NULL,NULL,'1900-01-01'),
(2,'001','Auxiliar','1','Pradomar','111',2,'2024-02-22 18:34:52','2024-02-22 18:34:52','2024-02-22'),
(3,'11114','John','Acuña','Cll 1d n. 16b 71','3227811941',3,'2024-02-24 14:27:45','2024-02-24 14:27:45','1980-02-07'),
(4,'1123','auxiliar 2','auxiliar 2','pradomar','11111',4,'2024-03-01 16:44:40','2024-03-01 16:44:40','2024-03-01'),
(5,'1124','auxiliar3','auxiliar3','pradomar','1111',5,'2024-03-01 16:47:21','2024-03-01 16:47:21','2024-03-01'),
(6,'1125','auxiliar 4','auxiliar 4','pradomar','1111',6,'2024-03-01 16:49:32','2024-03-01 16:49:32','2024-03-01');

/*Table structure for table `empresas` */

DROP TABLE IF EXISTS `empresas`;

CREATE TABLE `empresas` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nit` varchar(255) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `camara_de_comercio` varchar(255) DEFAULT NULL,
  `direccion` varchar(255) NOT NULL,
  `telefono` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `contacto` varchar(255) NOT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `slogan` text DEFAULT NULL,
  `tipo_regimen_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `empresas_nit_unique` (`nit`),
  KEY `empresas_tipo_regimen_id_foreign` (`tipo_regimen_id`),
  CONSTRAINT `empresas_tipo_regimen_id_foreign` FOREIGN KEY (`tipo_regimen_id`) REFERENCES `tipo_regimens` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `empresas` */

insert  into `empresas`(`id`,`nit`,`nombre`,`camara_de_comercio`,`direccion`,`telefono`,`email`,`contacto`,`logo`,`slogan`,`tipo_regimen_id`,`created_at`,`updated_at`) values 
(1,'72249068','Nikkybeach','0001','Cll 1d #16b 71 Pradomar. Puerto colombia','3227811941','nikkybeach22@gmail.com','nikkibeach',NULL,NULL,1,NULL,'2024-02-23 14:25:27');

/*Table structure for table `estados` */

DROP TABLE IF EXISTS `estados`;

CREATE TABLE `estados` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `estados` */

insert  into `estados`(`id`,`nombre`,`created_at`,`updated_at`) values 
(1,'Espera',NULL,NULL),
(2,'Entregado',NULL,NULL),
(3,'Pagado',NULL,NULL),
(4,'En mora',NULL,NULL);

/*Table structure for table `existencias` */

DROP TABLE IF EXISTS `existencias`;

CREATE TABLE `existencias` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `fecha` date NOT NULL,
  `cantidad` decimal(10,2) NOT NULL,
  `entrada` tinyint(4) NOT NULL DEFAULT 0,
  `producto_id` bigint(20) unsigned DEFAULT NULL,
  `materia_prima_id` bigint(20) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `existencias_materia_prima_id_foreign` (`materia_prima_id`),
  KEY `existencias_producto_id_foreign` (`producto_id`),
  CONSTRAINT `existencias_materia_prima_id_foreign` FOREIGN KEY (`materia_prima_id`) REFERENCES `materia_primas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `existencias_producto_id_foreign` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=327 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `existencias` */

insert  into `existencias`(`id`,`fecha`,`cantidad`,`entrada`,`producto_id`,`materia_prima_id`,`created_at`,`updated_at`) values 
(51,'2024-04-07',10.00,1,14,NULL,'2024-04-07 14:15:41','2024-04-07 14:15:41'),
(52,'2024-04-07',10.00,1,15,NULL,'2024-04-07 14:26:07','2024-04-07 14:26:07'),
(53,'2024-04-07',10.00,1,16,NULL,'2024-04-07 14:34:31','2024-04-07 14:34:31'),
(58,'2024-04-07',10.00,1,21,NULL,'2024-04-07 14:49:22','2024-04-07 14:49:22'),
(62,'2024-04-07',10.00,1,25,NULL,'2024-04-07 15:45:19','2024-04-07 15:45:19'),
(65,'2024-04-07',10.00,1,28,NULL,'2024-04-07 16:05:31','2024-04-07 16:05:31'),
(66,'2024-04-07',10.00,1,29,NULL,'2024-04-07 16:12:50','2024-04-07 16:12:50'),
(68,'2024-04-07',10.00,1,31,NULL,'2024-04-07 16:22:47','2024-04-07 16:22:47'),
(69,'2024-04-07',10.00,1,32,NULL,'2024-04-07 16:29:30','2024-04-07 16:29:30'),
(70,'2024-04-07',10.00,1,33,NULL,'2024-04-07 16:30:54','2024-04-07 16:30:54'),
(71,'2024-04-07',10.00,1,34,NULL,'2024-04-07 16:32:39','2024-04-07 16:32:39'),
(72,'2024-04-07',10.00,1,35,NULL,'2024-04-07 16:34:02','2024-04-07 16:34:02'),
(73,'2024-04-07',10.00,1,36,NULL,'2024-04-07 16:41:42','2024-04-07 16:41:42'),
(74,'2024-04-07',10.00,1,37,NULL,'2024-04-07 16:42:45','2024-04-07 16:42:45'),
(75,'2024-04-07',10.00,1,38,NULL,'2024-04-07 16:58:56','2024-04-07 16:58:56'),
(76,'2024-04-07',10.00,1,39,NULL,'2024-04-07 17:00:36','2024-04-07 17:00:36'),
(77,'2024-04-07',10.00,1,40,NULL,'2024-04-07 17:02:45','2024-04-07 17:02:45'),
(78,'2024-04-07',10.00,1,41,NULL,'2024-04-07 17:09:19','2024-04-07 17:09:19'),
(79,'2024-04-07',10.00,1,42,NULL,'2024-04-07 17:23:14','2024-04-07 17:23:14'),
(80,'2024-04-07',10.00,1,43,NULL,'2024-04-07 17:25:37','2024-04-07 17:25:37'),
(81,'2024-04-07',10.00,1,44,NULL,'2024-04-07 17:27:21','2024-04-07 17:27:21'),
(82,'2024-04-11',10.00,1,45,NULL,'2024-04-11 14:29:47','2024-04-11 14:29:47'),
(83,'2024-04-11',20.00,1,46,NULL,'2024-04-11 14:33:21','2024-04-11 14:33:21'),
(84,'2024-04-11',10.00,1,47,NULL,'2024-04-11 14:41:10','2024-04-11 14:41:10'),
(85,'2024-04-11',10.00,1,48,NULL,'2024-04-11 14:44:25','2024-04-11 14:44:25'),
(86,'2024-04-11',10.00,1,49,NULL,'2024-04-11 15:00:41','2024-04-11 15:00:41'),
(87,'2024-04-11',10.00,1,50,NULL,'2024-04-11 15:02:23','2024-04-11 15:02:23'),
(88,'2024-04-11',10.00,1,51,NULL,'2024-04-11 15:04:13','2024-04-11 15:04:13'),
(89,'2024-04-11',10.00,1,52,NULL,'2024-04-11 15:05:41','2024-04-11 15:05:41'),
(90,'2024-04-11',20.00,1,53,NULL,'2024-04-11 15:18:42','2024-04-11 15:18:42'),
(91,'2024-04-11',20.00,1,54,NULL,'2024-04-11 15:21:00','2024-04-11 15:21:00'),
(92,'2024-04-11',10.00,1,55,NULL,'2024-04-11 15:22:24','2024-04-11 15:22:24'),
(93,'2024-04-11',15.00,1,56,NULL,'2024-04-11 15:23:16','2024-04-11 15:23:16'),
(94,'2024-04-11',20.00,1,57,NULL,'2024-04-11 15:27:12','2024-04-11 15:27:12'),
(97,'2024-04-11',20.00,1,60,NULL,'2024-04-11 15:37:02','2024-04-11 15:37:02'),
(98,'2024-04-11',20.00,1,61,NULL,'2024-04-11 15:37:51','2024-04-11 15:37:51'),
(99,'2024-04-11',20.00,1,62,NULL,'2024-04-11 15:38:51','2024-04-11 15:38:51'),
(100,'2024-04-11',20.00,1,63,NULL,'2024-04-11 15:39:39','2024-04-11 15:39:39'),
(101,'2024-04-11',20.00,1,64,NULL,'2024-04-11 15:40:41','2024-04-11 15:40:41'),
(102,'2024-04-11',15.00,1,65,NULL,'2024-04-11 15:43:20','2024-04-11 15:43:20'),
(103,'2024-04-11',15.00,1,66,NULL,'2024-04-11 15:46:40','2024-04-11 15:46:40'),
(104,'2024-04-11',15.00,1,67,NULL,'2024-04-11 15:47:19','2024-04-11 15:47:19'),
(105,'2024-04-11',20.00,1,68,NULL,'2024-04-11 15:51:50','2024-04-11 15:51:50'),
(106,'2024-04-11',20.00,1,69,NULL,'2024-04-11 15:53:44','2024-04-11 15:53:44'),
(107,'2024-04-11',20.00,1,70,NULL,'2024-04-11 15:55:28','2024-04-11 15:55:28'),
(108,'2024-04-11',15.00,1,71,NULL,'2024-04-11 15:56:30','2024-04-11 15:56:30'),
(109,'2024-04-11',20.00,1,72,NULL,'2024-04-11 16:02:54','2024-04-11 16:02:54'),
(110,'2024-04-11',20.00,1,73,NULL,'2024-04-11 16:07:43','2024-04-11 16:07:43'),
(111,'2024-04-11',15.00,1,74,NULL,'2024-04-11 16:10:32','2024-04-11 16:10:32'),
(112,'2024-04-11',20.00,1,75,NULL,'2024-04-11 16:11:40','2024-04-11 16:11:40'),
(113,'2024-04-11',15.00,1,76,NULL,'2024-04-11 16:31:03','2024-04-11 16:31:03'),
(114,'2024-04-11',15.00,1,77,NULL,'2024-04-11 16:32:32','2024-04-11 16:32:32'),
(115,'2024-04-11',15.00,1,78,NULL,'2024-04-11 16:34:14','2024-04-11 16:34:14'),
(116,'2024-04-11',20.00,1,79,NULL,'2024-04-11 16:34:59','2024-04-11 16:34:59'),
(117,'2024-04-11',20.00,1,80,NULL,'2024-04-11 16:35:45','2024-04-11 16:35:45'),
(118,'2024-04-11',20.00,1,81,NULL,'2024-04-11 16:41:02','2024-04-11 16:41:02'),
(119,'2024-04-11',20.00,1,82,NULL,'2024-04-11 16:42:01','2024-04-11 16:42:01'),
(120,'2024-04-11',20.00,1,83,NULL,'2024-04-11 16:43:35','2024-04-11 16:43:35'),
(121,'2024-04-11',10.00,1,84,NULL,'2024-04-11 17:07:57','2024-04-11 17:07:57'),
(122,'2024-04-11',15.00,1,85,NULL,'2024-04-11 17:10:24','2024-04-11 17:10:24'),
(123,'2024-04-11',15.00,1,86,NULL,'2024-04-11 17:11:18','2024-04-11 17:11:18'),
(124,'2024-04-11',20.00,1,87,NULL,'2024-04-11 17:13:54','2024-04-11 17:13:54'),
(125,'2024-04-11',15.00,1,88,NULL,'2024-04-11 17:14:42','2024-04-11 17:14:42'),
(126,'2024-04-11',15.00,1,89,NULL,'2024-04-11 17:15:45','2024-04-11 17:15:45'),
(127,'2024-04-11',20.00,1,90,NULL,'2024-04-11 17:35:55','2024-04-11 17:35:55'),
(128,'2024-04-11',20.00,1,91,NULL,'2024-04-11 17:37:58','2024-04-11 17:37:58'),
(129,'2024-04-11',20.00,1,92,NULL,'2024-04-11 17:40:05','2024-04-11 17:40:05'),
(130,'2024-04-11',20.00,1,93,NULL,'2024-04-11 17:41:18','2024-04-11 17:41:18'),
(131,'2024-04-11',20.00,1,94,NULL,'2024-04-11 17:42:10','2024-04-11 17:42:10'),
(132,'2024-04-11',20.00,1,95,NULL,'2024-04-11 17:44:15','2024-04-11 17:44:15'),
(133,'2024-04-11',20.00,1,96,NULL,'2024-04-11 17:45:19','2024-04-11 17:45:19'),
(134,'2024-04-11',20.00,1,97,NULL,'2024-04-11 17:46:29','2024-04-11 17:46:29'),
(135,'2024-04-11',20.00,1,98,NULL,'2024-04-11 17:47:47','2024-04-11 17:47:47'),
(136,'2024-04-11',20.00,1,99,NULL,'2024-04-11 17:48:51','2024-04-11 17:48:51'),
(137,'2024-04-11',20.00,1,100,NULL,'2024-04-11 17:50:39','2024-04-11 17:50:39'),
(138,'2024-04-15',1.00,0,14,NULL,'2024-04-15 19:26:50','2024-04-15 19:26:50'),
(139,'2024-04-15',2.00,0,16,NULL,'2024-04-15 19:26:50','2024-04-15 19:26:50'),
(140,'2024-04-15',1.00,0,29,NULL,'2024-04-15 19:26:50','2024-04-15 19:26:50'),
(141,'2024-04-15',1.00,0,37,NULL,'2024-04-15 19:26:50','2024-04-15 19:26:50'),
(142,'2024-04-15',20.00,1,101,NULL,'2024-04-15 19:43:14','2024-04-15 19:43:14'),
(143,'2024-04-15',20.00,1,102,NULL,'2024-04-15 19:44:13','2024-04-15 19:44:13'),
(144,'2024-04-15',20.00,1,103,NULL,'2024-04-15 19:44:59','2024-04-15 19:44:59'),
(145,'2024-04-15',20.00,1,104,NULL,'2024-04-15 19:46:50','2024-04-15 19:46:50'),
(146,'2024-04-15',20.00,1,105,NULL,'2024-04-15 19:48:03','2024-04-15 19:48:03'),
(147,'2024-04-15',20.00,1,106,NULL,'2024-04-15 19:49:09','2024-04-15 19:49:09'),
(148,'2024-04-15',20.00,1,107,NULL,'2024-04-15 19:49:54','2024-04-15 19:49:54'),
(149,'2024-04-15',20.00,1,108,NULL,'2024-04-15 19:50:35','2024-04-15 19:50:35'),
(150,'2024-04-15',20.00,1,109,NULL,'2024-04-15 19:54:11','2024-04-15 19:54:11'),
(151,'2024-04-15',20.00,1,110,NULL,'2024-04-15 19:55:12','2024-04-15 19:55:12'),
(152,'2024-04-15',20.00,1,111,NULL,'2024-04-15 19:56:29','2024-04-15 19:56:29'),
(153,'2024-04-15',20.00,1,112,NULL,'2024-04-15 19:57:31','2024-04-15 19:57:31'),
(154,'2024-04-15',20.00,1,113,NULL,'2024-04-15 19:58:09','2024-04-15 19:58:09'),
(155,'2024-04-15',20.00,1,114,NULL,'2024-04-15 19:59:14','2024-04-15 19:59:14'),
(156,'2024-04-15',20.00,1,115,NULL,'2024-04-15 20:00:57','2024-04-15 20:00:57'),
(157,'2024-04-15',20.00,1,116,NULL,'2024-04-15 20:01:38','2024-04-15 20:01:38'),
(158,'2024-04-15',20.00,1,117,NULL,'2024-04-15 20:02:50','2024-04-15 20:02:50'),
(159,'2024-04-15',20.00,1,118,NULL,'2024-04-15 20:07:14','2024-04-15 20:07:14'),
(160,'2024-04-15',20.00,1,119,NULL,'2024-04-15 20:08:02','2024-04-15 20:08:02'),
(161,'2024-04-15',20.00,1,120,NULL,'2024-04-15 20:28:59','2024-04-15 20:28:59'),
(162,'2024-04-15',20.00,1,121,NULL,'2024-04-15 20:30:26','2024-04-15 20:30:26'),
(163,'2024-04-15',20.00,1,122,NULL,'2024-04-15 20:31:23','2024-04-15 20:31:23'),
(164,'2024-04-15',20.00,1,123,NULL,'2024-04-15 20:32:03','2024-04-15 20:32:03'),
(165,'2024-04-15',20.00,1,124,NULL,'2024-04-15 20:35:24','2024-04-15 20:35:24'),
(166,'2024-04-15',20.00,1,125,NULL,'2024-04-15 20:36:30','2024-04-15 20:36:30'),
(167,'2024-04-15',20.00,1,126,NULL,'2024-04-15 20:38:03','2024-04-15 20:38:03'),
(168,'2024-04-15',20.00,1,127,NULL,'2024-04-15 20:39:03','2024-04-15 20:39:03'),
(169,'2024-04-15',20.00,1,128,NULL,'2024-04-15 20:42:33','2024-04-15 20:42:33'),
(170,'2024-04-15',20.00,1,129,NULL,'2024-04-15 20:43:30','2024-04-15 20:43:30'),
(171,'2024-04-15',20.00,1,130,NULL,'2024-04-15 20:44:11','2024-04-15 20:44:11'),
(172,'2024-04-15',20.00,1,131,NULL,'2024-04-15 20:45:28','2024-04-15 20:45:28'),
(173,'2024-04-15',20.00,1,132,NULL,'2024-04-15 20:47:01','2024-04-15 20:47:01'),
(174,'2024-04-15',20.00,1,133,NULL,'2024-04-15 20:58:17','2024-04-15 20:58:17'),
(175,'2024-04-15',20.00,1,134,NULL,'2024-04-15 20:59:01','2024-04-15 20:59:01'),
(176,'2024-04-15',20.00,1,135,NULL,'2024-04-15 20:59:37','2024-04-15 20:59:37'),
(177,'2024-04-15',20.00,1,136,NULL,'2024-04-15 21:00:18','2024-04-15 21:00:18'),
(178,'2024-04-15',20.00,1,137,NULL,'2024-04-15 21:01:12','2024-04-15 21:01:12'),
(179,'2024-04-15',20.00,1,138,NULL,'2024-04-15 21:03:13','2024-04-15 21:03:13'),
(180,'2024-04-15',20.00,1,139,NULL,'2024-04-15 21:05:53','2024-04-15 21:05:53'),
(181,'2024-04-15',20.00,1,140,NULL,'2024-04-15 21:06:46','2024-04-15 21:06:46'),
(182,'2024-04-15',20.00,1,141,NULL,'2024-04-15 21:45:48','2024-04-15 21:45:48'),
(183,'2024-04-15',20.00,1,142,NULL,'2024-04-15 21:47:07','2024-04-15 21:47:07'),
(184,'2024-04-15',20.00,1,143,NULL,'2024-04-15 21:48:38','2024-04-15 21:48:38'),
(185,'2024-04-15',20.00,1,144,NULL,'2024-04-15 21:49:44','2024-04-15 21:49:44'),
(186,'2024-04-15',20.00,1,145,NULL,'2024-04-15 21:53:12','2024-04-15 21:53:12'),
(187,'2024-04-15',20.00,1,146,NULL,'2024-04-15 21:54:58','2024-04-15 21:54:58'),
(188,'2024-04-15',100.00,1,147,NULL,'2024-04-15 21:56:37','2024-04-15 21:56:37'),
(189,'2024-04-15',100.00,1,148,NULL,'2024-04-15 21:58:34','2024-04-15 21:58:34'),
(190,'2024-04-15',20.00,1,149,NULL,'2024-04-15 21:59:42','2024-04-15 21:59:42'),
(191,'2024-04-15',20.00,1,150,NULL,'2024-04-15 22:02:15','2024-04-15 22:02:15'),
(192,'2024-04-15',20.00,1,151,NULL,'2024-04-15 22:05:39','2024-04-15 22:05:39'),
(193,'2024-04-15',20.00,1,152,NULL,'2024-04-15 22:06:52','2024-04-15 22:06:52'),
(194,'2024-04-15',20.00,1,153,NULL,'2024-04-15 22:07:32','2024-04-15 22:07:32'),
(195,'2024-04-15',20.00,1,154,NULL,'2024-04-15 22:09:31','2024-04-15 22:09:31'),
(196,'2024-04-15',20.00,1,155,NULL,'2024-04-15 22:10:10','2024-04-15 22:10:10'),
(197,'2024-04-15',20.00,1,156,NULL,'2024-04-15 22:10:57','2024-04-15 22:10:57'),
(198,'2024-04-15',20.00,1,157,NULL,'2024-04-15 22:11:36','2024-04-15 22:11:36'),
(199,'2024-04-15',20.00,1,158,NULL,'2024-04-15 22:12:27','2024-04-15 22:12:27'),
(200,'2024-04-16',2.00,1,159,NULL,'2024-04-16 08:26:01','2024-04-16 08:26:01'),
(201,'2024-04-16',2.00,1,160,NULL,'2024-04-16 08:32:45','2024-04-16 08:32:45'),
(202,'2024-04-16',2.00,1,161,NULL,'2024-04-16 09:31:43','2024-04-16 09:31:43'),
(203,'2024-04-16',2.00,1,162,NULL,'2024-04-16 09:53:53','2024-04-16 09:53:53'),
(204,'2024-04-16',2.00,1,163,NULL,'2024-04-16 09:58:24','2024-04-16 09:58:24'),
(205,'2024-04-16',2.00,1,164,NULL,'2024-04-16 10:12:10','2024-04-16 10:12:10'),
(206,'2024-04-16',2.00,1,165,NULL,'2024-04-16 10:15:11','2024-04-16 10:15:11'),
(207,'2024-04-16',2.00,1,166,NULL,'2024-04-16 10:18:38','2024-04-16 10:18:38'),
(208,'2024-04-16',2.00,1,167,NULL,'2024-04-16 10:56:42','2024-04-16 10:56:42'),
(209,'2024-04-16',20.00,1,168,NULL,'2024-04-16 11:38:08','2024-04-16 11:38:08'),
(211,'2024-04-16',2.00,1,171,NULL,'2024-04-16 12:04:40','2024-04-16 12:04:40'),
(212,'2024-04-16',2.00,1,172,NULL,'2024-04-16 13:19:30','2024-04-16 13:19:30'),
(213,'2024-04-16',2.00,1,173,NULL,'2024-04-16 13:20:20','2024-04-16 13:20:20'),
(214,'2024-04-16',2.00,1,174,NULL,'2024-04-16 13:22:02','2024-04-16 13:22:02'),
(215,'2024-04-16',2.00,1,175,NULL,'2024-04-16 13:22:58','2024-04-16 13:22:58'),
(216,'2024-04-16',2.00,1,176,NULL,'2024-04-16 13:25:12','2024-04-16 13:25:12'),
(217,'2024-04-16',2.00,1,177,NULL,'2024-04-16 13:25:53','2024-04-16 13:25:53'),
(218,'2024-04-16',2.00,1,178,NULL,'2024-04-16 13:29:17','2024-04-16 13:29:17'),
(219,'2024-04-16',2.00,1,179,NULL,'2024-04-16 13:32:20','2024-04-16 13:32:20'),
(220,'2024-04-16',2.00,1,180,NULL,'2024-04-16 13:45:19','2024-04-16 13:45:19'),
(221,'2024-04-16',2.00,1,181,NULL,'2024-04-16 13:46:21','2024-04-16 13:46:21'),
(222,'2024-04-16',2.00,1,182,NULL,'2024-04-16 13:47:25','2024-04-16 13:47:25'),
(223,'2024-04-16',100.00,1,183,NULL,'2024-04-16 13:49:42','2024-04-16 13:49:42'),
(224,'2024-04-16',10.00,1,184,NULL,'2024-04-16 13:51:11','2024-04-16 13:51:11'),
(225,'2024-04-16',10.00,1,185,NULL,'2024-04-16 13:51:58','2024-04-16 13:51:58'),
(226,'2024-04-16',10.00,1,186,NULL,'2024-04-16 13:52:53','2024-04-16 13:52:53'),
(227,'2024-04-17',20.00,1,187,NULL,'2024-04-17 10:42:07','2024-04-17 10:42:07'),
(228,'2024-04-17',20.00,1,188,NULL,'2024-04-17 10:50:02','2024-04-17 10:50:02'),
(229,'2024-04-17',20.00,1,189,NULL,'2024-04-17 10:51:45','2024-04-17 10:51:45'),
(230,'2024-04-17',10.00,1,190,NULL,'2024-04-17 10:54:30','2024-04-17 10:54:30'),
(231,'2024-04-17',10.00,1,191,NULL,'2024-04-17 10:55:43','2024-04-17 10:55:43'),
(232,'2024-04-17',10.00,1,192,NULL,'2024-04-17 10:56:34','2024-04-17 10:56:34'),
(233,'2024-04-17',20.00,1,193,NULL,'2024-04-17 10:57:33','2024-04-17 10:57:33'),
(234,'2024-04-17',20.00,1,194,NULL,'2024-04-17 10:59:03','2024-04-17 10:59:03'),
(235,'2024-04-17',20.00,1,195,NULL,'2024-04-17 11:00:01','2024-04-17 11:00:01'),
(236,'2024-04-17',10.00,1,196,NULL,'2024-04-17 11:01:12','2024-04-17 11:01:12'),
(237,'2024-04-17',10.00,1,197,NULL,'2024-04-17 11:02:19','2024-04-17 11:02:19'),
(238,'2024-04-17',10.00,1,198,NULL,'2024-04-17 11:03:53','2024-04-17 11:03:53'),
(239,'2024-04-17',10.00,1,199,NULL,'2024-04-17 11:05:32','2024-04-17 11:05:32'),
(240,'2024-04-17',10.00,1,200,NULL,'2024-04-17 11:07:00','2024-04-17 11:07:00'),
(241,'2024-04-17',10.00,1,201,NULL,'2024-04-17 11:09:09','2024-04-17 11:09:09'),
(242,'2024-04-17',20.00,1,202,NULL,'2024-04-17 11:11:30','2024-04-17 11:11:30'),
(243,'2024-04-17',10.00,1,203,NULL,'2024-04-17 11:12:25','2024-04-17 11:12:25'),
(244,'2024-04-17',10.00,1,204,NULL,'2024-04-17 11:15:54','2024-04-17 11:15:54'),
(245,'2024-04-17',20.00,1,205,NULL,'2024-04-17 11:18:04','2024-04-17 11:18:04'),
(246,'2024-04-17',10.00,1,206,NULL,'2024-04-17 11:20:09','2024-04-17 11:20:09'),
(247,'2024-04-17',10.00,1,207,NULL,'2024-04-17 11:21:20','2024-04-17 11:21:20'),
(248,'2024-04-17',10.00,1,208,NULL,'2024-04-17 11:58:05','2024-04-17 11:58:05'),
(249,'2024-04-17',10.00,1,209,NULL,'2024-04-17 12:10:47','2024-04-17 12:10:47'),
(250,'2024-04-17',10.00,1,210,NULL,'2024-04-17 12:22:07','2024-04-17 12:22:07'),
(251,'2024-04-17',10.00,1,210,NULL,'2024-04-17 12:24:29','2024-04-17 12:24:29'),
(252,'2024-04-17',10.00,1,211,NULL,'2024-04-17 12:27:38','2024-04-17 12:27:38'),
(253,'2024-04-17',10.00,1,212,NULL,'2024-04-17 12:29:42','2024-04-17 12:29:42'),
(254,'2024-04-17',10.00,1,213,NULL,'2024-04-17 12:31:01','2024-04-17 12:31:01'),
(255,'2024-04-17',20.00,1,214,NULL,'2024-04-17 12:31:45','2024-04-17 12:31:45'),
(256,'2024-04-17',20.00,1,215,NULL,'2024-04-17 12:32:53','2024-04-17 12:32:53'),
(257,'2024-04-17',1.00,0,14,NULL,'2024-04-17 13:46:09','2024-04-17 13:46:09'),
(258,'2024-04-17',1.00,0,29,NULL,'2024-04-17 13:46:09','2024-04-17 13:46:09'),
(259,'2024-04-17',2.00,0,139,NULL,'2024-04-17 13:46:09','2024-04-17 13:46:09'),
(260,'2024-04-17',1.00,0,124,NULL,'2024-04-17 13:46:09','2024-04-17 13:46:09'),
(261,'2024-04-17',1.00,0,15,NULL,'2024-04-17 13:46:09','2024-04-17 13:46:09'),
(262,'2024-04-17',1.00,0,43,NULL,'2024-04-17 13:46:09','2024-04-17 13:46:09'),
(263,'2024-04-17',20.00,1,216,NULL,'2024-04-17 14:01:12','2024-04-17 14:01:12'),
(264,'2024-04-17',2.00,0,124,NULL,'2024-04-17 14:02:50','2024-04-17 14:02:50'),
(265,'2024-04-17',1.00,0,29,NULL,'2024-04-17 14:02:50','2024-04-17 14:02:50'),
(266,'2024-04-17',2.00,0,128,NULL,'2024-04-17 14:02:50','2024-04-17 14:02:50'),
(267,'2024-04-17',20.00,1,217,NULL,'2024-04-17 19:57:27','2024-04-17 19:57:27'),
(268,'2024-04-17',1.00,0,80,NULL,'2024-04-17 20:16:20','2024-04-17 20:16:20'),
(269,'2024-04-17',2.00,0,104,NULL,'2024-04-17 20:16:20','2024-04-17 20:16:20'),
(270,'2024-04-17',1.00,0,106,NULL,'2024-04-17 20:16:20','2024-04-17 20:16:20'),
(271,'2024-04-17',1.00,0,113,NULL,'2024-04-17 20:16:20','2024-04-17 20:16:20'),
(272,'2024-04-17',1.00,0,111,NULL,'2024-04-17 20:16:20','2024-04-17 20:16:20'),
(273,'2024-04-17',2.00,0,121,NULL,'2024-04-17 20:16:20','2024-04-17 20:16:20'),
(274,'2024-04-17',1.00,0,126,NULL,'2024-04-17 20:16:20','2024-04-17 20:16:20'),
(275,'2024-04-17',1.00,0,91,NULL,'2024-04-17 20:16:34','2024-04-17 20:16:34'),
(276,'2024-04-17',1.00,0,40,NULL,'2024-04-17 20:16:34','2024-04-17 20:16:34'),
(277,'2024-04-17',1.00,0,32,NULL,'2024-04-17 20:16:34','2024-04-17 20:16:34'),
(278,'2024-04-17',1.00,0,16,NULL,'2024-04-17 20:16:34','2024-04-17 20:16:34'),
(279,'2024-04-17',1.00,0,43,NULL,'2024-04-17 20:16:34','2024-04-17 20:16:34'),
(280,'2024-04-17',3.00,0,147,NULL,'2024-04-17 20:16:34','2024-04-17 20:16:34'),
(281,'2024-04-17',1.00,0,118,NULL,'2024-04-17 20:16:34','2024-04-17 20:16:34'),
(282,'2024-04-17',1.00,0,121,NULL,'2024-04-17 20:16:34','2024-04-17 20:16:34'),
(283,'2024-04-17',1.00,0,89,NULL,'2024-04-17 21:47:57','2024-04-17 21:47:57'),
(284,'2024-04-17',2.00,0,127,NULL,'2024-04-17 21:47:57','2024-04-17 21:47:57'),
(285,'2024-04-17',1.00,0,35,NULL,'2024-04-17 21:47:57','2024-04-17 21:47:57'),
(286,'2024-04-17',1.00,0,29,NULL,'2024-04-17 21:47:57','2024-04-17 21:47:57'),
(287,'2024-04-17',1.00,0,37,NULL,'2024-04-17 21:47:57','2024-04-17 21:47:57'),
(288,'2024-04-17',1.00,0,43,NULL,'2024-04-17 21:47:57','2024-04-17 21:47:57'),
(289,'2024-04-17',1.00,0,133,NULL,'2024-04-17 21:47:57','2024-04-17 21:47:57'),
(290,'2024-04-17',2.00,0,124,NULL,'2024-04-17 21:47:57','2024-04-17 21:47:57'),
(291,'2024-04-17',1.00,0,31,NULL,'2024-04-17 21:48:31','2024-04-17 21:48:31'),
(292,'2024-04-17',2.00,0,147,NULL,'2024-04-17 21:48:31','2024-04-17 21:48:31'),
(293,'2024-04-17',1.00,0,16,NULL,'2024-04-17 21:48:31','2024-04-17 21:48:31'),
(294,'2024-04-17',1.00,0,43,NULL,'2024-04-17 21:48:32','2024-04-17 21:48:32'),
(295,'2024-04-17',2.00,0,16,NULL,'2024-04-17 21:48:55','2024-04-17 21:48:55'),
(296,'2024-04-17',1.00,0,217,NULL,'2024-04-17 21:48:55','2024-04-17 21:48:55'),
(297,'2024-04-17',4.00,0,147,NULL,'2024-04-17 21:48:55','2024-04-17 21:48:55'),
(298,'2024-04-17',2.00,0,75,NULL,'2024-04-17 22:02:16','2024-04-17 22:02:16'),
(299,'2024-04-17',4.00,0,156,NULL,'2024-04-17 22:02:16','2024-04-17 22:02:16'),
(300,'2024-04-26',1.00,0,15,NULL,'2024-04-26 16:45:11','2024-04-26 16:45:11'),
(301,'2024-04-26',6.00,0,147,NULL,'2024-04-26 16:45:15','2024-04-26 16:45:15'),
(302,'2024-04-26',2.00,0,148,NULL,'2024-04-26 16:45:15','2024-04-26 16:45:15'),
(303,'2024-04-26',8.00,0,147,NULL,'2024-04-26 16:45:18','2024-04-26 16:45:18'),
(304,'2024-04-26',4.00,0,148,NULL,'2024-04-26 16:45:18','2024-04-26 16:45:18'),
(305,'2024-04-26',1.00,0,32,NULL,'2024-04-26 16:49:38','2024-04-26 16:49:38'),
(306,'2024-04-26',1.00,0,44,NULL,'2024-04-26 16:49:38','2024-04-26 16:49:38'),
(307,'2024-04-26',2.00,0,124,NULL,'2024-04-26 16:49:38','2024-04-26 16:49:38'),
(308,'2024-04-26',2.00,0,140,NULL,'2024-04-26 16:49:38','2024-04-26 16:49:38'),
(309,'2024-04-26',2.00,0,124,NULL,'2024-04-26 17:09:18','2024-04-26 17:09:18'),
(310,'2024-04-26',1.00,0,52,NULL,'2024-04-26 17:09:18','2024-04-26 17:09:18'),
(311,'2024-04-26',2.00,0,140,NULL,'2024-04-26 17:09:18','2024-04-26 17:09:18'),
(312,'2024-04-27',1.00,0,139,NULL,'2024-04-27 13:34:31','2024-04-27 13:34:31'),
(313,'2024-04-27',1.00,0,153,NULL,'2024-04-27 13:34:31','2024-04-27 13:34:31'),
(314,'2024-04-27',1.00,0,57,NULL,'2024-04-27 13:34:31','2024-04-27 13:34:31'),
(315,'2024-04-27',1.00,0,128,NULL,'2024-04-27 13:34:31','2024-04-27 13:34:31'),
(316,'2024-04-27',1.00,0,186,NULL,'2024-04-27 13:34:31','2024-04-27 13:34:31'),
(317,'2024-04-27',10.00,1,218,NULL,'2024-04-27 13:43:31','2024-04-27 13:43:31'),
(318,'2024-04-27',2.00,0,35,NULL,'2024-04-27 14:46:40','2024-04-27 14:46:40'),
(319,'2024-04-27',1.00,0,153,NULL,'2024-04-27 14:46:40','2024-04-27 14:46:40'),
(320,'2024-04-27',2.00,0,147,NULL,'2024-04-27 14:49:22','2024-04-27 14:49:22'),
(321,'2024-04-27',2.00,0,148,NULL,'2024-04-27 14:49:22','2024-04-27 14:49:22'),
(322,'2024-04-27',2.00,0,14,NULL,'2024-04-27 14:58:53','2024-04-27 14:58:53'),
(323,'2024-04-27',1.00,0,43,NULL,'2024-04-27 14:58:53','2024-04-27 14:58:53'),
(324,'2024-04-27',2.00,0,117,NULL,'2024-04-27 14:58:53','2024-04-27 14:58:53'),
(325,'2024-04-27',1.00,0,37,NULL,'2024-04-27 14:58:53','2024-04-27 14:58:53'),
(326,'2024-04-27',1.00,0,68,NULL,'2024-04-27 14:58:53','2024-04-27 14:58:53');

/*Table structure for table `factura_detalles` */

DROP TABLE IF EXISTS `factura_detalles`;

CREATE TABLE `factura_detalles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `cantidad` int(11) NOT NULL,
  `valor_unitario` decimal(10,2) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `producto_id` bigint(20) unsigned DEFAULT NULL,
  `cabaña_id` bigint(20) unsigned DEFAULT NULL,
  `factura_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `factura_detalles_producto_id_foreign` (`producto_id`),
  KEY `factura_detalles_cabaña_id_foreign` (`cabaña_id`),
  KEY `factura_detalles_factura_id_foreign` (`factura_id`),
  CONSTRAINT `factura_detalles_cabaña_id_foreign` FOREIGN KEY (`cabaña_id`) REFERENCES `cabañas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `factura_detalles_factura_id_foreign` FOREIGN KEY (`factura_id`) REFERENCES `factura_encabezados` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `factura_detalles_producto_id_foreign` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `factura_detalles` */

/*Table structure for table `factura_encabezados` */

DROP TABLE IF EXISTS `factura_encabezados`;

CREATE TABLE `factura_encabezados` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `fecha` date NOT NULL,
  `codigo` varchar(50) NOT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  `impuestos` decimal(10,2) NOT NULL,
  `descuento` decimal(10,2) NOT NULL,
  `recibido` decimal(10,2) NOT NULL,
  `empleado_id` bigint(20) unsigned NOT NULL,
  `cliente_id` bigint(20) unsigned DEFAULT NULL,
  `tipo_documento_id` bigint(20) unsigned NOT NULL,
  `forma_pago_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `factura_encabezados_codigo_unique` (`codigo`),
  KEY `factura_encabezados_empleado_id_foreign` (`empleado_id`),
  KEY `factura_encabezados_cliente_id_foreign` (`cliente_id`),
  KEY `factura_encabezados_tipo_documento_id_foreign` (`tipo_documento_id`),
  KEY `factura_encabezados_forma_pago_id_foreign` (`forma_pago_id`),
  CONSTRAINT `factura_encabezados_cliente_id_foreign` FOREIGN KEY (`cliente_id`) REFERENCES `clientes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `factura_encabezados_empleado_id_foreign` FOREIGN KEY (`empleado_id`) REFERENCES `empleados` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `factura_encabezados_forma_pago_id_foreign` FOREIGN KEY (`forma_pago_id`) REFERENCES `forma_pagos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `factura_encabezados_tipo_documento_id_foreign` FOREIGN KEY (`tipo_documento_id`) REFERENCES `tipo_documentos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `factura_encabezados` */

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

/*Table structure for table `forma_pagos` */

DROP TABLE IF EXISTS `forma_pagos`;

CREATE TABLE `forma_pagos` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `forma_pagos` */

insert  into `forma_pagos`(`id`,`nombre`,`descripcion`,`created_at`,`updated_at`) values 
(1,'Contado',NULL,NULL,NULL),
(2,'Datafono',NULL,NULL,NULL),
(3,'Transferencia',NULL,NULL,NULL);

/*Table structure for table `impresoras` */

DROP TABLE IF EXISTS `impresoras`;

CREATE TABLE `impresoras` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `codigo` varchar(50) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `recurso_compartido` varchar(50) NOT NULL,
  `tamaño_fuente_encabezado` int(11) NOT NULL,
  `tamaño_fuente_contenido` int(11) NOT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `impresoras_codigo_unique` (`codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `impresoras` */

insert  into `impresoras`(`id`,`codigo`,`nombre`,`recurso_compartido`,`tamaño_fuente_encabezado`,`tamaño_fuente_contenido`,`descripcion`,`created_at`,`updated_at`) values 
(1,'001','impresora bar','bar',2,1,NULL,NULL,'2024-02-21 17:05:17'),
(2,'002','impresora caja','caja',2,1,NULL,'2024-02-21 17:03:49','2024-02-21 17:03:49'),
(3,'003','impresora cocina','cocina',2,1,NULL,'2024-02-21 17:06:30','2024-02-21 17:06:30');

/*Table structure for table `impuestos` */

DROP TABLE IF EXISTS `impuestos`;

CREATE TABLE `impuestos` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  `valor` decimal(10,2) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `impuestos` */

insert  into `impuestos`(`id`,`nombre`,`valor`,`descripcion`,`created_at`,`updated_at`) values 
(1,'IVA',19.00,NULL,NULL,NULL);

/*Table structure for table `materia_primas` */

DROP TABLE IF EXISTS `materia_primas`;

CREATE TABLE `materia_primas` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `codigo` varchar(100) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `costo_unitario` decimal(10,2) NOT NULL,
  `imagen` varchar(100) DEFAULT NULL,
  `unidad_medida_id` bigint(20) unsigned NOT NULL,
  `categoria_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `materia_primas_codigo_unique` (`codigo`),
  KEY `materia_primas_unidad_medida_id_foreign` (`unidad_medida_id`),
  KEY `materia_primas_categoria_id_foreign` (`categoria_id`),
  CONSTRAINT `materia_primas_categoria_id_foreign` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `materia_primas_unidad_medida_id_foreign` FOREIGN KEY (`unidad_medida_id`) REFERENCES `unidad_medidas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `materia_primas` */

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `migrations` */

insert  into `migrations`(`id`,`migration`,`batch`) values 
(1,'2014_10_12_000000_create_users_table',1),
(2,'2014_10_12_100000_create_password_reset_tokens_table',1),
(3,'2019_08_19_000000_create_failed_jobs_table',1),
(4,'2019_12_14_000001_create_personal_access_tokens_table',1),
(5,'2023_05_30_132215_create_categorias_table',1),
(6,'2023_05_30_134539_create_unidad_medidas_table',1),
(7,'2023_05_30_140211_create_productos_table',1),
(8,'2023_05_30_215631_create_existencias_table',1),
(9,'2023_06_03_145100_create_cabañas_table',1),
(10,'2023_06_03_175348_create_empleados_table',1),
(11,'2023_06_03_183912_create_roles_table',1),
(12,'2023_06_03_202005_add_to_users_table',1),
(13,'2023_06_04_030822_create_clientes_table',1),
(14,'2023_06_04_172250_create_tipo_regimens_table',1),
(15,'2023_06_04_180712_create_impuestos_table',1),
(16,'2023_06_04_182552_create_empresas_table',1),
(17,'2023_06_04_192238_add_to_users_table',1),
(18,'2023_06_08_151831_create_materia_primas_table',1),
(19,'2023_06_08_153416_add_to_existencias_table',1),
(20,'2023_06_08_162339_create_preparacions_table',1),
(21,'2023_06_08_163317_create_estados_table',1),
(22,'2023_06_12_155735_create_orden_encabezados_table',1),
(23,'2023_06_12_155918_create_orden_detalles_table',1),
(24,'2023_06_28_085212_create_forma_pagos_table',1),
(25,'2023_06_28_085311_create_tipo_documentos_table',1),
(26,'2023_06_28_085527_create_factura_encabezados_table',1),
(27,'2023_06_28_091632_create_factura_detalles_table',1),
(28,'2023_07_15_132714_create_pagos_table',1),
(29,'2023_07_16_074431_create_configuracions_table',1),
(30,'2023_07_16_113510_add_to_orden_encabezados_table',1),
(31,'2023_09_21_142842_impresora',1),
(32,'2023_09_21_144455_add_to_productos_table',1),
(33,'2023_09_24_144143_create_obeservacions_table',1),
(34,'2023_09_25_123716_create_pago_detalles_table',1),
(35,'2023_10_11_121800_create_cajas_table',1),
(36,'2023_10_12_082141_add_to_users_table',1),
(37,'2023_10_12_082757_create_caja_movimientos_table',1),
(38,'2023_10_27_102909_add_to_orden_encabezados_table',1),
(39,'2023_11_22_114024_create_cuentas_cobrars_table',1),
(40,'2023_11_22_115909_create_cuentas_cobrar_detalles_table',1),
(41,'2023_11_22_131035_create_tipo_cobros_table',1),
(42,'2023_11_22_131957_add_to_cuentas_cobrars_table',1),
(43,'2024_02_04_184523_add_to_orden_encabezados_table',1),
(44,'2024_02_16_115234_add_to_empleados_table',1),
(45,'2024_02_16_180806_add_to_cabañas_table',1),
(46,'2024_03_03_112300_add_to_orden_encabezados_table',2),
(47,'2024_03_03_112658_add_to_orden_detalles_table',2);

/*Table structure for table `observacions` */

DROP TABLE IF EXISTS `observacions`;

CREATE TABLE `observacions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `codigo` varchar(50) NOT NULL,
  `descripcion` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `observacions_codigo_unique` (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `observacions` */

/*Table structure for table `orden_detalles` */

DROP TABLE IF EXISTS `orden_detalles`;

CREATE TABLE `orden_detalles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `cantidad` decimal(10,2) NOT NULL,
  `valor_unitario` decimal(10,2) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `orden_encabezado_id` bigint(20) unsigned NOT NULL,
  `producto_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `observaciones` text DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `orden_detalles_orden_encabezado_id_foreign` (`orden_encabezado_id`),
  KEY `orden_detalles_producto_id_foreign` (`producto_id`),
  CONSTRAINT `orden_detalles_orden_encabezado_id_foreign` FOREIGN KEY (`orden_encabezado_id`) REFERENCES `orden_encabezados` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `orden_detalles_producto_id_foreign` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=123 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `orden_detalles` */

insert  into `orden_detalles`(`id`,`cantidad`,`valor_unitario`,`total`,`orden_encabezado_id`,`producto_id`,`created_at`,`updated_at`,`observaciones`) values 
(52,1.00,35000.00,35000.00,20,14,'2024-04-11 13:11:51','2024-04-11 13:11:51','frita sudada'),
(53,2.00,38000.00,76000.00,20,16,'2024-04-11 13:11:51','2024-04-11 13:11:51','sin arroz mas patacon'),
(54,1.00,50000.00,50000.00,20,29,'2024-04-11 13:11:51','2024-04-11 13:11:51',NULL),
(55,1.00,40000.00,40000.00,20,37,'2024-04-11 13:11:51','2024-04-11 13:11:51',NULL),
(56,1.00,35000.00,35000.00,21,14,'2024-04-17 13:38:10','2024-04-17 13:38:10',NULL),
(57,1.00,50000.00,50000.00,21,29,'2024-04-17 13:38:10','2024-04-17 13:38:10','con poca sal'),
(58,2.00,25000.00,50000.00,21,139,'2024-04-17 13:38:10','2024-04-17 13:38:10',NULL),
(59,1.00,5000.00,5000.00,21,124,'2024-04-17 13:38:10','2024-04-17 13:38:10','cocacola personal con hielo'),
(60,1.00,32000.00,32000.00,21,15,'2024-04-17 13:38:10','2024-04-17 13:38:10','sudada'),
(61,1.00,8000.00,8000.00,21,43,'2024-04-17 13:38:10','2024-04-17 13:38:10',NULL),
(62,2.00,5000.00,10000.00,22,124,'2024-04-17 13:56:54','2024-04-17 13:56:54','Manzana y cocacola'),
(63,1.00,50000.00,50000.00,22,29,'2024-04-17 13:58:50','2024-04-17 13:58:50','Marinado'),
(64,2.00,4000.00,8000.00,22,128,'2024-04-17 14:02:25','2024-04-17 14:02:25',NULL),
(65,1.00,10000.00,10000.00,23,80,'2024-04-17 20:02:41','2024-04-17 20:02:41',NULL),
(66,2.00,6000.00,12000.00,23,104,'2024-04-17 20:02:41','2024-04-17 20:02:41',NULL),
(67,1.00,8000.00,8000.00,23,106,'2024-04-17 20:02:41','2024-04-17 20:02:41',NULL),
(68,1.00,10000.00,10000.00,23,113,'2024-04-17 20:02:41','2024-04-17 20:02:41',NULL),
(69,1.00,10000.00,10000.00,23,111,'2024-04-17 20:02:41','2024-04-17 20:02:41',NULL),
(70,2.00,9000.00,18000.00,23,121,'2024-04-17 20:02:41','2024-04-17 20:02:41','NISPERO Y ZAPOTE'),
(71,1.00,8000.00,8000.00,23,126,'2024-04-17 20:02:41','2024-04-17 20:02:41',NULL),
(72,1.00,38000.00,38000.00,24,91,'2024-04-17 20:09:18','2024-04-17 20:09:18',NULL),
(73,1.00,45000.00,45000.00,24,40,'2024-04-17 20:09:18','2024-04-17 20:09:18',NULL),
(74,1.00,43000.00,43000.00,24,32,'2024-04-17 20:09:18','2024-04-17 20:09:18',NULL),
(75,1.00,38000.00,38000.00,24,16,'2024-04-17 20:09:18','2024-04-17 20:09:18','SUDADO'),
(76,1.00,8000.00,8000.00,24,43,'2024-04-17 20:09:18','2024-04-17 20:09:18',NULL),
(77,3.00,5000.00,15000.00,24,147,'2024-04-17 20:09:18','2024-04-17 20:09:18',NULL),
(78,1.00,12000.00,12000.00,24,118,'2024-04-17 20:09:18','2024-04-17 20:09:18',NULL),
(79,1.00,9000.00,9000.00,24,121,'2024-04-17 20:09:18','2024-04-17 20:09:18','ZAPOTE'),
(80,2.00,80000.00,160000.00,25,75,'2024-04-17 20:13:13','2024-04-17 20:13:13',NULL),
(81,4.00,13000.00,52000.00,25,156,'2024-04-17 20:13:13','2024-04-17 20:13:13',NULL),
(82,2.00,38000.00,76000.00,26,16,'2024-04-17 20:28:10','2024-04-17 20:28:10',NULL),
(83,1.00,8000.00,8000.00,26,217,'2024-04-17 20:28:10','2024-04-17 20:28:10','Sapote'),
(84,4.00,5000.00,20000.00,26,147,'2024-04-17 20:28:10','2024-04-17 20:28:10',NULL),
(85,1.00,45000.00,45000.00,27,31,'2024-04-17 20:39:33','2024-04-17 20:39:33',NULL),
(86,2.00,5000.00,10000.00,27,147,'2024-04-17 20:39:33','2024-04-17 20:39:33',NULL),
(87,1.00,38000.00,38000.00,27,16,'2024-04-17 20:39:33','2024-04-17 20:39:33','Sudado'),
(88,1.00,8000.00,8000.00,27,43,'2024-04-17 20:39:33','2024-04-17 20:39:33',NULL),
(89,1.00,36000.00,36000.00,28,89,'2024-04-17 21:43:29','2024-04-17 21:43:29',NULL),
(90,2.00,8000.00,16000.00,28,127,'2024-04-17 21:43:29','2024-04-17 21:43:29','Michelada'),
(91,1.00,43000.00,43000.00,28,35,'2024-04-17 21:43:29','2024-04-17 21:43:29',NULL),
(92,1.00,50000.00,50000.00,28,29,'2024-04-17 21:43:29','2024-04-17 21:43:29','Sudado'),
(93,1.00,40000.00,40000.00,28,37,'2024-04-17 21:43:29','2024-04-17 21:43:29','Sudado'),
(94,1.00,8000.00,8000.00,28,43,'2024-04-17 21:43:29','2024-04-17 21:43:29',NULL),
(95,1.00,12000.00,12000.00,28,133,'2024-04-17 21:43:29','2024-04-17 21:43:29',NULL),
(96,2.00,5000.00,10000.00,28,124,'2024-04-17 21:43:29','2024-04-17 21:43:29','Cocacola y Postobón uva'),
(97,8.00,5000.00,40000.00,29,147,'2024-04-17 22:41:40','2024-04-17 22:52:10',NULL),
(98,6.00,5000.00,30000.00,30,147,'2024-04-17 22:48:20','2024-04-17 22:48:20',NULL),
(99,2.00,5000.00,10000.00,30,148,'2024-04-17 22:50:02','2024-04-17 22:50:02',NULL),
(100,4.00,5000.00,20000.00,29,148,'2024-04-17 22:54:13','2024-04-17 22:54:13',NULL),
(101,1.00,32000.00,32000.00,31,15,'2024-04-24 12:16:07','2024-04-24 12:16:07',NULL),
(102,1.00,43000.00,43000.00,32,32,'2024-04-26 16:47:47','2024-04-26 16:47:47','salsa marinera'),
(103,1.00,12000.00,12000.00,32,44,'2024-04-26 16:48:03','2024-04-26 16:48:03',NULL),
(104,2.00,5000.00,10000.00,32,124,'2024-04-26 16:48:45','2024-04-26 16:48:45','uva y cocacola'),
(105,2.00,23000.00,46000.00,32,140,'2024-04-26 16:49:23','2024-04-26 16:49:23','cerezada'),
(106,2.00,5000.00,10000.00,33,124,'2024-04-26 17:08:22','2024-04-26 17:08:22','cocacola y uva'),
(107,1.00,45000.00,45000.00,33,52,'2024-04-26 17:08:37','2024-04-26 17:08:37',NULL),
(108,2.00,23000.00,46000.00,33,140,'2024-04-26 17:09:10','2024-04-26 17:09:10','ceresadas'),
(109,2.00,5000.00,10000.00,34,147,'2024-04-27 13:28:07','2024-04-27 13:28:07',NULL),
(110,2.00,5000.00,10000.00,34,148,'2024-04-27 13:30:15','2024-04-27 13:30:15',NULL),
(111,2.00,43000.00,86000.00,35,35,'2024-04-27 13:31:01','2024-04-27 13:31:01',NULL),
(112,1.00,8000.00,8000.00,35,153,'2024-04-27 13:31:16','2024-04-27 13:31:16',NULL),
(113,1.00,25000.00,25000.00,36,139,'2024-04-27 13:32:33','2024-04-27 13:32:33',NULL),
(114,1.00,8000.00,8000.00,36,153,'2024-04-27 13:32:50','2024-04-27 13:32:50',NULL),
(115,1.00,32000.00,32000.00,36,57,'2024-04-27 13:33:26','2024-04-27 13:33:26',NULL),
(116,1.00,4000.00,4000.00,36,128,'2024-04-27 13:33:50','2024-04-27 13:33:50',NULL),
(117,1.00,15000.00,15000.00,36,186,'2024-04-27 13:34:20','2024-04-27 13:34:20',NULL),
(118,2.00,35000.00,70000.00,37,14,'2024-04-27 14:57:02','2024-04-27 14:57:02','UNA FRITA Y LA OTRA FRITA SUDADA'),
(119,1.00,8000.00,8000.00,37,43,'2024-04-27 14:57:12','2024-04-27 14:57:12',NULL),
(120,2.00,8000.00,16000.00,37,117,'2024-04-27 14:57:37','2024-04-27 14:57:37','POCA AZUCAR'),
(121,1.00,40000.00,40000.00,37,37,'2024-04-27 14:57:56','2024-04-27 14:57:56',NULL),
(122,1.00,35000.00,35000.00,37,68,'2024-04-27 14:58:40','2024-04-27 14:58:40',NULL);

/*Table structure for table `orden_encabezados` */

DROP TABLE IF EXISTS `orden_encabezados`;

CREATE TABLE `orden_encabezados` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `codigo` varchar(50) NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `hora_entrega` time NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `cabaña_id` bigint(20) unsigned DEFAULT NULL,
  `cliente_id` bigint(20) unsigned DEFAULT NULL,
  `empleado_id` bigint(20) unsigned NOT NULL,
  `estado_id` bigint(20) unsigned NOT NULL DEFAULT 1,
  `credito` tinyint(4) NOT NULL DEFAULT 0,
  `tipo_documento_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `domicilio` tinyint(4) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE KEY `orden_encabezados_codigo_unique` (`codigo`),
  KEY `orden_encabezados_cabaña_id_foreign` (`cabaña_id`),
  KEY `orden_encabezados_cliente_id_foreign` (`cliente_id`),
  KEY `orden_encabezados_empleado_id_foreign` (`empleado_id`),
  KEY `orden_encabezados_estado_id_foreign` (`estado_id`),
  KEY `orden_encabezados_tipo_documento_id_foreign` (`tipo_documento_id`),
  CONSTRAINT `orden_encabezados_cabaña_id_foreign` FOREIGN KEY (`cabaña_id`) REFERENCES `cabañas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `orden_encabezados_cliente_id_foreign` FOREIGN KEY (`cliente_id`) REFERENCES `clientes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `orden_encabezados_empleado_id_foreign` FOREIGN KEY (`empleado_id`) REFERENCES `empleados` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `orden_encabezados_estado_id_foreign` FOREIGN KEY (`estado_id`) REFERENCES `estados` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `orden_encabezados_tipo_documento_id_foreign` FOREIGN KEY (`tipo_documento_id`) REFERENCES `tipo_documentos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `orden_encabezados` */

insert  into `orden_encabezados`(`id`,`codigo`,`fecha`,`hora`,`hora_entrega`,`total`,`cabaña_id`,`cliente_id`,`empleado_id`,`estado_id`,`credito`,`tipo_documento_id`,`created_at`,`updated_at`,`domicilio`) values 
(15,'1709327828','2024-03-01','16:17:08','16:42:08',85000.00,1,NULL,2,3,0,3,'2024-03-01 16:17:33','2024-03-01 17:39:47',0),
(16,'1709328767','2024-03-01','16:32:47','16:52:47',50000.00,5,NULL,2,3,0,3,'2024-03-01 16:33:18','2024-03-01 17:38:18',0),
(17,'1709329104','2024-03-01','16:38:24','16:58:24',177000.00,4,NULL,2,3,0,3,'2024-03-01 16:39:07','2024-03-01 17:35:42',0),
(18,'1709332958','2024-03-01','17:42:38','18:02:38',206000.00,18,NULL,5,3,0,3,'2024-03-01 17:45:15','2024-03-01 18:04:18',0),
(20,'1712859090','2024-04-11','13:11:30','13:11:30',201000.00,1,NULL,3,3,0,3,'2024-04-11 13:11:51','2024-04-15 19:27:58',0),
(21,'1713378994','2024-04-17','13:36:34','13:36:34',180000.00,19,NULL,3,3,0,3,'2024-04-17 13:38:10','2024-04-17 13:47:17',0),
(22,'1713380129','2024-04-17','13:55:29','13:55:29',68000.00,1,NULL,2,3,0,3,'2024-04-17 13:56:54','2024-04-17 19:40:51',0),
(23,'1713402141','2024-04-17','20:02:21','20:02:21',76000.00,8,NULL,3,3,0,3,'2024-04-17 20:02:41','2024-04-17 20:16:54',0),
(24,'1713402547','2024-04-17','20:09:07','20:09:07',208000.00,13,NULL,3,3,0,3,'2024-04-17 20:09:18','2024-04-17 20:17:10',0),
(25,'1713402782','2024-04-17','20:13:02','20:13:02',212000.00,20,NULL,3,3,0,3,'2024-04-17 20:13:13','2024-04-17 22:39:31',0),
(26,'1713403678','2024-04-17','20:27:58','20:27:58',104000.00,5,NULL,2,3,0,3,'2024-04-17 20:28:10','2024-04-17 22:40:08',0),
(27,'1713404357','2024-04-17','20:39:17','20:39:17',101000.00,8,NULL,2,3,0,3,'2024-04-17 20:39:33','2024-04-17 22:36:50',0),
(28,'1713408192','2024-04-17','21:43:12','21:43:12',215000.00,16,NULL,2,3,0,3,'2024-04-17 21:43:29','2024-04-17 21:49:59',0),
(29,'1713411637','2024-04-17','22:40:37','22:40:37',60000.00,19,NULL,2,3,0,3,'2024-04-17 22:41:40','2024-04-26 16:46:00',0),
(30,'1713412078','2024-04-17','22:47:58','22:47:58',40000.00,20,NULL,2,3,0,3,'2024-04-17 22:48:20','2024-04-26 16:45:41',0),
(31,'1713978956','2024-04-24','12:15:56','12:15:56',32000.00,2,NULL,2,3,0,3,'2024-04-24 12:16:07','2024-04-26 16:45:30',0),
(32,'1714168059','2024-04-26','16:47:39','16:47:39',111000.00,1,NULL,3,3,0,3,'2024-04-26 16:47:47','2024-04-26 17:06:10',0),
(33,'1714169294','2024-04-26','17:08:14','17:08:14',101000.00,1,NULL,3,3,0,3,'2024-04-26 17:08:22','2024-04-26 17:17:13',0),
(34,'1714242478','2024-04-27','13:27:58','13:27:58',20000.00,2,NULL,3,3,0,3,'2024-04-27 13:28:07','2024-04-27 14:52:45',0),
(35,'1714242653','2024-04-27','13:30:53','13:30:53',94000.00,20,NULL,3,3,0,3,'2024-04-27 13:31:01','2024-04-27 14:50:32',0),
(36,'1714242746','2024-04-27','13:32:26','13:32:26',84000.00,19,NULL,3,3,0,3,'2024-04-27 13:32:33','2024-04-27 13:34:52',0),
(37,'1714247794','2024-04-27','14:56:34','14:56:34',169000.00,1,NULL,3,3,0,3,'2024-04-27 14:57:02','2024-04-27 15:01:49',0);

/*Table structure for table `pago_detalles` */

DROP TABLE IF EXISTS `pago_detalles`;

CREATE TABLE `pago_detalles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `detalle_pago` varchar(50) NOT NULL,
  `valor_recibido` decimal(10,2) NOT NULL,
  `forma_pago_id` bigint(20) unsigned NOT NULL,
  `pago_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pago_detalles_forma_pago_id_foreign` (`forma_pago_id`),
  KEY `pago_detalles_pago_id_foreign` (`pago_id`),
  CONSTRAINT `pago_detalles_forma_pago_id_foreign` FOREIGN KEY (`forma_pago_id`) REFERENCES `forma_pagos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `pago_detalles_pago_id_foreign` FOREIGN KEY (`pago_id`) REFERENCES `pagos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `pago_detalles` */

insert  into `pago_detalles`(`id`,`detalle_pago`,`valor_recibido`,`forma_pago_id`,`pago_id`,`created_at`,`updated_at`) values 
(4,'Pago de contado',177000.00,1,4,'2024-03-01 17:35:42','2024-03-01 17:35:42'),
(5,'Pago de contado',50000.00,1,5,'2024-03-01 17:38:18','2024-03-01 17:38:18'),
(6,'Pago de contado',85000.00,1,6,'2024-03-01 17:39:47','2024-03-01 17:39:47'),
(7,'Pago de contado',206000.00,1,7,'2024-03-01 18:04:18','2024-03-01 18:04:18'),
(8,'Pago de contado',201000.00,1,8,'2024-04-15 19:27:58','2024-04-15 19:27:58'),
(9,'Pago de contado',180000.00,1,9,'2024-04-17 13:47:17','2024-04-17 13:47:17'),
(10,'Pago de contado',68000.00,1,10,'2024-04-17 19:40:51','2024-04-17 19:40:51'),
(11,'Pago de contado',76000.00,1,11,'2024-04-17 20:16:54','2024-04-17 20:16:54'),
(12,'Pago de contado',208000.00,1,12,'2024-04-17 20:17:10','2024-04-17 20:17:10'),
(13,'Pago de contado',215000.00,1,13,'2024-04-17 21:49:59','2024-04-17 21:49:59'),
(14,'Pago de contado',101000.00,1,14,'2024-04-17 22:36:50','2024-04-17 22:36:50'),
(15,'Pago de contado',212000.00,1,15,'2024-04-17 22:39:31','2024-04-17 22:39:31'),
(16,'Pago de contado',104000.00,1,16,'2024-04-17 22:40:08','2024-04-17 22:40:08'),
(17,'Pago de contado',32000.00,1,17,'2024-04-26 16:45:30','2024-04-26 16:45:30'),
(18,'Pago de contado',40000.00,1,18,'2024-04-26 16:45:41','2024-04-26 16:45:41'),
(19,'Pago de contado',60000.00,1,19,'2024-04-26 16:46:00','2024-04-26 16:46:00'),
(20,'Pago de contado',111000.00,1,20,'2024-04-26 17:06:10','2024-04-26 17:06:10'),
(21,'Pago de contado',101000.00,1,21,'2024-04-26 17:17:13','2024-04-26 17:17:13'),
(22,'Pago de contado',84000.00,1,22,'2024-04-27 13:34:52','2024-04-27 13:34:52'),
(23,'Pago de contado',94000.00,1,23,'2024-04-27 14:50:32','2024-04-27 14:50:32'),
(24,'Pago de contado',20000.00,1,24,'2024-04-27 14:52:45','2024-04-27 14:52:45'),
(25,'Pago de contado',169000.00,1,25,'2024-04-27 15:01:49','2024-04-27 15:01:49');

/*Table structure for table `pagos` */

DROP TABLE IF EXISTS `pagos`;

CREATE TABLE `pagos` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `codigo` varchar(50) NOT NULL,
  `fecha_hora` date NOT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  `impuesto` decimal(10,2) NOT NULL,
  `descuento` decimal(10,2) NOT NULL,
  `total_pagar` decimal(10,2) NOT NULL,
  `recibido` decimal(10,2) NOT NULL,
  `cambio` decimal(10,2) NOT NULL,
  `observaciones` varchar(255) DEFAULT NULL,
  `orden_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `pagos_codigo_unique` (`codigo`),
  KEY `pagos_orden_id_foreign` (`orden_id`),
  CONSTRAINT `pagos_orden_id_foreign` FOREIGN KEY (`orden_id`) REFERENCES `orden_encabezados` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `pagos` */

insert  into `pagos`(`id`,`codigo`,`fecha_hora`,`subtotal`,`impuesto`,`descuento`,`total_pagar`,`recibido`,`cambio`,`observaciones`,`orden_id`,`created_at`,`updated_at`) values 
(4,'1709332536','2024-03-01',177000.00,0.00,0.00,177000.00,177000.00,0.00,NULL,17,'2024-03-01 17:35:42','2024-03-01 17:35:42'),
(5,'1709332695','2024-03-01',50000.00,0.00,0.00,50000.00,50000.00,0.00,NULL,16,'2024-03-01 17:38:18','2024-03-01 17:38:18'),
(6,'1709332784','2024-03-01',85000.00,0.00,0.00,85000.00,85000.00,0.00,NULL,15,'2024-03-01 17:39:47','2024-03-01 17:39:47'),
(7,'1709334251','2024-03-01',206000.00,0.00,0.00,206000.00,206000.00,0.00,NULL,18,'2024-03-01 18:04:18','2024-03-01 18:04:18'),
(8,'1713227271','2024-04-15',201000.00,0.00,0.00,201000.00,201000.00,0.00,NULL,20,'2024-04-15 19:27:58','2024-04-15 19:27:58'),
(9,'1713379631','2024-04-17',180000.00,0.00,0.00,180000.00,180000.00,0.00,NULL,21,'2024-04-17 13:47:17','2024-04-17 13:47:17'),
(10,'1713400834','2024-04-17',68000.00,0.00,0.00,68000.00,68000.00,0.00,NULL,22,'2024-04-17 19:40:51','2024-04-17 19:40:51'),
(11,'1713403008','2024-04-17',76000.00,0.00,0.00,76000.00,76000.00,0.00,NULL,23,'2024-04-17 20:16:54','2024-04-17 20:16:54'),
(12,'1713403026','2024-04-17',208000.00,0.00,0.00,208000.00,208000.00,0.00,NULL,24,'2024-04-17 20:17:10','2024-04-17 20:17:10'),
(13,'1713408592','2024-04-17',215000.00,0.00,0.00,215000.00,215000.00,0.00,NULL,28,'2024-04-17 21:49:59','2024-04-17 21:49:59'),
(14,'1713411399','2024-04-17',101000.00,0.00,10.00,101000.00,101000.00,0.00,NULL,27,'2024-04-17 22:36:50','2024-04-17 22:36:50'),
(15,'1713411567','2024-04-17',212000.00,0.00,0.00,212000.00,212000.00,0.00,NULL,25,'2024-04-17 22:39:31','2024-04-17 22:39:31'),
(16,'1713411583','2024-04-17',104000.00,0.00,0.00,104000.00,104000.00,0.00,NULL,26,'2024-04-17 22:40:08','2024-04-17 22:40:08'),
(17,'1714167928','2024-04-26',32000.00,0.00,0.00,32000.00,32000.00,0.00,NULL,31,'2024-04-26 16:45:30','2024-04-26 16:45:30'),
(18,'1714167939','2024-04-26',40000.00,0.00,0.00,40000.00,40000.00,0.00,NULL,30,'2024-04-26 16:45:41','2024-04-26 16:45:41'),
(19,'1714167958','2024-04-26',60000.00,0.00,0.00,60000.00,60000.00,0.00,NULL,29,'2024-04-26 16:46:00','2024-04-26 16:46:00'),
(20,'1714169169','2024-04-26',111000.00,0.00,0.00,111000.00,111000.00,0.00,NULL,32,'2024-04-26 17:06:10','2024-04-26 17:06:10'),
(21,'1714169831','2024-04-26',101000.00,0.00,0.00,101000.00,101000.00,0.00,NULL,33,'2024-04-26 17:17:13','2024-04-26 17:17:13'),
(22,'1714242890','2024-04-27',84000.00,0.00,0.00,84000.00,84000.00,0.00,NULL,36,'2024-04-27 13:34:52','2024-04-27 13:34:52'),
(23,'1714247430','2024-04-27',94000.00,0.00,0.00,94000.00,94000.00,0.00,NULL,35,'2024-04-27 14:50:32','2024-04-27 14:50:32'),
(24,'1714247547','2024-04-27',20000.00,0.00,0.00,20000.00,20000.00,0.00,'MANDAR COPIA AL WASAP 3227811941',34,'2024-04-27 14:52:45','2024-04-27 14:52:45'),
(25,'1714248098','2024-04-27',169000.00,0.00,0.00,169000.00,169000.00,0.00,'DESCUENTO EMPLEADO',37,'2024-04-27 15:01:49','2024-04-27 15:01:49');

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

/*Table structure for table `preparacions` */

DROP TABLE IF EXISTS `preparacions`;

CREATE TABLE `preparacions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `cantidad` decimal(10,2) NOT NULL,
  `materia_prima_id` bigint(20) unsigned NOT NULL,
  `producto_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `preparacions_materia_prima_id_foreign` (`materia_prima_id`),
  KEY `preparacions_producto_id_foreign` (`producto_id`),
  CONSTRAINT `preparacions_materia_prima_id_foreign` FOREIGN KEY (`materia_prima_id`) REFERENCES `materia_primas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `preparacions_producto_id_foreign` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `preparacions` */

/*Table structure for table `productos` */

DROP TABLE IF EXISTS `productos`;

CREATE TABLE `productos` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `codigo` varchar(100) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `preparacion` text DEFAULT NULL,
  `costo_unitario` decimal(10,2) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `imagen` varchar(100) DEFAULT NULL,
  `foraneo` tinyint(4) NOT NULL DEFAULT 0,
  `tiempo_coccion` int(11) DEFAULT NULL,
  `impresora_id` bigint(20) unsigned NOT NULL,
  `unidad_medida_id` bigint(20) unsigned DEFAULT NULL,
  `categoria_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `productos_codigo_unique` (`codigo`),
  KEY `productos_unidad_medida_id_foreign` (`unidad_medida_id`),
  KEY `productos_categoria_id_foreign` (`categoria_id`),
  KEY `productos_impresora_id_foreign` (`impresora_id`),
  CONSTRAINT `productos_categoria_id_foreign` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `productos_impresora_id_foreign` FOREIGN KEY (`impresora_id`) REFERENCES `impresoras` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `productos_unidad_medida_id_foreign` FOREIGN KEY (`unidad_medida_id`) REFERENCES `unidad_medidas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=219 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `productos` */

insert  into `productos`(`id`,`codigo`,`nombre`,`descripcion`,`preparacion`,`costo_unitario`,`precio`,`imagen`,`foraneo`,`tiempo_coccion`,`impresora_id`,`unidad_medida_id`,`categoria_id`,`created_at`,`updated_at`) values 
(14,'0001','MOJARRA ROJA','MOJARRA ROJA FRITA','MOJARRA ROJA FRITA',35000.00,35000.00,NULL,1,15,3,3,2,'2024-04-07 13:25:52','2024-04-11 14:12:00'),
(15,'0002','MOJARRA NEGRA','MOJARRA NEGRA FRITA','MOJARRA NEGRA FRITA',32000.00,32000.00,NULL,1,15,3,3,2,'2024-04-07 14:09:08','2024-04-11 14:12:23'),
(16,'0003','BOCACHICO','BOCACHICO FRITO',NULL,38000.00,38000.00,'0003-bocachico.jpg',1,NULL,3,3,2,'2024-04-07 14:34:31','2024-04-07 14:34:31'),
(21,'0007','PARGO ROJO','PARGO FRITO',NULL,56000.00,56000.00,NULL,1,NULL,3,NULL,2,'2024-04-07 14:49:22','2024-04-07 14:49:22'),
(25,'0004','PARGO ROJO',NULL,NULL,56000.00,56000.00,NULL,1,NULL,3,3,2,'2024-04-07 15:45:19','2024-04-07 16:19:14'),
(28,'0005','SALMON EN POSTA',NULL,NULL,52000.00,52000.00,NULL,1,NULL,3,3,2,'2024-04-07 16:05:31','2024-04-07 16:19:27'),
(29,'0006','LEBRANCHE','LEBRANCHE FRITO',NULL,50000.00,50000.00,NULL,1,NULL,3,3,2,'2024-04-07 16:12:49','2024-04-07 16:19:52'),
(31,'0008','ROBALO',NULL,NULL,45000.00,45000.00,NULL,1,NULL,3,3,2,'2024-04-07 16:22:47','2024-04-07 16:22:47'),
(32,'0009','FILETE DE ROBALO',NULL,NULL,43000.00,43000.00,NULL,1,NULL,3,3,2,'2024-04-07 16:29:30','2024-04-07 16:34:59'),
(33,'0010','FILETE DE CORVINA',NULL,NULL,45000.00,45000.00,NULL,1,NULL,3,3,2,'2024-04-07 16:30:54','2024-04-07 16:30:54'),
(34,'0011','MOJARRA PLATEADA',NULL,NULL,45000.00,45000.00,NULL,1,NULL,3,3,2,'2024-04-07 16:32:39','2024-04-07 16:32:39'),
(35,'0012','BAGRE EN POSTA',NULL,NULL,43000.00,43000.00,NULL,1,NULL,3,3,2,'2024-04-07 16:34:02','2024-04-07 16:34:02'),
(36,'0013','JUREL EN POSTA',NULL,NULL,40000.00,40000.00,NULL,1,NULL,3,3,2,'2024-04-07 16:41:42','2024-04-07 16:41:42'),
(37,'0014','SIERRA EN POSTA',NULL,NULL,40000.00,40000.00,NULL,1,NULL,3,3,2,'2024-04-07 16:42:45','2024-04-07 16:42:45'),
(38,'0015','ARROZ DE COCO Y MARISCOS',NULL,NULL,50000.00,50000.00,NULL,1,NULL,3,3,2,'2024-04-07 16:58:56','2024-04-07 16:58:56'),
(39,'0016','ARROZ DE MARISCO',NULL,NULL,45000.00,45000.00,NULL,1,NULL,3,3,2,'2024-04-07 17:00:36','2024-04-07 17:00:36'),
(40,'0017','ARROZ DE  COCO Y CAMARON',NULL,NULL,45000.00,45000.00,NULL,1,NULL,3,3,2,'2024-04-07 17:02:45','2024-04-07 17:02:45'),
(41,'0019','ARROZ TRIFASICO',NULL,NULL,42000.00,42000.00,NULL,1,NULL,3,3,2,'2024-04-07 17:09:19','2024-04-07 17:09:19'),
(42,'0021','ARROZ DE VERDURAS',NULL,NULL,25000.00,25000.00,NULL,1,NULL,3,3,2,'2024-04-07 17:23:14','2024-04-07 17:23:14'),
(43,'0022','SUDADOS SOBRE LOS PESCADOS',NULL,NULL,8000.00,8000.00,NULL,1,NULL,3,3,2,'2024-04-07 17:25:37','2024-04-07 17:25:37'),
(44,'0023','SALSA A LA MARINERA',NULL,NULL,12000.00,12000.00,NULL,1,NULL,3,3,2,'2024-04-07 17:27:21','2024-04-07 17:27:21'),
(45,'0017.1','ARROZ DE CAMARON',NULL,NULL,40.00,40.00,NULL,1,20,3,NULL,2,'2024-04-11 14:29:47','2024-04-11 14:29:47'),
(46,'0017,1','ARROZ DE CAMARON',NULL,NULL,40000.00,40000.00,NULL,1,20,3,3,2,'2024-04-11 14:33:21','2024-04-11 14:36:03'),
(47,'0024','AROOZ DE SARDINA',NULL,NULL,38000.00,38000.00,NULL,1,20,3,3,2,'2024-04-11 14:41:10','2024-04-11 14:41:10'),
(48,'0025','ARROZ FULL NIKKY BEACH',NULL,NULL,50000.00,50000.00,NULL,1,20,3,3,2,'2024-04-11 14:44:25','2024-04-11 14:44:25'),
(49,'0026','CAMARON CON SALTEADO V ERDURAS (ARROZ)',NULL,NULL,47000.00,47000.00,NULL,1,20,3,3,2,'2024-04-11 15:00:41','2024-04-11 15:00:41'),
(50,'0027','HUEVAS DE PESCADO (ARROZ)',NULL,NULL,47000.00,47000.00,NULL,1,20,3,3,2,'2024-04-11 15:02:23','2024-04-11 15:02:23'),
(51,'0028','PASTA A LA MAFRINERA',NULL,NULL,40000.00,40000.00,NULL,1,20,3,3,2,'2024-04-11 15:04:13','2024-04-11 15:04:13'),
(52,'0029','PASTAS CON CAMARO - SALSA MARINERA',NULL,NULL,45000.00,45000.00,NULL,1,20,3,3,2,'2024-04-11 15:05:41','2024-04-11 15:05:41'),
(53,'0030','SANCOCHO DE PESCADO',NULL,NULL,22000.00,22000.00,NULL,1,15,3,3,2,'2024-04-11 15:18:42','2024-04-11 15:18:42'),
(54,'0031','SOPA DE PESCADO (SIN ARROZ)',NULL,NULL,10000.00,10000.00,NULL,1,15,3,3,2,'2024-04-11 15:21:00','2024-04-11 15:21:00'),
(55,'0032','CASUELA DE MARISCOS',NULL,NULL,42000.00,42000.00,NULL,1,20,3,3,2,'2024-04-11 15:22:24','2024-04-11 15:22:24'),
(56,'0033','CASUELA DE CAMARON',NULL,NULL,45000.00,45000.00,NULL,1,20,3,3,2,'2024-04-11 15:23:16','2024-04-11 15:23:16'),
(57,'0034','COPA COCTEL CAMARON',NULL,NULL,32000.00,32000.00,NULL,1,15,3,3,2,'2024-04-11 15:27:12','2024-04-11 15:27:12'),
(60,'0035','COPA CEVICHE CAMARON',NULL,NULL,32000.00,32000.00,NULL,1,15,3,3,2,'2024-04-11 15:37:02','2024-04-11 15:37:02'),
(61,'0036','NIKKY CAMARON',NULL,NULL,40000.00,40000.00,NULL,1,15,3,3,2,'2024-04-11 15:37:51','2024-04-11 15:37:51'),
(62,'0037','NIKKY CAMARON (PARA 2)',NULL,NULL,60000.00,60000.00,NULL,1,20,3,3,2,'2024-04-11 15:38:51','2024-04-11 15:38:51'),
(63,'0038','NIKKY CAMARON-VERDURAS',NULL,NULL,40000.00,40000.00,NULL,1,20,3,3,2,'2024-04-11 15:39:39','2024-04-11 15:39:39'),
(64,'0039','NIKKY CAMARON-VERDURAS (PARA 2)',NULL,NULL,60000.00,60000.00,NULL,1,20,3,3,2,'2024-04-11 15:40:41','2024-04-11 15:40:41'),
(65,'0040','PICADA PESCADO (TEMPORADA)',NULL,NULL,35000.00,35000.00,NULL,1,20,3,3,2,'2024-04-11 15:43:20','2024-04-11 15:43:20'),
(66,'0041','PICADA DE ROBALO',NULL,NULL,40000.00,40000.00,NULL,1,20,3,3,2,'2024-04-11 15:46:40','2024-04-11 15:46:40'),
(67,'0042','PICADA DE ROBALO (PARA 2)',NULL,NULL,60000.00,60000.00,NULL,1,20,3,3,2,'2024-04-11 15:47:19','2024-04-11 15:47:19'),
(68,'0043','PICADA HUEVAS DE PESCADO',NULL,NULL,35000.00,35000.00,NULL,1,20,3,3,2,'2024-04-11 15:51:50','2024-04-11 15:51:50'),
(69,'0044','PICADA HUEVAS PESCADO )PARA 2)',NULL,NULL,55000.00,55000.00,NULL,1,20,3,3,2,'2024-04-11 15:53:44','2024-04-11 15:53:44'),
(70,'0045','PICADA HUEVAS Y CALAMARES',NULL,NULL,40000.00,40000.00,NULL,1,20,3,3,2,'2024-04-11 15:55:28','2024-04-11 15:55:28'),
(71,'0046','PICADA HUEVAS Y CALAMARES (PARA 2)',NULL,NULL,60000.00,60000.00,NULL,1,20,3,3,2,'2024-04-11 15:56:30','2024-04-11 15:56:30'),
(72,'0047','PICADA HUEVAS Y PESCADO',NULL,NULL,45000.00,45000.00,NULL,1,20,3,3,2,'2024-04-11 16:02:54','2024-04-11 16:02:54'),
(73,'0048','PICADA HUEVAS Y PESCADO (PARA 2)',NULL,NULL,65000.00,65000.00,NULL,1,20,3,3,2,'2024-04-11 16:07:43','2024-04-11 16:07:43'),
(74,'0049','PICADA HUEVAS-CALAMARES Y PESCADO',NULL,NULL,60000.00,60000.00,NULL,1,20,3,3,2,'2024-04-11 16:10:32','2024-04-11 16:10:32'),
(75,'0050','PICADA HUEVAS - CALAMARES Y PESCADO (PARA 2)',NULL,NULL,80000.00,80000.00,NULL,1,20,3,3,2,'2024-04-11 16:11:40','2024-04-11 16:11:40'),
(76,'0051','BANDEJA MIXTA NIKKY BEACH (PARA 2)',NULL,NULL,95000.00,95000.00,NULL,1,20,3,3,2,'2024-04-11 16:31:03','2024-04-11 16:31:03'),
(77,'0052','BANDEJA NIKKY BEACH (PARA 4)',NULL,NULL,180000.00,180000.00,NULL,1,20,3,3,2,'2024-04-11 16:32:32','2024-04-11 16:32:32'),
(78,'0053','PORCION ARROZ DE COCO',NULL,NULL,8000.00,8000.00,NULL,1,15,3,3,2,'2024-04-11 16:34:14','2024-04-11 16:34:14'),
(79,'0054','PORCION DE PATACONES X4',NULL,NULL,5000.00,5000.00,NULL,1,15,3,3,2,'2024-04-11 16:34:59','2024-04-11 16:34:59'),
(80,'0055','PORCION PATACONES X8',NULL,NULL,10000.00,10000.00,NULL,1,15,3,3,2,'2024-04-11 16:35:45','2024-04-11 16:35:45'),
(81,'0056','PORCION PAPA FRANCESA',NULL,NULL,10000.00,10000.00,NULL,1,15,3,3,2,'2024-04-11 16:41:02','2024-04-11 16:41:02'),
(82,'0057','PORCION ENSALADA',NULL,NULL,10000.00,10000.00,NULL,1,15,3,3,2,'2024-04-11 16:42:01','2024-04-11 16:42:01'),
(83,'0058','PORCION PICADA LIMON',NULL,NULL,4000.00,4000.00,NULL,1,15,3,3,2,'2024-04-11 16:43:35','2024-04-11 16:43:35'),
(84,'0059','ALITAS DE POLLO (X4 UNID)',NULL,NULL,20000.00,20000.00,NULL,1,20,3,3,2,'2024-04-11 17:07:57','2024-04-11 17:12:18'),
(85,'0060','EMPANADAS DE CARNE (X4 UNID)',NULL,NULL,14000.00,14000.00,NULL,1,20,3,3,2,'2024-04-11 17:10:24','2024-04-11 17:10:24'),
(86,'0061','EMPANADAS DE POLLO (X4 UNID)',NULL,NULL,14000.00,14000.00,NULL,1,20,3,3,2,'2024-04-11 17:11:18','2024-04-11 17:11:18'),
(87,'0062','CANASTA PATACON CARNE (X4 UNID)',NULL,NULL,24000.00,24000.00,NULL,1,20,3,3,2,'2024-04-11 17:13:54','2024-04-11 17:13:54'),
(88,'0063','CANASTAS DE POLLO (X4 UNID)',NULL,NULL,24000.00,24000.00,NULL,1,20,3,3,2,'2024-04-11 17:14:42','2024-04-11 17:14:42'),
(89,'0064','CANASTA DE CAMARON (X4 UNID)',NULL,NULL,36000.00,36000.00,NULL,1,20,3,3,2,'2024-04-11 17:15:45','2024-04-11 17:15:45'),
(90,'0065','PECHUGA DE POLLO',NULL,NULL,32000.00,32000.00,NULL,1,15,3,3,2,'2024-04-11 17:35:55','2024-04-11 17:35:55'),
(91,'0066','PECHUGA CREMA-CHAPIÑONES',NULL,NULL,38000.00,38000.00,NULL,1,20,3,3,2,'2024-04-11 17:37:58','2024-04-11 17:37:58'),
(92,'0067','PECHUGA EN JULIANA CON VERDURAS',NULL,NULL,37000.00,37000.00,NULL,1,15,3,3,2,'2024-04-11 17:40:05','2024-04-11 17:40:05'),
(93,'0068','PULPA CERDO',NULL,NULL,32000.00,32000.00,NULL,1,15,3,3,2,'2024-04-11 17:41:18','2024-04-11 17:41:18'),
(94,'0069','PULPA CERDO-CREMA CHAPIÑONES',NULL,NULL,38000.00,38000.00,NULL,1,15,3,3,2,'2024-04-11 17:42:10','2024-04-11 17:42:10'),
(95,'0070','PULPA CERDO -CREMA Y CHAMPIÑONES',NULL,NULL,38000.00,38000.00,NULL,1,15,3,3,2,'2024-04-11 17:44:15','2024-04-11 17:44:15'),
(96,'0071','PULPA CERDO - JULIANA Y VERDURAS',NULL,NULL,37000.00,37000.00,NULL,1,15,3,3,2,'2024-04-11 17:45:19','2024-04-11 17:45:19'),
(97,'0072','CHULETA DE CERDO',NULL,NULL,34000.00,34000.00,NULL,1,15,3,3,2,'2024-04-11 17:46:29','2024-04-11 17:46:29'),
(98,'0073','CARNE DE RES',NULL,NULL,36000.00,36000.00,NULL,1,15,3,3,2,'2024-04-11 17:47:47','2024-04-11 17:47:47'),
(99,'0074','CARNE RES -CREMA Y CHAMPIÑONES',NULL,NULL,42000.00,42000.00,NULL,1,15,3,3,2,'2024-04-11 17:48:51','2024-04-11 17:48:51'),
(100,'0075','POSTRE - HELADO',NULL,NULL,6000.00,6000.00,NULL,1,15,3,3,2,'2024-04-11 17:50:39','2024-04-11 17:50:39'),
(101,'0076','PORCION PATACON X8',NULL,NULL,10000.00,10000.00,NULL,1,15,3,3,2,'2024-04-15 19:43:14','2024-04-15 19:43:14'),
(102,'0077','PORCION PAPAS FRANCESAS',NULL,NULL,10000.00,10000.00,NULL,1,15,3,3,2,'2024-04-15 19:44:13','2024-04-15 19:44:13'),
(103,'0078','PORCION HOGAO',NULL,NULL,6000.00,6000.00,NULL,1,15,3,3,2,'2024-04-15 19:44:59','2024-04-15 19:44:59'),
(104,'0079','PORCION QUESO',NULL,NULL,6000.00,6000.00,NULL,1,15,3,3,2,'2024-04-15 19:46:50','2024-04-15 19:46:50'),
(105,'0080','PORCION CHORIZO TERNERA',NULL,NULL,8000.00,8000.00,NULL,1,15,3,3,2,'2024-04-15 19:48:03','2024-04-15 19:48:03'),
(106,'81','PORCION CHORIZO SANTANDEREANO',NULL,NULL,8000.00,8000.00,NULL,1,15,3,3,2,'2024-04-15 19:49:09','2024-04-15 19:49:09'),
(107,'0082','PORCION BUTIFARA',NULL,NULL,8000.00,8000.00,NULL,1,15,3,3,2,'2024-04-15 19:49:54','2024-04-15 19:49:54'),
(108,'0083','PORCION BOFE',NULL,NULL,8000.00,8000.00,NULL,1,15,3,3,2,'2024-04-15 19:50:35','2024-04-15 19:50:35'),
(109,'0084','PORCION SALCHICA RANCHERA',NULL,NULL,10000.00,10000.00,NULL,1,15,3,3,2,'2024-04-15 19:54:11','2024-04-15 19:54:11'),
(110,'0085','PORCION SALCHICHA SUIZA',NULL,NULL,10000.00,10000.00,NULL,1,15,3,3,2,'2024-04-15 19:55:12','2024-04-15 19:55:12'),
(111,'0086','PORCION CERDO',NULL,NULL,10000.00,10000.00,NULL,1,15,3,3,2,'2024-04-15 19:56:29','2024-04-15 19:56:29'),
(112,'0087','PORCION POLLO',NULL,NULL,10000.00,10000.00,NULL,1,15,3,3,2,'2024-04-15 19:57:31','2024-04-15 19:57:31'),
(113,'0088','PORCION CARNE',NULL,NULL,10000.00,10000.00,NULL,1,15,3,3,2,'2024-04-15 19:58:09','2024-04-15 19:58:09'),
(114,'0089','PORCION SALTEADO DE VERDURAS',NULL,NULL,8000.00,8000.00,NULL,1,15,3,3,2,'2024-04-15 19:59:14','2024-04-15 19:59:14'),
(115,'0090','JUGO NARANJA',NULL,NULL,8000.00,8000.00,NULL,1,15,1,3,3,'2024-04-15 20:00:57','2024-04-15 20:00:57'),
(116,'0091','JUGO POMELO',NULL,NULL,9000.00,9000.00,NULL,1,15,1,3,3,'2024-04-15 20:01:38','2024-04-15 20:01:38'),
(117,'0092','LIMONADA NATURAL',NULL,NULL,8000.00,8000.00,NULL,1,15,1,3,3,'2024-04-15 20:02:49','2024-04-15 20:02:49'),
(118,'0093','LIMONADA CEREZADA',NULL,NULL,12000.00,12000.00,NULL,1,15,1,3,3,'2024-04-15 20:07:14','2024-04-15 20:07:14'),
(119,'0094','LIMONADA HIERVA BUENA',NULL,NULL,12000.00,12000.00,NULL,1,15,1,3,3,'2024-04-15 20:08:02','2024-04-15 20:23:32'),
(120,'0095','LIMONADA COCO',NULL,NULL,15000.00,15000.00,NULL,1,15,1,3,3,'2024-04-15 20:28:59','2024-04-15 20:28:59'),
(121,'0096','JUGO EN LECHE',NULL,NULL,9000.00,9000.00,NULL,1,15,1,3,3,'2024-04-15 20:30:26','2024-04-17 20:06:16'),
(122,'0097','MILO',NULL,NULL,10000.00,10000.00,NULL,1,15,1,3,3,'2024-04-15 20:31:22','2024-04-15 20:31:22'),
(123,'0098','KOLA GRANULADA',NULL,NULL,10000.00,10000.00,NULL,1,15,1,3,3,'2024-04-15 20:32:03','2024-04-15 20:32:03'),
(124,'0099','GASEOSA PERSONAL',NULL,NULL,5000.00,5000.00,NULL,1,15,1,3,3,'2024-04-15 20:35:24','2024-04-15 20:35:24'),
(125,'0100','SODA PERSONAL',NULL,NULL,6000.00,6000.00,NULL,1,15,1,3,3,'2024-04-15 20:36:30','2024-04-15 20:36:30'),
(126,'0101','SODA PERSONAL MICHELADA',NULL,NULL,8000.00,8000.00,NULL,1,15,1,3,3,'2024-04-15 20:38:03','2024-04-15 20:38:03'),
(127,'0102','SODA HATSU',NULL,NULL,8000.00,8000.00,NULL,1,15,1,3,3,'2024-04-15 20:39:03','2024-04-15 20:39:03'),
(128,'0103','AGUA PERSONAL',NULL,NULL,4000.00,4000.00,NULL,1,15,1,3,3,'2024-04-15 20:42:33','2024-04-17 14:08:33'),
(129,'0104','GATORADE',NULL,NULL,7000.00,7000.00,NULL,1,15,1,3,3,'2024-04-15 20:43:30','2024-04-15 20:43:30'),
(130,'0105','RED BULL',NULL,NULL,10000.00,10000.00,NULL,1,15,1,3,3,'2024-04-15 20:44:11','2024-04-15 20:44:11'),
(131,'0106','MONSTER',NULL,NULL,14000.00,14000.00,NULL,1,15,1,3,3,'2024-04-15 20:45:28','2024-04-15 20:45:28'),
(132,'0107','GASEOSA POSRTOBON 1.5 L',NULL,NULL,10000.00,10000.00,NULL,1,15,1,3,3,'2024-04-15 20:47:01','2024-04-15 20:47:01'),
(133,'0108','GASEOSA COCACOLA 1.5',NULL,NULL,12000.00,12000.00,NULL,1,15,1,3,3,'2024-04-15 20:58:17','2024-04-15 20:58:17'),
(134,'0109','CAFE',NULL,NULL,3000.00,3000.00,NULL,1,15,1,3,3,'2024-04-15 20:59:01','2024-04-15 20:59:01'),
(135,'0110','CAFE CON LECHE',NULL,NULL,4000.00,4000.00,NULL,1,15,1,3,3,'2024-04-15 20:59:37','2024-04-15 20:59:37'),
(136,'0111','CAFE CAPUCHINO',NULL,NULL,6000.00,6000.00,NULL,1,15,1,3,3,'2024-04-15 21:00:18','2024-04-15 21:00:18'),
(137,'0112','CHOCOLATE',NULL,NULL,6000.00,6000.00,NULL,1,15,1,3,3,'2024-04-15 21:01:12','2024-04-15 21:01:12'),
(138,'0113','TE - INFUSION',NULL,NULL,5000.00,5000.00,NULL,1,15,1,3,3,'2024-04-15 21:03:13','2024-04-15 21:03:13'),
(139,'0114','PIÑA COLADA',NULL,NULL,25000.00,25000.00,NULL,1,15,1,3,3,'2024-04-15 21:05:53','2024-04-15 21:05:53'),
(140,'0115','MARGARITA',NULL,NULL,23000.00,23000.00,NULL,1,15,1,3,3,'2024-04-15 21:06:46','2024-04-15 21:06:46'),
(141,'0116','PORCION CEREZA X2UND.',NULL,NULL,3000.00,3000.00,NULL,1,15,1,3,3,'2024-04-15 21:45:48','2024-04-15 21:45:48'),
(142,'0117','PORCION LICOR MENTA MEDIA-ONZA',NULL,NULL,3000.00,3000.00,NULL,1,15,1,3,3,'2024-04-15 21:47:07','2024-04-15 21:47:07'),
(143,'0118','PORCION MARACUYA 1 ONZA',NULL,NULL,3000.00,3000.00,NULL,1,15,1,3,3,'2024-04-15 21:48:38','2024-04-15 21:48:38'),
(144,'0119','PORCION HIERVA BUENA',NULL,NULL,3000.00,3000.00,NULL,1,15,1,3,3,'2024-04-15 21:49:44','2024-04-15 21:49:44'),
(145,'0120','COPA SANGRIA',NULL,NULL,20000.00,20000.00,NULL,1,15,1,3,3,'2024-04-15 21:53:12','2024-04-15 21:53:12'),
(146,'0121','JARRA DE SANGRIA',NULL,NULL,80000.00,80000.00,NULL,1,15,1,3,3,'2024-04-15 21:54:58','2024-04-15 21:57:34'),
(147,'0122','AGUILA NEGRA',NULL,NULL,5000.00,5000.00,NULL,1,15,1,3,3,'2024-04-15 21:56:36','2024-04-15 21:57:47'),
(148,'0123','AGUILA LIGHT',NULL,NULL,5000.00,5000.00,NULL,1,NULL,1,3,3,'2024-04-15 21:58:34','2024-04-15 21:58:34'),
(149,'0124','CERVEZA SOL PEQ.',NULL,NULL,6000.00,6000.00,NULL,1,NULL,1,3,3,'2024-04-15 21:59:42','2024-04-15 21:59:42'),
(150,'0125','KEINEKEN PEQ.',NULL,NULL,7000.00,7000.00,NULL,1,NULL,1,3,3,'2024-04-15 22:02:15','2024-04-15 22:02:15'),
(151,'0126','CORONITA',NULL,NULL,7000.00,7000.00,NULL,1,NULL,1,3,3,'2024-04-15 22:05:39','2024-04-15 22:05:39'),
(152,'0127','CORONA EXTRA',NULL,NULL,10000.00,10000.00,NULL,1,NULL,1,3,3,'2024-04-15 22:06:52','2024-04-15 22:06:52'),
(153,'0128','CLUB COLOMBIA DORADA',NULL,NULL,8000.00,8000.00,NULL,1,NULL,1,3,3,'2024-04-15 22:07:32','2024-04-15 22:07:32'),
(154,'0129','ESTELLA ARTOIS',NULL,NULL,12000.00,12000.00,NULL,1,NULL,1,3,3,'2024-04-15 22:09:31','2024-04-15 22:09:31'),
(155,'0130','CORONA COCTEL TROPICAL',NULL,NULL,14000.00,14000.00,NULL,1,NULL,1,3,3,'2024-04-15 22:10:10','2024-04-15 22:10:10'),
(156,'0131','SMIRNOFF ICE',NULL,NULL,13000.00,13000.00,NULL,1,NULL,1,3,3,'2024-04-15 22:10:57','2024-04-15 22:10:57'),
(157,'0132','CERVEZA 0.0',NULL,NULL,8000.00,8000.00,NULL,1,NULL,1,3,3,'2024-04-15 22:11:36','2024-04-15 22:11:36'),
(158,'0133','VASO MICHELADO+2.000',NULL,NULL,2000.00,2000.00,NULL,1,NULL,1,3,3,'2024-04-15 22:12:27','2024-04-15 22:12:27'),
(159,'0134','AGURDIENTE ANTIQUEÑO 375 ML',NULL,NULL,60000.00,60000.00,NULL,1,15,1,3,3,'2024-04-16 08:26:01','2024-04-16 08:26:01'),
(160,'0135','AGURDIENTE ANTIQUEÑO 750 ML',NULL,NULL,110000.00,110000.00,NULL,1,NULL,1,3,3,'2024-04-16 08:32:45','2024-04-16 08:32:45'),
(161,'0136','AGURDIENTE AMARILLO 375 ML',NULL,NULL,70000.00,70000.00,NULL,1,NULL,1,3,3,'2024-04-16 09:31:43','2024-04-16 09:31:43'),
(162,'0137','AGUARDIENTE AMARILLO 750 ML',NULL,NULL,140000.00,140000.00,NULL,1,NULL,1,3,3,'2024-04-16 09:53:53','2024-04-16 09:53:53'),
(163,'0138','RON MEDELLIN 3 AÑOS 375 ML',NULL,NULL,70000.00,70000.00,NULL,1,NULL,1,3,3,'2024-04-16 09:58:24','2024-04-16 10:11:11'),
(164,'0139','MEDELLIN 3 AÑOS 750 ML',NULL,NULL,160000.00,160000.00,NULL,1,NULL,1,3,3,'2024-04-16 10:12:10','2024-04-16 10:12:10'),
(165,'0140','RON MEDELLIN 8 AÑOS 375 ML',NULL,NULL,110000.00,110000.00,NULL,1,NULL,1,3,3,'2024-04-16 10:15:11','2024-04-16 10:15:11'),
(166,'0145','RON MEDELLIN 8 AÑOS 750 ML',NULL,NULL,200000.00,200000.00,NULL,1,NULL,1,3,3,'2024-04-16 10:18:38','2024-04-16 10:20:22'),
(167,'0146','BUCHANAN DELUXE 12 AÑOS 375 ML',NULL,NULL,170000.00,170000.00,NULL,1,NULL,1,3,3,'2024-04-16 10:56:42','2024-04-16 10:56:42'),
(168,'0147','BUCHANANS DELUXE 12 AÑOS 750 ML',NULL,NULL,280000.00,280000.00,NULL,1,NULL,1,3,3,'2024-04-16 11:38:08','2024-04-16 11:39:41'),
(171,'0149','BUAHANAN MASTER 750 ML',NULL,NULL,320000.00,320000.00,NULL,1,NULL,1,3,3,'2024-04-16 12:04:40','2024-04-16 12:04:40'),
(172,'0150','OLD PARR 12 AÑOS 500 ML',NULL,NULL,180000.00,180000.00,NULL,1,NULL,1,3,3,'2024-04-16 13:19:30','2024-04-16 13:19:30'),
(173,'0151','OLD PARR 12 AÑOS 750ML',NULL,NULL,310000.00,310000.00,NULL,1,NULL,1,3,3,'2024-04-16 13:20:20','2024-04-16 13:20:20'),
(174,'0152','JONNY WALKER RED LABEL 375ML',NULL,NULL,120000.00,120000.00,NULL,1,NULL,1,3,3,'2024-04-16 13:22:02','2024-04-16 13:22:02'),
(175,'0153','JOHNNIE WALKER RED LABEL 700ML',NULL,NULL,190000.00,190000.00,NULL,1,NULL,1,3,3,'2024-04-16 13:22:58','2024-04-16 13:22:58'),
(176,'0154','CREMA BAILEYS 375ML',NULL,NULL,120000.00,120000.00,NULL,1,NULL,1,3,3,'2024-04-16 13:25:12','2024-04-16 13:25:12'),
(177,'0155','CREMA BAILEYS 700ML',NULL,NULL,200.00,200.00,NULL,1,NULL,1,3,3,'2024-04-16 13:25:53','2024-04-16 13:25:53'),
(178,'0156','VODKA SMIRNOFF LULO 375ML',NULL,NULL,60000.00,60000.00,NULL,1,NULL,1,3,3,'2024-04-16 13:29:17','2024-04-16 13:32:55'),
(179,'0157','VODKA SMIRNOFF LULO 750ML',NULL,NULL,110000.00,110000.00,NULL,1,NULL,1,3,3,'2024-04-16 13:32:20','2024-04-16 13:32:20'),
(180,'0158','VODKA SMIRNOFF ROJO 375ML',NULL,NULL,90000.00,90000.00,NULL,1,NULL,1,3,3,'2024-04-16 13:45:19','2024-04-16 13:45:19'),
(181,'0159','VODKA SMIRNOFF 700ML',NULL,NULL,130000.00,130000.00,NULL,1,NULL,1,3,3,'2024-04-16 13:46:21','2024-04-16 13:46:21'),
(182,'0160','DESCORCHE 375ML',NULL,NULL,50000.00,50000.00,NULL,1,NULL,1,3,3,'2024-04-16 13:47:24','2024-04-16 13:50:25'),
(183,'0161','DESCORCHE 750ML',NULL,NULL,80000.00,80000.00,NULL,1,NULL,1,3,3,'2024-04-16 13:49:42','2024-04-16 13:49:42'),
(184,'0162','SHOT DE RON',NULL,NULL,10000.00,10000.00,NULL,1,NULL,1,3,3,'2024-04-16 13:51:11','2024-04-16 13:51:11'),
(185,'0163','COPA RON-ROCAS',NULL,NULL,15000.00,15000.00,NULL,1,NULL,1,3,3,'2024-04-16 13:51:58','2024-04-16 13:51:58'),
(186,'0164','SHOT DE WISKY',NULL,NULL,15000.00,15000.00,NULL,1,NULL,1,3,3,'2024-04-16 13:52:53','2024-04-16 13:52:53'),
(187,'0165','COPA WISKY - ROCA',NULL,NULL,20000.00,20000.00,NULL,1,NULL,1,3,3,'2024-04-17 10:42:07','2024-04-17 10:42:07'),
(188,'0166','VINO DE LA CASA (DON SIMON)',NULL,NULL,60000.00,60000.00,NULL,1,NULL,1,3,3,'2024-04-17 10:50:02','2024-04-17 10:50:02'),
(189,'0167','COPA -VINO DE LA CASA',NULL,NULL,15000.00,15000.00,NULL,1,NULL,1,3,3,'2024-04-17 10:51:45','2024-04-17 10:51:45'),
(190,'0168','SANDWICH DE CAMARON',NULL,NULL,20000.00,20000.00,NULL,1,15,3,3,2,'2024-04-17 10:54:30','2024-04-17 10:54:30'),
(191,'0169','SANDWICH DE ATUN',NULL,NULL,14000.00,14000.00,NULL,1,15,3,3,2,'2024-04-17 10:55:43','2024-04-17 10:55:43'),
(192,'0170','SANDWICHE AMERICANO',NULL,NULL,12000.00,12000.00,NULL,1,15,3,3,2,'2024-04-17 10:56:34','2024-04-17 10:56:34'),
(193,'0171','SANDWICH TRADICIONAL',NULL,NULL,10000.00,10000.00,NULL,1,15,3,3,2,'2024-04-17 10:57:33','2024-04-17 10:57:33'),
(194,'0172','SALCHIPAPA CLASICA',NULL,NULL,18000.00,18000.00,NULL,1,15,3,3,2,'2024-04-17 10:59:03','2024-04-17 10:59:03'),
(195,'0173','SALCHIPAPA RANCHERA',NULL,NULL,22000.00,22000.00,NULL,1,15,3,3,2,'2024-04-17 11:00:01','2024-04-17 11:00:01'),
(196,'0174','SALCHIPAPA CHORIZO',NULL,NULL,22000.00,22000.00,NULL,1,15,3,3,2,'2024-04-17 11:01:12','2024-04-17 11:01:12'),
(197,'0175','SALCHIPAPA BUTIFFARRA',NULL,NULL,22000.00,22000.00,NULL,1,15,3,3,2,'2024-04-17 11:02:19','2024-04-17 11:02:19'),
(198,'0176','SALCHIPAPA CHORIZO BUTIFARA',NULL,NULL,26000.00,26000.00,NULL,1,15,3,3,2,'2024-04-17 11:03:53','2024-04-17 11:03:53'),
(199,'0177','SALCHIPAPA CARNE',NULL,NULL,26000.00,26000.00,NULL,1,15,3,3,2,'2024-04-17 11:05:32','2024-04-17 11:05:32'),
(200,'0178','SALCHIPAPA POLLO',NULL,NULL,24000.00,24000.00,NULL,1,15,3,3,2,'2024-04-17 11:07:00','2024-04-17 11:07:00'),
(201,'0179','SALCHIPAPA CERDO',NULL,NULL,25000.00,25000.00,NULL,1,15,3,3,2,'2024-04-17 11:09:09','2024-04-17 11:09:09'),
(202,'0180','SALCHIPAPA - COMBINADO 2 CARNES',NULL,NULL,30000.00,30000.00,NULL,1,15,3,3,2,'2024-04-17 11:11:30','2024-04-17 11:11:30'),
(203,'0181','SALCHIPAPA - COMBINADO 3 CARNES',NULL,NULL,40000.00,40000.00,NULL,1,15,3,3,2,'2024-04-17 11:12:25','2024-04-17 11:12:25'),
(204,'0182','SALCHIPAPA - MIXTA 3 EMBUTIDOS',NULL,NULL,36000.00,36000.00,NULL,1,15,3,3,2,'2024-04-17 11:15:54','2024-04-17 11:15:54'),
(205,'0183','SALCHIPAPA - CAMARON',NULL,NULL,40000.00,40000.00,NULL,1,15,3,3,2,'2024-04-17 11:18:04','2024-04-17 11:18:04'),
(206,'0184','SALCHIPAPA-FULL NIKY BEACH (4 INGREDIENTES)',NULL,NULL,55000.00,55000.00,NULL,1,15,3,3,2,'2024-04-17 11:20:09','2024-04-17 11:20:09'),
(207,'0185','SALCHIPAPA-FULL NIKY BEACH PARA 4 (6 INGREDIENTES)',NULL,NULL,90000.00,90000.00,NULL,1,15,3,3,2,'2024-04-17 11:21:20','2024-04-17 11:21:20'),
(208,'0186','PATACONADA- 1 de Patacones, queso, hogao',NULL,NULL,22000.00,22000.00,NULL,1,15,3,3,2,'2024-04-17 11:58:04','2024-04-17 12:34:42'),
(209,'0187','PATACONADA - 1 de Patacones, queso, hogao, cerdo',NULL,NULL,32000.00,32000.00,NULL,1,15,3,3,2,'2024-04-17 12:10:47','2024-04-17 12:35:51'),
(210,'0188','PATACONADA -1 de patacones, queso, hogao, chorizo, ranchera',NULL,NULL,38000.00,38000.00,NULL,1,15,3,3,2,'2024-04-17 12:22:07','2024-04-17 12:25:07'),
(211,'0189','PATACONADA- 1 de patacones, 2 queso, 2 hogao, 2 cerdo',NULL,NULL,54000.00,54000.00,NULL,1,15,3,3,2,'2024-04-17 12:27:38','2024-04-17 12:27:38'),
(212,'0190','PATACONADA- 2 de patacones, 2 queso, 2 hogao, 2 cerdo',NULL,NULL,64000.00,64000.00,NULL,1,15,3,3,2,'2024-04-17 12:29:42','2024-04-17 12:29:42'),
(213,'0191','PATACONADA - 2 de patacones, 2 queso, 2 hogao, 2 cerdo, 2 pollo',NULL,NULL,84000.00,84000.00,NULL,1,15,3,3,2,'2024-04-17 12:31:01','2024-04-17 12:31:01'),
(214,'0192','PATACONADA - 2 de patacones, 2 queso, 2 hogao, 2 chorizo, 2 ranchera',NULL,NULL,76000.00,76000.00,NULL,1,15,3,3,2,'2024-04-17 12:31:45','2024-04-17 12:33:52'),
(215,'0193','PATACONADA - 3 de patacones, 3 queso, 3 hogao, 3 cerdo, 3 pollo, 3 carne',NULL,NULL,155000.00,155000.00,NULL,1,15,3,3,2,'2024-04-17 12:32:53','2024-04-17 12:33:29'),
(216,'0194','vaso de vidrio con hielo. gaseosa',NULL,NULL,0.00,0.00,NULL,1,15,1,3,3,'2024-04-17 14:01:12','2024-04-17 14:08:10'),
(217,'0096,1','JUGO EN AGUA',NULL,NULL,8000.00,8000.00,NULL,1,15,1,3,3,'2024-04-17 19:57:27','2024-04-17 19:57:27'),
(218,'0195','AGUA CON GAS',NULL,NULL,5000.00,5000.00,NULL,1,15,1,3,3,'2024-04-27 13:43:31','2024-04-27 13:43:31');

/*Table structure for table `roles` */

DROP TABLE IF EXISTS `roles`;

CREATE TABLE `roles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `roles` */

insert  into `roles`(`id`,`nombre`,`descripcion`,`created_at`,`updated_at`) values 
(1,'Gerente',NULL,NULL,NULL),
(2,'Administrador',NULL,NULL,NULL),
(3,'Cajero',NULL,NULL,NULL),
(4,'Cocinero',NULL,NULL,NULL),
(5,'Mesero',NULL,NULL,NULL);

/*Table structure for table `tipo_cobros` */

DROP TABLE IF EXISTS `tipo_cobros`;

CREATE TABLE `tipo_cobros` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `tipo_cobros` */

insert  into `tipo_cobros`(`id`,`nombre`,`descripcion`,`created_at`,`updated_at`) values 
(1,'Mensual',NULL,NULL,NULL),
(2,'Quincenal',NULL,NULL,NULL),
(3,'Diario',NULL,NULL,NULL);

/*Table structure for table `tipo_documentos` */

DROP TABLE IF EXISTS `tipo_documentos`;

CREATE TABLE `tipo_documentos` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `tipo_documentos` */

insert  into `tipo_documentos`(`id`,`nombre`,`created_at`,`updated_at`) values 
(1,'Factura',NULL,NULL),
(2,'Remision',NULL,NULL),
(3,'Tikect pos',NULL,NULL);

/*Table structure for table `tipo_regimens` */

DROP TABLE IF EXISTS `tipo_regimens`;

CREATE TABLE `tipo_regimens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `tipo_regimens` */

insert  into `tipo_regimens`(`id`,`nombre`,`created_at`,`updated_at`) values 
(1,'Simplificado',NULL,NULL),
(2,'Comun',NULL,NULL);

/*Table structure for table `unidad_medidas` */

DROP TABLE IF EXISTS `unidad_medidas`;

CREATE TABLE `unidad_medidas` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `unidad_medidas` */

insert  into `unidad_medidas`(`id`,`nombre`,`descripcion`,`created_at`,`updated_at`) values 
(1,'Gramo',NULL,NULL,NULL),
(2,'Litro',NULL,NULL,NULL),
(3,'Unidad',NULL,NULL,NULL);

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `caja_id` bigint(20) unsigned DEFAULT NULL,
  `role_id` bigint(20) unsigned DEFAULT NULL,
  `empresa_id` bigint(20) unsigned DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_name_unique` (`name`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_role_id_foreign` (`role_id`),
  KEY `users_empresa_id_foreign` (`empresa_id`),
  KEY `users_caja_id_foreign` (`caja_id`),
  CONSTRAINT `users_caja_id_foreign` FOREIGN KEY (`caja_id`) REFERENCES `cajas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `users_empresa_id_foreign` FOREIGN KEY (`empresa_id`) REFERENCES `empresas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`name`,`email`,`email_verified_at`,`password`,`caja_id`,`role_id`,`empresa_id`,`remember_token`,`created_at`,`updated_at`) values 
(1,'admin','admin@example.com',NULL,'$2y$10$7w39WLSjaMPVqmUW2u8xr.Whje2FnudVLN4uL2s.CNUQ/VtcByyqu',1,2,1,NULL,NULL,'2024-02-22 19:03:50'),
(2,'Auxiliar1','Auxiliar1@nikkybeach.com',NULL,'$2y$10$2OH8JAyA63rCVaNbYFS96uNAYhA4SnHWl52yG/1.X4sJdMMZbQsH6',NULL,5,1,NULL,'2024-02-22 18:34:52','2024-02-23 21:36:40'),
(3,'jhon','nikkybeach22@gmail.com',NULL,'$2y$10$ehPDP9rZg2XFxtcuk6KfCe0u9kl/r6la.X2AhH/GZlEETE3xUUana',1,2,1,NULL,'2024-02-24 14:27:45','2024-03-01 15:01:47'),
(4,'auxiliar2','auxiliar2@nikkybeach.com',NULL,'$2y$10$ptiAAXIeaYTo6yeQn/dQU.7iP3xX6XvEe9zDWFdXi7WRL0eXN/JDK',NULL,5,1,NULL,'2024-03-01 16:44:40','2024-03-01 16:44:40'),
(5,'auxiliar3','auxiliar3@nikkybeach.com',NULL,'$2y$10$MV1.zTCGyC3wzrzFk5UCSOpyrHWAWREezBz94xcFfx/bPiWuu5bKC',NULL,5,1,NULL,'2024-03-01 16:47:21','2024-03-01 16:47:21'),
(6,'auxiliar4','auxiliar4@nikkybeach.com',NULL,'$2y$10$NSVJ/hA7wuFYoUaHMl4X1u6h9Q1GNeZt8pySXsbPDuXyT.Oe.3zne',NULL,5,1,NULL,'2024-03-01 16:49:32','2024-03-01 16:49:32');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;