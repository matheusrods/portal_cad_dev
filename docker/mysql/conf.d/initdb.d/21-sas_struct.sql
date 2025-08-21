/*M!999999\- enable the sandbox mode */ 
-- MariaDB dump 10.19  Distrib 10.11.11-MariaDB, for Linux (x86_64)
--
-- Host: 127.0.0.1    Database: sas
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
-- Current Database: `sas`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `sas` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;

USE `sas`;

--
-- Table structure for table `at_ura_retorno_consolid_inv_atu`
--

DROP TABLE IF EXISTS `at_ura_retorno_consolid_inv_atu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `at_ura_retorno_consolid_inv_atu` (
  `data` date NOT NULL,
  `qtd_registros` int(11) DEFAULT NULL,
  `data_atualizacao` datetime NOT NULL,
  PRIMARY KEY (`data`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `at_ura_retorno_consolid_outros_atu`
--

DROP TABLE IF EXISTS `at_ura_retorno_consolid_outros_atu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `at_ura_retorno_consolid_outros_atu` (
  `data` date NOT NULL,
  `qtd_registros` int(11) DEFAULT NULL,
  `data_atualizacao` datetime NOT NULL,
  PRIMARY KEY (`data`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `at_ura_retorno_distrib_inv_atu`
--

DROP TABLE IF EXISTS `at_ura_retorno_distrib_inv_atu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `at_ura_retorno_distrib_inv_atu` (
  `data` date NOT NULL,
  `qtd_registros` int(11) DEFAULT NULL,
  `data_atualizacao` datetime NOT NULL,
  PRIMARY KEY (`data`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `at_ura_retorno_distrib_outros_atu`
--

DROP TABLE IF EXISTS `at_ura_retorno_distrib_outros_atu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `at_ura_retorno_distrib_outros_atu` (
  `data` date NOT NULL,
  `qtd_registros` int(11) DEFAULT NULL,
  `data_atualizacao` datetime NOT NULL,
  PRIMARY KEY (`data`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `atip_assunto_base_analisada_atu`
--

DROP TABLE IF EXISTS `atip_assunto_base_analisada_atu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `atip_assunto_base_analisada_atu` (
  `data` date NOT NULL,
  `qtd_registros` int(11) DEFAULT NULL,
  `data_atualizacao` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`data`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `atip_assunto_base_historica_atu`
--

DROP TABLE IF EXISTS `atip_assunto_base_historica_atu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `atip_assunto_base_historica_atu` (
  `data` date NOT NULL,
  `qtd_registros` int(11) DEFAULT NULL,
  `data_atualizacao` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`data`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `atip_assunto_fato_atu`
--

DROP TABLE IF EXISTS `atip_assunto_fato_atu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `atip_assunto_fato_atu` (
  `data` date NOT NULL,
  `qtd_registros` int(11) DEFAULT NULL,
  `data_atualizacao` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`data`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `atip_nota_base_analisada_atu`
--

DROP TABLE IF EXISTS `atip_nota_base_analisada_atu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `atip_nota_base_analisada_atu` (
  `data` date NOT NULL,
  `qtd_registros` int(11) DEFAULT NULL,
  `data_atualizacao` datetime NOT NULL,
  PRIMARY KEY (`data`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `atip_nota_base_analisada_trn_atu`
--

DROP TABLE IF EXISTS `atip_nota_base_analisada_trn_atu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `atip_nota_base_analisada_trn_atu` (
  `data` date NOT NULL,
  `qtd_registros` int(11) DEFAULT NULL,
  `data_atualizacao` datetime NOT NULL,
  PRIMARY KEY (`data`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `atip_nota_base_historica_atu`
--

DROP TABLE IF EXISTS `atip_nota_base_historica_atu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `atip_nota_base_historica_atu` (
  `data` date NOT NULL,
  `qtd_registros` int(11) DEFAULT NULL,
  `data_atualizacao` datetime NOT NULL,
  PRIMARY KEY (`data`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `atip_nota_base_historica_trn_atu`
--

DROP TABLE IF EXISTS `atip_nota_base_historica_trn_atu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `atip_nota_base_historica_trn_atu` (
  `data` date NOT NULL,
  `qtd_registros` int(11) DEFAULT NULL,
  `data_atualizacao` datetime NOT NULL,
  PRIMARY KEY (`data`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `atip_tran_base_atu`
--

DROP TABLE IF EXISTS `atip_tran_base_atu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `atip_tran_base_atu` (
  `data` date NOT NULL,
  `qtd_registros` int(11) DEFAULT NULL,
  `data_atualizacao` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`data`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `atip_tran_trnd_dia_atu`
--

DROP TABLE IF EXISTS `atip_tran_trnd_dia_atu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `atip_tran_trnd_dia_atu` (
  `data` date NOT NULL,
  `qtd_registros` int(11) DEFAULT NULL,
  `data_atualizacao` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`data`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `ativo_ura_retorno_consolidado_atualizacao`
--

DROP TABLE IF EXISTS `ativo_ura_retorno_consolidado_atualizacao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `ativo_ura_retorno_consolidado_atualizacao` (
  `data` date NOT NULL,
  `qtd_registros` int(11) DEFAULT NULL,
  `data_atualizacao` datetime NOT NULL,
  PRIMARY KEY (`data`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `ativo_ura_retorno_distribuicao_atualizacao`
--

DROP TABLE IF EXISTS `ativo_ura_retorno_distribuicao_atualizacao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `ativo_ura_retorno_distribuicao_atualizacao` (
  `data` date NOT NULL,
  `qtd_registros` int(11) DEFAULT NULL,
  `data_atualizacao` datetime NOT NULL,
  PRIMARY KEY (`data`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `base_alertas_pf`
--

DROP TABLE IF EXISTS `base_alertas_pf`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `base_alertas_pf` (
  `data` date NOT NULL,
  `qtd_registros` int(11) DEFAULT NULL,
  `data_atualizacao` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`data`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `base_alertas_pj`
--

DROP TABLE IF EXISTS `base_alertas_pj`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `base_alertas_pj` (
  `data` date NOT NULL,
  `qtd_registros` int(11) DEFAULT NULL,
  `data_atualizacao` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`data`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `base_any_atu`
--

DROP TABLE IF EXISTS `base_any_atu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `base_any_atu` (
  `data` date NOT NULL,
  `qtd_registros` int(11) DEFAULT NULL,
  `data_atualizacao` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`data`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `base_ativo_ura_atualizacao`
--

DROP TABLE IF EXISTS `base_ativo_ura_atualizacao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `base_ativo_ura_atualizacao` (
  `data` date NOT NULL,
  `qtd_registros` int(11) DEFAULT NULL,
  `data_atualizacao` datetime NOT NULL,
  PRIMARY KEY (`data`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `base_ativo_ura_inv_atu`
--

DROP TABLE IF EXISTS `base_ativo_ura_inv_atu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `base_ativo_ura_inv_atu` (
  `data` date NOT NULL,
  `qtd_registros` int(11) DEFAULT NULL,
  `data_atualizacao` datetime NOT NULL,
  PRIMARY KEY (`data`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `base_ativo_ura_outros_atu`
--

DROP TABLE IF EXISTS `base_ativo_ura_outros_atu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `base_ativo_ura_outros_atu` (
  `data` date NOT NULL,
  `qtd_registros` int(11) DEFAULT NULL,
  `data_atualizacao` datetime NOT NULL,
  PRIMARY KEY (`data`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `base_avaliacoes_atualizacao`
--

DROP TABLE IF EXISTS `base_avaliacoes_atualizacao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `base_avaliacoes_atualizacao` (
  `data` date NOT NULL,
  `qtd_registros` int(11) DEFAULT NULL,
  `data_atualizacao` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`data`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `base_avaliacoes_ind_atu`
--

DROP TABLE IF EXISTS `base_avaliacoes_ind_atu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `base_avaliacoes_ind_atu` (
  `data` date NOT NULL,
  `qtd_registros` int(11) DEFAULT NULL,
  `data_atualizacao` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`data`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `base_avaliacoes_ind_saud_atu`
--

DROP TABLE IF EXISTS `base_avaliacoes_ind_saud_atu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `base_avaliacoes_ind_saud_atu` (
  `data` date NOT NULL,
  `qtd_registros` int(11) DEFAULT NULL,
  `data_atualizacao` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`data`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `base_dialogo_nia`
--

DROP TABLE IF EXISTS `base_dialogo_nia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `base_dialogo_nia` (
  `CD_HASH_VISD` varchar(50) NOT NULL,
  `NM_HASH_VISD` varchar(70) DEFAULT NULL,
  `CD_IDFR_CLSD` int(8) NOT NULL,
  `NM_SRVC` varchar(50) DEFAULT NULL,
  `CD_IDFR_TMA` int(8) DEFAULT NULL,
  `CD_IDFR_ACAO` int(8) DEFAULT NULL,
  `CD_IDFR_OBJ_UM` int(8) DEFAULT NULL,
  `CD_IDFR_OBJ_DOIS` int(8) DEFAULT NULL,
  `NM_TMA` varchar(50) DEFAULT NULL,
  `NM_ACAO` varchar(50) DEFAULT NULL,
  `NM_OBJ_UM` varchar(50) DEFAULT NULL,
  `NM_OBJ_DOIS` varchar(50) DEFAULT NULL,
  `NM_TIP_HASH_VISD` varchar(50) DEFAULT NULL,
  `CD_EST` int(11) DEFAULT NULL,
  `DATA_ATUALIZACAO` datetime DEFAULT NULL,
  PRIMARY KEY (`CD_HASH_VISD`,`CD_IDFR_CLSD`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `base_funci`
--

DROP TABLE IF EXISTS `base_funci`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `base_funci` (
  `matricula` varchar(8) NOT NULL,
  `nome` varchar(250) NOT NULL,
  `nome_guerra` varchar(250) DEFAULT NULL,
  `cd_depe_lclz` int(4) DEFAULT 0,
  `nm_depe_lclz` varchar(250) DEFAULT NULL,
  `cd_cmss_fun` int(11) DEFAULT NULL,
  `nm_cmss_fun` int(11) DEFAULT NULL,
  `mci` int(11) DEFAULT NULL,
  `nr_cpf` int(11) DEFAULT NULL,
  `sexo` varchar(1) DEFAULT NULL,
  `dt_nsc` date DEFAULT NULL,
  `dt_atualizacao` datetime DEFAULT NULL,
  PRIMARY KEY (`matricula`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `base_funil_trn`
--

DROP TABLE IF EXISTS `base_funil_trn`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `base_funil_trn` (
  `dt_ref` date NOT NULL,
  `nm_srvc` varchar(50) NOT NULL,
  `nm_trn` varchar(50) NOT NULL,
  `tipo` varchar(50) NOT NULL,
  `hash` varchar(50) NOT NULL,
  `nm_tip_hash_visd` varchar(50) DEFAULT NULL,
  `qtd_int` int(11) DEFAULT NULL,
  `qtd_usu` int(11) DEFAULT NULL,
  `nota_x_qtd_avlc` int(11) DEFAULT NULL,
  `qtd_avlc` int(11) DEFAULT NULL,
  `data_atualizacao` datetime DEFAULT NULL,
  PRIMARY KEY (`dt_ref`,`hash`,`nm_trn`,`tipo`,`nm_srvc`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `base_funil_trn_copy`
--

DROP TABLE IF EXISTS `base_funil_trn_copy`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `base_funil_trn_copy` (
  `dt_ref` date NOT NULL,
  `nm_srvc` varchar(50) NOT NULL,
  `nm_trn` varchar(50) NOT NULL,
  `tipo` varchar(50) NOT NULL,
  `hash` varchar(50) NOT NULL,
  `nm_tip_hash_visd` varchar(50) DEFAULT NULL,
  `qtd_int` int(11) DEFAULT NULL,
  `qtd_usu` int(11) DEFAULT NULL,
  `nota_x_qtd_avlc` int(11) DEFAULT NULL,
  `qtd_avlc` int(11) DEFAULT NULL,
  `data_atualizacao` datetime DEFAULT NULL,
  PRIMARY KEY (`dt_ref`,`hash`,`nm_trn`,`tipo`,`nm_srvc`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `base_funil_trn_temp`
--

DROP TABLE IF EXISTS `base_funil_trn_temp`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `base_funil_trn_temp` (
  `dt_ref` date NOT NULL,
  `nm_srvc` varchar(50) NOT NULL,
  `nm_trn` varchar(50) NOT NULL,
  `tipo` varchar(50) NOT NULL,
  `hash` varchar(50) NOT NULL,
  `nm_tip_hash_visd` varchar(50) DEFAULT NULL,
  `qtd_int` int(11) DEFAULT NULL,
  `qtd_usu` int(11) DEFAULT NULL,
  `nota_x_qtd_avlc` int(11) DEFAULT NULL,
  `qtd_avlc` int(11) DEFAULT NULL,
  `data_atualizacao` datetime DEFAULT NULL,
  PRIMARY KEY (`dt_ref`,`hash`,`nm_trn`,`tipo`,`nm_srvc`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `base_margem_final_atualizacao`
--

DROP TABLE IF EXISTS `base_margem_final_atualizacao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `base_margem_final_atualizacao` (
  `data` date NOT NULL,
  `qtd_registros` int(11) DEFAULT NULL,
  `data_atualizacao` datetime NOT NULL,
  PRIMARY KEY (`data`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `base_margem_final_inv_atu`
--

DROP TABLE IF EXISTS `base_margem_final_inv_atu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `base_margem_final_inv_atu` (
  `data` date NOT NULL,
  `qtd_registros` int(11) DEFAULT NULL,
  `data_atualizacao` datetime NOT NULL,
  PRIMARY KEY (`data`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `base_margem_final_outros_atu`
--

DROP TABLE IF EXISTS `base_margem_final_outros_atu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `base_margem_final_outros_atu` (
  `data` date NOT NULL,
  `qtd_registros` int(11) DEFAULT NULL,
  `data_atualizacao` datetime NOT NULL,
  PRIMARY KEY (`data`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `base_reacoes_amostra_atualizacao`
--

DROP TABLE IF EXISTS `base_reacoes_amostra_atualizacao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `base_reacoes_amostra_atualizacao` (
  `data` date NOT NULL,
  `qtd_registros` int(11) DEFAULT NULL,
  `data_atualizacao` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`data`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `base_reacoes_amostra_ind_atu`
--

DROP TABLE IF EXISTS `base_reacoes_amostra_ind_atu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `base_reacoes_amostra_ind_atu` (
  `data` date NOT NULL,
  `qtd_registros` int(11) DEFAULT NULL,
  `data_atualizacao` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`data`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `base_reacoes_amostra_ind_saud_atu`
--

DROP TABLE IF EXISTS `base_reacoes_amostra_ind_saud_atu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `base_reacoes_amostra_ind_saud_atu` (
  `data` date NOT NULL,
  `qtd_registros` int(11) DEFAULT NULL,
  `data_atualizacao` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`data`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `base_reacoes_atualizacao`
--

DROP TABLE IF EXISTS `base_reacoes_atualizacao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `base_reacoes_atualizacao` (
  `data` date NOT NULL,
  `qtd_registros` int(11) DEFAULT NULL,
  `data_atualizacao` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`data`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `base_reacoes_ind_atu`
--

DROP TABLE IF EXISTS `base_reacoes_ind_atu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `base_reacoes_ind_atu` (
  `data` date NOT NULL,
  `qtd_registros` int(11) DEFAULT NULL,
  `data_atualizacao` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`data`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `base_reacoes_ind_saud_atu`
--

DROP TABLE IF EXISTS `base_reacoes_ind_saud_atu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `base_reacoes_ind_saud_atu` (
  `data` date NOT NULL,
  `qtd_registros` int(11) DEFAULT NULL,
  `data_atualizacao` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`data`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `base_timeout_amostra_atualizacao`
--

DROP TABLE IF EXISTS `base_timeout_amostra_atualizacao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `base_timeout_amostra_atualizacao` (
  `data` date NOT NULL,
  `qtd_registros` int(11) DEFAULT NULL,
  `data_atualizacao` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`data`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `base_timeout_amostra_pj_atualizacao`
--

DROP TABLE IF EXISTS `base_timeout_amostra_pj_atualizacao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `base_timeout_amostra_pj_atualizacao` (
  `data` date NOT NULL,
  `qtd_registros` int(11) DEFAULT NULL,
  `data_atualizacao` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`data`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `base_timeout_atualizacao`
--

DROP TABLE IF EXISTS `base_timeout_atualizacao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `base_timeout_atualizacao` (
  `data` date NOT NULL,
  `qtd_registros` int(11) DEFAULT NULL,
  `data_atualizacao` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`data`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `base_timeout_pj_atualizacao`
--

DROP TABLE IF EXISTS `base_timeout_pj_atualizacao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `base_timeout_pj_atualizacao` (
  `data` date NOT NULL,
  `qtd_registros` int(11) DEFAULT NULL,
  `data_atualizacao` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`data`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `base_wa_nodes_sem_tag_atu`
--

DROP TABLE IF EXISTS `base_wa_nodes_sem_tag_atu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `base_wa_nodes_sem_tag_atu` (
  `data` date NOT NULL,
  `qtd_registros` int(11) DEFAULT NULL,
  `data_atualizacao` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`data`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `dados_funci_cad`
--

DROP TABLE IF EXISTS `dados_funci_cad`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `dados_funci_cad` (
  `cd_usu` text NOT NULL,
  `cd_mtc` int(11) NOT NULL,
  `tip_vcl` varchar(1) NOT NULL,
  `cd_ctgr_fun` varchar(1) NOT NULL,
  `nm_fun` varchar(255) NOT NULL,
  `nm_rdz_fun` varchar(255) NOT NULL,
  `cd_cli` int(11) NOT NULL,
  `nr_cpf` bigint(20) NOT NULL,
  `cd_est` int(11) NOT NULL,
  `nm_est` varchar(255) NOT NULL,
  `cd_depe_lclz` int(11) NOT NULL,
  `cd_cmss_fun` int(11) NOT NULL,
  `tx_cmss_fun` varchar(255) NOT NULL,
  `dt_nsc` date NOT NULL,
  `data_atualizacao` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `myqnia_atualizacao`
--

DROP TABLE IF EXISTS `myqnia_atualizacao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `myqnia_atualizacao` (
  `data` date NOT NULL,
  `qtd_registros` int(11) DEFAULT NULL,
  `qtd_id_log_nia_infra` int(11) DEFAULT NULL,
  `alerta` varchar(50) DEFAULT NULL,
  `data_atualizacao` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`data`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `priorizacao_curadoria_atu`
--

DROP TABLE IF EXISTS `priorizacao_curadoria_atu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `priorizacao_curadoria_atu` (
  `data` date NOT NULL,
  `qtd_registros` int(11) DEFAULT NULL,
  `data_atualizacao` datetime NOT NULL,
  PRIMARY KEY (`data`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Temporary table structure for view `resumo_atualizacao_diaria`
--

DROP TABLE IF EXISTS `resumo_atualizacao_diaria`;
/*!50001 DROP VIEW IF EXISTS `resumo_atualizacao_diaria`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8mb4;
/*!50001 CREATE VIEW `resumo_atualizacao_diaria` AS SELECT
 1 AS `projeto`,
  1 AS `base`,
  1 AS `tipo`,
  1 AS `qtd_dias_atualizados`,
  1 AS `dados_ontem`,
  1 AS `alerta`,
  1 AS `ultima_atualizacao` */;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `t1c_tag_asnt_inro_hash`
--

DROP TABLE IF EXISTS `t1c_tag_asnt_inro_hash`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `t1c_tag_asnt_inro_hash` (
  `CD_HASH_VISD` varchar(50) DEFAULT NULL,
  `CD_IDFR_CLSD` int(11) DEFAULT NULL,
  `NM_SRVC` varchar(50) DEFAULT NULL,
  `NM_TIP_ASNT_INRO` varchar(80) DEFAULT NULL,
  `NM_TAG_ASNT_INRO` varchar(80) DEFAULT NULL,
  `data_atualizacao` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `t1c_tag_hash_visd`
--

DROP TABLE IF EXISTS `t1c_tag_hash_visd`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `t1c_tag_hash_visd` (
  `CD_HASH_VISD` varchar(50) NOT NULL,
  `NM_HASH_VISD` varchar(70) DEFAULT NULL,
  `CD_IDFR_CLSD` int(8) DEFAULT NULL,
  `NM_SRVC` varchar(50) DEFAULT NULL,
  `CD_IDFR_TMA` int(8) DEFAULT NULL,
  `CD_IDFR_ACAO` int(8) DEFAULT NULL,
  `CD_IDFR_OBJ_UM` int(8) DEFAULT NULL,
  `CD_IDFR_OBJ_DOIS` int(8) DEFAULT NULL,
  `NM_TMA` varchar(50) DEFAULT NULL,
  `NM_ACAO` varchar(50) DEFAULT NULL,
  `NM_OBJ_UM` varchar(50) DEFAULT NULL,
  `NM_OBJ_DOIS` varchar(50) DEFAULT NULL,
  `NM_TIP_HASH_VISD` varchar(50) DEFAULT NULL,
  `DATA_ATUALIZACAO` datetime DEFAULT NULL,
  PRIMARY KEY (`CD_HASH_VISD`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `wa_base_tx_rpst_atu`
--

DROP TABLE IF EXISTS `wa_base_tx_rpst_atu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `wa_base_tx_rpst_atu` (
  `data` date NOT NULL,
  `qtd_registros` int(11) DEFAULT NULL,
  `data_atualizacao` datetime NOT NULL,
  PRIMARY KEY (`data`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping routines for database 'sas'
--
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_atualiza_base_funil_trn` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
DELIMITER ;;
CREATE DEFINER=`flavia`@`%` PROCEDURE `sp_atualiza_base_funil_trn`()
BEGIN

insert into base_funil_trn
 select * from base_funil_trn_temp as b 
ON DUPLICATE KEY UPDATE  
	nm_tip_hash_visd = b.nm_tip_hash_visd,
	qtd_int = b.qtd_int,
	qtd_usu = b.qtd_usu,
	nota_x_qtd_avlc = b.nota_x_qtd_avlc,
	qtd_avlc = b.qtd_avlc,
   data_atualizacao = b.data_atualizacao;
 
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Current Database: `sas`
--

USE `sas`;

--
-- Final view structure for view `resumo_atualizacao_diaria`
--

/*!50001 DROP VIEW IF EXISTS `resumo_atualizacao_diaria`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`shirley`@`%` SQL SECURITY DEFINER */
/*!50001 VIEW `resumo_atualizacao_diaria` AS select 'ativos_enviados_report' AS `projeto`,'report.base_ativos_qtd_enviados' AS `base`,'sas' AS `tipo`,count(distinct `report`.`base_ativos_qtd_enviados`.`data`) AS `qtd_dias_atualizados`,if(max(`report`.`base_ativos_qtd_enviados`.`data`) = curdate() - interval 1 day,'sim','NÃO') AS `dados_ontem`,case when max(cast(`report`.`base_ativos_qtd_enviados`.`data_atualizacao` as date)) < curdate() then 'verificar agendador SAS' else '-' end AS `alerta`,max(`report`.`base_ativos_qtd_enviados`.`data_atualizacao`) AS `ultima_atualizacao` from `report`.`base_ativos_qtd_enviados` where `report`.`base_ativos_qtd_enviados`.`data_atualizacao` = (select max(`report`.`base_ativos_qtd_enviados`.`data_atualizacao`) from `report`.`base_ativos_qtd_enviados`) union select 'base_optin' AS `projeto`,'report.base_optin' AS `base`,'sas' AS `tipo`,count(distinct `report`.`base_optin`.`data`) AS `qtd_dias_atualizados`,if(max(`report`.`base_optin`.`data`) = curdate() - interval 1 day,'sim','NÃO') AS `dados_ontem`,case when max(cast(`report`.`base_optin`.`data_atualizacao` as date)) < curdate() then 'verificar agendador SAS' else '-' end AS `alerta`,max(`report`.`base_optin`.`data_atualizacao`) AS `ultima_atualizacao` from `report`.`base_optin` where `report`.`base_optin`.`data_atualizacao` = (select max(`report`.`base_optin`.`data_atualizacao`) from `report`.`base_optin`) union select 'Lista_ativos_enviados_report' AS `projeto`,'report.base_ativos_lista_enviados' AS `base`,'sas' AS `tipo`,count(distinct `report`.`base_ativos_lista_enviados`.`data`) AS `qtd_dias_atualizados`,if(max(`report`.`base_ativos_lista_enviados`.`data`) = curdate() - interval 1 day,'sim','NÃO') AS `dados_ontem`,case when max(cast(`report`.`base_ativos_lista_enviados`.`data_atualizacao` as date)) < curdate() then 'verificar agendador SAS' else '-' end AS `alerta`,max(`report`.`base_ativos_lista_enviados`.`data_atualizacao`) AS `ultima_atualizacao` from `report`.`base_ativos_lista_enviados` where cast(`report`.`base_ativos_lista_enviados`.`data_atualizacao` as date) = (select max(cast(`report`.`base_ativos_lista_enviados`.`data_atualizacao` as date)) from `report`.`base_ativos_lista_enviados`) union select 'dados_report' AS `projeto`,'report.dados' AS `base`,'sas' AS `tipo`,count(distinct `report`.`dados`.`data`) AS `qtd_dias_atualizados`,if(max(`report`.`dados`.`data`) = curdate() - interval 1 day,'sim','NÃO') AS `dados_ontem`,case when max(cast(`report`.`dados`.`data_atualizacao` as date)) < curdate() then 'verificar agendador SAS' when max(cast(`report`.`dados`.`data` as date)) < curdate() - interval 1 day then 'verificar myqnia' else '-' end AS `alerta`,max(`report`.`dados`.`data_atualizacao`) AS `ultima_atualizacao` from `report`.`dados` where `report`.`dados`.`data_atualizacao` = (select max(`report`.`dados`.`data_atualizacao`) from `report`.`dados`) union select 'base_ativos_sa' AS `projeto`,'report.base_ativos_sa' AS `base`,'spark/csv' AS `tipo`,count(distinct `report`.`base_ativos_sa`.`data`) AS `qtd_dias_atualizados`,if(max(`report`.`base_ativos_sa`.`data`) >= curdate() - interval 1 day,'sim','NÃO') AS `dados_ontem`,case when max(cast(`report`.`base_ativos_sa`.`data_atualizacao` as date)) < curdate() then 'executar rotina spark/csv' when max(`report`.`base_ativos_sa`.`data`) < curdate() - interval 1 day then 'verificar myqnia' else '-' end AS `alerta`,max(`report`.`base_ativos_sa`.`data_atualizacao`) AS `ultima_atualizacao` from `report`.`base_ativos_sa` where `report`.`base_ativos_sa`.`data_atualizacao` = (select max(`report`.`base_ativos_sa`.`data_atualizacao`) from `report`.`base_ativos_sa`) union select 'base_usuarios' AS `projeto`,'report.base_usuarios' AS `base`,'sas' AS `tipo`,count(distinct `report`.`base_usuarios`.`data`) AS `qtd_dias_atualizados`,if(max(`report`.`base_usuarios`.`data`) = curdate() - interval 1 day,'sim','NÃO') AS `dados_ontem`,case when max(cast(`report`.`base_usuarios`.`data` as date)) < curdate() - interval 1 day then 'verificar myqnia' when max(cast(`report`.`base_usuarios`.`data_atualizacao` as date)) < curdate() then 'verificar agendador SAS' else '-' end AS `alerta`,max(`report`.`base_usuarios`.`data_atualizacao`) AS `ultima_atualizacao` from `report`.`base_usuarios` where `report`.`base_usuarios`.`data` = (select max(`report`.`base_usuarios`.`data`) from `report`.`base_usuarios`) union select 'base_erros' AS `projeto`,'report.base_erros' AS `base`,'sas' AS `tipo`,count(distinct `report`.`base_erros`.`data`) AS `qtd_dias_atualizados`,if(max(`report`.`base_erros`.`data`) >= curdate() - interval 1 day,'sim','NÃO') AS `dados_ontem`,case when max(cast(`report`.`base_erros`.`data_atualizacao` as date)) < curdate() then 'verificar agendador SAS' when max(`report`.`base_erros`.`data`) < curdate() - interval 1 day then 'verificar job AnalyticsLabb *d1k_cad_erros_watson_grafeno_alertas* ou myqnia' else '-' end AS `alerta`,max(`report`.`base_erros`.`data_atualizacao`) AS `ultima_atualizacao` from `report`.`base_erros` where `report`.`base_erros`.`data_atualizacao` = (select max(`report`.`base_erros`.`data_atualizacao`) from `report`.`base_erros`) union select 'base_avaliacoes' AS `projeto`,'report.base_avaliacoes' AS `base`,'sas' AS `tipo`,count(distinct `report`.`base_avaliacoes`.`data`) AS `qtd_dias_atualizados`,if(max(`report`.`base_avaliacoes`.`data`) >= curdate() - interval 1 day,'sim','NÃO') AS `dados_ontem`,case when max(cast(`report`.`base_avaliacoes`.`data_atualizacao` as date)) < curdate() then 'verificar agendador SAS' when max(cast(`report`.`base_avaliacoes`.`data` as date)) < curdate() - interval 1 day then 'verificar agendador SAS' else '-' end AS `alerta`,max(`report`.`base_avaliacoes`.`data_atualizacao`) AS `ultima_atualizacao` from `report`.`base_avaliacoes` where `report`.`base_avaliacoes`.`data_atualizacao` = (select max(`report`.`base_avaliacoes`.`data_atualizacao`) from `report`.`base_avaliacoes`) union select 'WA_Negociacao' AS `projeto`,'report.wa_negociacao' AS `base`,'sas' AS `tipo`,count(distinct `report`.`wa_negociacao`.`DATA`) AS `qtd_dias_atualizados`,if(max(`report`.`wa_negociacao`.`DATA`) = curdate() - interval 1 day,'sim','NÃO') AS `dados_ontem`,case when max(cast(`report`.`wa_negociacao`.`DATA_ATUALIZACAO` as date)) < curdate() then 'verificar agendador SAS' else '-' end AS `alerta`,max(`report`.`wa_negociacao`.`DATA_ATUALIZACAO`) AS `ultima_atualizacao` from `report`.`wa_negociacao` where `report`.`wa_negociacao`.`DATA_ATUALIZACAO` = (select max(`report`.`wa_negociacao`.`DATA_ATUALIZACAO`) from `report`.`wa_negociacao`) and `report`.`wa_negociacao`.`DATA` < curdate() union select 'WA_Negociacao_dia' AS `projeto`,'report.wa_negociacao_dia' AS `base`,'sas' AS `tipo`,count(distinct `report`.`wa_negociacao_dia`.`DATA`) AS `qtd_dias_atualizados`,if(max(`report`.`wa_negociacao_dia`.`DATA`) = curdate(),'sim','NÃO') AS `dados_ontem`,case when max(cast(`report`.`wa_negociacao_dia`.`DATA_ATUALIZACAO` as date)) < curdate() then 'verificar agendador SAS' else '-' end AS `alerta`,max(`report`.`wa_negociacao_dia`.`DATA_ATUALIZACAO`) AS `ultima_atualizacao` from `report`.`wa_negociacao_dia` where `report`.`wa_negociacao_dia`.`DATA_ATUALIZACAO` = (select max(`report`.`wa_negociacao_dia`.`DATA_ATUALIZACAO`) from `report`.`wa_negociacao_dia`) and `report`.`wa_negociacao_dia`.`DATA` = curdate() union select 'base_mensal' AS `projeto`,'report.base_mensal' AS `base`,'sas' AS `tipo`,count(distinct `report`.`base_mensal`.`periodo`) AS `qtd_dias_atualizados`,if(max(cast(`report`.`base_mensal`.`data_atualizacao` as date)) = curdate(),'sim','NÃO') AS `dados_ontem`,case when max(cast(`report`.`base_mensal`.`data_atualizacao` as date)) < curdate() then 'verificar agendador SAS' else '-' end AS `alerta`,max(`report`.`base_mensal`.`data_atualizacao`) AS `ultima_atualizacao` from `report`.`base_mensal` where `report`.`base_mensal`.`data_atualizacao` = (select max(`report`.`base_mensal`.`data_atualizacao`) from `report`.`base_mensal`) union select 'WA_Timeout_PJ' AS `projeto`,'DB2I1670.Base_Timeout_PJ' AS `base`,'sas' AS `tipo`,count(distinct `sas`.`base_timeout_pj_atualizacao`.`data`) AS `qtd_dias_atualizados`,if(max(`sas`.`base_timeout_pj_atualizacao`.`data`) = curdate() - interval 1 day,'sim','NÃO') AS `dados_ontem`,case when max(cast(`sas`.`base_timeout_pj_atualizacao`.`data_atualizacao` as date)) < curdate() then 'verificar agendador SAS' when max(`sas`.`base_timeout_pj_atualizacao`.`data`) < curdate() - interval 1 day then 'verificar job AnalyticsLabb *cargat-t1c-paineis-ia* ou myqnia' else '-' end AS `alerta`,max(`sas`.`base_timeout_pj_atualizacao`.`data_atualizacao`) AS `ultima_atualizacao` from `sas`.`base_timeout_pj_atualizacao` where `sas`.`base_timeout_pj_atualizacao`.`data_atualizacao` = (select max(`sas`.`base_timeout_pj_atualizacao`.`data_atualizacao`) from `sas`.`base_timeout_pj_atualizacao`) union select 'WA_Timeout_PJ' AS `projeto`,'DB2I1670.Base_Timeout_Amostra_PJ' AS `base`,'sas' AS `tipo`,count(distinct `sas`.`base_timeout_amostra_pj_atualizacao`.`data`) AS `qtd_dias_atualizados`,if(max(`sas`.`base_timeout_amostra_pj_atualizacao`.`data`) = curdate() - interval 1 day,'sim','NÃO') AS `dados_ontem`,case when max(cast(`sas`.`base_timeout_amostra_pj_atualizacao`.`data_atualizacao` as date)) < curdate() then 'verificar agendador SAS' when max(`sas`.`base_timeout_amostra_pj_atualizacao`.`data`) < curdate() - interval 1 day then 'verificar job AnalyticsLabb *cargat-t1c-paineis-ia* ou myqnia' else '-' end AS `alerta`,max(`sas`.`base_timeout_amostra_pj_atualizacao`.`data_atualizacao`) AS `ultima_atualizacao` from `sas`.`base_timeout_amostra_pj_atualizacao` where `sas`.`base_timeout_amostra_pj_atualizacao`.`data_atualizacao` = (select max(`sas`.`base_timeout_amostra_pj_atualizacao`.`data_atualizacao`) from `sas`.`base_timeout_amostra_pj_atualizacao`) union select 't1c_tag_hash_visd' AS `projeto`,'sas.t1c_tag_hash_visd' AS `base`,'sas' AS `tipo`,count(`sas`.`t1c_tag_hash_visd`.`CD_HASH_VISD`) AS `qtd_dias_atualizados`,if(cast(`sas`.`t1c_tag_hash_visd`.`DATA_ATUALIZACAO` as date) = curdate(),'sim','NÃO') AS `dados_ontem`,case when max(cast(`sas`.`t1c_tag_hash_visd`.`DATA_ATUALIZACAO` as date)) < curdate() then 'verificar agendador SAS' else '-' end AS `alerta`,max(`sas`.`t1c_tag_hash_visd`.`DATA_ATUALIZACAO`) AS `ultima_atualizacao` from `sas`.`t1c_tag_hash_visd` union select 't1c_tag_hash_visd' AS `projeto`,'sas.t1c_tag_asnt_inro_hash' AS `base`,'sas' AS `tipo`,count(`sas`.`t1c_tag_asnt_inro_hash`.`CD_HASH_VISD`) AS `qtd_dias_atualizados`,if(cast(`sas`.`t1c_tag_asnt_inro_hash`.`data_atualizacao` as date) = curdate(),'sim','NÃO') AS `dados_ontem`,case when max(cast(`sas`.`t1c_tag_asnt_inro_hash`.`data_atualizacao` as date)) < curdate() then 'verificar agendador SAS' else '-' end AS `alerta`,max(`sas`.`t1c_tag_asnt_inro_hash`.`data_atualizacao`) AS `ultima_atualizacao` from `sas`.`t1c_tag_asnt_inro_hash` union select 'efetividade_ativos_URA_v2' AS `projeto`,'DB2I1670.base_ativo_ura_v2' AS `base`,'sas' AS `tipo`,count(`sas`.`base_ativo_ura_atualizacao`.`data`) AS `qtd_dias_atualizados`,if(`sas`.`base_ativo_ura_atualizacao`.`data` = curdate() - interval 1 day,'sim','NÃO') AS `dados_ontem`,case when max(cast(`sas`.`base_ativo_ura_atualizacao`.`data_atualizacao` as date)) < curdate() then 'verificar agendador SAS' else '-' end AS `alerta`,max(`sas`.`base_ativo_ura_atualizacao`.`data_atualizacao`) AS `ultima_atualizacao` from `sas`.`base_ativo_ura_atualizacao` union select 'efetividade_ativos_URA_v2' AS `projeto`,'DB2I1670.ativo_ura_base_margem' AS `base`,'sas' AS `tipo`,count(`sas`.`base_margem_final_atualizacao`.`data`) AS `qtd_dias_atualizados`,if(`sas`.`base_margem_final_atualizacao`.`data` = curdate() - interval 1 day,'sim','NÃO') AS `dados_ontem`,case when max(cast(`sas`.`base_margem_final_atualizacao`.`data_atualizacao` as date)) < curdate() then 'verificar agendador SAS' else '-' end AS `alerta`,max(`sas`.`base_margem_final_atualizacao`.`data_atualizacao`) AS `ultima_atualizacao` from `sas`.`base_margem_final_atualizacao` union select 'efetividade_ativos_URA_v2' AS `projeto`,'DB2I1670.ativo_ura_retorno_distrib_v2' AS `base`,'sas' AS `tipo`,count(`sas`.`ativo_ura_retorno_distribuicao_atualizacao`.`data`) AS `qtd_dias_atualizados`,if(`sas`.`ativo_ura_retorno_distribuicao_atualizacao`.`data` = curdate() - interval 1 day,'sim','NÃO') AS `dados_ontem`,case when max(cast(`sas`.`ativo_ura_retorno_distribuicao_atualizacao`.`data_atualizacao` as date)) < curdate() then 'verificar agendador SAS' else '-' end AS `alerta`,max(`sas`.`ativo_ura_retorno_distribuicao_atualizacao`.`data_atualizacao`) AS `ultima_atualizacao` from `sas`.`ativo_ura_retorno_distribuicao_atualizacao` union select 'efetividade_ativos_URA_v2' AS `projeto`,'DB2I1670.ativo_ura_retorno_consolidado_v2' AS `base`,'sas' AS `tipo`,count(`sas`.`ativo_ura_retorno_consolidado_atualizacao`.`data`) AS `qtd_dias_atualizados`,if(`sas`.`ativo_ura_retorno_consolidado_atualizacao`.`data` = curdate() - interval 1 day,'sim','NÃO') AS `dados_ontem`,case when max(cast(`sas`.`ativo_ura_retorno_consolidado_atualizacao`.`data_atualizacao` as date)) < curdate() then 'verificar agendador SAS' else '-' end AS `alerta`,max(`sas`.`ativo_ura_retorno_consolidado_atualizacao`.`data_atualizacao`) AS `ultima_atualizacao` from `sas`.`ativo_ura_retorno_consolidado_atualizacao` union select 'atualizacao_myqnia' AS `projeto`,'myqnia.c4gsccaaud_log_nia_infra' AS `base`,'hive' AS `tipo`,count(`sas`.`myqnia_atualizacao`.`data`) AS `qtd_dias_atualizados`,if(max(`sas`.`myqnia_atualizacao`.`data`) = curdate() - interval 1 day,'sim','NÃO') AS `dados_ontem`,case when max(cast(`sas`.`myqnia_atualizacao`.`data_atualizacao` as date)) < curdate() then 'verificar agendador SAS' when max(`sas`.`myqnia_atualizacao`.`data`) < curdate() - interval 1 day then 'verificar base myqnia' else max(`sas`.`myqnia_atualizacao`.`alerta`) end AS `alerta`,max(`sas`.`myqnia_atualizacao`.`data_atualizacao`) AS `ultima_atualizacao` from `sas`.`myqnia_atualizacao` union select 'AtipicidadeNota' AS `projeto`,'DB2I1670.atip_nota_base_analisada' AS `base`,'sas' AS `tipo`,count(`sas`.`atip_nota_base_analisada_atu`.`data`) AS `qtd_dias_atualizados`,if(max(`sas`.`atip_nota_base_analisada_atu`.`data`) = curdate() - interval 1 day,'sim','NÃO') AS `dados_ontem`,case when max(cast(`sas`.`atip_nota_base_analisada_atu`.`data_atualizacao` as date)) < curdate() then 'verificar agendador SAS' when max(`sas`.`atip_nota_base_analisada_atu`.`data`) < curdate() - interval 1 day then 'verificar job AnalyticsLabb *avaliacoes_por_assunto_tagueamento_v2* ou myqnia' else '-' end AS `alerta`,max(`sas`.`atip_nota_base_analisada_atu`.`data_atualizacao`) AS `ultima_atualizacao` from `sas`.`atip_nota_base_analisada_atu` union select 'AtipicidadeNota' AS `projeto`,'DB2I1670.atip_nota_base_historica' AS `base`,'sas' AS `tipo`,count(`sas`.`atip_nota_base_historica_atu`.`data`) AS `qtd_dias_atualizados`,if(max(`sas`.`atip_nota_base_historica_atu`.`data`) = curdate() - interval 1 day,'sim','NÃO') AS `dados_ontem`,case when max(cast(`sas`.`atip_nota_base_historica_atu`.`data_atualizacao` as date)) < curdate() then 'verificar agendador SAS' when max(`sas`.`atip_nota_base_historica_atu`.`data`) < curdate() - interval 1 day then 'verificar job AnalyticsLabb *avaliacoes_por_assunto_tagueamento_v2* ou myqnia' else '-' end AS `alerta`,max(`sas`.`atip_nota_base_historica_atu`.`data_atualizacao`) AS `ultima_atualizacao` from `sas`.`atip_nota_base_historica_atu` union select 'AtipicidadeTransbordo' AS `projeto`,'DB2I1670.atip_tran_trnd_dia' AS `base`,'sas' AS `tipo`,count(`sas`.`atip_tran_trnd_dia_atu`.`data`) AS `qtd_dias_atualizados`,if(max(`sas`.`atip_tran_trnd_dia_atu`.`data`) = curdate() - interval 1 day,'sim','NÃO') AS `dados_ontem`,case when max(cast(`sas`.`atip_tran_trnd_dia_atu`.`data_atualizacao` as date)) < curdate() then 'verificar agendador SAS' when max(`sas`.`atip_tran_trnd_dia_atu`.`data`) < curdate() - interval 1 day then 'verificar job AnalyticsLabb *cargat-t1c-paineis-ia* ou myqnia' else '-' end AS `alerta`,max(`sas`.`atip_tran_trnd_dia_atu`.`data_atualizacao`) AS `ultima_atualizacao` from `sas`.`atip_tran_trnd_dia_atu` union select 'AtipicidadeTransbordo' AS `projeto`,'DB2I1670.atip_tran_base' AS `base`,'sas' AS `tipo`,count(`sas`.`atip_tran_base_atu`.`data`) AS `qtd_dias_atualizados`,if(max(`sas`.`atip_tran_base_atu`.`data`) = curdate() - interval 1 day,'sim','NÃO') AS `dados_ontem`,case when max(cast(`sas`.`atip_tran_base_atu`.`data_atualizacao` as date)) < curdate() then 'verificar agendador SAS' when max(`sas`.`atip_tran_base_atu`.`data`) < curdate() - interval 1 day then 'verificar job AnalyticsLabb *cargat-t1c-paineis-ia* ou myqnia' else '-' end AS `alerta`,max(`sas`.`atip_tran_base_atu`.`data_atualizacao`) AS `ultima_atualizacao` from `sas`.`atip_tran_base_atu` union select 'AtipicidadeAssunto' AS `projeto`,'DB2I1670.atip_assunto_fato' AS `base`,'sas' AS `tipo`,count(`sas`.`atip_assunto_fato_atu`.`data`) AS `qtd_dias_atualizados`,if(max(`sas`.`atip_assunto_fato_atu`.`data`) = curdate() - interval 1 day,'sim','NÃO') AS `dados_ontem`,case when max(cast(`sas`.`atip_assunto_fato_atu`.`data_atualizacao` as date)) < curdate() then 'verificar agendador SAS' when max(`sas`.`atip_assunto_fato_atu`.`data`) < curdate() - interval 1 day then 'verificar job AnalyticsLabb *cargat-t1c-paineis-ia* ou myqnia' else '-' end AS `alerta`,max(`sas`.`atip_assunto_fato_atu`.`data_atualizacao`) AS `ultima_atualizacao` from `sas`.`atip_assunto_fato_atu` union select 'AtipicidadeAssunto' AS `projeto`,'DB2I1670.atip_assunto_base_analisada' AS `base`,'sas' AS `tipo`,count(`sas`.`atip_assunto_base_analisada_atu`.`data`) AS `qtd_dias_atualizados`,if(max(`sas`.`atip_assunto_base_analisada_atu`.`data`) = curdate() - interval 1 day,'sim','NÃO') AS `dados_ontem`,case when max(cast(`sas`.`atip_assunto_base_analisada_atu`.`data_atualizacao` as date)) < curdate() then 'verificar agendador SAS' when max(`sas`.`atip_assunto_base_analisada_atu`.`data`) < curdate() - interval 1 day then 'verificar job AnalyticsLabb *cargat-t1c-paineis-ia* ou myqnia' else '-' end AS `alerta`,max(`sas`.`atip_assunto_base_analisada_atu`.`data_atualizacao`) AS `ultima_atualizacao` from `sas`.`atip_assunto_base_analisada_atu` union select 'AtipicidadeAssunto' AS `projeto`,'DB2I1670.atip_assunto_base_historica' AS `base`,'sas' AS `tipo`,count(`sas`.`atip_assunto_base_historica_atu`.`data`) AS `qtd_dias_atualizados`,if(max(`sas`.`atip_assunto_base_historica_atu`.`data`) = curdate() - interval 1 day,'sim','NÃO') AS `dados_ontem`,case when max(cast(`sas`.`atip_assunto_base_historica_atu`.`data_atualizacao` as date)) < curdate() then 'verificar agendador SAS' when max(`sas`.`atip_assunto_base_historica_atu`.`data`) < curdate() - interval 1 day then 'verificar job AnalyticsLabb *cargat-t1c-paineis-ia* ou myqnia' else '-' end AS `alerta`,max(`sas`.`atip_assunto_base_historica_atu`.`data_atualizacao`) AS `ultima_atualizacao` from `sas`.`atip_assunto_base_historica_atu` union select 'WA_Nodes_Sem_Tagueamento' AS `projeto`,'DB2I1670.wa_nodes_sem_tag' AS `base`,'sas' AS `tipo`,count(distinct `sas`.`base_wa_nodes_sem_tag_atu`.`data`) AS `qtd_dias_atualizados`,if(max(`sas`.`base_wa_nodes_sem_tag_atu`.`data`) = curdate() - interval 1 day,'sim','NÃO') AS `dados_ontem`,case when max(cast(`sas`.`base_wa_nodes_sem_tag_atu`.`data_atualizacao` as date)) < curdate() then 'verificar agendador SAS' when max(`sas`.`base_wa_nodes_sem_tag_atu`.`data`) < curdate() - interval 1 day then 'verificar job AnalyticsLabb *cad_bases_curadoria*' else '-' end AS `alerta`,max(`sas`.`base_wa_nodes_sem_tag_atu`.`data_atualizacao`) AS `ultima_atualizacao` from `sas`.`base_wa_nodes_sem_tag_atu` where `sas`.`base_wa_nodes_sem_tag_atu`.`data_atualizacao` = (select max(`sas`.`base_wa_nodes_sem_tag_atu`.`data_atualizacao`) from `sas`.`base_wa_nodes_sem_tag_atu`) union select 'WA_Alertas' AS `projeto`,'DB2I1670.alertas_pf' AS `base`,'sas' AS `tipo`,count(distinct `sas`.`base_alertas_pf`.`data`) AS `qtd_dias_atualizados`,if(max(`sas`.`base_alertas_pf`.`data`) = curdate() - interval 1 day,'sim','NÃO') AS `dados_ontem`,case when max(cast(`sas`.`base_alertas_pf`.`data_atualizacao` as date)) < curdate() then 'verificar agendador SAS' when max(`sas`.`base_alertas_pf`.`data`) < curdate() - interval 1 day then 'verificar job AnalyticsLabb *cad_bases_curadoria*' else '-' end AS `alerta`,max(`sas`.`base_alertas_pf`.`data_atualizacao`) AS `ultima_atualizacao` from `sas`.`base_alertas_pf` where `sas`.`base_alertas_pf`.`data_atualizacao` = (select max(`sas`.`base_alertas_pf`.`data_atualizacao`) from `sas`.`base_alertas_pf`) union select 'WA_Alertas' AS `projeto`,'DB2I1670.alertas_pj' AS `base`,'sas' AS `tipo`,count(distinct `sas`.`base_alertas_pj`.`data`) AS `qtd_dias_atualizados`,if(max(`sas`.`base_alertas_pj`.`data`) = curdate() - interval 1 day,'sim','NÃO') AS `dados_ontem`,case when max(cast(`sas`.`base_alertas_pj`.`data_atualizacao` as date)) < curdate() then 'verificar agendador SAS' when max(`sas`.`base_alertas_pj`.`data`) < curdate() - interval 1 day then 'verificar job AnalyticsLabb *cad_bases_curadoria*' else '-' end AS `alerta`,max(`sas`.`base_alertas_pj`.`data_atualizacao`) AS `ultima_atualizacao` from `sas`.`base_alertas_pj` where `sas`.`base_alertas_pj`.`data_atualizacao` = (select max(`sas`.`base_alertas_pj`.`data_atualizacao`) from `sas`.`base_alertas_pj`) union select 'resolucao_conversas' AS `projeto`,'base_resolucao_conversas' AS `base`,'sas' AS `tipo`,count(distinct `report`.`base_resolucao_conversas`.`data`) AS `qtd_dias_atualizados`,if(max(`report`.`base_resolucao_conversas`.`data`) = curdate() - interval 1 day,'sim','NÃO') AS `dados_ontem`,case when max(cast(`report`.`base_resolucao_conversas`.`data_atualizacao` as date)) < curdate() then 'verificar agendador SAS' when max(`report`.`base_resolucao_conversas`.`data`) < curdate() - interval 1 day then 'verificar myqnia' else '-' end AS `alerta`,max(`report`.`base_resolucao_conversas`.`data_atualizacao`) AS `ultima_atualizacao` from `report`.`base_resolucao_conversas` where cast(`report`.`base_resolucao_conversas`.`data_atualizacao` as date) = (select max(cast(`report`.`base_resolucao_conversas`.`data_atualizacao` as date)) from `report`.`base_resolucao_conversas`) union select 'WA_Inducoes_Curadoria_Saudacao	' AS `projeto`,'DB2I1670.Base_Reacoes_Ind_Saud' AS `base`,'sas' AS `tipo`,count(distinct `sas`.`base_reacoes_ind_saud_atu`.`data`) AS `qtd_dias_atualizados`,if(max(`sas`.`base_reacoes_ind_saud_atu`.`data`) = curdate() - interval 1 day,'sim','NÃO') AS `dados_ontem`,case when max(cast(`sas`.`base_reacoes_ind_saud_atu`.`data_atualizacao` as date)) < curdate() then 'verificar agendador SAS' when max(`sas`.`base_reacoes_ind_saud_atu`.`data`) < curdate() - interval 1 day then 'verificar job AnalyticsLabb *cargat-t1c-paineis-ia* ou myqnia' else '-' end AS `alerta`,max(`sas`.`base_reacoes_ind_saud_atu`.`data_atualizacao`) AS `ultima_atualizacao` from `sas`.`base_reacoes_ind_saud_atu` where `sas`.`base_reacoes_ind_saud_atu`.`data_atualizacao` = (select max(`sas`.`base_reacoes_ind_saud_atu`.`data_atualizacao`) from `sas`.`base_reacoes_ind_saud_atu`) union select 'WA_Inducoes_Curadoria_Saudacao	' AS `projeto`,'DB2I1670.Base_Reacoes_Ind_Saud' AS `base`,'sas' AS `tipo`,count(distinct `sas`.`base_reacoes_ind_saud_atu`.`data`) AS `qtd_dias_atualizados`,if(max(`sas`.`base_reacoes_ind_saud_atu`.`data`) = curdate() - interval 1 day,'sim','NÃO') AS `dados_ontem`,case when max(cast(`sas`.`base_reacoes_ind_saud_atu`.`data_atualizacao` as date)) < curdate() then 'verificar agendador SAS' when max(`sas`.`base_reacoes_ind_saud_atu`.`data`) < curdate() - interval 1 day then 'verificar job AnalyticsLabb *cargat-t1c-paineis-ia* ou myqnia' else '-' end AS `alerta`,max(`sas`.`base_reacoes_ind_saud_atu`.`data_atualizacao`) AS `ultima_atualizacao` from `sas`.`base_reacoes_ind_saud_atu` where `sas`.`base_reacoes_ind_saud_atu`.`data_atualizacao` = (select max(`sas`.`base_reacoes_ind_saud_atu`.`data_atualizacao`) from `sas`.`base_reacoes_ind_saud_atu`) union select 'WA_Inducoes_Curadoria_Saudacao	' AS `projeto`,'DB2I1670.Base_Avaliacoes_Ind_Saud' AS `base`,'sas' AS `tipo`,count(distinct `sas`.`base_avaliacoes_ind_saud_atu`.`data`) AS `qtd_dias_atualizados`,if(max(`sas`.`base_avaliacoes_ind_saud_atu`.`data`) = curdate() - interval 1 day,'sim','NÃO') AS `dados_ontem`,case when max(cast(`sas`.`base_avaliacoes_ind_saud_atu`.`data_atualizacao` as date)) < curdate() then 'verificar agendador SAS' when max(`sas`.`base_avaliacoes_ind_saud_atu`.`data`) < curdate() - interval 1 day then 'verificar job AnalyticsLabb *cargat-t1c-paineis-ia* ou myqnia' else '-' end AS `alerta`,max(`sas`.`base_avaliacoes_ind_saud_atu`.`data_atualizacao`) AS `ultima_atualizacao` from `sas`.`base_avaliacoes_ind_saud_atu` where `sas`.`base_avaliacoes_ind_saud_atu`.`data_atualizacao` = (select max(`sas`.`base_avaliacoes_ind_saud_atu`.`data_atualizacao`) from `sas`.`base_avaliacoes_ind_saud_atu`) union select 'WA_Inducoes_Curadoria_Saudacao	' AS `projeto`,'DB2I1670.Base_Reacoes_Amostra_Ind_Saud' AS `base`,'sas' AS `tipo`,count(distinct `sas`.`base_reacoes_amostra_ind_saud_atu`.`data`) AS `qtd_dias_atualizados`,if(max(`sas`.`base_reacoes_amostra_ind_saud_atu`.`data`) = curdate() - interval 1 day,'sim','NÃO') AS `dados_ontem`,case when max(cast(`sas`.`base_reacoes_amostra_ind_saud_atu`.`data_atualizacao` as date)) < curdate() then 'verificar agendador SAS' when max(`sas`.`base_reacoes_amostra_ind_saud_atu`.`data`) < curdate() - interval 1 day then 'verificar job AnalyticsLabb *cargat-t1c-paineis-ia* ou myqnia' else '-' end AS `alerta`,max(`sas`.`base_reacoes_amostra_ind_saud_atu`.`data_atualizacao`) AS `ultima_atualizacao` from `sas`.`base_reacoes_amostra_ind_saud_atu` where `sas`.`base_reacoes_amostra_ind_saud_atu`.`data_atualizacao` = (select max(`sas`.`base_reacoes_amostra_ind_saud_atu`.`data_atualizacao`) from `sas`.`base_reacoes_amostra_ind_saud_atu`) union select 'Analise_Funil_TRN_v2	' AS `projeto`,'base_funil_trn' AS `base`,'sas' AS `tipo`,count(distinct `sas`.`base_funil_trn`.`dt_ref`) AS `qtd_dias_atualizados`,if(max(`sas`.`base_funil_trn`.`dt_ref`) = curdate() - interval 1 day,'sim','NÃO') AS `dados_ontem`,case when max(cast(`sas`.`base_funil_trn`.`dt_ref` as date)) < curdate() - interval 1 day then 'verificar hive_d1k.anl_crda_inro_nota' when max(cast(`sas`.`base_funil_trn`.`data_atualizacao` as date)) < curdate() then 'verificar agendador SAS' else '-' end AS `alerta`,max(`sas`.`base_funil_trn`.`data_atualizacao`) AS `ultima_atualizacao` from `sas`.`base_funil_trn` where `sas`.`base_funil_trn`.`dt_ref` = (select max(`sas`.`base_funil_trn`.`dt_ref`) from `sas`.`base_funil_trn`) union select 'WA_texto_resposta	' AS `projeto`,'DB2I1670.wa_base_tx_rpst' AS `base`,'sas' AS `tipo`,count(distinct `sas`.`wa_base_tx_rpst_atu`.`data`) AS `qtd_dias_atualizados`,if(max(`sas`.`wa_base_tx_rpst_atu`.`data`) = curdate(),'sim','NÃO') AS `dados_ontem`,case when max(cast(`sas`.`wa_base_tx_rpst_atu`.`data_atualizacao` as date)) < curdate() then 'verificar agendador SAS' when max(`sas`.`wa_base_tx_rpst_atu`.`data`) < curdate() then 'verificar job AnalyticsLabb *base_curadoria* ou myqnia' else '-' end AS `alerta`,max(`sas`.`wa_base_tx_rpst_atu`.`data_atualizacao`) AS `ultima_atualizacao` from `sas`.`wa_base_tx_rpst_atu` union select 'Priorizacao_Curadoria_v2' AS `projeto`,'DB2I1670.priorizacao_curadoria' AS `base`,'sas' AS `tipo`,count(distinct `sas`.`priorizacao_curadoria_atu`.`data`) AS `qtd_dias_atualizados`,if(max(`sas`.`priorizacao_curadoria_atu`.`data`) = curdate() - interval 1 day,'sim','NÃO') AS `dados_ontem`,case when max(cast(`sas`.`priorizacao_curadoria_atu`.`data_atualizacao` as date)) < curdate() then 'verificar agendador SAS' when max(`sas`.`priorizacao_curadoria_atu`.`data`) < curdate() - interval 1 day then 'verificar job AnalyticsLabb e demais projetos SAS ou myqnia' else '-' end AS `alerta`,max(`sas`.`priorizacao_curadoria_atu`.`data_atualizacao`) AS `ultima_atualizacao` from `sas`.`priorizacao_curadoria_atu` union select 'Analise_Anythingelse_PF' AS `projeto`,'DB2I1670.BASE_ANY' AS `base`,'sas' AS `tipo`,count(distinct `sas`.`base_any_atu`.`data`) AS `qtd_dias_atualizados`,if(max(`sas`.`base_any_atu`.`data`) = curdate() - interval 1 day,'sim','NÃO') AS `dados_ontem`,case when max(cast(`sas`.`base_any_atu`.`data_atualizacao` as date)) < curdate() then 'verificar agendador SAS' when max(`sas`.`base_any_atu`.`data`) < curdate() - interval 1 day then 'verificar job AnalyticsLabb *cad_bases_curadoria*' else '-' end AS `alerta`,max(`sas`.`base_any_atu`.`data_atualizacao`) AS `ultima_atualizacao` from `sas`.`base_any_atu` where `sas`.`base_any_atu`.`data_atualizacao` = (select max(`sas`.`base_any_atu`.`data_atualizacao`) from `sas`.`base_any_atu`) union select 'WA_Negociacao' AS `projeto`,'report.wa_negociacao_detalhe' AS `base`,'sas' AS `tipo`,count(distinct `report`.`wa_negociacao_detalhe`.`DATA`) AS `qtd_dias_atualizados`,if(max(`report`.`wa_negociacao_detalhe`.`DATA`) = curdate() - interval 1 day,'sim','NÃO') AS `dados_ontem`,case when max(cast(`report`.`wa_negociacao_detalhe`.`DATA_ATUALIZACAO` as date)) < curdate() then 'verificar agendador SAS' else '-' end AS `alerta`,max(`report`.`wa_negociacao_detalhe`.`DATA_ATUALIZACAO`) AS `ultima_atualizacao` from `report`.`wa_negociacao_detalhe` where `report`.`wa_negociacao_detalhe`.`DATA_ATUALIZACAO` = (select max(`report`.`wa_negociacao_detalhe`.`DATA_ATUALIZACAO`) from `report`.`wa_negociacao_detalhe`) and `report`.`wa_negociacao_detalhe`.`DATA` < curdate() */;
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

-- Dump completed on 2025-08-20  0:18:18
