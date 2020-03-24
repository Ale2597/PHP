/*
SQLyog Community v12.5.1 (64 bit)
MySQL - 10.1.31-MariaDB : Database - practica
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`programahonor` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci */;

USE `programahonor`;

/*Table structure for table `departamento` */

DROP TABLE IF EXISTS `departamento`;

CREATE TABLE `departamento` (
  `depto_id` INT(2) NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(65) COLLATE utf8_spanish_ci NOT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*Data for the table `estudiante` */

insert  into `estudiante`(`est_id`,`nombre`,`apellido_p`,`apellido_m`,`email`,`depto_id`,`promedio`) values 
(1,'Aixa','Ramírez','Toledo','aixa.ramirez@upr.edu',7,4.00),
(2,'Norma','Torres','Herrero','norma.torres@upr.edu',7,3.85),
(4,'Luis','Colón','Colón','luis.colon19@upr.edu',7,3.33),
(5,'Luisa','Leonardo',NULL,'luisa.leonardo@upr.edu',3,3.93);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
