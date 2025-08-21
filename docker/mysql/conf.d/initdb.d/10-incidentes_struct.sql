/*M!999999\- enable the sandbox mode */ 
-- MariaDB dump 10.19  Distrib 10.11.11-MariaDB, for Linux (x86_64)
--
-- Host: 127.0.0.1    Database: incidentes
-- ------------------------------------------------------
-- Server version	10.11.11-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Current Database: `incidentes`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `incidentes` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;

USE `incidentes`;

--
-- Table structure for table `ambiente`
--

DROP TABLE IF EXISTS `ambiente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `ambiente` (
  `codigo` int(4) NOT NULL,
  `ambiente` varchar(30) NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `backup_incidente_20250107`
--

DROP TABLE IF EXISTS `backup_incidente_20250107`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `backup_incidente_20250107` (
  `numIntIssue` varchar(255) DEFAULT NULL,
  `matriculaAbertura` varchar(8) DEFAULT NULL,
  `dataHoraAbertura` datetime DEFAULT NULL,
  `matriculaEncerramento` varchar(8) DEFAULT NULL,
  `dataHoraEncerramento` datetime DEFAULT NULL,
  `motivo` varchar(255) DEFAULT NULL,
  `ambiente` int(4) DEFAULT NULL,
  `dependencia` varchar(255) DEFAULT NULL,
  `observacao` varchar(255) DEFAULT NULL,
  `responsavel` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `tipo` int(11) DEFAULT NULL,
  `id` int(11) NOT NULL DEFAULT 0,
  `ativo` int(1) DEFAULT 1,
  `matriculaDeleteIncidente` varchar(8) DEFAULT NULL,
  `dataHoraDelete` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `incidente`
--

DROP TABLE IF EXISTS `incidente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `incidente` (
  `numIntIssue` varchar(255) DEFAULT NULL,
  `matriculaAbertura` varchar(8) DEFAULT NULL,
  `dataHoraAbertura` datetime DEFAULT NULL,
  `matriculaEncerramento` varchar(8) DEFAULT NULL,
  `dataHoraEncerramento` datetime DEFAULT NULL,
  `motivo` varchar(255) DEFAULT NULL,
  `ambiente` int(4) DEFAULT NULL,
  `dependencia` varchar(255) DEFAULT NULL,
  `observacao` varchar(255) DEFAULT NULL,
  `responsavel` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `tipo` int(11) DEFAULT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ativo` int(1) DEFAULT 1,
  `matriculaDeleteIncidente` varchar(8) DEFAULT NULL,
  `dataHoraDelete` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ambiente` (`ambiente`),
  CONSTRAINT `incidente_ibfk_1` FOREIGN KEY (`ambiente`) REFERENCES `ambiente` (`codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=292 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `status`
--

DROP TABLE IF EXISTS `status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `status` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tipoIncidentes`
--

DROP TABLE IF EXISTS `tipoIncidentes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tipoIncidentes` (
  `codigo` int(4) NOT NULL,
  `tipo` varchar(30) NOT NULL,
  `tooltip` varchar(300) DEFAULT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping routines for database 'incidentes'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-08-20  0:17:38
