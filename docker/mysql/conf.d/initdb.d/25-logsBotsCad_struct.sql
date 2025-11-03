/*M!999999\- enable the sandbox mode */ 
-- MariaDB dump 10.19  Distrib 10.11.14-MariaDB, for Linux (x86_64)
--
-- Host: 127.0.0.1    Database: logsBotsCad
-- ------------------------------------------------------
-- Server version	10.11.14-MariaDB

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
-- Current Database: `logsBotsCad`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `logsBotsCad` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;

USE `logsBotsCad`;

--
-- Table structure for table `logBotDev`
--

DROP TABLE IF EXISTS `logBotDev`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `logBotDev` (
  `idConversa` varchar(100) NOT NULL,
  `usuario` varchar(8) DEFAULT NULL,
  `input` text DEFAULT NULL,
  `resposta_bot` text DEFAULT NULL,
  `contexto` text DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `ativo` int(11) DEFAULT 1 COMMENT 'Utilizado para dar a opção para o usuário apagar o contexto atual da sua conversa\n"0" = Contexto Inválido\n"1" = Contexto Válido',
  PRIMARY KEY (`idConversa`,`timestamp`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `logBotDevHomolog`
--

DROP TABLE IF EXISTS `logBotDevHomolog`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `logBotDevHomolog` (
  `idConversa` varchar(100) NOT NULL,
  `usuario` varchar(8) DEFAULT NULL,
  `input` text DEFAULT NULL,
  `resposta_bot` text DEFAULT NULL,
  `contexto` text DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `ativo` int(11) DEFAULT 1 COMMENT 'Utilizado para dar a opção para o usuário apagar o contexto atual da sua conversa\n"0" = Contexto Inválido\n"1" = Contexto Válido',
  PRIMARY KEY (`idConversa`,`timestamp`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `logBotSql`
--

DROP TABLE IF EXISTS `logBotSql`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `logBotSql` (
  `idConversa` varchar(100) NOT NULL,
  `usuario` varchar(8) DEFAULT NULL,
  `input` text DEFAULT NULL,
  `resposta_bot` text DEFAULT NULL,
  `contexto` text DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `ativo` int(11) DEFAULT 1 COMMENT 'Utilizado para dar a opção para o usuário apagar o contexto atual da sua conversa\n"0" = Contexto Inválido\n"1" = Contexto Válido',
  PRIMARY KEY (`idConversa`,`timestamp`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `logCodigosRespostas`
--

DROP TABLE IF EXISTS `logCodigosRespostas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `logCodigosRespostas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `matricula` varchar(8) DEFAULT NULL,
  `nomeBot` varchar(45) DEFAULT NULL,
  `input` longtext DEFAULT NULL,
  `codResposta` int(11) DEFAULT NULL,
  `data` date DEFAULT NULL,
  `timestamp` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2146 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `logGuiaLinguagem`
--

DROP TABLE IF EXISTS `logGuiaLinguagem`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `logGuiaLinguagem` (
  `idConversa` varchar(100) NOT NULL,
  `usuario` varchar(8) DEFAULT NULL,
  `tipoInput` varchar(45) DEFAULT NULL,
  `input` longtext DEFAULT NULL,
  `resposta_bot` longtext DEFAULT NULL,
  `contexto` longtext DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `ativo` int(11) DEFAULT 1 COMMENT 'Utilizado para dar a opção para o usuário apagar o contexto atual da sua conversa\n"0" = Contexto Inválido\n"1" = Contexto Válido',
  PRIMARY KEY (`idConversa`,`timestamp`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `logGuiaLinguagemHomolog`
--

DROP TABLE IF EXISTS `logGuiaLinguagemHomolog`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `logGuiaLinguagemHomolog` (
  `idConversa` varchar(100) NOT NULL,
  `usuario` varchar(8) DEFAULT NULL,
  `input` text DEFAULT NULL,
  `resposta_bot` text DEFAULT NULL,
  `contexto` text DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `ativo` int(11) DEFAULT 1 COMMENT 'Utilizado para dar a opção para o usuário apagar o contexto atual da sua conversa\n"0" = Contexto Inválido\n"1" = Contexto Válido',
  PRIMARY KEY (`idConversa`,`timestamp`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


DROP TABLE IF EXISTS `logFeedbackTom`;

CREATE TABLE `logFeedbackTom` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `mensagem_bot` TEXT NOT NULL,
  `matricula` VARCHAR(8) DEFAULT NULL,
  `comentario_usuario` TEXT DEFAULT NULL,
  `avaliacao` ENUM('like', 'dislike') NOT NULL,
  `timestamp` TIMESTAMP NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`, `timestamp`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


DROP TABLE IF EXISTS `logFeedbackCaramelo`;

CREATE TABLE `logFeedbackCaramelo` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `mensagem_bot` TEXT NOT NULL,
  `matricula` VARCHAR(8) DEFAULT NULL,
  `comentario_usuario` TEXT DEFAULT NULL,
  `avaliacao` ENUM('like', 'dislike') NOT NULL,
  `timestamp` TIMESTAMP NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`, `timestamp`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



