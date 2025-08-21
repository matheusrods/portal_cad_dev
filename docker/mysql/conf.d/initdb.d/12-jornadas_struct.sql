/*M!999999\- enable the sandbox mode */ 
-- MariaDB dump 10.19  Distrib 10.11.11-MariaDB, for Linux (x86_64)
--
-- Host: 127.0.0.1    Database: jornadas
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
-- Current Database: `jornadas`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `jornadas` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci */;

USE `jornadas`;

--
-- Table structure for table `perguntas`
--

DROP TABLE IF EXISTS `perguntas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `perguntas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pergunta` varchar(1500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `respostasJornadas`
--

DROP TABLE IF EXISTS `respostasJornadas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `respostasJornadas` (
  `idJornada` int(11) NOT NULL AUTO_INCREMENT,
  `1` text DEFAULT NULL,
  `2` text DEFAULT NULL,
  `3` text DEFAULT NULL,
  `4` text DEFAULT NULL,
  `5` text DEFAULT NULL,
  `6` text DEFAULT NULL,
  `7` text DEFAULT NULL,
  `8` text DEFAULT NULL,
  `9` text DEFAULT NULL,
  `10` text DEFAULT NULL,
  `11` text DEFAULT NULL,
  `12` text DEFAULT NULL,
  `13` text DEFAULT NULL,
  `14` text DEFAULT NULL,
  `15` text DEFAULT NULL,
  `16` text DEFAULT NULL,
  `17` text DEFAULT NULL,
  `18` text DEFAULT NULL,
  `19` text DEFAULT NULL,
  `20` text DEFAULT NULL,
  `21` text DEFAULT NULL,
  `22` text DEFAULT NULL,
  `23` text DEFAULT NULL,
  `24` text DEFAULT NULL,
  `25` text DEFAULT NULL,
  `26` text DEFAULT NULL,
  `27` text DEFAULT NULL,
  `28` text DEFAULT NULL,
  `29` text DEFAULT NULL,
  `30` text DEFAULT NULL,
  `31` text DEFAULT NULL,
  `timestamp` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`idJornada`)
) ENGINE=InnoDB AUTO_INCREMENT=1302 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `respostasJornadas_20250603`
--

DROP TABLE IF EXISTS `respostasJornadas_20250603`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `respostasJornadas_20250603` (
  `idJornada` int(11) NOT NULL DEFAULT 0,
  `1` text DEFAULT NULL,
  `2` text DEFAULT NULL,
  `3` text DEFAULT NULL,
  `4` text DEFAULT NULL,
  `5` text DEFAULT NULL,
  `6` text DEFAULT NULL,
  `7` text DEFAULT NULL,
  `8` text DEFAULT NULL,
  `9` text DEFAULT NULL,
  `10` text DEFAULT NULL,
  `11` text DEFAULT NULL,
  `12` text DEFAULT NULL,
  `13` text DEFAULT NULL,
  `14` text DEFAULT NULL,
  `15` text DEFAULT NULL,
  `16` text DEFAULT NULL,
  `17` text DEFAULT NULL,
  `18` text DEFAULT NULL,
  `19` text DEFAULT NULL,
  `20` text DEFAULT NULL,
  `21` text DEFAULT NULL,
  `22` text DEFAULT NULL,
  `23` text DEFAULT NULL,
  `24` text DEFAULT NULL,
  `25` text DEFAULT NULL,
  `26` text DEFAULT NULL,
  `27` text DEFAULT NULL,
  `28` text DEFAULT NULL,
  `29` text DEFAULT NULL,
  `30` text DEFAULT NULL,
  `31` text DEFAULT NULL,
  `timestamp` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping routines for database 'jornadas'
--
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
/*!50003 DROP PROCEDURE IF EXISTS `consultaJornadas` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
DELIMITER ;;
CREATE DEFINER=`albert`@`%` PROCEDURE `consultaJornadas`()
BEGIN
    -- Obter os textos das perguntas
    SELECT GROUP_CONCAT(
        CONCAT('r.`', p.id, '` AS `', p.pergunta, '`')
    ) INTO @sql
    FROM jornadas.perguntas p
    JOIN INFORMATION_SCHEMA.COLUMNS c ON c.TABLE_NAME = 'respostasJornadas' AND c.COLUMN_NAME = p.id;

    -- Concatenar a consulta final
    SET @sql = CONCAT('SELECT r.idJornada, ', @sql, ' FROM jornadas.perguntas p JOIN jornadas.respostasJornadas r ON p.id = r.idJornada');

    -- Preparar e executar a consulta
    PREPARE stmt FROM @sql;
    EXECUTE stmt;
    DEALLOCATE PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-08-20  0:17:58
