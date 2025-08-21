/*M!999999\- enable the sandbox mode */ 
-- MariaDB dump 10.19  Distrib 10.11.11-MariaDB, for Linux (x86_64)
--
-- Host: 127.0.0.1    Database: report
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
-- Current Database: `report`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `report` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;

USE `report`;

--
-- Table structure for table `ERROS_LOGIN`
--

DROP TABLE IF EXISTS `ERROS_LOGIN`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `ERROS_LOGIN` (
  `tx_cd_erro_idfc` char(8) NOT NULL COMMENT 'Código do Texto do Erro do Login no Bot WhatsApp',
  `tx_mtv_erro` char(255) NOT NULL COMMENT 'Texto do Erro do Login no Bot WhatsApp'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `INDUCAO_WA`
--

DROP TABLE IF EXISTS `INDUCAO_WA`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `INDUCAO_WA` (
  `INPUT` varchar(128) DEFAULT NULL,
  `INPUT2` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `base_ativos_lista_enviados`
--

DROP TABLE IF EXISTS `base_ativos_lista_enviados`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `base_ativos_lista_enviados` (
  `data` date NOT NULL,
  `ordem` int(1) NOT NULL,
  `nm_ativo` varchar(50) DEFAULT NULL,
  `qtd_enviada` int(11) NOT NULL DEFAULT 0,
  `data_atualizacao` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`data`,`ordem`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC COMMENT='tabela com resumo diária da quantidade ativos enviados nos útimos 3 dias. Dados gerados na rotina SAS xxxx';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `base_ativos_lista_enviados_temp`
--

DROP TABLE IF EXISTS `base_ativos_lista_enviados_temp`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `base_ativos_lista_enviados_temp` (
  `data` date NOT NULL,
  `ordem` int(1) NOT NULL,
  `nm_ativo` varchar(50) DEFAULT NULL,
  `qtd_enviada` int(11) NOT NULL DEFAULT 0,
  `data_atualizacao` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`data`,`ordem`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC COMMENT='tabela com resumo diária da quantidade ativos enviados nos útimos 3 dias. Dados gerados na rotina SAS xxxx';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `base_ativos_qtd_enviados`
--

DROP TABLE IF EXISTS `base_ativos_qtd_enviados`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `base_ativos_qtd_enviados` (
  `data` date NOT NULL,
  `qtd_ativos_enviados` int(11) NOT NULL DEFAULT 0,
  `data_atualizacao` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`data`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC COMMENT='tabela com resumo diária da quantidade ativos enviados nos útimos 3 dias. Dados gerados na rotina SAS xxxx';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `base_ativos_qtd_enviados_temp`
--

DROP TABLE IF EXISTS `base_ativos_qtd_enviados_temp`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `base_ativos_qtd_enviados_temp` (
  `data` date NOT NULL,
  `qtd_ativos_enviados` int(11) NOT NULL DEFAULT 0,
  `data_atualizacao` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC COMMENT='tabela com resumo diária da quantidade ativos enviados nos útimos 3 dias. Dados gerados na rotina SAS xxxx';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `base_ativos_sa`
--

DROP TABLE IF EXISTS `base_ativos_sa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `base_ativos_sa` (
  `data` date NOT NULL COMMENT 'Data do contrato com a Ativos SA',
  `canal_bot` varchar(50) NOT NULL DEFAULT '' COMMENT 'Canal do contrato com a Ativos SA',
  `id_log_nia_infra` bigint(20) NOT NULL DEFAULT 0 COMMENT 'Id do log_nia_intra de contratos com a Ativos SA',
  `valor` double NOT NULL DEFAULT 0 COMMENT 'Valor do contratos com a Ativos SA',
  `data_atualizacao` datetime NOT NULL DEFAULT current_timestamp(),
  UNIQUE KEY `ativos_sa_data_IDX` (`data`,`canal_bot`,`id_log_nia_infra`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `base_ativos_sa_copy`
--

DROP TABLE IF EXISTS `base_ativos_sa_copy`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `base_ativos_sa_copy` (
  `data` date NOT NULL COMMENT 'Data do contrato com a Ativos SA',
  `canal_bot` varchar(50) NOT NULL DEFAULT '' COMMENT 'Canal do contrato com a Ativos SA',
  `id_log_nia_infra` bigint(20) NOT NULL DEFAULT 0 COMMENT 'Id do log_nia_intra de contratos com a Ativos SA',
  `valor` double NOT NULL DEFAULT 0 COMMENT 'Valor do contratos com a Ativos SA',
  `data_atualizacao` datetime NOT NULL DEFAULT current_timestamp(),
  UNIQUE KEY `ativos_sa_data_IDX` (`data`,`canal_bot`,`id_log_nia_infra`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `base_ativos_sa_temp`
--

DROP TABLE IF EXISTS `base_ativos_sa_temp`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `base_ativos_sa_temp` (
  `data` date NOT NULL COMMENT 'Data do contrato com a Ativos SA',
  `canal_bot` varchar(50) NOT NULL DEFAULT '' COMMENT 'Canal do contrato com a Ativos SA',
  `id_log_nia_infra` bigint(20) NOT NULL DEFAULT 0 COMMENT 'Id do log_nia_intra de contratos com a Ativos SA',
  `valor` double NOT NULL DEFAULT 0 COMMENT 'Valor do contratos com a Ativos SA',
  `data_atualizacao` datetime NOT NULL DEFAULT current_timestamp(),
  UNIQUE KEY `ativos_sa_data_IDX` (`data`,`canal_bot`,`id_log_nia_infra`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `base_avaliacoes`
--

DROP TABLE IF EXISTS `base_avaliacoes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `base_avaliacoes` (
  `data` date NOT NULL,
  `canal_bot` varchar(50) NOT NULL DEFAULT '',
  `qtd_avaliacoes` int(11) NOT NULL DEFAULT 0,
  `nota_media` decimal(12,2) NOT NULL DEFAULT 0.00,
  `data_atualizacao` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`data`,`canal_bot`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `base_avaliacoes_temp`
--

DROP TABLE IF EXISTS `base_avaliacoes_temp`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `base_avaliacoes_temp` (
  `data` date NOT NULL,
  `canal_bot` varchar(50) NOT NULL DEFAULT '',
  `qtd_avaliacoes` int(11) NOT NULL DEFAULT 0,
  `nota_media` decimal(12,2) NOT NULL DEFAULT 0.00,
  `data_atualizacao` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`data`,`canal_bot`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `base_engajamento_tema`
--

DROP TABLE IF EXISTS `base_engajamento_tema`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `base_engajamento_tema` (
  `data` date NOT NULL,
  `nm_tema` varchar(50) NOT NULL,
  `tx_in_usu_cmtd` varchar(1) NOT NULL,
  `qtd_conversas` int(11) DEFAULT NULL,
  `data_atualizacao` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`data`,`nm_tema`,`tx_in_usu_cmtd`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `base_engajamento_tema_temp`
--

DROP TABLE IF EXISTS `base_engajamento_tema_temp`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `base_engajamento_tema_temp` (
  `data` date NOT NULL,
  `nm_tema` varchar(50) NOT NULL,
  `tx_in_usu_cmtd` varchar(1) NOT NULL,
  `qtd_conversas` int(11) DEFAULT NULL,
  `data_atualizacao` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`data`,`nm_tema`,`tx_in_usu_cmtd`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `base_erros`
--

DROP TABLE IF EXISTS `base_erros`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `base_erros` (
  `data` date NOT NULL,
  `qtd_erro_trn` int(11) DEFAULT NULL,
  `qtd_erro_watson` int(11) DEFAULT NULL,
  `qtd_erro_alerta` int(11) DEFAULT NULL,
  `qtd_erro_cdc` int(11) DEFAULT NULL,
  `canal_bot` varchar(100) NOT NULL,
  `data_atualizacao` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`data`,`canal_bot`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `base_erros_temp`
--

DROP TABLE IF EXISTS `base_erros_temp`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `base_erros_temp` (
  `data` date NOT NULL,
  `qtd_erro_trn` int(11) DEFAULT NULL,
  `qtd_erro_watson` int(11) DEFAULT NULL,
  `qtd_erro_alerta` int(11) DEFAULT NULL,
  `qtd_erro_cdc` int(11) DEFAULT NULL,
  `canal_bot` varchar(50) NOT NULL,
  `data_atualizacao` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`data`,`canal_bot`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `base_mensal`
--

DROP TABLE IF EXISTS `base_mensal`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `base_mensal` (
  `periodo` varchar(6) NOT NULL DEFAULT '',
  `qtd_interacoes` int(11) DEFAULT NULL,
  `qtd_usuarios` int(11) DEFAULT NULL,
  `qtd_conversas` int(11) DEFAULT NULL,
  `qtd_transbordos` int(11) DEFAULT NULL,
  `qtd_usuarios_engajados` int(11) DEFAULT NULL,
  `canal_bot` varchar(50) NOT NULL,
  `data_atualizacao` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`periodo`,`canal_bot`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `base_mensal_bkp`
--

DROP TABLE IF EXISTS `base_mensal_bkp`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `base_mensal_bkp` (
  `periodo` varchar(6) NOT NULL DEFAULT '',
  `qtd_interacoes` int(11) DEFAULT NULL,
  `qtd_usuarios` int(11) DEFAULT NULL,
  `qtd_conversas` int(11) DEFAULT NULL,
  `qtd_transbordos` int(11) DEFAULT NULL,
  `canal_bot` varchar(50) NOT NULL,
  `data_atualizacao` datetime DEFAULT NULL,
  PRIMARY KEY (`periodo`,`canal_bot`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `base_mensal_temp`
--

DROP TABLE IF EXISTS `base_mensal_temp`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `base_mensal_temp` (
  `periodo` varchar(6) NOT NULL DEFAULT '',
  `qtd_interacoes` int(11) DEFAULT NULL,
  `qtd_usuarios` int(11) DEFAULT NULL,
  `qtd_conversas` int(11) DEFAULT NULL,
  `qtd_transbordos` int(11) DEFAULT NULL,
  `qtd_usuarios_engajados` int(11) DEFAULT NULL,
  `canal_bot` varchar(50) NOT NULL,
  `data_atualizacao` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`periodo`,`canal_bot`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `base_mensal_temp_bkp`
--

DROP TABLE IF EXISTS `base_mensal_temp_bkp`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `base_mensal_temp_bkp` (
  `periodo` varchar(6) NOT NULL DEFAULT '',
  `qtd_interacoes` int(11) DEFAULT NULL,
  `qtd_usuarios` int(11) DEFAULT NULL,
  `qtd_conversas` int(11) DEFAULT NULL,
  `qtd_transbordos` int(11) DEFAULT NULL,
  `canal_bot` varchar(50) NOT NULL,
  `data_atualizacao` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`periodo`,`canal_bot`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `base_optin`
--

DROP TABLE IF EXISTS `base_optin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `base_optin` (
  `data` date NOT NULL,
  `qtd_usuarios_optin` int(11) NOT NULL DEFAULT 0,
  `data_atualizacao` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='tabela com foto diária da qunatidade de clientes únicos(MCI) com opt-in até a data de atualização. Dadoa gerados na rotina SAS xxxx';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `base_resolucao_conversas`
--

DROP TABLE IF EXISTS `base_resolucao_conversas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `base_resolucao_conversas` (
  `data` date NOT NULL,
  `canal_bot` varchar(50) NOT NULL,
  `qtd_total_conversas` int(11) DEFAULT NULL,
  `qtd_conversas_engajadas` int(11) DEFAULT NULL,
  `qtd_conversas_finalizadas` int(11) DEFAULT NULL,
  `qtd_conversas_nao_finalizadas` int(11) DEFAULT NULL,
  `qtd_conversas_avaliadas` int(11) DEFAULT NULL,
  `qtd_conversas_transbordo` int(11) DEFAULT NULL,
  `data_atualizacao` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`data`,`canal_bot`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `base_resolucao_conversas_temp`
--

DROP TABLE IF EXISTS `base_resolucao_conversas_temp`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `base_resolucao_conversas_temp` (
  `data` date NOT NULL,
  `canal_bot` varchar(50) NOT NULL,
  `qtd_total_conversas` int(11) DEFAULT NULL,
  `qtd_conversas_engajadas` int(11) DEFAULT NULL,
  `qtd_conversas_finalizadas` int(11) DEFAULT NULL,
  `qtd_conversas_nao_finalizadas` int(11) DEFAULT NULL,
  `qtd_conversas_avaliadas` int(11) DEFAULT NULL,
  `qtd_conversas_transbordo` int(11) DEFAULT NULL,
  `data_atualizacao` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`data`,`canal_bot`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `base_usuarios`
--

DROP TABLE IF EXISTS `base_usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `base_usuarios` (
  `data` date NOT NULL,
  `canal_bot` varchar(50) NOT NULL DEFAULT '',
  `qtd_usu_ativo` int(11) NOT NULL DEFAULT 0 COMMENT 'Quatidade de usuários únicos que  interagiram com o bot nos últimos 90 dias',
  `qtd_usu_engajado` int(11) NOT NULL DEFAULT 0 COMMENT 'Usuário engajado é aquele que acessou alguma jornada do bot, chegando ao OP_ENCERRAMENTO_CONVERSA ou TIMEOUT_SLOT. São contabilizados os usuários únicos que atendem ao critério nos últimos 90 dias',
  `qtd_usu_engajado_dia` int(11) NOT NULL DEFAULT 0,
  `data_atualizacao` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`data`,`canal_bot`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `dados`
--

DROP TABLE IF EXISTS `dados`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `dados` (
  `data` date NOT NULL,
  `qtd_interacoes` int(20) DEFAULT NULL,
  `qtd_usuarios` int(20) DEFAULT NULL,
  `qtd_conversas` int(20) DEFAULT NULL,
  `qtd_transbordos` int(20) DEFAULT NULL,
  `canal_bot` varchar(50) NOT NULL,
  `data_atualizacao` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`data`,`canal_bot`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `dados_temp`
--

DROP TABLE IF EXISTS `dados_temp`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `dados_temp` (
  `data` date NOT NULL,
  `qtd_interacoes` int(11) DEFAULT NULL,
  `qtd_usuarios` int(11) DEFAULT NULL,
  `qtd_conversas` int(11) DEFAULT NULL,
  `qtd_transbordos` int(11) DEFAULT NULL,
  `canal_bot` varchar(50) NOT NULL,
  `data_atualizacao` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`data`,`canal_bot`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `destaques`
--

DROP TABLE IF EXISTS `destaques`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `destaques` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `matricula` varchar(8) NOT NULL,
  `texto` varchar(200) DEFAULT NULL,
  `squad` int(11) DEFAULT NULL,
  `url` varchar(1000) DEFAULT NULL,
  `data` date DEFAULT NULL,
  `timestampInsert` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=137 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `indisponibilidades`
--

DROP TABLE IF EXISTS `indisponibilidades`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `indisponibilidades` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `matricula` varchar(8) NOT NULL,
  `titulo` varchar(100) DEFAULT NULL,
  `texto` varchar(200) DEFAULT NULL,
  `dataInicio` date DEFAULT NULL,
  `dataFim` date DEFAULT NULL,
  `vigente` int(11) DEFAULT NULL,
  `falhaCad` int(11) DEFAULT NULL,
  `ferramentaTicket` varchar(15) DEFAULT NULL,
  `numeroTicket` varchar(100) DEFAULT NULL,
  `timestampInsert` datetime DEFAULT current_timestamp(),
  `timestampEncerramento` datetime DEFAULT NULL,
  `matriculaEncerramento` varchar(8) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=380 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `noticias`
--

DROP TABLE IF EXISTS `noticias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `noticias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `matricula` varchar(8) DEFAULT NULL,
  `texto` varchar(200) DEFAULT NULL,
  `url` varchar(1000) DEFAULT NULL,
  `data` date DEFAULT NULL,
  `timestampInsert` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=319 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tiposReport`
--

DROP TABLE IF EXISTS `tiposReport`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tiposReport` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `values` varchar(45) DEFAULT NULL,
  `descricao` varchar(45) DEFAULT NULL,
  `ativo` int(11) DEFAULT NULL,
  `ordem` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `usuarios_ativos_temp`
--

DROP TABLE IF EXISTS `usuarios_ativos_temp`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuarios_ativos_temp` (
  `data` date NOT NULL,
  `canal_bot` varchar(50) NOT NULL DEFAULT '',
  `qtd_usu_ativo` int(11) NOT NULL DEFAULT 0 COMMENT 'Quatidade de usuários únicos que  interagiram com o bot nos últimos 90 dias',
  `qtd_usu_engajado` int(11) NOT NULL DEFAULT 0 COMMENT 'Quatidade de usuários únicos que  interagiram com o bot pela primeira vez nos últimos 90 dias',
  `qtd_usu_engajado_dia` int(11) NOT NULL DEFAULT 0,
  `data_atualizacao` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`data`,`canal_bot`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Temporary table structure for view `vw_usuarios ativos`
--

DROP TABLE IF EXISTS `vw_usuarios ativos`;
/*!50001 DROP VIEW IF EXISTS `vw_usuarios ativos`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8mb4;
/*!50001 CREATE VIEW `vw_usuarios ativos` AS SELECT
 1 AS `DATA`,
  1 AS `qtd_usu_avivos` */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `vw_wa_negociacao_consolidado`
--

DROP TABLE IF EXISTS `vw_wa_negociacao_consolidado`;
/*!50001 DROP VIEW IF EXISTS `vw_wa_negociacao_consolidado`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8mb4;
/*!50001 CREATE VIEW `vw_wa_negociacao_consolidado` AS SELECT
 1 AS `DATA`,
  1 AS `TIPO`,
  1 AS `QTDE`,
  1 AS `VALOR`,
  1 AS `DATA_ATUALIZACAO` */;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `wa_negociacao`
--

DROP TABLE IF EXISTS `wa_negociacao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `wa_negociacao` (
  `DATA` date NOT NULL,
  `TIPO` varchar(25) NOT NULL,
  `QTDE` int(11) DEFAULT NULL,
  `VALOR` double DEFAULT NULL,
  `DATA_ATUALIZACAO` datetime DEFAULT NULL,
  PRIMARY KEY (`DATA`,`TIPO`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='pojeto com origem dos dados  no SAS:  /dados/uop/geade/gedec/interno/db2_rme/WA_Negociacao.sas';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `wa_negociacao_detalhe`
--

DROP TABLE IF EXISTS `wa_negociacao_detalhe`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `wa_negociacao_detalhe` (
  `DATA` date NOT NULL,
  `TIPO` varchar(25) NOT NULL,
  `DESCRICAO` varchar(50) NOT NULL,
  `QTDE` int(11) DEFAULT NULL,
  `VALOR` double DEFAULT NULL,
  `DATA_ATUALIZACAO` datetime DEFAULT NULL,
  PRIMARY KEY (`DATA`,`TIPO`,`DESCRICAO`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC COMMENT='pojeto com origem dos dados  no SAS:  /dados/uop/geade/gedec/interno/db2_rme/WA_Negociacao.sas';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `wa_negociacao_dia`
--

DROP TABLE IF EXISTS `wa_negociacao_dia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `wa_negociacao_dia` (
  `DATA` date NOT NULL,
  `TIPO` varchar(25) NOT NULL,
  `DESCRICAO` varchar(50) NOT NULL,
  `QTDE` int(11) DEFAULT NULL,
  `VALOR` double DEFAULT NULL,
  `DATA_ATUALIZACAO` datetime DEFAULT NULL,
  PRIMARY KEY (`DATA`,`TIPO`,`DESCRICAO`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC COMMENT='pojeto com origem dos dados  no SAS:  /dados/uop/geade/gedec/interno/db2_rme/WA_Negociacao.sas';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping routines for database 'report'
--
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
/*!50003 DROP PROCEDURE IF EXISTS `consultaGrandesNumerosPf` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
DELIMITER ;;
CREATE DEFINER=`albert`@`%` PROCEDURE `consultaGrandesNumerosPf`(dataFiltro varchar(20))
BEGIN

	DROP TEMPORARY TABLE IF EXISTS report.interacoesPf;
	DROP TEMPORARY TABLE IF EXISTS report.mediaInteracoesPf;
	DROP TEMPORARY TABLE IF EXISTS report.interacoesPfD7;
	DROP TEMPORARY TABLE IF EXISTS report.usuariosPf;
	DROP TEMPORARY TABLE IF EXISTS report.mediaUsuariosPf;
	DROP TEMPORARY TABLE IF EXISTS report.usuariosPfD7;
    DROP TEMPORARY TABLE IF EXISTS report.usuariosPf90D;
	DROP TEMPORARY TABLE IF EXISTS report.conversasPf;
	DROP TEMPORARY TABLE IF EXISTS report.mediaConversasPf;
	DROP TEMPORARY TABLE IF EXISTS report.conversasPfD7;
	DROP TEMPORARY TABLE IF EXISTS report.notaMediaPf;
	DROP TEMPORARY TABLE IF EXISTS report.notaMediaPf30d;
	DROP TEMPORARY TABLE IF EXISTS report.notaMediaPfD7;
    DROP TEMPORARY TABLE IF EXISTS report.totalRao;
    DROP TEMPORARY TABLE IF EXISTS report.totalAtivos;
    DROP TEMPORARY TABLE IF EXISTS report.totalCdc;
    DROP TEMPORARY TABLE IF EXISTS report.totalAtivosEnviados;
    DROP TEMPORARY TABLE IF EXISTS report.ativo1;
	DROP TEMPORARY TABLE IF EXISTS report.ativo2;
	DROP TEMPORARY TABLE IF EXISTS report.ativo3;
    DROP TEMPORARY TABLE IF EXISTS report.mediaAtivosEnviados;
    DROP TEMPORARY TABLE IF EXISTS report.ativosEnviadosD7;
    DROP TEMPORARY TABLE IF EXISTS report.tempIndisponibilidades;


	CREATE TEMPORARY TABLE report.interacoesPf AS
	SELECT dataFiltro as dataJoin, qtd_interacoes as interacoesPf FROM report.dados WHERE canal_bot = 'whatsapp pf' and data = dataFiltro;

	CREATE TEMPORARY TABLE report.mediaInteracoesPf AS
	SELECT dataFiltro as dataJoin, round(avg(qtd_interacoes)) as mediaInteracoesPf FROM report.dados WHERE canal_bot = 'whatsapp pf' and data between date_sub(dataFiltro, interval 30 day) and dataFiltro;

	CREATE TEMPORARY TABLE report.interacoesPfD7 AS
	SELECT dataFiltro as dataJoin, qtd_interacoes as interacoesPfD7 FROM report.dados WHERE canal_bot = 'whatsapp pf' and data = date_sub(dataFiltro, interval 7 day);

	CREATE TEMPORARY TABLE report.usuariosPf AS
	SELECT dataFiltro as dataJoin, qtd_usuarios as usuariosPf FROM report.dados WHERE canal_bot = 'whatsapp pf' and data = dataFiltro;

	CREATE TEMPORARY TABLE report.mediaUsuariosPf AS
	SELECT dataFiltro as dataJoin, round(avg(qtd_usuarios)) as mediaUsuariosPf FROM report.dados WHERE canal_bot = 'whatsapp pf' and data between date_sub(dataFiltro, interval 30 day) and dataFiltro;

	CREATE TEMPORARY TABLE report.usuariosPfD7 AS
	SELECT dataFiltro as dataJoin, qtd_usuarios as usuariosPfD7 FROM report.dados WHERE canal_bot = 'whatsapp pf' and data = date_sub(dataFiltro, interval 7 day);
	
    CREATE TEMPORARY TABLE report.usuariosPf90D AS	
	SELECT dataFiltro as dataJoin, qtd_usu_ativo as usuariosPf90D FROM report.base_usuarios WHERE canal_bot = 'whatsapp pf' and data = dataFiltro;
    
	CREATE TEMPORARY TABLE report.conversasPf AS
	SELECT dataFiltro as dataJoin, qtd_conversas as conversasPf FROM report.dados WHERE canal_bot = 'whatsapp pf' and data = dataFiltro;

	CREATE TEMPORARY TABLE report.mediaConversasPf AS
	SELECT dataFiltro as dataJoin, round(avg(qtd_conversas)) as mediaConversasPf FROM report.dados WHERE canal_bot = 'whatsapp pf' and data between date_sub(dataFiltro, interval 30 day) and dataFiltro;

	CREATE TEMPORARY TABLE report.conversasPfD7 AS
	SELECT dataFiltro as dataJoin, qtd_conversas as conversasPfD7 FROM report.dados WHERE canal_bot = 'whatsapp pf' and data = date_sub(dataFiltro, interval 7 day);

	CREATE TEMPORARY TABLE report.notaMediaPf AS
	SELECT dataFiltro as dataJoin, nota_media as notaMediaPf, qtd_avaliacoes AS qtdAvaliacoesPf FROM report.base_avaliacoes WHERE canal_bot = 'whatsapp pf' and data = dataFiltro;

	CREATE TEMPORARY TABLE report.notaMediaPf30d AS
	SELECT dataFiltro as dataJoin, round(avg(nota_media),2) as notaMediaPf30d, round(avg(qtd_avaliacoes)) as qtdMediaAvaliacoesPf30d FROM report.base_avaliacoes WHERE canal_bot = 'whatsapp pf' and data between date_sub(dataFiltro, interval 30 day) and dataFiltro;

	CREATE TEMPORARY TABLE report.notaMediaPfD7 AS
	SELECT dataFiltro as dataJoin, nota_media as notaMediaPfD7, qtd_avaliacoes as qtdMediaAvaliacoesPfD7 FROM report.base_avaliacoes WHERE canal_bot = 'whatsapp pf' and data = date_sub(dataFiltro, interval 7 day);
	
    CREATE TEMPORARY TABLE report.totalRao AS
    /* QUERY ALTERADA POIS DESDE 01/01/2025 OS ACORDOS RAO VÊM COM INFORMAÇÃO DE RENEG NA TABELA */
    /* SELECT dataFiltro as dataJoin, qtde as qtdRao, valor as totalRao FROM report.vw_wa_negociacao_consolidado WHERE data = dataFiltro AND tipo = 'RAO'; */
    SELECT dataFiltro as dataJoin, qtde as qtdRao, /*ROUND(valor, 0) as totalRao*/ valor as totalRao FROM report.vw_wa_negociacao_consolidado WHERE data = dataFiltro AND tipo IN ('RAO','RENEG');
	
    CREATE TEMPORARY TABLE report.totalAtivos AS
    /*SELECT dataFiltro as dataJoin, qtde as qtdAtivos, ROUND(valor, 0) as totalAtivos FROM report.vw_wa_negociacao_consolidado WHERE data = dataFiltro AND tipo = 'ATIVOS SA';*/
    SELECT 
		dataFiltro as dataJoin, 
		ifnull((SELECT qtde FROM report.vw_wa_negociacao_consolidado WHERE data = dataFiltro AND tipo = 'ATIVOS SA'), '0') as qtdAtivos, 
		/*ifnull((SELECT ROUND(valor, 0) FROM report.vw_wa_negociacao_consolidado WHERE data = dataFiltro AND tipo = 'ATIVOS SA'), '0') as totalAtivos;*/
        ifnull((SELECT valor FROM report.vw_wa_negociacao_consolidado WHERE data = dataFiltro AND tipo = 'ATIVOS SA'), '0') as totalAtivos;
	
    CREATE TEMPORARY TABLE report.totalCdc AS
    SELECT dataFiltro as dataJoin, qtde as qtdCdc, /*ROUND(valor, 0) as totalCdc*/ valor as totalCdc FROM report.vw_wa_negociacao_consolidado WHERE data <= dataFiltro AND tipo = 'CDC' ORDER BY data DESC LIMIT 1;
    
    CREATE TEMPORARY TABLE report.totalAtivosEnviados AS
    SELECT dataFiltro as dataJoin, qtd_ativos_enviados as totalAtivosEnviados FROM report.base_ativos_qtd_enviados WHERE data = dataFiltro;
    
    CREATE TEMPORARY TABLE report.ativo1 AS
	SELECT dataFiltro as dataJoin, qtd_enviada as qtdEnviada1, nm_ativo as nomeAtivo1, ordem FROM report.base_ativos_lista_enviados WHERE data = dataFiltro and ordem = 1;

	CREATE TEMPORARY TABLE report.ativo2 AS
	SELECT dataFiltro as dataJoin, qtd_enviada as qtdEnviada2, nm_ativo as nomeAtivo2, ordem FROM report.base_ativos_lista_enviados WHERE data = dataFiltro and ordem = 2;

	CREATE TEMPORARY TABLE report.ativo3 AS
	SELECT dataFiltro as dataJoin, qtd_enviada as qtdEnviada3, nm_ativo as nomeAtivo3, ordem FROM report.base_ativos_lista_enviados WHERE data = dataFiltro and ordem = 3;
    
	CREATE TEMPORARY TABLE report.mediaAtivosEnviados AS
    SELECT dataFiltro as dataJoin, round(avg(qtd_ativos_enviados)) as mediaAtivosEnviados FROM report.base_ativos_qtd_enviados WHERE data between date_sub(dataFiltro, interval 30 day) and dataFiltro;

	CREATE TEMPORARY TABLE report.ativosEnviadosD7 AS
    #SELECT dataFiltro as dataJoin, qtd_ativos_enviados as ativosEnviadosD7 FROM report.base_ativos_qtd_enviados WHERE data = date_sub(dataFiltro, interval 7 day);
    SELECT dataFiltro as dataJoin, qtd_ativos_enviados as ativosEnviadosD7 FROM report.base_ativos_qtd_enviados
	WHERE data = IF(
		(SELECT (date_sub(dataFiltro, interval 7 day)) FROM report.base_ativos_qtd_enviados WHERE data = dataFiltro) < '2024-01-01' ,
		date_sub(dataFiltro, interval datediff(dataFiltro, '2024-01-01') day),
		(date_sub(dataFiltro, interval 7 day))
	);
    
    CREATE TEMPORARY TABLE report.tempIndisponibilidades AS
    SELECT * FROM (
		SELECT 
				dataFiltro as dataJoin,
				'-' as textoIndisp,
				0 as totalIndisp,
				#(SELECT datediff(dataFiltro, (SELECT max(dataFim) FROM report.indisponibilidades WHERE falhaCad = 1 AND dataFim < dataFiltro))) as maxDataFim,
                #IFNULL(datediff(dataFiltro, (SELECT max(dataFim) FROM report.indisponibilidades WHERE falhaCad = 1 AND dataFim < dataFiltro)), (datediff(dataFiltro, '2024-01-01'))) as maxDataFim,
                IFNULL(datediff(dataFiltro, (SELECT max(dataFim) FROM report.indisponibilidades WHERE falhaCad = 1 AND dataFim <= dataFiltro)), (datediff(dataFiltro, '2024-01-01'))) as maxDataFim,
                0 as indispVigente
			FROM report.indisponibilidades
            
            
            UNION ALL
            
            SELECT 	
				dataFiltro as dataJoin,
				IFNULL(group_concat('-',titulo separator '<br>'),'N/A') as textoIndisp,
				count(distinct(id)) as totalIndisp, 
				0 as maxDataFim,
				1 as indispVigente
			FROM report.indisponibilidades
			WHERE falhaCad = 1 AND (vigente = 1 
				OR (dataInicio <= dataFiltro AND dataFim = dataFiltro))
	) temp
	WHERE indispVigente = IF(
		(SELECT 
			count(distinct(id)) 
		FROM report.indisponibilidades
		WHERE falhaCad = 1 AND (vigente = 1
			OR (dataInicio <= dataFiltro AND dataFim = dataFiltro))>0),1,0) LIMIT 1;
    
    SELECT 	a.dataJoin,
		date_format(a.dataJoin, '%d/%m/%Y') as dataFormatada,
		interacoesPf,
		mediaInteracoesPf,
		interacoesPfD7,
		usuariosPf,
		mediaUsuariosPf,
		usuariosPfD7,
        usuariosPf90D,
		conversasPf,
		mediaConversasPf,
		conversasPfD7,
		notaMediaPf,
		notaMediaPf30d,
		notaMediaPfD7,
        qtdAvaliacoesPf,
        qtdMediaAvaliacoesPf30d,
        qtdMediaAvaliacoesPfD7,
        totalRao,
        qtdRao,
        totalAtivos,
        qtdAtivos,
        totalCdc,
        qtdCdc,
        totalAtivosEnviados,
        qtdEnviada1,
        nomeAtivo1,
        qtdEnviada2,
        nomeAtivo2,
        qtdEnviada3,
        nomeAtivo3,
        mediaAtivosEnviados,
        ativosEnviadosD7,
        textoIndisp,
        totalIndisp,
        maxDataFim,
        indispVigente
	FROM report.interacoesPf a
	JOIN report.mediaInteracoesPf b ON a.dataJoin = b.dataJoin
	JOIN report.interacoesPfD7 c ON a.dataJoin = c.dataJoin
	JOIN report.usuariosPf d ON a.dataJoin = d.dataJoin
	JOIN report.mediaUsuariosPf e ON a.dataJoin = e.dataJoin
	JOIN report.usuariosPfD7 f ON a.dataJoin = f.dataJoin
	JOIN report.conversasPf g ON a.dataJoin = g.dataJoin
	JOIN report.mediaConversasPf h ON a.dataJoin = h.dataJoin
	JOIN report.conversasPfD7 i ON a.dataJoin = i.dataJoin
	JOIN report.notaMediaPf j ON a.dataJoin = j.dataJoin
	JOIN report.notaMediaPf30d k ON a.dataJoin = k.dataJoin
	JOIN report.notaMediaPfD7 l ON a.dataJoin = l.dataJoin
    JOIN report.usuariosPf90D m ON a.dataJoin = m.dataJoin
    JOIN report.totalRao n ON a.dataJoin = n.dataJoin
    JOIN report.totalAtivos o ON a.dataJoin = o.dataJoin
    JOIN report.totalCdc p ON a.dataJoin = p.dataJoin
    JOIN report.totalAtivosEnviados q ON a.dataJoin = q.dataJoin
    JOIN report.tempIndisponibilidades r ON a.dataJoin = r.dataJoin
    JOIN report.ativo1 s ON a.dataJoin = s.dataJoin
    JOIN report.ativo2 t ON a.dataJoin = t.dataJoin
    JOIN report.ativo3 u ON a.dataJoin = u.dataJoin
    JOIN report.mediaAtivosEnviados v ON a.dataJoin = v.dataJoin
    JOIN report.ativosEnviadosD7 w ON a.dataJoin = w.dataJoin LIMIT 1;

	DROP TEMPORARY TABLE IF EXISTS report.interacoesPf;
	DROP TEMPORARY TABLE IF EXISTS report.mediaInteracoesPf;
	DROP TEMPORARY TABLE IF EXISTS report.interacoesPfD7;
	DROP TEMPORARY TABLE IF EXISTS report.usuariosPf;
	DROP TEMPORARY TABLE IF EXISTS report.mediaUsuariosPf;
	DROP TEMPORARY TABLE IF EXISTS report.usuariosPfD7;
    DROP TEMPORARY TABLE IF EXISTS report.usuariosPf90D;
	DROP TEMPORARY TABLE IF EXISTS report.conversasPf;
	DROP TEMPORARY TABLE IF EXISTS report.mediaConversasPf;
	DROP TEMPORARY TABLE IF EXISTS report.conversasPfD7;
	DROP TEMPORARY TABLE IF EXISTS report.notaMediaPf;
	DROP TEMPORARY TABLE IF EXISTS report.notaMediaPf30d;
	DROP TEMPORARY TABLE IF EXISTS report.notaMediaPfD7;
    DROP TEMPORARY TABLE IF EXISTS report.totalRao;
    DROP TEMPORARY TABLE IF EXISTS report.totalAtivos;
    DROP TEMPORARY TABLE IF EXISTS report.totalCdc;
    DROP TEMPORARY TABLE IF EXISTS report.totalAtivosEnviados;
    DROP TEMPORARY TABLE IF EXISTS report.ativo1;
	DROP TEMPORARY TABLE IF EXISTS report.ativo2;
	DROP TEMPORARY TABLE IF EXISTS report.ativo3;
    DROP TEMPORARY TABLE IF EXISTS report.mediaAtivosEnviados;
    DROP TEMPORARY TABLE IF EXISTS report.ativosEnviadosD7;
    DROP TEMPORARY TABLE IF EXISTS report.tempIndisponibilidades;
        
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
/*!50003 DROP PROCEDURE IF EXISTS `consultaGrandesNumerosPj` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
DELIMITER ;;
CREATE DEFINER=`albert`@`%` PROCEDURE `consultaGrandesNumerosPj`(dataFiltro varchar(20))
BEGIN

	DROP TEMPORARY TABLE IF EXISTS report.interacoesPj;
	DROP TEMPORARY TABLE IF EXISTS report.mediaInteracoesPj;
	DROP TEMPORARY TABLE IF EXISTS report.interacoesPjD7;
	DROP TEMPORARY TABLE IF EXISTS report.usuariosPj;
	DROP TEMPORARY TABLE IF EXISTS report.mediaUsuariosPj;
	DROP TEMPORARY TABLE IF EXISTS report.usuariosPjD7;
    DROP TEMPORARY TABLE IF EXISTS report.usuariosPj90D;
	DROP TEMPORARY TABLE IF EXISTS report.conversasPj;
	DROP TEMPORARY TABLE IF EXISTS report.mediaConversasPj;
	DROP TEMPORARY TABLE IF EXISTS report.conversasPjD7;
	DROP TEMPORARY TABLE IF EXISTS report.notaMediaPj;
	DROP TEMPORARY TABLE IF EXISTS report.notaMediaPj30d;
	DROP TEMPORARY TABLE IF EXISTS report.notaMediaPjD7;

	CREATE TEMPORARY TABLE report.interacoesPj AS
	SELECT dataFiltro as dataJoin, qtd_interacoes as interacoesPj FROM report.dados WHERE canal_bot = 'whatsapp pj' and data = dataFiltro;

	CREATE TEMPORARY TABLE report.mediaInteracoesPj AS
	SELECT dataFiltro as dataJoin, round(avg(qtd_interacoes)) as mediaInteracoesPj FROM report.dados WHERE canal_bot = 'whatsapp pj' and data between date_sub(dataFiltro, interval 30 day) and dataFiltro;

	CREATE TEMPORARY TABLE report.interacoesPjD7 AS
	SELECT dataFiltro as dataJoin, qtd_interacoes as interacoesPjD7 FROM report.dados WHERE canal_bot = 'whatsapp pj' and data = date_sub(dataFiltro, interval 7 day);

	CREATE TEMPORARY TABLE report.usuariosPj AS
	SELECT dataFiltro as dataJoin, qtd_usuarios as usuariosPj FROM report.dados WHERE canal_bot = 'whatsapp pj' and data = dataFiltro;

	CREATE TEMPORARY TABLE report.mediaUsuariosPj AS
	SELECT dataFiltro as dataJoin, round(avg(qtd_usuarios)) as mediaUsuariosPj FROM report.dados WHERE canal_bot = 'whatsapp pj' and data between date_sub(dataFiltro, interval 30 day) and dataFiltro;

	CREATE TEMPORARY TABLE report.usuariosPjD7 AS
	SELECT dataFiltro as dataJoin, qtd_usuarios as usuariosPjD7 FROM report.dados WHERE canal_bot = 'whatsapp pj' and data = date_sub(dataFiltro, interval 7 day);
	
    CREATE TEMPORARY TABLE report.usuariosPj90D AS	
	SELECT dataFiltro as dataJoin, qtd_usu_ativo as usuariosPj90D FROM report.base_usuarios WHERE canal_bot = 'whatsapp pj' and data = dataFiltro;
    
	CREATE TEMPORARY TABLE report.conversasPj AS
	SELECT dataFiltro as dataJoin, qtd_conversas as conversasPj FROM report.dados WHERE canal_bot = 'whatsapp pj' and data = dataFiltro;

	CREATE TEMPORARY TABLE report.mediaConversasPj AS
	SELECT dataFiltro as dataJoin, round(avg(qtd_conversas)) as mediaConversasPj FROM report.dados WHERE canal_bot = 'whatsapp pj' and data between date_sub(dataFiltro, interval 30 day) and dataFiltro;

	CREATE TEMPORARY TABLE report.conversasPjD7 AS
	SELECT dataFiltro as dataJoin, qtd_conversas as conversasPjD7 FROM report.dados WHERE canal_bot = 'whatsapp pj' and data = date_sub(dataFiltro, interval 7 day);

	CREATE TEMPORARY TABLE report.notaMediaPj AS
	/*SELECT dataFiltro as dataJoin, nota_media as notaMediaPj, qtd_avaliacoes AS qtdAvaliacoesPj FROM report.base_avaliacoes WHERE canal_bot = 'whatsapp pj' and data = dataFiltro;*/
    SELECT 
		dataFiltro as dataJoin, 
		ifnull((SELECT nota_media FROM report.base_avaliacoes WHERE canal_bot = 'whatsapp pj' and data = dataFiltro),'0') as notaMediaPj,
		ifnull((SELECT qtd_avaliacoes FROM report.base_avaliacoes WHERE canal_bot = 'whatsapp pj' and data = dataFiltro),'0') as qtdAvaliacoesPj;

	CREATE TEMPORARY TABLE report.notaMediaPj30d AS
	SELECT dataFiltro as dataJoin, round(avg(nota_media),2) as notaMediaPj30d, round(avg(qtd_avaliacoes)) as qtdMediaAvaliacoesPj30d FROM report.base_avaliacoes WHERE canal_bot = 'whatsapp pj' and data between date_sub(dataFiltro, interval 30 day) and dataFiltro;

	CREATE TEMPORARY TABLE report.notaMediaPjD7 AS
	/*SELECT dataFiltro as dataJoin, nota_media as notaMediaPjD7, qtd_avaliacoes as qtdMediaAvaliacoesPjD7 FROM report.base_avaliacoes WHERE canal_bot = 'whatsapp pj' and data = date_sub(dataFiltro, interval 7 day);*/
    SELECT 
		dataFiltro as dataJoin,
        ifnull((SELECT nota_media FROM report.base_avaliacoes WHERE canal_bot = 'whatsapp pj' and data = date_sub(dataFiltro, interval 7 day)),'0') as notaMediaPjD7, 
        ifnull((SELECT qtd_avaliacoes FROM report.base_avaliacoes WHERE canal_bot = 'whatsapp pj' and data = date_sub(dataFiltro, interval 7 day)), '0') as qtdMediaAvaliacoesPjD7;
	
	SELECT 	a.dataJoin,
		interacoesPj,
		mediaInteracoesPj,
		interacoesPjD7,
		usuariosPj,
		mediaUsuariosPj,
		usuariosPjD7,
        usuariosPj90D,
		conversasPj,
		mediaConversasPj,
		conversasPjD7,
		notaMediaPj,
		notaMediaPj30d,
		notaMediaPjD7,
        qtdAvaliacoesPj,
        qtdMediaAvaliacoesPj30d,
        qtdMediaAvaliacoesPjD7
	FROM report.interacoesPj a
	JOIN report.mediaInteracoesPj b ON a.dataJoin = b.dataJoin
	JOIN report.interacoesPjD7 c ON a.dataJoin = c.dataJoin
	JOIN report.usuariosPj d ON a.dataJoin = d.dataJoin
	JOIN report.mediaUsuariosPj e ON a.dataJoin = e.dataJoin
	JOIN report.usuariosPjD7 f ON a.dataJoin = f.dataJoin
	JOIN report.conversasPj g ON a.dataJoin = g.dataJoin
	JOIN report.mediaConversasPj h ON a.dataJoin = h.dataJoin
	JOIN report.conversasPjD7 i ON a.dataJoin = i.dataJoin
	JOIN report.notaMediaPj j ON a.dataJoin = j.dataJoin
	JOIN report.notaMediaPj30d k ON a.dataJoin = k.dataJoin
	JOIN report.notaMediaPjD7 l ON a.dataJoin = l.dataJoin
    JOIN report.usuariosPj90D m ON a.dataJoin = m.dataJoin;

	DROP TEMPORARY TABLE IF EXISTS report.interacoesPj;
	DROP TEMPORARY TABLE IF EXISTS report.mediaInteracoesPj;
	DROP TEMPORARY TABLE IF EXISTS report.interacoesPjD7;
	DROP TEMPORARY TABLE IF EXISTS report.usuariosPj;
	DROP TEMPORARY TABLE IF EXISTS report.mediaUsuariosPj;
	DROP TEMPORARY TABLE IF EXISTS report.usuariosPjD7;
    DROP TEMPORARY TABLE IF EXISTS report.usuariosPj90D;
	DROP TEMPORARY TABLE IF EXISTS report.conversasPj;
	DROP TEMPORARY TABLE IF EXISTS report.mediaConversasPj;
	DROP TEMPORARY TABLE IF EXISTS report.conversasPjD7;
	DROP TEMPORARY TABLE IF EXISTS report.notaMediaPj;
	DROP TEMPORARY TABLE IF EXISTS report.notaMediaPj30d;
	DROP TEMPORARY TABLE IF EXISTS report.notaMediaPjD7;
        
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
/*!50003 DROP PROCEDURE IF EXISTS `consultaNumerosAcumulados` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
DELIMITER ;;
CREATE DEFINER=`albert`@`%` PROCEDURE `consultaNumerosAcumulados`(dataFiltro varchar(20))
BEGIN
	DROP TEMPORARY TABLE IF EXISTS report.totalUsuariosOptin;
    DROP TEMPORARY TABLE IF EXISTS report.totalRao;
    DROP TEMPORARY TABLE IF EXISTS report.totalCdc;
    DROP TEMPORARY TABLE IF EXISTS report.totalTesouro;
    DROP TEMPORARY TABLE IF EXISTS report.totalAgro;
	
    CREATE TEMPORARY TABLE report.totalUsuariosOptin AS
    SELECT datafiltro as dataJoin, qtd_usuarios_optin as totalUsuariosOptin FROM report.base_optin WHERE data = dataFiltro;
	
    CREATE TEMPORARY TABLE report.totalRao AS
    SELECT datafiltro as dataJoin, ROUND(SUM(valor),2) as totalRao FROM report.vw_wa_negociacao_consolidado WHERE data between (SELECT CONCAT(DATE_FORMAT(CURDATE(), '%Y'), '-01-01')) AND datafiltro AND tipo = 'RAO' GROUP BY tipo;
    
    CREATE TEMPORARY TABLE report.totalCdc AS
	SELECT datafiltro as dataJoin, ROUND(SUM(valor),2) as totalCdc FROM report.vw_wa_negociacao_consolidado WHERE data between (SELECT CONCAT(DATE_FORMAT(CURDATE(), '%Y'), '-01-01')) AND datafiltro AND tipo = 'CDC' GROUP BY tipo;
    
    CREATE TEMPORARY TABLE report.totalTesouro AS
	SELECT datafiltro as dataJoin, ROUND(SUM(valor),2) as totalTesouro FROM report.vw_wa_negociacao_consolidado WHERE data between (SELECT CONCAT(DATE_FORMAT(CURDATE(), '%Y'), '-01-01')) AND datafiltro AND tipo = 'TDR' GROUP BY tipo;
    
	CREATE TEMPORARY TABLE report.totalAgro AS
	SELECT datafiltro as dataJoin, ROUND(SUM(valor),2) as totalAgro FROM report.vw_wa_negociacao_consolidado WHERE data between (SELECT CONCAT(DATE_FORMAT(CURDATE(), '%Y'), '-01-01')) AND datafiltro AND tipo = 'AGRO' GROUP BY tipo;
   
	SELECT
		totalUsuariosOptin,
        totalRao,
        totalCdc,
        totalTesouro,
        totalAgro
	FROM report.totalUsuariosOptin a
    JOIN report.totalRao b ON a.dataJoin = b.dataJoin
    JOIN report.totalCdc c ON a.dataJoin = c.dataJoin
    JOIN report.totalTesouro d ON a.dataJoin = d.dataJoin
    JOIN report.totalAgro e ON a.dataJoin = e.dataJoin;

	DROP TEMPORARY TABLE IF EXISTS report.totalUsuariosOptin;
    DROP TEMPORARY TABLE IF EXISTS report.totalRao;
    DROP TEMPORARY TABLE IF EXISTS report.totalCdc;
    DROP TEMPORARY TABLE IF EXISTS report.totalTesouro;
    DROP TEMPORARY TABLE IF EXISTS report.totalAgro;
    
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_atualiza_base_ativos_lista_enviados` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
DELIMITER ;;
CREATE DEFINER=`flavia`@`%` PROCEDURE `sp_atualiza_base_ativos_lista_enviados`()
BEGIN

insert into base_ativos_lista_enviados 
 select * from base_ativos_lista_enviados_temp as b 
ON DUPLICATE KEY UPDATE  
	nm_ativo = b.nm_ativo,
	qtd_enviada = b.qtd_enviada,
   data_atualizacao = b.data_atualizacao;
 
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_atualiza_base_ativos_qtd_enviados` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
DELIMITER ;;
CREATE DEFINER=`flavia`@`%` PROCEDURE `sp_atualiza_base_ativos_qtd_enviados`()
BEGIN

insert into base_ativos_qtd_enviados 
 select * from base_ativos_qtd_enviados_temp as b 
ON DUPLICATE KEY UPDATE  
	qtd_ativos_enviados = b.qtd_ativos_enviados,
   data_atualizacao = b.data_atualizacao;
 


END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_atualiza_base_ativos_sa` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
DELIMITER ;;
CREATE DEFINER=`flavia`@`%` PROCEDURE `sp_atualiza_base_ativos_sa`()
BEGIN
insert into base_ativos_sa 
 select * from base_ativos_sa_temp as b 
ON DUPLICATE KEY UPDATE  
	valor = b.valor,
   data_atualizacao = b.data_atualizacao;
 
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_atualiza_base_avaliacoes` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
DELIMITER ;;
CREATE DEFINER=`flavia`@`%` PROCEDURE `sp_atualiza_base_avaliacoes`()
BEGIN
insert into base_avaliacoes 
 select * from base_avaliacoes_temp as b 
ON DUPLICATE KEY UPDATE  
	qtd_avaliacoes = b.qtd_avaliacoes,
    nota_media = b.nota_media,
    data_atualizacao = b.data_atualizacao;
 

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_atualiza_base_engajamento_tema` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
DELIMITER ;;
CREATE DEFINER=`flavia`@`%` PROCEDURE `sp_atualiza_base_engajamento_tema`()
BEGIN
insert into report.base_engajamento_tema
 select * from report.base_engajamento_tema_temp as b 
ON DUPLICATE KEY UPDATE  
	 qtd_conversas = b.qtd_conversas,
    data_atualizacao = NOW();

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_atualiza_base_erros` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
DELIMITER ;;
CREATE DEFINER=`flavia`@`%` PROCEDURE `sp_atualiza_base_erros`()
BEGIN
insert into base_erros 
 select * from base_erros_temp as b 
ON DUPLICATE KEY UPDATE  
	qtd_erro_trn = b.qtd_erro_trn,
	qtd_erro_watson = b.qtd_erro_watson,
	qtd_erro_alerta = b.qtd_erro_alerta,
	qtd_erro_cdc = b.qtd_erro_cdc,
   data_atualizacao = b.data_atualizacao;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_atualiza_base_mensal` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
DELIMITER ;;
CREATE DEFINER=`flavia`@`%` PROCEDURE `sp_atualiza_base_mensal`()
BEGIN
insert into base_mensal 
 select * from base_mensal_temp as b 
ON DUPLICATE KEY UPDATE  
	qtd_interacoes = b.qtd_interacoes,
    qtd_usuarios = b.qtd_usuarios,
    qtd_conversas = b.qtd_conversas,
    qtd_transbordos = b.qtd_transbordos,
    qtd_usuarios_engajados = b.qtd_usuarios_engajados,
    data_atualizacao = b.data_atualizacao;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_atualiza_base_resolucao_conversas` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
DELIMITER ;;
CREATE DEFINER=`flavia`@`%` PROCEDURE `sp_atualiza_base_resolucao_conversas`()
BEGIN
insert into base_resolucao_conversas
 select * from base_resolucao_conversas_temp as b 
ON DUPLICATE KEY UPDATE  
	qtd_total_conversas = b.qtd_total_conversas,
    qtd_conversas_engajadas = b.qtd_conversas_engajadas,
    qtd_conversas_finalizadas = b.qtd_conversas_finalizadas,
    qtd_conversas_nao_finalizadas = b.qtd_conversas_nao_finalizadas, 
    qtd_conversas_avaliadas = b.qtd_conversas_avaliadas,
    qtd_conversas_transbordo = b.qtd_conversas_transbordo,
    data_atualizacao = b.data_atualizacao;
 
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_atualiza_base_usuarios` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
DELIMITER ;;
CREATE DEFINER=`flavia`@`%` PROCEDURE `sp_atualiza_base_usuarios`()
BEGIN

insert into base_usuarios
 select * from usuarios_ativos_temp as b 
ON DUPLICATE KEY UPDATE  
	 qtd_usu_ativo = b.qtd_usu_ativo,
    qtd_usu_engajado = b.qtd_usu_engajado,
    qtd_usu_engajado_dia = b.qtd_usu_engajado_dia,
 	 data_atualizacao = b.data_atualizacao;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_atualiza_base_usuarios_bkp` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
DELIMITER ;;
CREATE DEFINER=`flavia`@`%` PROCEDURE `sp_atualiza_base_usuarios_bkp`()
BEGIN

insert into base_usuarios 
 select * from usuarios_ativos_temp as b 
ON DUPLICATE KEY UPDATE  
	qtd_usu_ativo = b.qtd_usu_ativo,
    qtd_usu_novo = b.qtd_usu_novo,
    data_atualizacao = b.data_atualizacao;
 

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_atualiza_base_usuarios_copy` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
DELIMITER ;;
CREATE DEFINER=`flavia`@`%` PROCEDURE `sp_atualiza_base_usuarios_copy`()
BEGIN


insert into base_usuarios_copy 
 select * from usuarios_ativos_temp_copy as b 
ON DUPLICATE KEY UPDATE  
	 qtd_usu_ativo = b.qtd_usu_ativo,
    qtd_usu_engajado = b.qtd_usu_engajado,
    qtd_usu_engajado_dia = b.qtd_usu_engajado_dia,
 	 data_atualizacao = b.data_atualizacao;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_atualiza_dados_report` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
DELIMITER ;;
CREATE DEFINER=`flavia`@`%` PROCEDURE `sp_atualiza_dados_report`()
BEGIN
insert into dados 
 select * from dados_temp as b 
ON DUPLICATE KEY UPDATE  
	qtd_interacoes = b.qtd_interacoes,
    qtd_usuarios = b.qtd_usuarios,
    qtd_conversas = b.qtd_conversas,
    qtd_transbordos = b.qtd_transbordos,
    data_atualizacao = b.data_atualizacao;
 
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Current Database: `report`
--

USE `report`;

--
-- Final view structure for view `vw_usuarios ativos`
--

/*!50001 DROP VIEW IF EXISTS `vw_usuarios ativos`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`flavia`@`%` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_usuarios ativos` AS select `base_usuarios`.`data` AS `DATA`,sum(`base_usuarios`.`qtd_usu_ativo`) AS `qtd_usu_avivos` from `base_usuarios` group by `base_usuarios`.`data` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vw_wa_negociacao_consolidado`
--

/*!50001 DROP VIEW IF EXISTS `vw_wa_negociacao_consolidado`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`flavia`@`%` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_wa_negociacao_consolidado` AS select `wa_negociacao`.`DATA` AS `DATA`,`wa_negociacao`.`TIPO` AS `TIPO`,`wa_negociacao`.`QTDE` AS `QTDE`,`wa_negociacao`.`VALOR` AS `VALOR`,`wa_negociacao`.`DATA_ATUALIZACAO` AS `DATA_ATUALIZACAO` from `wa_negociacao` union select `base_ativos_sa`.`data` AS `DATA`,'ATIVOS SA' AS `TIPO`,count(if(`base_ativos_sa`.`valor` > 0,`base_ativos_sa`.`valor`,NULL)) AS `QTDE`,sum(`base_ativos_sa`.`valor`) AS `VALOR`,`base_ativos_sa`.`data_atualizacao` AS `data_atualizacao` from `base_ativos_sa` group by `base_ativos_sa`.`data` union select '2024-01-01' AS `DATA`,'CDC' AS `TIPO`,0 AS `QTDE`,0 AS `VALOR`,'2024-06-21 14:58:15' AS `DATA_ATUALIZACAO` union select '2024-01-01' AS `DATA`,'RAO' AS `TIPO`,0 AS `QTDE`,0 AS `VALOR`,'2024-06-21 14:58:15' AS `DATA_ATUALIZACAO` union select '2024-01-02' AS `DATA`,'RAO' AS `TIPO`,0 AS `QTDE`,0 AS `VALOR`,'2024-06-21 14:58:15' AS `DATA_ATUALIZACAO` order by `DATA`,`TIPO` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-08-20  0:15:36
