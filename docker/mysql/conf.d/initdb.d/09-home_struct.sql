/*M!999999\- enable the sandbox mode */ 
-- MariaDB dump 10.19  Distrib 10.11.11-MariaDB, for Linux (x86_64)
--
-- Host: 127.0.0.1    Database: home
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
-- Current Database: `home`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `home` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci */;

USE `home`;

--
-- Table structure for table `avisoEcoa`
--

DROP TABLE IF EXISTS `avisoEcoa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `avisoEcoa` (
  `idAvisoEcoa` int(11) NOT NULL AUTO_INCREMENT,
  `tituloAviso` varchar(255) DEFAULT NULL,
  `data` date DEFAULT NULL,
  `horario` time DEFAULT NULL,
  `descricao` text DEFAULT NULL,
  `timestamp` datetime DEFAULT current_timestamp(),
  `ativo` varchar(45) DEFAULT '1',
  PRIMARY KEY (`idAvisoEcoa`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping routines for database 'home'
--
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
/*!50003 DROP PROCEDURE IF EXISTS `consultaGrandesNumeros` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
DELIMITER ;;
CREATE DEFINER=`albert`@`%` PROCEDURE `consultaGrandesNumeros`()
BEGIN

	DECLARE dataFiltro date;
	DECLARE dataFiltroOntem date;

	SET dataFiltro = DATE_SUB(curdate(), interval 1 day);
	SET dataFiltroOntem = DATE_SUB(dataFiltro, interval 1 day);


	DROP TEMPORARY TABLE IF EXISTS report.interacoesPf;
    DROP TEMPORARY TABLE IF EXISTS report.interacoesPfOntem;
	DROP TEMPORARY TABLE IF EXISTS report.usuariosPf;
    DROP TEMPORARY TABLE IF EXISTS report.usuariosPfOntem;
	DROP TEMPORARY TABLE IF EXISTS report.conversasPf;
    DROP TEMPORARY TABLE IF EXISTS report.conversasPfOntem;
	DROP TEMPORARY TABLE IF EXISTS report.notaMediaPf;
    DROP TEMPORARY TABLE IF EXISTS report.notaMediaPfOntem;
	DROP TEMPORARY TABLE IF EXISTS report.totalRao;
    DROP TEMPORARY TABLE IF EXISTS report.totalRaoOntem;
    DROP TEMPORARY TABLE IF EXISTS report.totalAtivosSA;
    DROP TEMPORARY TABLE IF EXISTS report.totalAtivosSAOntem;
    DROP TEMPORARY TABLE IF EXISTS report.totalCdc;
    DROP TEMPORARY TABLE IF EXISTS report.totalCdcOntem;
    DROP TEMPORARY TABLE IF EXISTS report.totalAtivosEnviados;
    DROP TEMPORARY TABLE IF EXISTS report.totalAtivosEnviadosOntem;

	CREATE TEMPORARY TABLE report.interacoesPf AS
	SELECT dataFiltro as dataJoin, qtd_interacoes as interacoesPf FROM report.dados WHERE canal_bot = 'whatsapp pf' and data = dataFiltro;
    
    CREATE TEMPORARY TABLE report.interacoesPfOntem AS
	SELECT dataFiltro as dataJoin, qtd_interacoes as interacoesPfOntem FROM report.dados WHERE canal_bot = 'whatsapp pf' and data = dataFiltroOntem;

	CREATE TEMPORARY TABLE report.usuariosPf AS
	SELECT dataFiltro as dataJoin, qtd_usuarios as usuariosPf FROM report.dados WHERE canal_bot = 'whatsapp pf' and data = dataFiltro;
    
    CREATE TEMPORARY TABLE report.usuariosPfOntem AS
	SELECT dataFiltro as dataJoin, qtd_usuarios as usuariosPfOntem FROM report.dados WHERE canal_bot = 'whatsapp pf' and data = dataFiltroOntem;
    
	CREATE TEMPORARY TABLE report.conversasPf AS
	SELECT dataFiltro as dataJoin, qtd_conversas as conversasPf FROM report.dados WHERE canal_bot = 'whatsapp pf' and data = dataFiltro;
    
    CREATE TEMPORARY TABLE report.conversasPfOntem AS
	SELECT dataFiltro as dataJoin, qtd_conversas as conversasPfOntem FROM report.dados WHERE canal_bot = 'whatsapp pf' and data = dataFiltroOntem;
    
    CREATE TEMPORARY TABLE report.notaMediaPf AS
	SELECT dataFiltro as dataJoin, nota_media as notaMediaPf FROM report.base_avaliacoes WHERE canal_bot = 'whatsapp pf' and data = dataFiltro;
    
    CREATE TEMPORARY TABLE report.notaMediaPfOntem AS
	SELECT dataFiltro as dataJoin, nota_media as notaMediaPfOntem FROM report.base_avaliacoes WHERE canal_bot = 'whatsapp pf' and data = dataFiltroOntem;

	CREATE TEMPORARY TABLE report.totalAtivosEnviados AS
    SELECT dataFiltro as dataJoin, qtd_ativos_enviados as totalAtivosEnviados FROM report.base_ativos_qtd_enviados WHERE data = dataFiltro;
    
    CREATE TEMPORARY TABLE report.totalAtivosEnviadosOntem AS
    SELECT dataFiltro as dataJoin, qtd_ativos_enviados as totalAtivosEnviadosOntem FROM report.base_ativos_qtd_enviados WHERE data = dataFiltroOntem;

    CREATE TEMPORARY TABLE report.totalRao AS
    SELECT dataFiltro as dataJoin, qtde as qtdRao, /*ROUND(valor, 0) as totalRao*/ valor as totalRao FROM report.vw_wa_negociacao_consolidado WHERE data = dataFiltro AND tipo IN ('RAO','RENEG');
    
    CREATE TEMPORARY TABLE report.totalRaoOntem AS
    SELECT dataFiltro as dataJoin, valor as totalRaoOntem FROM report.vw_wa_negociacao_consolidado WHERE data = dataFiltroOntem AND tipo IN ('RAO','RENEG');
	
    CREATE TEMPORARY TABLE report.totalAtivosSA AS
    SELECT 
		dataFiltro as dataJoin, 
		ifnull((SELECT qtde FROM report.vw_wa_negociacao_consolidado WHERE data = dataFiltro AND tipo = 'ATIVOS SA'), '0') as qtdAtivos, 
        ifnull((SELECT valor FROM report.vw_wa_negociacao_consolidado WHERE data = dataFiltro AND tipo = 'ATIVOS SA'), '0') as totalAtivosSA;
        
	CREATE TEMPORARY TABLE report.totalAtivosSAOntem AS
    SELECT 
		dataFiltro as dataJoin, 
		ifnull((SELECT qtde FROM report.vw_wa_negociacao_consolidado WHERE data = dataFiltroOntem AND tipo = 'ATIVOS SA'), '0') as qtdAtivos, 
        ifnull((SELECT valor FROM report.vw_wa_negociacao_consolidado WHERE data = dataFiltroOntem AND tipo = 'ATIVOS SA'), '0') as totalAtivosSAOntem;
	
    CREATE TEMPORARY TABLE report.totalCdc AS
    SELECT dataFiltro as dataJoin, qtde as qtdCdc, /*ROUND(valor, 0) as totalCdc*/ valor as totalCdc FROM report.vw_wa_negociacao_consolidado WHERE data <= dataFiltro AND tipo = 'CDC' ORDER BY data DESC LIMIT 1;
    
    CREATE TEMPORARY TABLE report.totalCdcOntem AS
    SELECT dataFiltro as dataJoin, qtde as qtdCdc, /*ROUND(valor, 0) as totalCdc*/ valor as totalCdcOntem FROM report.vw_wa_negociacao_consolidado WHERE data <= dataFiltroOntem AND tipo = 'CDC' ORDER BY data DESC LIMIT 1;
    
    
    
    /*SELECT 	a.dataJoin,
		date_format(a.dataJoin, '%d/%m/%Y') as dataFormatada,
		interacoesPf,
        interacoesPfOntem,
        CONCAT(ROUND((interacoesPf / interacoesPfOntem * 100)-100,2),'%') as percentualInteracoes,
		usuariosPf,
        usuariosPfOntem,
        CONCAT(ROUND((usuariosPf / usuariosPfOntem * 100)-100,2),'%') as percentualUsuarios,
		conversasPf,
        conversasPfOntem,
        CONCAT(ROUND((conversasPf / conversasPfOntem * 100)-100,2),'%') as percentualConversas,
		notaMediaPf,
        notaMediaPfOntem,
        CONCAT(ROUND((notaMediaPf / notaMediaPfOntem * 100)-100,2),'%') as percentualNotaMedia,
        totalAtivosEnviados,
        totalAtivosEnviadosOntem,
        CONCAT(ROUND((totalAtivosEnviados / totalAtivosEnviadosOntem * 100)-100,2),'%') as percentualTotalAtivosEnviados,
		totalRao,
        totalRaoOntem,
        CONCAT(ROUND((totalRao / totalRaoOntem * 100)-100,2),'%') as percentualTotalRao,
        round(totalAtivosSA,2) as totalAtivosSA,
        round(totalAtivosSA,2) as totalAtivosSAOntem,
        CONCAT(ROUND((totalAtivosSA / totalAtivosSAOntem * 100)-100,2),'%') as percentualTotalAtivosSA,
        round(totalCdc,2) as totalCdc,
        round(totalCdc,2) as totalCdcOntem,
        CONCAT(ROUND((totalCdc / totalCdcOntem * 100)-100,2),'%') as percentualTotalCdc
	FROM report.interacoesPf a
	JOIN report.usuariosPf b ON a.dataJoin = b.dataJoin
	JOIN report.conversasPf c ON a.dataJoin = c.dataJoin
	JOIN report.notaMediaPf d ON a.dataJoin = d.dataJoin
    JOIN report.totalRao e ON a.dataJoin = e.dataJoin
    JOIN report.totalAtivosSA f ON a.dataJoin = f.dataJoin
    JOIN report.totalCdc g ON a.dataJoin = g.dataJoin
    JOIN report.totalAtivosEnviados h ON a.dataJoin = h.dataJoin
    JOIN report.interacoesPfOntem i ON a.dataJoin = i.dataJoin
	JOIN report.usuariosPfOntem j ON a.dataJoin = j.dataJoin
	JOIN report.conversasPfOntem k ON a.dataJoin = k.dataJoin
	JOIN report.notaMediaPfOntem l ON a.dataJoin = l.dataJoin
    JOIN report.totalRaoOntem m ON a.dataJoin = m.dataJoin
    JOIN report.totalAtivosSAOntem n ON a.dataJoin = n.dataJoin
    JOIN report.totalCdcOntem o ON a.dataJoin = o.dataJoin
    JOIN report.totalAtivosEnviadosOntem p ON a.dataJoin = p.dataJoin;*/
    
    SELECT  a.dataJoin,
        date_format(a.dataJoin, '%d/%m/%Y') as dataFormatada,
        CASE 
            WHEN interacoesPf >= 1000000 THEN CONCAT(ROUND(interacoesPf / 1000000, 1), 'M')
            WHEN interacoesPf >= 1000 THEN CONCAT(ROUND(interacoesPf / 1000, 1), 'K')
            ELSE interacoesPf
        END as interacoesPf,
        CASE 
            WHEN interacoesPfOntem >= 1000000 THEN CONCAT(ROUND(interacoesPfOntem / 1000000, 1), 'M')
            WHEN interacoesPfOntem >= 1000 THEN CONCAT(ROUND(interacoesPfOntem / 1000, 1), 'K')
            ELSE interacoesPfOntem
        END as interacoesPfOntem,
        CONCAT(ROUND((interacoesPf / interacoesPfOntem * 100)-100,2),'%') as percentualInteracoes,
        CASE 
            WHEN usuariosPf >= 1000000 THEN CONCAT(ROUND(usuariosPf / 1000000, 1), 'M')
            WHEN usuariosPf >= 1000 THEN CONCAT(ROUND(usuariosPf / 1000, 1), 'K')
            ELSE usuariosPf
        END as usuariosPf,
        CASE 
            WHEN usuariosPfOntem >= 1000000 THEN CONCAT(ROUND(usuariosPfOntem / 1000000, 1), 'M')
            WHEN usuariosPfOntem >= 1000 THEN CONCAT(ROUND(usuariosPfOntem / 1000, 1), 'K')
            ELSE usuariosPfOntem
        END as usuariosPfOntem,
        CONCAT(ROUND((usuariosPf / usuariosPfOntem * 100)-100,2),'%') as percentualUsuarios,
        CASE 
            WHEN conversasPf >= 1000000 THEN CONCAT(ROUND(conversasPf / 1000000, 1), 'M')
            WHEN conversasPf >= 1000 THEN CONCAT(ROUND(conversasPf / 1000, 1), 'K')
            ELSE conversasPf
        END as conversasPf,
        CASE 
            WHEN conversasPfOntem >= 1000000 THEN CONCAT(ROUND(conversasPfOntem / 1000000, 1), 'M')
            WHEN conversasPfOntem >= 1000 THEN CONCAT(ROUND(conversasPfOntem / 1000, 1), 'K')
            ELSE conversasPfOntem
        END as conversasPfOntem,
        CONCAT(ROUND((conversasPf / conversasPfOntem * 100)-100,2),'%') as percentualConversas,
        CASE 
            WHEN notaMediaPf >= 1000000 THEN CONCAT(ROUND(notaMediaPf / 1000000, 1), 'M')
            WHEN notaMediaPf >= 1000 THEN CONCAT(ROUND(notaMediaPf / 1000, 1), 'K')
            ELSE notaMediaPf
        END as notaMediaPf,
        CASE 
            WHEN notaMediaPfOntem >= 1000000 THEN CONCAT(ROUND(notaMediaPfOntem / 1000000, 1), 'M')
            WHEN notaMediaPfOntem >= 1000 THEN CONCAT(ROUND(notaMediaPfOntem / 1000, 1), 'K')
            ELSE notaMediaPfOntem
        END as notaMediaPfOntem,
        CONCAT(ROUND((notaMediaPf / notaMediaPfOntem * 100)-100,2),'%') as percentualNotaMedia,
        CASE 
            WHEN totalAtivosEnviados >= 1000000 THEN CONCAT(ROUND(totalAtivosEnviados / 1000000, 1), 'M')
            WHEN totalAtivosEnviados >= 1000 THEN CONCAT(ROUND(totalAtivosEnviados / 1000, 1), 'K')
            ELSE totalAtivosEnviados
        END as totalAtivosEnviados,
        CASE 
            WHEN totalAtivosEnviadosOntem >= 1000000 THEN CONCAT(ROUND(totalAtivosEnviadosOntem / 1000000, 1), 'M')
            WHEN totalAtivosEnviadosOntem >= 1000 THEN CONCAT(ROUND(totalAtivosEnviadosOntem / 1000, 1), 'K')
            ELSE totalAtivosEnviadosOntem
        END as totalAtivosEnviadosOntem,
        CONCAT(ROUND((totalAtivosEnviados / totalAtivosEnviadosOntem * 100)-100,2),'%') as percentualTotalAtivosEnviados,
        CASE 
            WHEN totalRao >= 1000000 THEN CONCAT(ROUND(totalRao / 1000000, 1), 'M')
            WHEN totalRao >= 1000 THEN CONCAT(ROUND(totalRao / 1000, 1), 'K')
            ELSE totalRao
        END as totalRao,
        CASE 
            WHEN totalRaoOntem >= 1000000 THEN CONCAT(ROUND(totalRaoOntem / 1000000, 1), 'M')
            WHEN totalRaoOntem >= 1000 THEN CONCAT(ROUND(totalRaoOntem / 1000, 1), 'K')
            ELSE totalRaoOntem
        END as totalRaoOntem,
        CONCAT(ROUND((totalRao / totalRaoOntem * 100)-100,2),'%') as percentualTotalRao,
        CASE 
            WHEN totalAtivosSA >= 1000000 THEN CONCAT(ROUND(totalAtivosSA / 1000000, 1), 'M')
            WHEN totalAtivosSA >= 1000 THEN CONCAT(ROUND(totalAtivosSA / 1000, 1), 'K')
            ELSE round(totalAtivosSA,2)
        END as totalAtivosSA,
        CASE 
            WHEN totalAtivosSAOntem >= 1000000 THEN CONCAT(ROUND(totalAtivosSAOntem / 1000000, 1), 'M')
            WHEN totalAtivosSAOntem >= 1000 THEN CONCAT(ROUND(totalAtivosSAOntem / 1000, 1), 'K')
            ELSE round(totalAtivosSAOntem,2)
        END as totalAtivosSAOntem,
        CONCAT(ROUND((totalAtivosSA / totalAtivosSAOntem * 100)-100,2),'%') as percentualTotalAtivosSA,
        CASE 
            WHEN totalCdc >= 1000000 THEN CONCAT(ROUND(totalCdc / 1000000, 1), 'M')
            WHEN totalCdc >= 1000 THEN CONCAT(ROUND(totalCdc / 1000, 1), 'K')
            ELSE round(totalCdc,2)
        END as totalCdc,
        CASE 
            WHEN totalCdcOntem >= 1000000 THEN CONCAT(ROUND(totalCdcOntem / 1000000, 1), 'M')
            WHEN totalCdcOntem >= 1000 THEN CONCAT(ROUND(totalCdcOntem / 1000, 1), 'K')
            ELSE round(totalCdcOntem,2)
        END as totalCdcOntem,
        CONCAT(ROUND((totalCdc / totalCdcOntem * 100)-100,2),'%') as percentualTotalCdc
	FROM report.interacoesPf a
	JOIN report.usuariosPf b ON a.dataJoin = b.dataJoin
	JOIN report.conversasPf c ON a.dataJoin = c.dataJoin
	JOIN report.notaMediaPf d ON a.dataJoin = d.dataJoin
	JOIN report.totalRao e ON a.dataJoin = e.dataJoin
	JOIN report.totalAtivosSA f ON a.dataJoin = f.dataJoin
	JOIN report.totalCdc g ON a.dataJoin = g.dataJoin
	JOIN report.totalAtivosEnviados h ON a.dataJoin = h.dataJoin
	JOIN report.interacoesPfOntem i ON a.dataJoin = i.dataJoin
	JOIN report.usuariosPfOntem j ON a.dataJoin = j.dataJoin
	JOIN report.conversasPfOntem k ON a.dataJoin = k.dataJoin
	JOIN report.notaMediaPfOntem l ON a.dataJoin = l.dataJoin
	JOIN report.totalRaoOntem m ON a.dataJoin = m.dataJoin
	JOIN report.totalAtivosSAOntem n ON a.dataJoin = n.dataJoin
	JOIN report.totalCdcOntem o ON a.dataJoin = o.dataJoin
	JOIN report.totalAtivosEnviadosOntem p ON a.dataJoin = p.dataJoin;


	DROP TEMPORARY TABLE IF EXISTS report.interacoesPf;
    DROP TEMPORARY TABLE IF EXISTS report.interacoesPfOntem;
	DROP TEMPORARY TABLE IF EXISTS report.usuariosPf;
    DROP TEMPORARY TABLE IF EXISTS report.usuariosPfOntem;
	DROP TEMPORARY TABLE IF EXISTS report.conversasPf;
    DROP TEMPORARY TABLE IF EXISTS report.conversasPfOntem;
	DROP TEMPORARY TABLE IF EXISTS report.notaMediaPf;
    DROP TEMPORARY TABLE IF EXISTS report.notaMediaPfOntem;
	DROP TEMPORARY TABLE IF EXISTS report.totalRao;
    DROP TEMPORARY TABLE IF EXISTS report.totalRaoOntem;
    DROP TEMPORARY TABLE IF EXISTS report.totalAtivosSA;
    DROP TEMPORARY TABLE IF EXISTS report.totalAtivosSAOntem;
    DROP TEMPORARY TABLE IF EXISTS report.totalCdc;
    DROP TEMPORARY TABLE IF EXISTS report.totalCdcOntem;
    DROP TEMPORARY TABLE IF EXISTS report.totalAtivosEnviados;
    DROP TEMPORARY TABLE IF EXISTS report.totalAtivosEnviadosOntem;
        
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
/*!50003 DROP PROCEDURE IF EXISTS `consultaGrandesNumerosBrutos` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
DELIMITER ;;
CREATE DEFINER=`yasmin`@`%` PROCEDURE `consultaGrandesNumerosBrutos`()
BEGIN
	DECLARE dataFiltro date;
	DECLARE dataFiltroOntem date;

	SET dataFiltro = DATE_SUB(curdate(), interval 1 day);
	SET dataFiltroOntem = DATE_SUB(dataFiltro, interval 1 day);


	DROP TEMPORARY TABLE IF EXISTS report.interacoesPf;
    DROP TEMPORARY TABLE IF EXISTS report.interacoesPfOntem;
	DROP TEMPORARY TABLE IF EXISTS report.usuariosPf;
    DROP TEMPORARY TABLE IF EXISTS report.usuariosPfOntem;
	DROP TEMPORARY TABLE IF EXISTS report.conversasPf;
    DROP TEMPORARY TABLE IF EXISTS report.conversasPfOntem;
	DROP TEMPORARY TABLE IF EXISTS report.notaMediaPf;
    DROP TEMPORARY TABLE IF EXISTS report.notaMediaPfOntem;
	DROP TEMPORARY TABLE IF EXISTS report.totalRao;
    DROP TEMPORARY TABLE IF EXISTS report.totalRaoOntem;
    DROP TEMPORARY TABLE IF EXISTS report.totalAtivosSA;
    DROP TEMPORARY TABLE IF EXISTS report.totalAtivosSAOntem;
    DROP TEMPORARY TABLE IF EXISTS report.totalCdc;
    DROP TEMPORARY TABLE IF EXISTS report.totalCdcOntem;
    DROP TEMPORARY TABLE IF EXISTS report.totalAtivosEnviados;
    DROP TEMPORARY TABLE IF EXISTS report.totalAtivosEnviadosOntem;

	CREATE TEMPORARY TABLE report.interacoesPf AS
	SELECT dataFiltro as dataJoin, qtd_interacoes as interacoesPf FROM report.dados WHERE canal_bot = 'whatsapp pf' and data = dataFiltro;
    
    CREATE TEMPORARY TABLE report.interacoesPfOntem AS
	SELECT dataFiltro as dataJoin, qtd_interacoes as interacoesPfOntem FROM report.dados WHERE canal_bot = 'whatsapp pf' and data = dataFiltroOntem;

	CREATE TEMPORARY TABLE report.usuariosPf AS
	SELECT dataFiltro as dataJoin, qtd_usuarios as usuariosPf FROM report.dados WHERE canal_bot = 'whatsapp pf' and data = dataFiltro;
    
    CREATE TEMPORARY TABLE report.usuariosPfOntem AS
	SELECT dataFiltro as dataJoin, qtd_usuarios as usuariosPfOntem FROM report.dados WHERE canal_bot = 'whatsapp pf' and data = dataFiltroOntem;
    
	CREATE TEMPORARY TABLE report.conversasPf AS
	SELECT dataFiltro as dataJoin, qtd_conversas as conversasPf FROM report.dados WHERE canal_bot = 'whatsapp pf' and data = dataFiltro;
    
    CREATE TEMPORARY TABLE report.conversasPfOntem AS
	SELECT dataFiltro as dataJoin, qtd_conversas as conversasPfOntem FROM report.dados WHERE canal_bot = 'whatsapp pf' and data = dataFiltroOntem;
    
    CREATE TEMPORARY TABLE report.notaMediaPf AS
	SELECT dataFiltro as dataJoin, nota_media as notaMediaPf FROM report.base_avaliacoes WHERE canal_bot = 'whatsapp pf' and data = dataFiltro;
    
    CREATE TEMPORARY TABLE report.notaMediaPfOntem AS
	SELECT dataFiltro as dataJoin, nota_media as notaMediaPfOntem FROM report.base_avaliacoes WHERE canal_bot = 'whatsapp pf' and data = dataFiltroOntem;

	CREATE TEMPORARY TABLE report.totalAtivosEnviados AS
    SELECT dataFiltro as dataJoin, qtd_ativos_enviados as totalAtivosEnviados FROM report.base_ativos_qtd_enviados WHERE data = dataFiltro;
    
    CREATE TEMPORARY TABLE report.totalAtivosEnviadosOntem AS
    SELECT dataFiltro as dataJoin, qtd_ativos_enviados as totalAtivosEnviadosOntem FROM report.base_ativos_qtd_enviados WHERE data = dataFiltroOntem;

    CREATE TEMPORARY TABLE report.totalRao AS
    SELECT dataFiltro as dataJoin, qtde as qtdRao, /*ROUND(valor, 0) as totalRao*/ valor as totalRao FROM report.vw_wa_negociacao_consolidado WHERE data = dataFiltro AND tipo IN ('RAO','RENEG');
    
    CREATE TEMPORARY TABLE report.totalRaoOntem AS
    SELECT dataFiltro as dataJoin, valor as totalRaoOntem FROM report.vw_wa_negociacao_consolidado WHERE data = dataFiltroOntem AND tipo IN ('RAO','RENEG');
	
    CREATE TEMPORARY TABLE report.totalAtivosSA AS
    SELECT 
		dataFiltro as dataJoin, 
		ifnull((SELECT qtde FROM report.vw_wa_negociacao_consolidado WHERE data = dataFiltro AND tipo = 'ATIVOS SA'), '0') as qtdAtivos, 
        ifnull((SELECT valor FROM report.vw_wa_negociacao_consolidado WHERE data = dataFiltro AND tipo = 'ATIVOS SA'), '0') as totalAtivosSA;
        
	CREATE TEMPORARY TABLE report.totalAtivosSAOntem AS
    SELECT 
		dataFiltro as dataJoin, 
		ifnull((SELECT qtde FROM report.vw_wa_negociacao_consolidado WHERE data = dataFiltroOntem AND tipo = 'ATIVOS SA'), '0') as qtdAtivos, 
        ifnull((SELECT valor FROM report.vw_wa_negociacao_consolidado WHERE data = dataFiltroOntem AND tipo = 'ATIVOS SA'), '0') as totalAtivosSAOntem;
	
    CREATE TEMPORARY TABLE report.totalCdc AS
    SELECT dataFiltro as dataJoin, qtde as qtdCdc, /*ROUND(valor, 0) as totalCdc*/ valor as totalCdc FROM report.vw_wa_negociacao_consolidado WHERE data <= dataFiltro AND tipo = 'CDC' ORDER BY data DESC LIMIT 1;
    
    CREATE TEMPORARY TABLE report.totalCdcOntem AS
    SELECT dataFiltro as dataJoin, qtde as qtdCdc, /*ROUND(valor, 0) as totalCdc*/ valor as totalCdcOntem FROM report.vw_wa_negociacao_consolidado WHERE data <= dataFiltroOntem AND tipo = 'CDC' ORDER BY data DESC LIMIT 1;
    
    SELECT  a.dataJoin,
			totalRao,
            totalRaoOntem,
            totalAtivosSA,
            totalAtivosSAOntem,
            
        date_format(a.dataJoin, '%d/%m/%Y') as dataFormatada,
        CASE 
            WHEN interacoesPf >= 1000000 THEN CONCAT(ROUND(interacoesPf / 1000000, 1), 'M')
            WHEN interacoesPf >= 1000 THEN CONCAT(ROUND(interacoesPf / 1000, 1), 'K')
            ELSE interacoesPf
        END as interacoesPf,
        CASE 
            WHEN interacoesPfOntem >= 1000000 THEN CONCAT(ROUND(interacoesPfOntem / 1000000, 1), 'M')
            WHEN interacoesPfOntem >= 1000 THEN CONCAT(ROUND(interacoesPfOntem / 1000, 1), 'K')
            ELSE interacoesPfOntem
        END as interacoesPfOntem,
        CONCAT(ROUND((interacoesPf / interacoesPfOntem * 100)-100,2),'%') as percentualInteracoes,
        CASE 
            WHEN usuariosPf >= 1000000 THEN CONCAT(ROUND(usuariosPf / 1000000, 1), 'M')
            WHEN usuariosPf >= 1000 THEN CONCAT(ROUND(usuariosPf / 1000, 1), 'K')
            ELSE usuariosPf
        END as usuariosPf,
        CASE 
            WHEN usuariosPfOntem >= 1000000 THEN CONCAT(ROUND(usuariosPfOntem / 1000000, 1), 'M')
            WHEN usuariosPfOntem >= 1000 THEN CONCAT(ROUND(usuariosPfOntem / 1000, 1), 'K')
            ELSE usuariosPfOntem
        END as usuariosPfOntem,
        CONCAT(ROUND((usuariosPf / usuariosPfOntem * 100)-100,2),'%') as percentualUsuarios,
        CASE 
            WHEN conversasPf >= 1000000 THEN CONCAT(ROUND(conversasPf / 1000000, 1), 'M')
            WHEN conversasPf >= 1000 THEN CONCAT(ROUND(conversasPf / 1000, 1), 'K')
            ELSE conversasPf
        END as conversasPf,
        CASE 
            WHEN conversasPfOntem >= 1000000 THEN CONCAT(ROUND(conversasPfOntem / 1000000, 1), 'M')
            WHEN conversasPfOntem >= 1000 THEN CONCAT(ROUND(conversasPfOntem / 1000, 1), 'K')
            ELSE conversasPfOntem
        END as conversasPfOntem,
        CONCAT(ROUND((conversasPf / conversasPfOntem * 100)-100,2),'%') as percentualConversas,
        CASE 
            WHEN notaMediaPf >= 1000000 THEN CONCAT(ROUND(notaMediaPf / 1000000, 1), 'M')
            WHEN notaMediaPf >= 1000 THEN CONCAT(ROUND(notaMediaPf / 1000, 1), 'K')
            ELSE notaMediaPf
        END as notaMediaPf,
        CASE 
            WHEN notaMediaPfOntem >= 1000000 THEN CONCAT(ROUND(notaMediaPfOntem / 1000000, 1), 'M')
            WHEN notaMediaPfOntem >= 1000 THEN CONCAT(ROUND(notaMediaPfOntem / 1000, 1), 'K')
            ELSE notaMediaPfOntem
        END as notaMediaPfOntem,
        CONCAT(ROUND((notaMediaPf / notaMediaPfOntem * 100)-100,2),'%') as percentualNotaMedia,
        CASE 
            WHEN totalAtivosEnviados >= 1000000 THEN CONCAT(ROUND(totalAtivosEnviados / 1000000, 1), 'M')
            WHEN totalAtivosEnviados >= 1000 THEN CONCAT(ROUND(totalAtivosEnviados / 1000, 1), 'K')
            ELSE totalAtivosEnviados
        END as totalAtivosEnviados,
        CASE 
            WHEN totalAtivosEnviadosOntem >= 1000000 THEN CONCAT(ROUND(totalAtivosEnviadosOntem / 1000000, 1), 'M')
            WHEN totalAtivosEnviadosOntem >= 1000 THEN CONCAT(ROUND(totalAtivosEnviadosOntem / 1000, 1), 'K')
            ELSE totalAtivosEnviadosOntem
        END as totalAtivosEnviadosOntem,
        CONCAT(ROUND((totalAtivosEnviados / totalAtivosEnviadosOntem * 100)-100,2),'%') as percentualTotalAtivosEnviados,
      
        CASE 
            WHEN totalAtivosSAOntem >= 1000000 THEN CONCAT(ROUND(totalAtivosSAOntem / 1000000, 1), 'M')
            WHEN totalAtivosSAOntem >= 1000 THEN CONCAT(ROUND(totalAtivosSAOntem / 1000, 1), 'K')
            ELSE round(totalAtivosSAOntem,2)
        END as totalAtivosSAOntem,
        CONCAT(ROUND((totalAtivosSA / totalAtivosSAOntem * 100)-100,2),'%') as percentualTotalAtivosSA,
        CASE 
            WHEN totalCdc >= 1000000 THEN CONCAT(ROUND(totalCdc / 1000000, 1), 'M')
            WHEN totalCdc >= 1000 THEN CONCAT(ROUND(totalCdc / 1000, 1), 'K')
            ELSE round(totalCdc,2)
        END as totalCdc,
        CASE 
            WHEN totalCdcOntem >= 1000000 THEN CONCAT(ROUND(totalCdcOntem / 1000000, 1), 'M')
            WHEN totalCdcOntem >= 1000 THEN CONCAT(ROUND(totalCdcOntem / 1000, 1), 'K')
            ELSE round(totalCdcOntem,2)
        END as totalCdcOntem,
        CONCAT(ROUND((totalCdc / totalCdcOntem * 100)-100,2),'%') as percentualTotalCdc
	FROM report.interacoesPf a
	JOIN report.usuariosPf b ON a.dataJoin = b.dataJoin
	JOIN report.conversasPf c ON a.dataJoin = c.dataJoin
	JOIN report.notaMediaPf d ON a.dataJoin = d.dataJoin
	JOIN report.totalRao e ON a.dataJoin = e.dataJoin
	JOIN report.totalAtivosSA f ON a.dataJoin = f.dataJoin
	JOIN report.totalCdc g ON a.dataJoin = g.dataJoin
	JOIN report.totalAtivosEnviados h ON a.dataJoin = h.dataJoin
	JOIN report.interacoesPfOntem i ON a.dataJoin = i.dataJoin
	JOIN report.usuariosPfOntem j ON a.dataJoin = j.dataJoin
	JOIN report.conversasPfOntem k ON a.dataJoin = k.dataJoin
	JOIN report.notaMediaPfOntem l ON a.dataJoin = l.dataJoin
	JOIN report.totalRaoOntem m ON a.dataJoin = m.dataJoin
	JOIN report.totalAtivosSAOntem n ON a.dataJoin = n.dataJoin
	JOIN report.totalCdcOntem o ON a.dataJoin = o.dataJoin
	JOIN report.totalAtivosEnviadosOntem p ON a.dataJoin = p.dataJoin;


	DROP TEMPORARY TABLE IF EXISTS report.interacoesPf;
    DROP TEMPORARY TABLE IF EXISTS report.interacoesPfOntem;
	DROP TEMPORARY TABLE IF EXISTS report.usuariosPf;
    DROP TEMPORARY TABLE IF EXISTS report.usuariosPfOntem;
	DROP TEMPORARY TABLE IF EXISTS report.conversasPf;
    DROP TEMPORARY TABLE IF EXISTS report.conversasPfOntem;
	DROP TEMPORARY TABLE IF EXISTS report.notaMediaPf;
    DROP TEMPORARY TABLE IF EXISTS report.notaMediaPfOntem;
	DROP TEMPORARY TABLE IF EXISTS report.totalRao;
    DROP TEMPORARY TABLE IF EXISTS report.totalRaoOntem;
    DROP TEMPORARY TABLE IF EXISTS report.totalAtivosSA;
    DROP TEMPORARY TABLE IF EXISTS report.totalAtivosSAOntem;
    DROP TEMPORARY TABLE IF EXISTS report.totalCdc;
    DROP TEMPORARY TABLE IF EXISTS report.totalCdcOntem;
    DROP TEMPORARY TABLE IF EXISTS report.totalAtivosEnviados;
    DROP TEMPORARY TABLE IF EXISTS report.totalAtivosEnviadosOntem;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
/*!50003 DROP PROCEDURE IF EXISTS `consultaGrandesNumerosBrutos_teste` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
DELIMITER ;;
CREATE DEFINER=`yasmin`@`%` PROCEDURE `consultaGrandesNumerosBrutos_teste`()
BEGIN
	DECLARE dataFiltro date;
	DECLARE dataFiltroOntem date;

	SET dataFiltro = DATE_SUB(curdate(), interval 1 day);
	SET dataFiltroOntem = DATE_SUB(dataFiltro, interval 1 day);


	DROP TEMPORARY TABLE IF EXISTS report.interacoesPf;
    DROP TEMPORARY TABLE IF EXISTS report.interacoesPfOntem;
	DROP TEMPORARY TABLE IF EXISTS report.usuariosPf;
    DROP TEMPORARY TABLE IF EXISTS report.usuariosPfOntem;
	DROP TEMPORARY TABLE IF EXISTS report.conversasPf;
    DROP TEMPORARY TABLE IF EXISTS report.conversasPfOntem;
	DROP TEMPORARY TABLE IF EXISTS report.notaMediaPf;
    DROP TEMPORARY TABLE IF EXISTS report.notaMediaPfOntem;
	DROP TEMPORARY TABLE IF EXISTS report.totalRao;
    DROP TEMPORARY TABLE IF EXISTS report.totalRaoOntem;
    DROP TEMPORARY TABLE IF EXISTS report.totalAtivosSA;
    DROP TEMPORARY TABLE IF EXISTS report.totalAtivosSAOntem;
    DROP TEMPORARY TABLE IF EXISTS report.totalCdc;
    DROP TEMPORARY TABLE IF EXISTS report.totalCdcOntem;
    DROP TEMPORARY TABLE IF EXISTS report.totalAtivosEnviados;
    DROP TEMPORARY TABLE IF EXISTS report.totalAtivosEnviadosOntem;

	CREATE TEMPORARY TABLE report.interacoesPf AS
	SELECT dataFiltro as dataJoin, qtd_interacoes as interacoesPf FROM report.dados WHERE canal_bot = 'whatsapp pf' and data = dataFiltro;
    
    CREATE TEMPORARY TABLE report.interacoesPfOntem AS
	SELECT dataFiltro as dataJoin, qtd_interacoes as interacoesPfOntem FROM report.dados WHERE canal_bot = 'whatsapp pf' and data = dataFiltroOntem;

	CREATE TEMPORARY TABLE report.usuariosPf AS
	SELECT dataFiltro as dataJoin, qtd_usuarios as usuariosPf FROM report.dados WHERE canal_bot = 'whatsapp pf' and data = dataFiltro;
    
    CREATE TEMPORARY TABLE report.usuariosPfOntem AS
	SELECT dataFiltro as dataJoin, qtd_usuarios as usuariosPfOntem FROM report.dados WHERE canal_bot = 'whatsapp pf' and data = dataFiltroOntem;
    
	CREATE TEMPORARY TABLE report.conversasPf AS
	SELECT dataFiltro as dataJoin, qtd_conversas as conversasPf FROM report.dados WHERE canal_bot = 'whatsapp pf' and data = dataFiltro;
    
    CREATE TEMPORARY TABLE report.conversasPfOntem AS
	SELECT dataFiltro as dataJoin, qtd_conversas as conversasPfOntem FROM report.dados WHERE canal_bot = 'whatsapp pf' and data = dataFiltroOntem;
    
    CREATE TEMPORARY TABLE report.notaMediaPf AS
	SELECT dataFiltro as dataJoin, nota_media as notaMediaPf FROM report.base_avaliacoes WHERE canal_bot = 'whatsapp pf' and data = dataFiltro;
    
    CREATE TEMPORARY TABLE report.notaMediaPfOntem AS
	SELECT dataFiltro as dataJoin, nota_media as notaMediaPfOntem FROM report.base_avaliacoes WHERE canal_bot = 'whatsapp pf' and data = dataFiltroOntem;

	CREATE TEMPORARY TABLE report.totalAtivosEnviados AS
    SELECT dataFiltro as dataJoin, qtd_ativos_enviados as totalAtivosEnviados FROM report.base_ativos_qtd_enviados WHERE data = dataFiltro;
    
    CREATE TEMPORARY TABLE report.totalAtivosEnviadosOntem AS
    SELECT dataFiltro as dataJoin, qtd_ativos_enviados as totalAtivosEnviadosOntem FROM report.base_ativos_qtd_enviados WHERE data = dataFiltroOntem;

    CREATE TEMPORARY TABLE report.totalRao AS
    SELECT dataFiltro as dataJoin, qtde as qtdRao, /*ROUND(valor, 0) as totalRao*/ valor as totalRao FROM report.vw_wa_negociacao_consolidado WHERE data = dataFiltro AND tipo IN ('RAO','RENEG');
    
    CREATE TEMPORARY TABLE report.totalRaoOntem AS
    SELECT dataFiltro as dataJoin, valor as totalRaoOntem FROM report.vw_wa_negociacao_consolidado WHERE data = dataFiltroOntem AND tipo IN ('RAO','RENEG');
	
    CREATE TEMPORARY TABLE report.totalAtivosSA AS
    SELECT 
		dataFiltro as dataJoin, 
		ifnull((SELECT qtde FROM report.vw_wa_negociacao_consolidado WHERE data = dataFiltro AND tipo = 'ATIVOS SA'), '0') as qtdAtivos, 
        ifnull((SELECT valor FROM report.vw_wa_negociacao_consolidado WHERE data = dataFiltro AND tipo = 'ATIVOS SA'), '0') as totalAtivosSA;
        
	CREATE TEMPORARY TABLE report.totalAtivosSAOntem AS
    SELECT 
		dataFiltro as dataJoin, 
		ifnull((SELECT qtde FROM report.vw_wa_negociacao_consolidado WHERE data = dataFiltroOntem AND tipo = 'ATIVOS SA'), '0') as qtdAtivos, 
        ifnull((SELECT valor FROM report.vw_wa_negociacao_consolidado WHERE data = dataFiltroOntem AND tipo = 'ATIVOS SA'), '0') as totalAtivosSAOntem;
	
    CREATE TEMPORARY TABLE report.totalCdc AS
    SELECT dataFiltro as dataJoin, qtde as qtdCdc, /*ROUND(valor, 0) as totalCdc*/ valor as totalCdc FROM report.vw_wa_negociacao_consolidado WHERE data <= dataFiltro AND tipo = 'CDC' ORDER BY data DESC LIMIT 1;
    
    CREATE TEMPORARY TABLE report.totalCdcOntem AS
    SELECT dataFiltro as dataJoin, qtde as qtdCdc, /*ROUND(valor, 0) as totalCdc*/ valor as totalCdcOntem FROM report.vw_wa_negociacao_consolidado WHERE data <= dataFiltroOntem AND tipo = 'CDC' ORDER BY data DESC LIMIT 1;
    
    SELECT  a.dataJoin,
			totalRao,
            totalRaoOntem,
            totalAtivosSA,
            totalAtivosSAOntem,
        date_format(a.dataJoin, '%d/%m/%Y') as dataFormatada,
		CASE 
			WHEN (totalRao + totalAtivosSA) >= 1000000 THEN CONCAT(ROUND((totalRao + totalAtivosSA) / 1000000, 1), 'M')
			WHEN (totalRao + totalAtivosSA) >= 1000 THEN CONCAT(ROUND((totalRao + totalAtivosSA) / 1000, 1), 'K')
			ELSE (totalRao + totalAtivosSA)
		END as totalReneg,
		CASE 
			WHEN (totalRaoOntem + totalAtivosSAOntem) >= 1000000 THEN CONCAT(ROUND((totalRaoOntem + totalAtivosSAOntem) / 1000000, 1), 'M')
			WHEN (totalRaoOntem + totalAtivosSAOntem) >= 1000 THEN CONCAT(ROUND((totalRaoOntem + totalAtivosSAOntem) / 1000, 1), 'K')
			ELSE (totalRaoOntem + totalAtivosSAOntem)
			END as totalRenegOntem,
		CONCAT(ROUND((((totalRao + totalAtivosSA) / (totalRaoOntem + totalAtivosSAOntem)) * 100) - 100,2),'%') as percentualReneg,
        CASE 
            WHEN interacoesPf >= 1000000 THEN CONCAT(ROUND(interacoesPf / 1000000, 1), 'M')
            WHEN interacoesPf >= 1000 THEN CONCAT(ROUND(interacoesPf / 1000, 1), 'K')
            ELSE interacoesPf
        END as interacoesPf,
        CASE 
            WHEN interacoesPfOntem >= 1000000 THEN CONCAT(ROUND(interacoesPfOntem / 1000000, 1), 'M')
            WHEN interacoesPfOntem >= 1000 THEN CONCAT(ROUND(interacoesPfOntem / 1000, 1), 'K')
            ELSE interacoesPfOntem
        END as interacoesPfOntem,
        CONCAT(ROUND((interacoesPf / interacoesPfOntem * 100)-100,2),'%') as percentualInteracoes,
        CASE 
            WHEN usuariosPf >= 1000000 THEN CONCAT(ROUND(usuariosPf / 1000000, 1), 'M')
            WHEN usuariosPf >= 1000 THEN CONCAT(ROUND(usuariosPf / 1000, 1), 'K')
            ELSE usuariosPf
        END as usuariosPf,
        CASE 
            WHEN usuariosPfOntem >= 1000000 THEN CONCAT(ROUND(usuariosPfOntem / 1000000, 1), 'M')
            WHEN usuariosPfOntem >= 1000 THEN CONCAT(ROUND(usuariosPfOntem / 1000, 1), 'K')
            ELSE usuariosPfOntem
        END as usuariosPfOntem,
        CONCAT(ROUND((usuariosPf / usuariosPfOntem * 100)-100,2),'%') as percentualUsuarios,
        CASE 
            WHEN conversasPf >= 1000000 THEN CONCAT(ROUND(conversasPf / 1000000, 1), 'M')
            WHEN conversasPf >= 1000 THEN CONCAT(ROUND(conversasPf / 1000, 1), 'K')
            ELSE conversasPf
        END as conversasPf,
        CASE 
            WHEN conversasPfOntem >= 1000000 THEN CONCAT(ROUND(conversasPfOntem / 1000000, 1), 'M')
            WHEN conversasPfOntem >= 1000 THEN CONCAT(ROUND(conversasPfOntem / 1000, 1), 'K')
            ELSE conversasPfOntem
        END as conversasPfOntem,
        CONCAT(ROUND((conversasPf / conversasPfOntem * 100)-100,2),'%') as percentualConversas,
        CASE 
            WHEN notaMediaPf >= 1000000 THEN CONCAT(ROUND(notaMediaPf / 1000000, 1), 'M')
            WHEN notaMediaPf >= 1000 THEN CONCAT(ROUND(notaMediaPf / 1000, 1), 'K')
            ELSE notaMediaPf
        END as notaMediaPf,
        CASE 
            WHEN notaMediaPfOntem >= 1000000 THEN CONCAT(ROUND(notaMediaPfOntem / 1000000, 1), 'M')
            WHEN notaMediaPfOntem >= 1000 THEN CONCAT(ROUND(notaMediaPfOntem / 1000, 1), 'K')
            ELSE notaMediaPfOntem
        END as notaMediaPfOntem,
        CONCAT(ROUND((notaMediaPf / notaMediaPfOntem * 100)-100,2),'%') as percentualNotaMedia,
        CASE 
            WHEN totalAtivosEnviados >= 1000000 THEN CONCAT(ROUND(totalAtivosEnviados / 1000000, 1), 'M')
            WHEN totalAtivosEnviados >= 1000 THEN CONCAT(ROUND(totalAtivosEnviados / 1000, 1), 'K')
            ELSE totalAtivosEnviados
        END as totalAtivosEnviados,
        CASE 
            WHEN totalAtivosEnviadosOntem >= 1000000 THEN CONCAT(ROUND(totalAtivosEnviadosOntem / 1000000, 1), 'M')
            WHEN totalAtivosEnviadosOntem >= 1000 THEN CONCAT(ROUND(totalAtivosEnviadosOntem / 1000, 1), 'K')
            ELSE totalAtivosEnviadosOntem
        END as totalAtivosEnviadosOntem,
        CONCAT(ROUND((totalAtivosEnviados / totalAtivosEnviadosOntem * 100)-100,2),'%') as percentualTotalAtivosEnviados,
      
        CASE 
            WHEN totalAtivosSAOntem >= 1000000 THEN CONCAT(ROUND(totalAtivosSAOntem / 1000000, 1), 'M')
            WHEN totalAtivosSAOntem >= 1000 THEN CONCAT(ROUND(totalAtivosSAOntem / 1000, 1), 'K')
            ELSE round(totalAtivosSAOntem,2)
        END as totalAtivosSAOntem,
        CONCAT(ROUND((totalAtivosSA / totalAtivosSAOntem * 100)-100,2),'%') as percentualTotalAtivosSA,
        CASE 
            WHEN totalCdc >= 1000000 THEN CONCAT(ROUND(totalCdc / 1000000, 1), 'M')
            WHEN totalCdc >= 1000 THEN CONCAT(ROUND(totalCdc / 1000, 1), 'K')
            ELSE round(totalCdc,2)
        END as totalCdc,
        CASE 
            WHEN totalCdcOntem >= 1000000 THEN CONCAT(ROUND(totalCdcOntem / 1000000, 1), 'M')
            WHEN totalCdcOntem >= 1000 THEN CONCAT(ROUND(totalCdcOntem / 1000, 1), 'K')
            ELSE round(totalCdcOntem,2)
        END as totalCdcOntem,
        CONCAT(ROUND((totalCdc / totalCdcOntem * 100)-100,2),'%') as percentualTotalCdc
	FROM report.interacoesPf a
	JOIN report.usuariosPf b ON a.dataJoin = b.dataJoin
	JOIN report.conversasPf c ON a.dataJoin = c.dataJoin
	JOIN report.notaMediaPf d ON a.dataJoin = d.dataJoin
	JOIN report.totalRao e ON a.dataJoin = e.dataJoin
	JOIN report.totalAtivosSA f ON a.dataJoin = f.dataJoin
	JOIN report.totalCdc g ON a.dataJoin = g.dataJoin
	JOIN report.totalAtivosEnviados h ON a.dataJoin = h.dataJoin
	JOIN report.interacoesPfOntem i ON a.dataJoin = i.dataJoin
	JOIN report.usuariosPfOntem j ON a.dataJoin = j.dataJoin
	JOIN report.conversasPfOntem k ON a.dataJoin = k.dataJoin
	JOIN report.notaMediaPfOntem l ON a.dataJoin = l.dataJoin
	JOIN report.totalRaoOntem m ON a.dataJoin = m.dataJoin
	JOIN report.totalAtivosSAOntem n ON a.dataJoin = n.dataJoin
	JOIN report.totalCdcOntem o ON a.dataJoin = o.dataJoin
	JOIN report.totalAtivosEnviadosOntem p ON a.dataJoin = p.dataJoin;


	DROP TEMPORARY TABLE IF EXISTS report.interacoesPf;
    DROP TEMPORARY TABLE IF EXISTS report.interacoesPfOntem;
	DROP TEMPORARY TABLE IF EXISTS report.usuariosPf;
    DROP TEMPORARY TABLE IF EXISTS report.usuariosPfOntem;
	DROP TEMPORARY TABLE IF EXISTS report.conversasPf;
    DROP TEMPORARY TABLE IF EXISTS report.conversasPfOntem;
	DROP TEMPORARY TABLE IF EXISTS report.notaMediaPf;
    DROP TEMPORARY TABLE IF EXISTS report.notaMediaPfOntem;
	DROP TEMPORARY TABLE IF EXISTS report.totalRao;
    DROP TEMPORARY TABLE IF EXISTS report.totalRaoOntem;
    DROP TEMPORARY TABLE IF EXISTS report.totalAtivosSA;
    DROP TEMPORARY TABLE IF EXISTS report.totalAtivosSAOntem;
    DROP TEMPORARY TABLE IF EXISTS report.totalCdc;
    DROP TEMPORARY TABLE IF EXISTS report.totalCdcOntem;
    DROP TEMPORARY TABLE IF EXISTS report.totalAtivosEnviados;
    DROP TEMPORARY TABLE IF EXISTS report.totalAtivosEnviadosOntem;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
/*!50003 DROP PROCEDURE IF EXISTS `cosultaGrandesNumeros` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
DELIMITER ;;
CREATE DEFINER=`albert`@`%` PROCEDURE `cosultaGrandesNumeros`(dataFiltro date)
BEGIN

DECLARE dataFiltroOntem date;
SET dataFiltroOntem = DATE_SUB(dataFiltro, interval 1 day);

SELECT dataFiltro, dataFiltroOntem;

	DROP TEMPORARY TABLE IF EXISTS report.interacoesPf;
	DROP TEMPORARY TABLE IF EXISTS report.usuariosPf;
	DROP TEMPORARY TABLE IF EXISTS report.conversasPf;
	DROP TEMPORARY TABLE IF EXISTS report.notaMediaPf;
	DROP TEMPORARY TABLE IF EXISTS report.totalRao;
    DROP TEMPORARY TABLE IF EXISTS report.totalAtivosSA;
    DROP TEMPORARY TABLE IF EXISTS report.totalCdc;
    DROP TEMPORARY TABLE IF EXISTS report.totalAtivosEnviados;


	CREATE TEMPORARY TABLE report.interacoesPf AS
	SELECT dataFiltro as dataJoin, qtd_interacoes as interacoesPf FROM report.dados WHERE canal_bot = 'whatsapp pf' and data = dataFiltro;

	CREATE TEMPORARY TABLE report.usuariosPf AS
	SELECT dataFiltro as dataJoin, qtd_usuarios as usuariosPf FROM report.dados WHERE canal_bot = 'whatsapp pf' and data = dataFiltro;
    
	CREATE TEMPORARY TABLE report.conversasPf AS
	SELECT dataFiltro as dataJoin, qtd_conversas as conversasPf FROM report.dados WHERE canal_bot = 'whatsapp pf' and data = dataFiltro;
    
    CREATE TEMPORARY TABLE report.notaMediaPf AS
	SELECT dataFiltro as dataJoin, nota_media as notaMediaPf, qtd_avaliacoes AS qtdAvaliacoesPf FROM report.base_avaliacoes WHERE canal_bot = 'whatsapp pf' and data = dataFiltro;

	CREATE TEMPORARY TABLE report.totalAtivosEnviados AS
    SELECT dataFiltro as dataJoin, qtd_ativos_enviados as totalAtivosEnviados FROM report.base_ativos_qtd_enviados WHERE data = dataFiltro;

    CREATE TEMPORARY TABLE report.totalRao AS
    SELECT dataFiltro as dataJoin, qtde as qtdRao, /*ROUND(valor, 0) as totalRao*/ valor as totalRao FROM report.vw_wa_negociacao_consolidado WHERE data = dataFiltro AND tipo IN ('RAO','RENEG');
	
    CREATE TEMPORARY TABLE report.totalAtivosSA AS
    SELECT 
		dataFiltro as dataJoin, 
		ifnull((SELECT qtde FROM report.vw_wa_negociacao_consolidado WHERE data = dataFiltro AND tipo = 'ATIVOS SA'), '0') as qtdAtivos, 
        ifnull((SELECT valor FROM report.vw_wa_negociacao_consolidado WHERE data = dataFiltro AND tipo = 'ATIVOS SA'), '0') as totalAtivosSA;
	
    CREATE TEMPORARY TABLE report.totalCdc AS
    SELECT dataFiltro as dataJoin, qtde as qtdCdc, /*ROUND(valor, 0) as totalCdc*/ valor as totalCdc FROM report.vw_wa_negociacao_consolidado WHERE data <= dataFiltro AND tipo = 'CDC' ORDER BY data DESC LIMIT 1;
    
    
    
    SELECT 	a.dataJoin,
		date_format(a.dataJoin, '%d/%m/%Y') as dataFormatada,
		interacoesPf,
		usuariosPf,
		conversasPf,
		notaMediaPf,
        totalAtivosEnviados,
		totalRao,
        round(totalAtivosSA,2) as totalAtivosSA,
        round(totalCdc,2) as totalCdc        
	FROM report.interacoesPf a
	JOIN report.usuariosPf b ON a.dataJoin = b.dataJoin
	JOIN report.conversasPf c ON a.dataJoin = c.dataJoin
	JOIN report.notaMediaPf d ON a.dataJoin = d.dataJoin
    JOIN report.totalRao e ON a.dataJoin = e.dataJoin
    JOIN report.totalAtivosSA f ON a.dataJoin = f.dataJoin
    JOIN report.totalCdc g ON a.dataJoin = g.dataJoin
    JOIN report.totalAtivosEnviados h ON a.dataJoin = h.dataJoin;

	DROP TEMPORARY TABLE IF EXISTS report.interacoesPf;
	DROP TEMPORARY TABLE IF EXISTS report.usuariosPf;
	DROP TEMPORARY TABLE IF EXISTS report.conversasPf;
	DROP TEMPORARY TABLE IF EXISTS report.notaMediaPf;
	DROP TEMPORARY TABLE IF EXISTS report.totalRao;
    DROP TEMPORARY TABLE IF EXISTS report.totalAtivosSA;
    DROP TEMPORARY TABLE IF EXISTS report.totalCdc;
    DROP TEMPORARY TABLE IF EXISTS report.totalAtivosEnviados;
        
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

-- Dump completed on 2025-08-20  0:19:15
