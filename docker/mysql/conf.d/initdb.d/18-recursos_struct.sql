/*M!999999\- enable the sandbox mode */ 
-- MariaDB dump 10.19  Distrib 10.11.11-MariaDB, for Linux (x86_64)
--
-- Host: 127.0.0.1    Database: recursos
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
-- Current Database: `recursos`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `recursos` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;

USE `recursos`;

--
-- Table structure for table `logAlteracaoRecursos`
--

DROP TABLE IF EXISTS `logAlteracaoRecursos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `logAlteracaoRecursos` (
  `idRecurso` int(11) NOT NULL,
  `matAlteracao` varchar(8) DEFAULT NULL,
  `timestampAlteracao` datetime NOT NULL DEFAULT current_timestamp(),
  `tituloAnterior` varchar(200) DEFAULT NULL,
  `tituloNovo` varchar(200) DEFAULT NULL,
  `descricaoAnterior` varchar(500) DEFAULT NULL,
  `descricaoNova` varchar(500) DEFAULT NULL,
  `nomeArquivoAnterior` varchar(200) DEFAULT NULL,
  `nomeArquivoNovo` varchar(200) DEFAULT NULL,
  `nomeCapaAnterior` varchar(200) DEFAULT NULL,
  `nomeCapaNovo` varchar(200) DEFAULT NULL,
  `temaAnterior` int(11) DEFAULT NULL,
  `temaNovo` int(11) DEFAULT NULL,
  `statusAnterior` int(1) DEFAULT NULL,
  `novoStatus` int(1) DEFAULT NULL,
  `tipoAlteracao` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`idRecurso`,`timestampAlteracao`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `recursos`
--

DROP TABLE IF EXISTS `recursos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `recursos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(200) DEFAULT NULL,
  `subtitulo` varchar(500) DEFAULT NULL,
  `nomeArquivo` varchar(2500) DEFAULT NULL,
  `nomeCapa` varchar(200) DEFAULT NULL,
  `linkExterno` int(1) DEFAULT 0,
  `ativo` int(11) DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=71 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `recursosTemas`
--

DROP TABLE IF EXISTS `recursosTemas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `recursosTemas` (
  `idRecurso` int(11) NOT NULL,
  `idTema` int(11) NOT NULL,
  PRIMARY KEY (`idTema`,`idRecurso`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `temas`
--

DROP TABLE IF EXISTS `temas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `temas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tema` varchar(45) DEFAULT NULL,
  `ativo` int(11) DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping routines for database 'recursos'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-08-20  0:16:58
