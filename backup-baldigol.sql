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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `area`
--

LOCK TABLES `area` WRITE;
/*!40000 ALTER TABLE `area` DISABLE KEYS */;
INSERT INTO `area` VALUES (1,1,'Cancha 1',300,_binary '\0'),(2,1,'Cancha 2',30,_binary '');
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
  `id_temporada` int NOT NULL,
  `fecha` date NOT NULL,
  `observacion` text,
  `valido` bit(1) NOT NULL DEFAULT b'1',
  PRIMARY KEY (`id_calendario`),
  KEY `fk_calendario_temporada` (`id_temporada`),
  CONSTRAINT `fk_calendario_temporada` FOREIGN KEY (`id_temporada`) REFERENCES `temporada` (`id_temporada`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `calendario`
--

LOCK TABLES `calendario` WRITE;
/*!40000 ALTER TABLE `calendario` DISABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categoria`
--

LOCK TABLES `categoria` WRITE;
/*!40000 ALTER TABLE `categoria` DISABLE KEYS */;
INSERT INTO `categoria` VALUES (1,'Sub 15',11,15,_binary '\0');
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `complejo`
--

LOCK TABLES `complejo` WRITE;
/*!40000 ALTER TABLE `complejo` DISABLE KEYS */;
INSERT INTO `complejo` VALUES (1,'The Strongest','Complejo deportivo multifuncional',_binary ''),(2,'The Strongestd','Complejo deportivo multifuncional',_binary '');
/*!40000 ALTER TABLE `complejo` ENABLE KEYS */;
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
  `tipo_costo` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_final` date NOT NULL,
  `valor` decimal(10,2) NOT NULL,
  `valido` bit(1) NOT NULL DEFAULT b'1',
  PRIMARY KEY (`id_costo`),
  KEY `fk_costo_servicio` (`id_servicio`),
  CONSTRAINT `fk_costo_servicio` FOREIGN KEY (`id_servicio`) REFERENCES `servicio` (`id_servicio`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `costo`
--

LOCK TABLES `costo` WRITE;
/*!40000 ALTER TABLE `costo` DISABLE KEYS */;
INSERT INTO `costo` VALUES (1,1,'Matrícula','2024-01-01','2024-12-31',300.00,_binary ''),(2,1,'Mensualidad','2024-01-01','2024-12-31',300.00,_binary ''),(3,1,'	Uniforme','2024-01-01','2024-12-31',300.00,_binary ''),(4,2,'Matrícula','2024-01-01','2024-12-31',300.00,_binary ''),(5,2,'Sesión','2024-01-01','2024-12-31',300.00,_binary ''),(6,3,'Campamento','2024-06-01','2024-08-31',300.00,_binary ''),(7,3,'	Uniforme','2024-06-01','2024-12-31',120.00,_binary '');
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
  `observaciones` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `certificad_med` text,
  PRIMARY KEY (`id_dm`),
  KEY `fk_dm_persona` (`id_persona`),
  CONSTRAINT `fk_dm_persona` FOREIGN KEY (`id_persona`) REFERENCES `persona` (`id_persona`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2024-03-27-003040','App\\Database\\Migrations\\AddTimestampsToTutor','default','App',1711499464,1),(2,'2024-03-27-003229','App\\Database\\Migrations\\AddTimestampsToTutor2','default','App',1711499583,2);
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
  `nro_cuota` int DEFAULT NULL,
  PRIMARY KEY (`id_pago`),
  KEY `fk_pago_costo` (`id_costo`),
  CONSTRAINT `fk_pago_costo` FOREIGN KEY (`id_costo`) REFERENCES `costo` (`id_costo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pago`
--

LOCK TABLES `pago` WRITE;
/*!40000 ALTER TABLE `pago` DISABLE KEYS */;
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
  `extension` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `complemento` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `nombres` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `ap_paterno` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `ap_materno` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `fecha_nac` date NOT NULL,
  `sexo` tinyint NOT NULL,
  `direccion` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `foto` text,
  `nacionalidad` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`id_persona`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `persona`
--

LOCK TABLES `persona` WRITE;
/*!40000 ALTER TABLE `persona` DISABLE KEYS */;
INSERT INTO `persona` VALUES (1,'6595638','po',NULL,'Mauricio Ariel ','Aramayo','Vidaurre','1999-03-08',1,'B. Guadalquivir','1711462042DSC_0070.JPG','Boliviana'),(2,'45997832','tj',NULL,'Diego','Vidaurre','Castellon','2004-02-19',1,'Pueblo Nuevo','1711499315DSC_0243.JPG','Boliviana'),(3,'1391581','po',NULL,'Weimar','Aramayo','Escaray','1960-11-19',1,'Pueblo Nuevo',NULL,'Boliviana'),(4,'3681969','tj',NULL,'Sonia','Vidaurre','Rodriguez','1965-12-19',1,'Pueblo Nuevo',NULL,'Boliviana');
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `telefono`
--

LOCK TABLES `telefono` WRITE;
/*!40000 ALTER TABLE `telefono` DISABLE KEYS */;
INSERT INTO `telefono` VALUES (1,1,'Bo','195',76681428,_binary '');
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `temporada`
--

LOCK TABLES `temporada` WRITE;
/*!40000 ALTER TABLE `temporada` DISABLE KEYS */;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tutor`
--

LOCK TABLES `tutor` WRITE;
/*!40000 ALTER TABLE `tutor` DISABLE KEYS */;
INSERT INTO `tutor` VALUES (1,2,'estudiante','Estudiante de la escuela',3,_binary '',NULL,'2024-03-27 00:33:31',NULL),(2,3,'tutor','Tutor de estudiante',NULL,_binary '',NULL,NULL,NULL),(3,4,'tutor','Tutor de estudiante',NULL,_binary '',NULL,NULL,NULL);
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
  PRIMARY KEY (`id_usuario`),
  KEY `fk_persona` (`id_persona`),
  CONSTRAINT `fk_persona` FOREIGN KEY (`id_persona`) REFERENCES `persona` (`id_persona`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES (1,1,1,1,'admin','$2y$10$gVyQ/7q1Wul7lPo0c12xee1bEHX6Apq5YNF4oZW1oVbeq773tTmJi',_binary '','2024-03-27 10:27:27');
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

-- Dump completed on 2024-03-27 10:45:34
