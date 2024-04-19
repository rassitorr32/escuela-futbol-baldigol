-- MySQL dump 10.13  Distrib 8.0.30, for Win64 (x86_64)
--
-- Host: localhost    Database: escuela-futbol-baldigol
-- ------------------------------------------------------
-- Server version	8.0.30

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `admision`
--

DROP TABLE IF EXISTS `admision`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `admision` (
  `id_admision` int NOT NULL AUTO_INCREMENT,
  `fecha_adm` date NOT NULL,
  `nroadm` varchar(15) NOT NULL,
  `estado` varchar(5) NOT NULL,
  PRIMARY KEY (`id_admision`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admision`
--

LOCK TABLES `admision` WRITE;
/*!40000 ALTER TABLE `admision` DISABLE KEYS */;
/*!40000 ALTER TABLE `admision` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `area`
--

DROP TABLE IF EXISTS `area`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `area` (
  `id_area` int NOT NULL AUTO_INCREMENT,
  `id_complejo` int NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `cap_max` int NOT NULL,
  `valido` bit(1) NOT NULL DEFAULT b'1',
  PRIMARY KEY (`id_area`),
  KEY `fk_area_complejo` (`id_complejo`),
  CONSTRAINT `fk_area_complejo` FOREIGN KEY (`id_complejo`) REFERENCES `complejo` (`id_complejo`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `area`
--

LOCK TABLES `area` WRITE;
/*!40000 ALTER TABLE `area` DISABLE KEYS */;
INSERT INTO `area` VALUES (1,1,'Cancha 1',300,_binary '\0'),(2,1,'Cancha 2',30,_binary ''),(3,1,'Cancha 3',1,_binary '');
/*!40000 ALTER TABLE `area` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `calendario`
--

DROP TABLE IF EXISTS `calendario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `calendario` (
  `id_calendario` int NOT NULL AUTO_INCREMENT,
  `id_usuario` int NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `inicio` datetime NOT NULL,
  `fin` datetime NOT NULL,
  `className` varchar(100) NOT NULL,
  `allDay` bit(1) NOT NULL DEFAULT b'0',
  PRIMARY KEY (`id_calendario`),
  KEY `fk_calendario_usuario` (`id_usuario`),
  CONSTRAINT `fk_calendario_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=93 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `calendario`
--

LOCK TABLES `calendario` WRITE;
/*!40000 ALTER TABLE `calendario` DISABLE KEYS */;
INSERT INTO `calendario` VALUES (19,2,'Comidass','2024-04-08 15:00:00','2024-04-08 16:10:00','bg-warning',_binary '\0'),(28,1,'Entrenamiento','2024-04-07 17:00:00','2024-04-07 19:00:00','bg-danger',_binary ''),(29,1,'Patido 55466','2024-04-24 00:00:00','2024-04-14 00:00:00','bg-danger',_binary ''),(32,1,'Patido 5fa','2024-05-08 08:47:00','2024-05-08 08:47:00','bg-danger',_binary '\0'),(33,1,'Entrenamiento','2024-05-04 10:00:00','2024-05-04 12:00:00','bg-info',_binary '\0'),(34,1,'Entrenamiento123','2024-04-25 00:00:00','2024-04-27 00:00:00','bg-primary',_binary ''),(35,2,'Clases','2024-04-11 00:00:00','2024-04-11 07:30:00','bg-info',_binary ''),(37,1,'Pruebita','2024-04-28 00:00:00','2024-04-28 00:00:00','bg-danger',_binary ''),(38,1,'asdf','2024-05-08 00:00:00','2024-05-08 00:00:00','bg-danger',_binary ''),(39,1,'asdf','2024-05-08 00:00:00','2024-05-08 00:00:00','bg-danger',_binary ''),(41,1,'nuevel','2024-04-07 17:00:00','2024-04-07 15:00:00','bg-danger',_binary '\0'),(42,1,'asdf','2024-05-08 00:00:00','2024-05-08 00:00:00','bg-danger',_binary ''),(43,1,'asdf','2024-05-08 00:00:00','2024-05-08 00:00:00','bg-danger',_binary ''),(45,1,'Prueba pruea','2024-04-07 06:00:00','2024-04-08 16:01:00','bg-danger',_binary '\0'),(47,1,'asdf','2024-04-07 00:00:00','2024-04-07 03:00:00','bg-danger',_binary ''),(48,1,'asdf','2024-04-18 00:00:00','2024-04-18 02:00:00','bg-danger',_binary ''),(59,1,'Pruebadf','2024-04-18 12:00:00','2024-04-18 13:00:00','bg-danger',_binary ''),(60,1,'Patido 5','2024-04-25 00:00:00','2024-04-25 00:00:00','bg-danger',_binary ''),(62,1,'Patido 5','2024-04-10 12:25:00','2024-04-10 13:00:00','bg-primary',_binary '\0'),(63,1,'asdf','2024-04-12 00:00:00','2024-04-13 00:00:00','bg-danger',_binary ''),(64,1,'prueba 16','2024-04-16 18:00:00','2024-04-24 18:00:00','bg-danger',_binary '\0'),(65,1,'prueba 22','2024-04-22 14:00:00','2024-04-22 15:00:00','bg-primary',_binary '\0'),(66,1,'28','2024-04-28 17:00:00','2024-04-28 18:00:00','bg-success',_binary '\0'),(67,1,'28','2024-04-28 00:00:00','2024-04-28 00:00:00','bg-success',_binary ''),(68,1,'30','2024-04-30 01:00:00','2024-04-30 03:00:00','bg-info',_binary '\0'),(69,1,'30','2024-04-30 00:00:00','2024-04-30 04:00:00','bg-info',_binary '\0'),(70,1,'30','2024-04-30 01:00:00','2024-04-30 04:00:00','bg-info',_binary '\0'),(71,1,'30','2024-04-30 01:00:00','2024-04-30 04:00:00','bg-info',_binary '\0'),(72,1,'30','2024-04-30 01:00:00','2024-04-30 03:00:00','bg-info',_binary '\0'),(73,1,'30','2024-04-30 01:00:00','2024-04-30 03:00:00','bg-info',_binary '\0'),(74,1,'30','2024-04-30 01:00:00','2024-04-30 03:00:00','bg-info',_binary '\0'),(75,1,'30','2024-04-30 00:00:00','2024-04-30 00:00:00','bg-info',_binary ''),(76,1,'30','2024-04-30 00:00:00','2024-04-30 00:00:00','bg-info',_binary ''),(77,1,'30','2024-04-30 00:00:00','2024-04-30 00:00:00','bg-info',_binary ''),(78,1,'30','2024-04-30 00:00:00','2024-04-30 00:00:00','bg-info',_binary ''),(79,1,'14','2024-04-14 01:04:00','2024-04-14 05:02:00','bg-info',_binary '\0'),(80,1,'18','2024-04-18 14:00:00','2024-04-18 17:00:00','bg-danger',_binary '\0'),(81,1,'2','2024-05-02 14:00:00','2024-05-02 19:00:00','bg-danger',_binary '\0'),(82,1,'24j','2024-04-24 22:00:00','2024-04-24 23:00:00','bg-danger',_binary '\0'),(83,1,'10','2024-05-10 15:00:00','2024-05-10 17:00:00','bg-danger',_binary '\0'),(84,1,'3','2024-05-03 15:55:00','2024-05-03 16:55:00','bg-danger',_binary '\0'),(85,1,'6','2024-05-06 14:25:00','2024-05-06 15:55:00','bg-danger',_binary '\0'),(86,1,'5','2024-05-05 14:25:00','2024-05-05 22:25:00','bg-warning',_binary '\0'),(87,1,'5','2024-05-05 14:25:00','2024-05-05 22:25:00','bg-warning',_binary '\0'),(88,1,'20gf','2024-04-20 14:25:00','2024-04-20 14:28:00','bg-danger',_binary '\0'),(89,1,'11','2024-05-11 14:24:00','2024-05-11 14:58:00','bg-danger',_binary '\0'),(90,1,'274','2024-04-27 14:24:00','2024-04-27 15:00:00','bg-danger',_binary '\0'),(91,1,'asdf','2024-04-05 14:25:00','2024-04-05 15:25:00','bg-success',_binary '\0'),(92,1,'3','2024-04-03 00:00:00','2024-04-03 00:00:00','bg-success',_binary '');
/*!40000 ALTER TABLE `calendario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categoria`
--

DROP TABLE IF EXISTS `categoria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categoria` (
  `id_categoria` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(150) NOT NULL,
  `edad_inicio` int NOT NULL,
  `edad_final` int NOT NULL,
  `valido` bit(1) NOT NULL DEFAULT b'1',
  PRIMARY KEY (`id_categoria`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categoria`
--

LOCK TABLES `categoria` WRITE;
/*!40000 ALTER TABLE `categoria` DISABLE KEYS */;
INSERT INTO `categoria` VALUES (1,'Sub 15',11,15,_binary '');
/*!40000 ALTER TABLE `categoria` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `complejo`
--

DROP TABLE IF EXISTS `complejo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `complejo` (
  `id_complejo` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(150) NOT NULL,
  `descripcion` text NOT NULL,
  `valido` bit(1) NOT NULL DEFAULT b'1',
  PRIMARY KEY (`id_complejo`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `complejo`
--

LOCK TABLES `complejo` WRITE;
/*!40000 ALTER TABLE `complejo` DISABLE KEYS */;
INSERT INTO `complejo` VALUES (1,'The Strongest','Complejo deportivo multifuncional',_binary ''),(2,'The Strongestd','Complejo deportivo multifuncional',_binary ''),(3,'Complejo 3','Complejo completo',_binary '');
/*!40000 ALTER TABLE `complejo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `configuracion`
--

DROP TABLE IF EXISTS `configuracion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `configuracion` (
  `id_configuracion` int NOT NULL AUTO_INCREMENT,
  `id_usuario` int NOT NULL,
  `choose-skin` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'cyan',
  `font_setting` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'font-montserrat',
  `darkmode` bit(1) NOT NULL DEFAULT b'0',
  `fixnavbar` bit(1) NOT NULL DEFAULT b'0',
  `pageheader` bit(1) NOT NULL DEFAULT b'0',
  `min_sidebar` bit(1) NOT NULL DEFAULT b'0',
  `sidebar` bit(1) NOT NULL DEFAULT b'0',
  `iconcolor` int NOT NULL DEFAULT '0',
  `gradient` bit(1) NOT NULL DEFAULT b'1',
  `boxshadow` bit(1) NOT NULL DEFAULT b'0',
  `rtl` bit(1) NOT NULL DEFAULT b'0',
  `boxlayout` bit(1) NOT NULL DEFAULT b'0',
  `grid_menu` bit(1) NOT NULL DEFAULT b'0',
  PRIMARY KEY (`id_configuracion`),
  KEY `fk_configuracion_usuario` (`id_usuario`),
  CONSTRAINT `fk_configuracion_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `configuracion`
--

LOCK TABLES `configuracion` WRITE;
/*!40000 ALTER TABLE `configuracion` DISABLE KEYS */;
INSERT INTO `configuracion` VALUES (1,1,'purple','font-montserrat',_binary '',_binary '\0',_binary '\0',_binary '',_binary '\0',1,_binary '',_binary '',_binary '\0',_binary '\0',_binary '\0'),(2,2,'cyan','font-montserrat',_binary '',_binary '\0',_binary '\0',_binary '\0',_binary '\0',0,_binary '\0',_binary '\0',_binary '\0',_binary '\0',_binary '\0'),(4,5,'cyan','font-montserrat',_binary '',_binary '\0',_binary '\0',_binary '\0',_binary '\0',0,_binary '',_binary '\0',_binary '\0',_binary '\0',_binary '\0'),(5,6,'orange','font-montserrat',_binary '',_binary '\0',_binary '\0',_binary '\0',_binary '\0',0,_binary '\0',_binary '\0',_binary '\0',_binary '\0',_binary '\0');
/*!40000 ALTER TABLE `configuracion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `costo`
--

DROP TABLE IF EXISTS `costo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `costo` (
  `id_costo` int NOT NULL AUTO_INCREMENT,
  `id_servicio` int NOT NULL,
  `tipo_costo` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_final` date NOT NULL,
  `valor` decimal(10,2) NOT NULL,
  `valido` bit(1) NOT NULL DEFAULT b'1',
  `nro_cuotas_max` int NOT NULL,
  PRIMARY KEY (`id_costo`),
  KEY `fk_costo_servicio` (`id_servicio`),
  CONSTRAINT `fk_costo_servicio` FOREIGN KEY (`id_servicio`) REFERENCES `servicio` (`id_servicio`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `costo`
--

LOCK TABLES `costo` WRITE;
/*!40000 ALTER TABLE `costo` DISABLE KEYS */;
INSERT INTO `costo` VALUES (1,1,'Matrícula','2024-01-01','2024-12-31',150.00,_binary '',2),(2,1,'Mensualidad','2024-01-01','2024-12-31',50.00,_binary '',1),(3,1,'Uniforme','2024-01-01','2024-12-31',120.00,_binary '',1),(4,2,'Matrícula','2024-01-01','2024-12-31',300.00,_binary '',3),(5,2,'Sesión','2024-01-01','2024-12-31',300.00,_binary '',3),(6,3,'Campamentosdf','2024-01-05','2024-08-31',300.00,_binary '',3),(7,3,'Uniforme','2024-06-01','2024-12-31',120.00,_binary '',1);
/*!40000 ALTER TABLE `costo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `datos_medicos`
--

DROP TABLE IF EXISTS `datos_medicos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `datos_medicos` (
  `id_dm` int NOT NULL AUTO_INCREMENT,
  `id_persona` int NOT NULL,
  `tipo_dm` varchar(100) NOT NULL,
  `observaciones` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `certificad_med` text,
  PRIMARY KEY (`id_dm`),
  KEY `fk_dm_persona` (`id_persona`),
  CONSTRAINT `fk_dm_persona` FOREIGN KEY (`id_persona`) REFERENCES `persona` (`id_persona`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `datos_medicos`
--

LOCK TABLES `datos_medicos` WRITE;
/*!40000 ALTER TABLE `datos_medicos` DISABLE KEYS */;
/*!40000 ALTER TABLE `datos_medicos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int NOT NULL,
  `batch` int unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2024-03-27-003040','App\\Database\\Migrations\\AddTimestampsToTutor','default','App',1711499464,1),(2,'2024-03-27-003229','App\\Database\\Migrations\\AddTimestampsToTutor2','default','App',1711499583,2),(3,'2024-04-07-155102','App\\Database\\Migrations\\AddTimestampsToUsuario','default','App',1712505101,3);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pago`
--

DROP TABLE IF EXISTS `pago`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pago` (
  `id_pago` int NOT NULL AUTO_INCREMENT,
  `id_costo` int NOT NULL,
  `monto_pagado` decimal(10,2) NOT NULL,
  `fecha_pago` date NOT NULL,
  `nro_cuota` int DEFAULT '1',
  `id_persona` int NOT NULL,
  `id_estudiante` int NOT NULL COMMENT 'El estudiante de quien se realiza el pago',
  `id_dep` int DEFAULT NULL,
  `id_usuario` int NOT NULL,
  `archivo` text,
  PRIMARY KEY (`id_pago`),
  KEY `fk_pago_costo` (`id_costo`),
  KEY `fk_pago_persona` (`id_persona`),
  KEY `fk_pago_estudiante` (`id_estudiante`),
  CONSTRAINT `fk_pago_costo` FOREIGN KEY (`id_costo`) REFERENCES `costo` (`id_costo`),
  CONSTRAINT `fk_pago_estudiante` FOREIGN KEY (`id_estudiante`) REFERENCES `tutor` (`id_tutor`),
  CONSTRAINT `fk_pago_persona` FOREIGN KEY (`id_persona`) REFERENCES `persona` (`id_persona`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pago`
--

LOCK TABLES `pago` WRITE;
/*!40000 ALTER TABLE `pago` DISABLE KEYS */;
INSERT INTO `pago` VALUES (1,1,50.00,'2024-04-02',1,4,1,NULL,1,NULL),(2,1,100.00,'2024-04-06',2,4,1,1,1,NULL),(3,3,120.00,'2024-04-10',1,4,1,NULL,1,NULL),(4,2,50.00,'2024-04-12',1,4,1,NULL,1,NULL);
/*!40000 ALTER TABLE `pago` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `persona`
--

DROP TABLE IF EXISTS `persona`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `persona` (
  `id_persona` int NOT NULL AUTO_INCREMENT,
  `dni` varchar(50) NOT NULL,
  `extension` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `complemento` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `nombres` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `ap_paterno` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `ap_materno` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `fecha_nac` date NOT NULL,
  `sexo` tinyint NOT NULL,
  `direccion` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `foto` text,
  `nacionalidad` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_persona`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `persona`
--

LOCK TABLES `persona` WRITE;
/*!40000 ALTER TABLE `persona` DISABLE KEYS */;
INSERT INTO `persona` VALUES (1,'6595638','po',NULL,'Mauricio Ariel ','Aramayo','','1999-03-08',1,'B. Guadalquivir','1712253707IMG-20240401-WA0020.jpg','Boliviana'),(2,'45997832','tj',NULL,'Diego','Vidaurre','Castellon','2004-02-19',1,'Pueblo Nuevo','1712462723eren-rogue-titan-anime-rilun-1920x1080.jpg','Boliviana'),(3,'1391581','po',NULL,'Weimar','Aramayo','Escaray','1960-11-19',1,'Pueblo Nuevo',NULL,'Boliviana'),(4,'3681969','tj',NULL,'Sonia','Vidaurre','Rodriguez','1965-12-19',1,'Pueblo Nuevo',NULL,'Boliviana'),(5,'564546','',NULL,'Dieter','Gutierrez','','1993-04-14',0,'','1712282209eren-rogue-titan-anime-rilun-1920x1080.jpg',''),(6,'134','',NULL,'adsf','adsf','','2024-04-26',0,'',NULL,''),(7,'3252525','',NULL,'prueba user1','ap1','apmat1','2024-05-02',0,'',NULL,''),(8,'453525','',NULL,'Prueba2','prueba2','prueba2','2024-04-18',0,'',NULL,''),(9,'2354354','',NULL,'Goku','son','goku','2024-04-04',0,'','1712452952son-goku-super-saiyan-hd-wallpaper-1920x1200.jpg','');
/*!40000 ALTER TABLE `persona` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `persona_admision`
--

DROP TABLE IF EXISTS `persona_admision`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `persona_admision` (
  `id_pa` int NOT NULL AUTO_INCREMENT,
  `id_persona` int NOT NULL,
  `id_admision` int NOT NULL,
  `tipo_pa` varchar(15) NOT NULL,
  PRIMARY KEY (`id_pa`),
  KEY `fk_pa_persona` (`id_persona`),
  KEY `fk_pa_admision` (`id_admision`),
  CONSTRAINT `fk_pa_admision` FOREIGN KEY (`id_admision`) REFERENCES `admision` (`id_admision`),
  CONSTRAINT `fk_pa_persona` FOREIGN KEY (`id_persona`) REFERENCES `persona` (`id_persona`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `persona_admision`
--

LOCK TABLES `persona_admision` WRITE;
/*!40000 ALTER TABLE `persona_admision` DISABLE KEYS */;
/*!40000 ALTER TABLE `persona_admision` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `servicio`
--

DROP TABLE IF EXISTS `servicio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `servicio` (
  `id_servicio` int NOT NULL AUTO_INCREMENT,
  `tipo_servicio` varchar(100) NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `descripcion` text NOT NULL,
  `id_dep` int DEFAULT NULL,
  `valido` bit(1) NOT NULL DEFAULT b'1',
  PRIMARY KEY (`id_servicio`),
  KEY `fk_servicio_servicio` (`id_dep`),
  CONSTRAINT `fk_servicio_servicio` FOREIGN KEY (`id_dep`) REFERENCES `servicio` (`id_servicio`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `servicio`
--

LOCK TABLES `servicio` WRITE;
/*!40000 ALTER TABLE `servicio` DISABLE KEYS */;
INSERT INTO `servicio` VALUES (1,'Clases regulares','Clases regulares','Clases regulares',NULL,_binary ''),(2,'	Entrenamiento personalizado','	Entrenamiento personalizado','	Entrenamiento personalizado',NULL,_binary ''),(3,'	Campamento de verano','	Campamento de verano','	Campamento de verano',NULL,_binary ''),(4,'	Clases para niños','	Clases para niños','Clases regulares',1,_binary ''),(5,'Clases para adultos','Clases para adultos','Clases regulares',1,_binary '');
/*!40000 ALTER TABLE `servicio` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `telefono`
--

DROP TABLE IF EXISTS `telefono`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `telefono` (
  `id_telefono` int NOT NULL AUTO_INCREMENT,
  `id_persona` int NOT NULL,
  `tipo_tel` varchar(25) NOT NULL,
  `cod_area` varchar(6) NOT NULL,
  `numero` int NOT NULL,
  `valido` bit(1) NOT NULL DEFAULT b'1',
  PRIMARY KEY (`id_telefono`),
  KEY `fk_telefono_persona` (`id_persona`),
  CONSTRAINT `fk_telefono_persona` FOREIGN KEY (`id_persona`) REFERENCES `persona` (`id_persona`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `telefono`
--

LOCK TABLES `telefono` WRITE;
/*!40000 ALTER TABLE `telefono` DISABLE KEYS */;
INSERT INTO `telefono` VALUES (1,1,'Bo','195',76681428,_binary ''),(3,2,'Bo','195',76681428,_binary '');
/*!40000 ALTER TABLE `telefono` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `temporada`
--

DROP TABLE IF EXISTS `temporada`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `temporada` (
  `id_temporada` int NOT NULL AUTO_INCREMENT,
  `id_area` int NOT NULL,
  `id_turno` int NOT NULL,
  `id_categoria` int NOT NULL,
  `id_servicio` int NOT NULL,
  `tipo_temporada` varchar(100) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_fin` date NOT NULL,
  `valido` bit(1) NOT NULL DEFAULT b'1',
  PRIMARY KEY (`id_temporada`),
  KEY `fk_temporada_area` (`id_area`),
  KEY `fk_temporada_turno` (`id_turno`),
  KEY `fk_temporada_categoria` (`id_categoria`),
  KEY `fk_temporada_servicio` (`id_servicio`),
  CONSTRAINT `fk_temporada_area` FOREIGN KEY (`id_area`) REFERENCES `area` (`id_area`),
  CONSTRAINT `fk_temporada_categoria` FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id_categoria`),
  CONSTRAINT `fk_temporada_servicio` FOREIGN KEY (`id_servicio`) REFERENCES `servicio` (`id_servicio`),
  CONSTRAINT `fk_temporada_turno` FOREIGN KEY (`id_turno`) REFERENCES `turno` (`id_turno`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `temporada`
--

LOCK TABLES `temporada` WRITE;
/*!40000 ALTER TABLE `temporada` DISABLE KEYS */;
INSERT INTO `temporada` VALUES (1,2,1,1,3,'temp 1','Temporada 1','2024-06-01','2024-07-31',_binary '\0'),(2,2,1,1,3,'tipo temp 1','Temporada 2','2024-04-04','2024-04-18',_binary '');
/*!40000 ALTER TABLE `temporada` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `temporada_admision`
--

DROP TABLE IF EXISTS `temporada_admision`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `temporada_admision` (
  `id_ta` int NOT NULL AUTO_INCREMENT,
  `id_temporada` int NOT NULL,
  `id_admision` int NOT NULL,
  `fec_alt_temp` date NOT NULL,
  `fec_baja_temp` date NOT NULL,
  `estado` varchar(15) NOT NULL,
  PRIMARY KEY (`id_ta`),
  KEY `fk_ta_admision` (`id_admision`),
  KEY `fk_ta_temporada` (`id_temporada`),
  CONSTRAINT `fk_ta_admision` FOREIGN KEY (`id_admision`) REFERENCES `admision` (`id_admision`),
  CONSTRAINT `fk_ta_temporada` FOREIGN KEY (`id_temporada`) REFERENCES `temporada` (`id_temporada`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `temporada_admision`
--

LOCK TABLES `temporada_admision` WRITE;
/*!40000 ALTER TABLE `temporada_admision` DISABLE KEYS */;
/*!40000 ALTER TABLE `temporada_admision` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `turno`
--

DROP TABLE IF EXISTS `turno`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `turno` (
  `id_turno` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `hora_inicio` time NOT NULL,
  `hora_fin` time NOT NULL,
  `valido` bit(1) NOT NULL DEFAULT b'1',
  PRIMARY KEY (`id_turno`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `turno`
--

LOCK TABLES `turno` WRITE;
/*!40000 ALTER TABLE `turno` DISABLE KEYS */;
INSERT INTO `turno` VALUES (1,'Tarde','14:00:00','16:00:00',_binary '');
/*!40000 ALTER TABLE `turno` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tutor`
--

DROP TABLE IF EXISTS `tutor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tutor` (
  `id_tutor` int NOT NULL AUTO_INCREMENT,
  `id_persona` int NOT NULL,
  `tipo_tutor` varchar(50) NOT NULL,
  `descripcion` varchar(150) NOT NULL,
  `id_dep` int DEFAULT NULL,
  `valido` bit(1) NOT NULL DEFAULT b'1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_tutor`),
  KEY `fk_tutor_persona` (`id_persona`),
  KEY `fk_tutor_tutor` (`id_dep`),
  CONSTRAINT `fk_tutor_persona` FOREIGN KEY (`id_persona`) REFERENCES `persona` (`id_persona`),
  CONSTRAINT `fk_tutor_tutor` FOREIGN KEY (`id_dep`) REFERENCES `tutor` (`id_tutor`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tutor`
--

LOCK TABLES `tutor` WRITE;
/*!40000 ALTER TABLE `tutor` DISABLE KEYS */;
INSERT INTO `tutor` VALUES (1,2,'estudiante','Estudiante de la escuela',3,_binary '','2024-04-02 21:17:11','2024-04-07 16:22:22',NULL),(2,3,'tutor','Tutor de estudiante',NULL,_binary '','2024-04-02 21:17:11',NULL,NULL),(3,4,'tutor','Tutor de estudiante',NULL,_binary '','2024-04-02 21:17:11',NULL,NULL);
/*!40000 ALTER TABLE `tutor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuario` (
  `id_usuario` int NOT NULL AUTO_INCREMENT,
  `id_rol` int NOT NULL,
  `id_cargo` int NOT NULL,
  `id_persona` int NOT NULL,
  `usuario` varchar(100) NOT NULL,
  `contraseña` text NOT NULL,
  `estado` bit(1) NOT NULL DEFAULT b'1',
  `ultimo_login` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_usuario`),
  KEY `fk_persona` (`id_persona`),
  CONSTRAINT `fk_persona` FOREIGN KEY (`id_persona`) REFERENCES `persona` (`id_persona`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES (1,1,1,1,'admin','$2y$10$gVyQ/7q1Wul7lPo0c12xee1bEHX6Apq5YNF4oZW1oVbeq773tTmJi',_binary '','2024-04-09 12:24:09','2024-04-02 21:23:24','2024-04-09 12:24:09',NULL),(2,2,1,5,'dieter','$2y$10$c4DkT2PFmV4Qv8R6Ig3VHuIBv7c7gh6A2sf9qgoBbnwnJDBQNAFAS',_binary '','2024-04-08 11:48:24','2024-04-02 21:23:24','2024-04-08 11:48:24',NULL),(5,2,1,8,'prueba2','$2y$10$dP2983KGkew1gf9TK11SIuGALcGUdcCgzRkzfshS7.orLMBZ7JNDm',_binary '','2024-04-06 19:49:03','2024-04-02 21:23:24',NULL,NULL),(6,2,1,9,'goku','$2y$10$Hc9bMzz2Eh/BH/NSS0C5BO/1hcJTAzDgRjGimTcZ5OrtfE3rztWZm',_binary '','2024-04-02 21:23:24','2024-04-02 21:23:24','2024-04-07 15:53:07',NULL);
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-04-09 15:20:47
