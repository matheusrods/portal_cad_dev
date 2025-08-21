/*M!999999\- enable the sandbox mode */ 
-- MariaDB dump 10.19  Distrib 10.11.11-MariaDB, for Linux (x86_64)
--
-- Host: 127.0.0.1    Database: solicitacoes
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
-- Current Database: `solicitacoes`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `solicitacoes` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;

USE `solicitacoes`;

--
-- Table structure for table `analiseInteligenciaArtificial`
--

DROP TABLE IF EXISTS `analiseInteligenciaArtificial`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `analiseInteligenciaArtificial` (
  `idSolicitacao` int(11) NOT NULL,
  `perguntaResposta` text DEFAULT NULL,
  `timestampPerguntaResposta` datetime NOT NULL,
  `analiseInteligênciaArtificial` text DEFAULT NULL,
  `timestampAnalise` datetime DEFAULT NULL,
  `resumoDemanda` text DEFAULT NULL,
  `classificacaoFinal` varchar(10) DEFAULT NULL,
  `justificativa` text DEFAULT NULL,
  `resultadoFinal` text DEFAULT NULL,
  `historia` text DEFAULT NULL,
  `criteriosAceitacao` text DEFAULT NULL,
  `cenariosTeste` text DEFAULT NULL,
  `ativo` int(11) DEFAULT 1,
  PRIMARY KEY (`idSolicitacao`,`timestampPerguntaResposta`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `comentarioAnaliseCad`
--

DROP TABLE IF EXISTS `comentarioAnaliseCad`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `comentarioAnaliseCad` (
  `idComentario` int(11) NOT NULL AUTO_INCREMENT,
  `idSolicitacao` int(11) DEFAULT NULL,
  `comentario` text DEFAULT NULL,
  `matComentario` varchar(8) DEFAULT NULL,
  `nomeComentario` varchar(500) DEFAULT NULL,
  `timestampComentario` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`idComentario`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `duvidaFormulario`
--

DROP TABLE IF EXISTS `duvidaFormulario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `duvidaFormulario` (
  `id` int(11) NOT NULL,
  `iconeDuvidaFormulario` varchar(2500) DEFAULT NULL,
  `textoDuvidaFormulario` varchar(2500) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `etapaFormularios`
--

DROP TABLE IF EXISTS `etapaFormularios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `etapaFormularios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `etapaFormulario` text DEFAULT NULL,
  `ordemExibicao` int(11) DEFAULT NULL,
  `chamadoPor` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=205 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `opcoesFormularios`
--

DROP TABLE IF EXISTS `opcoesFormularios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `opcoesFormularios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idFormulario` int(11) DEFAULT NULL,
  `textoOpcao` varchar(500) DEFAULT NULL,
  `proximaEtapaFormulario` int(11) DEFAULT NULL,
  `ordem` int(11) DEFAULT NULL,
  `campoDuvida` varchar(2500) DEFAULT NULL,
  `textoDuvida` varchar(2500) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `parecerFinalCad`
--

DROP TABLE IF EXISTS `parecerFinalCad`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `parecerFinalCad` (
  `idSolicitacao` int(11) NOT NULL,
  `parecerFinal` text DEFAULT NULL,
  `matricula` varchar(8) DEFAULT NULL,
  `timestamp` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`idSolicitacao`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `respostasJornadasInformacionais`
--

DROP TABLE IF EXISTS `respostasJornadasInformacionais`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `respostasJornadasInformacionais` (
  `idSolicitacao` int(11) NOT NULL,
  `canalTransacao` varchar(500) DEFAULT NULL,
  `atendeRa` varchar(10) DEFAULT NULL,
  `especificoWhatsapp` varchar(10) DEFAULT NULL,
  `assuntoJornada` varchar(500) DEFAULT NULL,
  `objetivoJornada` varchar(500) DEFAULT NULL,
  `metricaSucesso` varchar(500) DEFAULT NULL,
  `resultadoProjetado` varchar(500) DEFAULT NULL,
  `acompanhamentoMetrica` varchar(500) DEFAULT NULL,
  `estimuloConsumoTransacao` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`idSolicitacao`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`albert`@`%`*/ /*!50003 TRIGGER after_insert_respostasJornadasInformacionais
AFTER INSERT ON solicitacoes.respostasJornadasInformacionais
FOR EACH ROW
BEGIN
    DECLARE perguntaResposta TEXT;
    DECLARE canalTransacao TEXT;
    DECLARE atendeRa TEXT;
    DECLARE especificoWhatsapp TEXT;
    DECLARE assuntoJornada TEXT;
    DECLARE objetivoJornada TEXT;
    DECLARE metricaSucesso TEXT;
    DECLARE resultadoProjetado TEXT;
    DECLARE acompanhamentoMetrica TEXT;
    DECLARE estimuloConsumoTransacao TEXT;
    DECLARE CONTINUE HANDLER FOR NOT FOUND SET canalTransacao = NULL;

    -- Obter os valores necessários
    SELECT 
        a.canalTransacao, 
        a.atendeRa, 
        a.especificoWhatsapp, 
        a.assuntoJornada, 
        a.objetivoJornada, 
        a.metricaSucesso, 
        a.resultadoProjetado, 
        a.acompanhamentoMetrica, 
        a.estimuloConsumoTransacao
    INTO 
        canalTransacao, 
        atendeRa, 
        especificoWhatsapp, 
        assuntoJornada, 
        objetivoJornada, 
        metricaSucesso, 
        resultadoProjetado, 
        acompanhamentoMetrica, 
        estimuloConsumoTransacao
    FROM solicitacoes.respostasJornadasInformacionais a
    LEFT JOIN solicitacoes.solicitacoes b ON a.idSolicitacao = b.idSolicitacao 
    WHERE a.idSolicitacao = NEW.idSolicitacao;

    -- Concatenar os valores na variável perguntaResposta
    SET perguntaResposta = CONCAT(
		CONCAT('<pergunta>Tipo de jornada:</pergunta><resposta>Jornada Informacional</resposta>'),
        CONCAT('<pergunta>Em qual canal deseja incluir a transação?</pergunta><resposta>', IFNULL(canalTransacao, 'N/A'), '</resposta>'),
        CONCAT('<pergunta>A transação visa atender RA (Recomendação de auditoria) e/ou Regulatório?</pergunta><resposta>', IFNULL(atendeRa, 'N/A'), '</resposta>'),
        IF(atendeRa = 'sim', CONCAT('<pergunta>A RA, regulamento ou lei especifica que a transação deve ser disponibilizada no WhatsApp?</pergunta><resposta>', IFNULL(especificoWhatsapp, 'N/A'), '</resposta>'), ''),
        CONCAT('<pergunta>Qual o assunto principal da transação?</pergunta><resposta>', IFNULL(assuntoJornada, 'N/A'), '</resposta>'),
        CONCAT('<pergunta>Qual o objetivo da transação?</pergunta><resposta>', IFNULL(objetivoJornada, 'N/A'), '</resposta>'),
        CONCAT('<pergunta>Qual será a métrica de sucesso da transação no canal?</pergunta><resposta>', IFNULL(metricaSucesso, 'N/A'), '</resposta>'),
        CONCAT('<pergunta>Qual o resultado projetado nos primeiros 6 meses com a implementação?</pergunta><resposta>', IFNULL(resultadoProjetado, 'N/A'), '</resposta>'),
        CONCAT('<pergunta>Como será feito o acompanhamento dessa(s) métrica(s) de sucesso?</pergunta><resposta>', IFNULL(acompanhamentoMetrica, 'N/A'), '</resposta>'),
        CONCAT('<pergunta>Como o público-alvo será estimulado a consumir essa transação no canal?</pergunta><resposta>', IFNULL(estimuloConsumoTransacao, 'N/A'), '</resposta>')
    );

    -- Inserir o resultado na tabela de análise
    INSERT INTO solicitacoes.analiseInteligenciaArtificial (idSolicitacao, perguntaResposta, timestampPerguntaResposta)
    VALUES (NEW.idSolicitacao, perguntaResposta, NOW());
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`albert`@`%`*/ /*!50003 TRIGGER `solicitacoes`.`respostasJornadasInformacionais_AFTER_UPDATE` AFTER UPDATE ON `respostasJornadasInformacionais` FOR EACH ROW

BEGIN
    DECLARE v_idSolicitacao INT;
    
    DECLARE perguntaResposta TEXT;
    DECLARE canalTransacao TEXT;
    DECLARE atendeRa TEXT;
    DECLARE especificoWhatsapp TEXT;
    DECLARE assuntoJornada TEXT;
    DECLARE objetivoJornada TEXT;
    DECLARE metricaSucesso TEXT;
    DECLARE resultadoProjetado TEXT;
    DECLARE acompanhamentoMetrica TEXT;
    DECLARE estimuloConsumoTransacao TEXT;
    DECLARE CONTINUE HANDLER FOR NOT FOUND SET canalTransacao = NULL;
    
    -- Obter o idSolicitacao da nova linha que está sendo inserida
    SET v_idSolicitacao = NEW.idSolicitacao;
    
    -- Verificar se existe uma linha ativa na tabela analiseInteligenciaArtificial
    IF EXISTS (SELECT 1 FROM solicitacoes.analiseInteligenciaArtificial 
               WHERE idSolicitacao = v_idSolicitacao AND ativo = 1) THEN
        -- Atualizar o campo ativo para 0
        UPDATE solicitacoes.analiseInteligenciaArtificial
        SET ativo = 0
        WHERE idSolicitacao = v_idSolicitacao AND ativo = 1;
    END IF;
    
    

    -- Obter os valores necessários
    SELECT 
        a.canalTransacao, 
        a.atendeRa, 
        a.especificoWhatsapp, 
        a.assuntoJornada, 
        a.objetivoJornada, 
        a.metricaSucesso, 
        a.resultadoProjetado, 
        a.acompanhamentoMetrica, 
        a.estimuloConsumoTransacao
    INTO 
        canalTransacao, 
        atendeRa, 
        especificoWhatsapp, 
        assuntoJornada, 
        objetivoJornada, 
        metricaSucesso, 
        resultadoProjetado, 
        acompanhamentoMetrica, 
        estimuloConsumoTransacao
    FROM solicitacoes.respostasJornadasInformacionais a
    LEFT JOIN solicitacoes.solicitacoes b ON a.idSolicitacao = b.idSolicitacao 
    WHERE a.idSolicitacao = NEW.idSolicitacao;

    -- Concatenar os valores na variável perguntaResposta
    SET perguntaResposta = CONCAT(
		CONCAT('<pergunta>Tipo de jornada:</pergunta><resposta>Jornada Informacional</resposta>'),
        CONCAT('<pergunta>Em qual canal deseja incluir a transação?</pergunta><resposta>', IFNULL(canalTransacao, 'N/A'), '</resposta>'),
        CONCAT('<pergunta>A transação visa atender RA (Recomendação de auditoria) e/ou Regulatório?</pergunta><resposta>', IFNULL(atendeRa, 'N/A'), '</resposta>'),
        IF(atendeRa = 'sim', CONCAT('<pergunta>A RA, regulamento ou lei especifica que a transação deve ser disponibilizada no WhatsApp?</pergunta><resposta>', IFNULL(especificoWhatsapp, 'N/A'), '</resposta>'), ''),
        CONCAT('<pergunta>Qual o assunto principal da transação?</pergunta><resposta>', IFNULL(assuntoJornada, 'N/A'), '</resposta>'),
        CONCAT('<pergunta>Qual o objetivo da transação?</pergunta><resposta>', IFNULL(objetivoJornada, 'N/A'), '</resposta>'),
        CONCAT('<pergunta>Qual será a métrica de sucesso da transação no canal?</pergunta><resposta>', IFNULL(metricaSucesso, 'N/A'), '</resposta>'),
        CONCAT('<pergunta>Qual o resultado projetado nos primeiros 6 meses com a implementação?</pergunta><resposta>', IFNULL(resultadoProjetado, 'N/A'), '</resposta>'),
        CONCAT('<pergunta>Como será feito o acompanhamento dessa(s) métrica(s) de sucesso?</pergunta><resposta>', IFNULL(acompanhamentoMetrica, 'N/A'), '</resposta>'),
        CONCAT('<pergunta>Como o público-alvo será estimulado a consumir essa transação no canal?</pergunta><resposta>', IFNULL(estimuloConsumoTransacao, 'N/A'), '</resposta>')
    );

    -- Inserir o resultado na tabela de análise
    INSERT INTO solicitacoes.analiseInteligenciaArtificial (idSolicitacao, perguntaResposta, timestampPerguntaResposta)
    VALUES (NEW.idSolicitacao, perguntaResposta, NOW());
    
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `respostasJornadasTransacionais`
--

DROP TABLE IF EXISTS `respostasJornadasTransacionais`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `respostasJornadasTransacionais` (
  `idSolicitacao` int(11) NOT NULL,
  `temaProduto` varchar(500) DEFAULT NULL,
  `canalTransacao` varchar(500) DEFAULT NULL,
  `raOuRegulatorio` varchar(10) DEFAULT NULL,
  `especificoWhatsapp` varchar(10) DEFAULT NULL,
  `assuntoTransacao` varchar(500) DEFAULT NULL,
  `objetivoTransacao` varchar(500) DEFAULT NULL,
  `canaisTransacaoExiste` varchar(500) DEFAULT NULL,
  `publicoAlvo` varchar(500) DEFAULT NULL,
  `metricaSucesso` varchar(500) DEFAULT NULL,
  `resultadoProjetado` varchar(500) DEFAULT NULL,
  `acompanhamentoMetrica` varchar(500) DEFAULT NULL,
  `estimuloConsumoTransacao` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`idSolicitacao`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`albert`@`%`*/ /*!50003 TRIGGER `solicitacoes`.`respostasJornadasTransacionais_AFTER_INSERT` AFTER INSERT ON `respostasJornadasTransacionais` FOR EACH ROW

BEGIN
    DECLARE perguntaResposta TEXT;
    DECLARE canalTransacao TEXT;
    DECLARE raOuRegulatorio TEXT;
    DECLARE especificoWhatsapp TEXT;
    DECLARE assuntoTransacao TEXT;
    DECLARE publicoAlvo TEXT;
    DECLARE objetivoTransacao TEXT;
    DECLARE canaisTransacaoExiste TEXT;
    DECLARE metricaSucesso TEXT;
    DECLARE resultadoProjetado TEXT;
    DECLARE acompanhamentoMetrica TEXT;
    DECLARE estimuloConsumoTransacao TEXT;
    DECLARE CONTINUE HANDLER FOR NOT FOUND SET canalTransacao = NULL;

    -- Obter os valores necessários
    SELECT 
        a.canalTransacao, 
        a.raOuRegulatorio, 
        a.especificoWhatsapp, 
        a.assuntoTransacao, 
        a.publicoAlvo, 
        a.objetivoTransacao, 
        a.canaisTransacaoExiste, 
        a.metricaSucesso, 
        a.resultadoProjetado, 
        a.acompanhamentoMetrica, 
        a.estimuloConsumoTransacao
    INTO 
        canalTransacao, 
        raOuRegulatorio, 
        especificoWhatsapp, 
        assuntoTransacao, 
        publicoAlvo, 
        objetivoTransacao, 
        canaisTransacaoExiste, 
        metricaSucesso, 
        resultadoProjetado, 
        acompanhamentoMetrica, 
        estimuloConsumoTransacao
    FROM solicitacoes.respostasJornadasTransacionais a
    LEFT JOIN solicitacoes.solicitacoes b ON a.idSolicitacao = b.idSolicitacao 
    WHERE a.idSolicitacao = NEW.idSolicitacao;

    -- Concatenar os valores na variável perguntaResposta
    SET perguntaResposta = CONCAT(
		CONCAT('<pergunta>Tipo de jornada:</pergunta><resposta>Jornada Transacional</resposta>'),
        CONCAT('<pergunta>Em qual canal deseja incluir a transação?</pergunta><resposta>', IFNULL(canalTransacao, 'N/A'), '</resposta>'),
        CONCAT('<pergunta>A transação visa atender RA (Recomendação de auditoria) e/ou Regulatório?</pergunta><resposta>', IFNULL(raOuRegulatorio, 'N/A'), '</resposta>'),
        IF(raOuRegulatorio = "sim", CONCAT('<pergunta>A RA, regulamento ou lei especifica que a transação deve ser disponibilizada no WhatsApp?</pergunta><resposta>', IFNULL(especificoWhatsapp, 'N/A'), '</resposta>'), ""),
        CONCAT('<pergunta>Qual o assunto principal da transação?</pergunta><resposta>', IFNULL(assuntoTransacao, 'N/A'), '</resposta>'),
        CONCAT('<pergunta>Qual o público-alvo da transação?</pergunta><resposta>', IFNULL(publicoAlvo, 'N/A'), '</resposta>'),
        CONCAT('<pergunta>Qual o objetivo da transação?</pergunta><resposta>', IFNULL(objetivoTransacao, 'N/A'), '</resposta>'),
        CONCAT('<pergunta>Em quais canais a transação já existe?</pergunta><resposta>', IFNULL(canaisTransacaoExiste, 'N/A'), '</resposta>'),
        CONCAT('<pergunta>Qual será a métrica de sucesso da transação no canal?</pergunta><resposta>', IFNULL(metricaSucesso, 'N/A'), '</resposta>'),
        CONCAT('<pergunta>Qual o resultado projetado nos primeiros 6 meses com a implementação?</pergunta><resposta>', IFNULL(resultadoProjetado, 'N/A'), '</resposta>'),
        CONCAT('<pergunta>Como será feito o acompanhamento dessa(s) métrica(s) de sucesso?</pergunta><resposta>', IFNULL(acompanhamentoMetrica, 'N/A'), '</resposta>'),
        CONCAT('<pergunta>Como o público-alvo será estimulado a consumir essa transação no canal?</pergunta><resposta>', IFNULL(estimuloConsumoTransacao, 'N/A'), '</resposta>')
    );

    -- Inserir o resultado na tabela de análise
    INSERT INTO solicitacoes.analiseInteligenciaArtificial (idSolicitacao, perguntaResposta, timestampPerguntaResposta)
    VALUES (NEW.idSolicitacao, perguntaResposta, NOW());
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`albert`@`%`*/ /*!50003 TRIGGER `solicitacoes`.`respostasJornadasTransacionais_AFTER_UPDATE` AFTER UPDATE ON `respostasJornadasTransacionais` FOR EACH ROW
BEGIN

	DECLARE v_idSolicitacao INT;
    
    DECLARE perguntaResposta TEXT;
    DECLARE canalTransacao TEXT;
    DECLARE raOuRegulatorio TEXT;
    DECLARE especificoWhatsapp TEXT;
    DECLARE assuntoTransacao TEXT;
    DECLARE publicoAlvo TEXT;
    DECLARE objetivoTransacao TEXT;
    DECLARE canaisTransacaoExiste TEXT;
    DECLARE metricaSucesso TEXT;
    DECLARE resultadoProjetado TEXT;
    DECLARE acompanhamentoMetrica TEXT;
    DECLARE estimuloConsumoTransacao TEXT;
    DECLARE CONTINUE HANDLER FOR NOT FOUND SET canalTransacao = NULL;
    
    -- Obter o idSolicitacao da nova linha que está sendo inserida
    SET v_idSolicitacao = NEW.idSolicitacao;
    
    -- Verificar se existe uma linha ativa na tabela analiseInteligenciaArtificial
    IF EXISTS (SELECT 1 FROM solicitacoes.analiseInteligenciaArtificial 
               WHERE idSolicitacao = v_idSolicitacao AND ativo = 1) THEN
        -- Atualizar o campo ativo para 0
        UPDATE solicitacoes.analiseInteligenciaArtificial
        SET ativo = 0
        WHERE idSolicitacao = v_idSolicitacao AND ativo = 1;
    END IF;
    
    -- Obter os valores necessários
    SELECT 
        a.canalTransacao, 
        a.raOuRegulatorio, 
        a.especificoWhatsapp, 
        a.assuntoTransacao, 
        a.publicoAlvo, 
        a.objetivoTransacao, 
        a.canaisTransacaoExiste, 
        a.metricaSucesso, 
        a.resultadoProjetado, 
        a.acompanhamentoMetrica, 
        a.estimuloConsumoTransacao
    INTO 
        canalTransacao, 
        raOuRegulatorio, 
        especificoWhatsapp, 
        assuntoTransacao, 
        publicoAlvo, 
        objetivoTransacao, 
        canaisTransacaoExiste, 
        metricaSucesso, 
        resultadoProjetado, 
        acompanhamentoMetrica, 
        estimuloConsumoTransacao
    FROM solicitacoes.respostasJornadasTransacionais a
    LEFT JOIN solicitacoes.solicitacoes b ON a.idSolicitacao = b.idSolicitacao 
    WHERE a.idSolicitacao = NEW.idSolicitacao;

    -- Concatenar os valores na variável perguntaResposta
    SET perguntaResposta = CONCAT(
		CONCAT('<pergunta>Tipo de jornada:</pergunta><resposta>Jornada Transacional</resposta>'),
        CONCAT('<pergunta>Em qual canal deseja incluir a transação?</pergunta><resposta>', IFNULL(canalTransacao, 'N/A'), '</resposta>'),
        CONCAT('<pergunta>A transação visa atender RA (Recomendação de auditoria) e/ou Regulatório?</pergunta><resposta>', IFNULL(raOuRegulatorio, 'N/A'), '</resposta>'),
        IF(raOuRegulatorio = "sim", CONCAT('<pergunta>A RA, regulamento ou lei especifica que a transação deve ser disponibilizada no WhatsApp?</pergunta><resposta>', IFNULL(especificoWhatsapp, 'N/A'), '</resposta>'), ""),
        CONCAT('<pergunta>Qual o assunto principal da transação?</pergunta><resposta>', IFNULL(assuntoTransacao, 'N/A'), '</resposta>'),
        CONCAT('<pergunta>Qual o público-alvo da transação?</pergunta><resposta>', IFNULL(publicoAlvo, 'N/A'), '</resposta>'),
        CONCAT('<pergunta>Qual o objetivo da transação?</pergunta><resposta>', IFNULL(objetivoTransacao, 'N/A'), '</resposta>'),
        CONCAT('<pergunta>Em quais canais a transação já existe?</pergunta><resposta>', IFNULL(canaisTransacaoExiste, 'N/A'), '</resposta>'),
        CONCAT('<pergunta>Qual será a métrica de sucesso da transação no canal?</pergunta><resposta>', IFNULL(metricaSucesso, 'N/A'), '</resposta>'),
        CONCAT('<pergunta>Qual o resultado projetado nos primeiros 6 meses com a implementação?</pergunta><resposta>', IFNULL(resultadoProjetado, 'N/A'), '</resposta>'),
        CONCAT('<pergunta>Como será feito o acompanhamento dessa(s) métrica(s) de sucesso?</pergunta><resposta>', IFNULL(acompanhamentoMetrica, 'N/A'), '</resposta>'),
        CONCAT('<pergunta>Como o público-alvo será estimulado a consumir essa transação no canal?</pergunta><resposta>', IFNULL(estimuloConsumoTransacao, 'N/A'), '</resposta>')
    );

    -- Inserir o resultado na tabela de análise
    INSERT INTO solicitacoes.analiseInteligenciaArtificial (idSolicitacao, perguntaResposta, timestampPerguntaResposta)
    VALUES (NEW.idSolicitacao, perguntaResposta, NOW());
    
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `solicitacoes`
--

DROP TABLE IF EXISTS `solicitacoes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `solicitacoes` (
  `idSolicitacao` int(11) NOT NULL AUTO_INCREMENT,
  `status` int(11) DEFAULT 1,
  `tipoSolicitacao` varchar(45) DEFAULT NULL,
  `matricula` varchar(8) DEFAULT NULL,
  `nome` varchar(500) DEFAULT NULL,
  `email` varchar(500) DEFAULT NULL,
  `dependencia` varchar(500) DEFAULT NULL,
  `prefixo` int(11) DEFAULT NULL,
  `timestamp` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`idSolicitacao`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `status`
--

DROP TABLE IF EXISTS `status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `status` (
  `id` int(11) NOT NULL,
  `status` varchar(45) DEFAULT NULL,
  `ativo` int(11) DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `visualizaNotificacaoVisaoGestor`
--

DROP TABLE IF EXISTS `visualizaNotificacaoVisaoGestor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `visualizaNotificacaoVisaoGestor` (
  `idSolicitacao` int(11) NOT NULL,
  `statusAtual` int(11) NOT NULL,
  `solicitacaoVisualizada` int(11) DEFAULT 0,
  `timestampCriacao` datetime DEFAULT NULL,
  `timestampVisualizacao` datetime DEFAULT NULL,
  PRIMARY KEY (`idSolicitacao`,`statusAtual`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping routines for database 'solicitacoes'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-08-20  0:17:48
