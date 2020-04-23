/*
SQLyog Community v13.1.5  (64 bit)
MySQL - 10.4.8-MariaDB : Database - programahonor
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

USE `hirverme_db`;

/*Table structure for table `admins` */

DROP TABLE IF EXISTS `admins`;

CREATE TABLE `admins` (
  `admin_id` int(2) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `apelldo1` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `apellido2` varchar(30) COLLATE utf8_spanish_ci DEFAULT NULL,
  `email` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `pass` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `telefono` int(11) DEFAULT NULL,
  PRIMARY KEY (`admin_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*Data for the table `admins` */

insert  into `admins`(`admin_id`,`nombre`,`apelldo1`,`apellido2`,`email`,`pass`,`telefono`) values 
(1,'Aixa','Ramírez','Toledo','aixa.ramirez@upr.edu','1234',2147483647),
(2,'Hiram','Vera','Mercado','hiram.vera@upr.edu','1234',2147483647),
(3,'Alejandro','Zeno','Miranda','alejandro.zeno@upr.edu','1234',2147483647);

/*Table structure for table `departamento` */

DROP TABLE IF EXISTS `departamento`;

CREATE TABLE `departamento` (
  `depto_id` int(2) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(65) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`depto_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*Data for the table `departamento` */

insert  into `departamento`(`depto_id`,`nombre`) values 
(1,'Español'),
(2,'Inglés'),
(3,'Matemáticas'),
(4,'Ciencias Sociales'),
(5,'Humanidades'),
(6,'Física Química'),
(7,'Ciencias de Cómputos'),
(8,'Biología'),
(9,'Comunicación Tele-Radial'),
(10,'Administración de Empresas'),
(11,'Enfermería'),
(12,'Educación'),
(13,'Gerencia de Tecnologías de Información y Procesos Administrativos');

/*Table structure for table `estudiante` */

DROP TABLE IF EXISTS `estudiante`;

CREATE TABLE `estudiante` (
  `est_id` int(3) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(12) COLLATE utf8_spanish_ci NOT NULL,
  `apellido_p` varchar(15) COLLATE utf8_spanish_ci NOT NULL,
  `apellido_m` varchar(15) COLLATE utf8_spanish_ci DEFAULT NULL,
  `email` varchar(40) COLLATE utf8_spanish_ci NOT NULL,
  `depto_id` int(2) NOT NULL,
  `promedio` float(4,2) unsigned NOT NULL,
  PRIMARY KEY (`est_id`),
  KEY `fk_depto` (`depto_id`),
  CONSTRAINT `fk_depto` FOREIGN KEY (`depto_id`) REFERENCES `departamento` (`depto_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*Data for the table `estudiante` */

insert  into `estudiante`(`est_id`,`nombre`,`apellido_p`,`apellido_m`,`email`,`depto_id`,`promedio`) values 
(2,'Norma','Torres','Herrero','norma.torres@upr.edu',7,3.85),
(5,'Luisa','Leonardo','Suárez','luisa.leonardo@upr.edu',3,3.93),
(6,'Hiram','Vera','Mercado','hiram.vera@upr.edu',7,3.90),
(9,'Aixa','Ramírez','Toledo','aixa.ramirez@upr.edu',7,4.00),
(11,'Alejandro','Zeno','Miranda','alejandro.zeno@upr.com',7,3.80);

/*Table structure for table `estudiante2` */

DROP TABLE IF EXISTS `estudiante2`;

CREATE TABLE `estudiante2` (
  `est_id` int(3) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `apellido1` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `apellido2` varchar(30) COLLATE utf8_spanish_ci DEFAULT NULL,
  `email` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `depto_id` int(2) NOT NULL,
  `promedio` float(4,2) unsigned NOT NULL,
  PRIMARY KEY (`est_id`),
  UNIQUE KEY `email` (`email`),
  KEY `estudiante2_ibfk_1` (`depto_id`),
  CONSTRAINT `estudiante2_ibfk_1` FOREIGN KEY (`depto_id`) REFERENCES `departamento` (`depto_id`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*Data for the table `estudiante2` */

insert  into `estudiante2`(`est_id`,`nombre`,`apellido1`,`apellido2`,`email`,`depto_id`,`promedio`) values 
(3,'Hiram','Vera','Mercado','hiram.vera@upr.edu',7,3.95),
(4,'Julio','Papa','Majada','julio.papa@gmail.com',5,3.50),
(7,'Aixa','Ramírez','Toledo','aixa.ramirez@upr.edu',7,4.00),
(8,'Alejandro','Zeno','Miranda','alejandro.zeno@upr.edu',7,4.00),
(9,'Luisa','Leonardo','Suárez','luisa.leonardo@upr.edu',3,3.92),
(11,'Juliana','Papa','Wedge','juliana.papa@gmail.com',12,3.55);

/*Table structure for table `usuarios` */

DROP TABLE IF EXISTS `usuarios`;

CREATE TABLE `usuarios` (
  `id` int(3) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `pass` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `nombre` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `apellido1` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `apellido2` varchar(30) COLLATE utf8_spanish_ci DEFAULT NULL,
  `rol` varchar(6) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*Data for the table `usuarios` */

insert  into `usuarios`(`id`,`email`,`pass`,`nombre`,`apellido1`,`apellido2`,`rol`) values 
(1,'hiram.vera@upr.edu','1234','Hiram','Vera','Mercado','admin'),
(2,'aixa.ramirez@upr.edu','1234','Aixa','Ramirez','Toledo','admin'),
(3,'julio.papa@gmail.com','1234','Julio','Papa','Frita','user'),
(5,'julia.papa@gmail.com','1234','Julia','Papa','Wedge','user');

/*Table structure for table `usuarios2` */

DROP TABLE IF EXISTS `usuarios2`;

CREATE TABLE `usuarios2` (
  `user_id` int(3) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `pass` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `telefono` varchar(11) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  KEY `email` (`email`),
  CONSTRAINT `usuarios2_ibfk_1` FOREIGN KEY (`email`) REFERENCES `estudiante2` (`email`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*Data for the table `usuarios2` */

insert  into `usuarios2`(`user_id`,`email`,`pass`,`telefono`) values 
(1,'julio.papa@gmail.com','1234','7874339625'),
(14,'juliana.papa@gmail.com','12345','-3903');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
