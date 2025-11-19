/*M!999999\- enable the sandbox mode */ 
-- MariaDB dump 10.19  Distrib 10.11.11-MariaDB, for Linux (x86_64)
--
-- Host: 127.0.0.1    Database: intranet
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
-- Current Database: `intranet`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `intranet` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;

USE `intranet`;

DROP TABLE IF EXISTS `cabecalho_categoria_subitem`;

CREATE TABLE `cabecalho_categoria_subitem` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `categoria` varchar(45) DEFAULT NULL,
  `vinculoItem` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


DROP TABLE IF EXISTS `cabecalho_item`;

CREATE TABLE `cabecalho_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item` varchar(45) DEFAULT NULL,
  `tipo` varchar(45) DEFAULT NULL COMMENT '01 - Item é "master" de subitens      02 - Link para outra página',
  `nomePaginaInterna` varchar(200) DEFAULT NULL,
  `ativo` int(11) DEFAULT NULL,
  `producao` int(11) DEFAULT 0,
  `exclusivoCad` int(11) DEFAULT 1,
  `uorPermitida` varchar(10000) DEFAULT NULL,
  `ordemCabecalho` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


DROP TABLE IF EXISTS `cabecalho_subitem`;

CREATE TABLE `cabecalho_subitem` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subitem` varchar(45) DEFAULT NULL,
  `url` varchar(2000) DEFAULT NULL,
  `vinculoItem` int(11) DEFAULT NULL,
  `categoria` int(11) DEFAULT NULL,
  `descricao` varchar(2000) DEFAULT NULL,
  `iconeCabecalho` varchar(100) DEFAULT NULL,
  `ativo` int(11) DEFAULT NULL,
  `producao` int(11) DEFAULT NULL,
  `exclusivoCad` int(11) DEFAULT 1,
  `ordem` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `cabecalho_item` VALUES
(1,'Quem somos?','2','quemSomos',1,1,0,NULL,2),
(2,'Capacitação','1',NULL,1,1,0,NULL,3),
(3,'Notícias','1','',1,1,0,NULL,4),
(4,'Analytics','1',NULL,1,1,0,NULL,5),
(5,'Imersão Chatbot','2','mentoria',1,1,0,NULL,6),
(6,'Explorar','1',NULL,1,1,0,NULL,7),
(7,'Incidentes','2','incidentes',1,1,1,'514424',8),
(8,'Solicitações','2','solicitacoes',0,0,1,'532286,514424,532283,514416',9),
(9,'Home (?‍♀️?️ em construção)','2','home',0,0,1,'514424',10),
(10,'Solicitações(refinamento)','2','refinamentoTecnico',0,0,1,NULL,11),
(11,'Report','1',NULL,1,1,0,NULL,12),
(12,'Home','2','home',1,1,0,NULL,1);

INSERT INTO `cabecalho_subitem` VALUES
(1,'Onboarding','onboarding',2,NULL,'Bem-vindo ao CAD! Tudo o que você precisa saber para dar seus primeiros passos','fas fa-users',1,1,0,1),
(2,'UX','ux',2,NULL,'Nessa trilha você vai aprender tudo sobre experiência do usuário','fas fa-comments',1,1,0,2),
(3,'Dev','dev',2,NULL,'Aprenda sobre a construção de jornadas conversacionais e desenvolvimento web','fas fa-tools',0,0,1,4),
(4,'Analytics','analytics',2,NULL,'Se aprofunde na extração e tratamento de dados para criação de painéis de acompanhamento','fas fa-chart-line',0,0,1,NULL),
(5,'Experimentos','experimentos',6,NULL,'Conheça nossos testes para melhorar a jornada dos usuários.','fa-solid fa-rocket',1,1,0,2),
(6,'Estudos e Pesquisas','estudosPesquisas',6,NULL,'Pesquisas sobre nossos Assistentes Virtuais e o mercado de chatbots.','fa-solid fa-magnifying-glass',1,1,0,3),
(7,'Painéis','paineis',4,NULL,'Consulte e acesse os painéis mais usados aqui no CAD','fa-solid fa-chart-line',1,1,0,1),
(8,'Grandes Números','analytics',4,NULL,'Explore os Resultados do CAD e confira os números atingidos','fa-solid fa-calendar-days',1,1,0,2),
(9,'Recursos','recursos',6,NULL,'Design System, Guia de linguagem, Reportes de curadoria, manuais do CAD...','fa-solid fa-book',1,1,0,1),
(12,'Saiu na AGN','noticias',3,NULL,'As principais notícias, eventos e novidades do BB em um só lugar','fa-solid fa-bullhorn',1,1,0,1),
(13,'Notícias do Mercado','trends',3,NULL,'Fique por dentro das principais novidades em tecnologia e inovação','fa fa-newspaper-o',1,1,0,2),
(14,'Analytics','capacitacao_analytics',2,NULL,'O início de sua jornada no universo de Analytics','fa-solid fa-ranking-star',1,1,0,3),
(16,'Report PF','reportPf',11,NULL,'Resumo Mensal de Experiências Conversacionais - WhatsApp PF','fa-brands fa-whatsapp',1,1,0,1),
(17,'Report PJ','reportPj',11,NULL,'Resumo Mensal de Experiências Conversacionais - WhatsApp PJ','fa-brands fa-whatsapp',1,1,0,2);


DROP TABLE IF EXISTS `logEmailEnviado`;

CREATE TABLE `logEmailEnviado` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tituloEmail` varchar(500) DEFAULT NULL,
  `conteudoEmail` text DEFAULT NULL,
  `remetente` varchar(200) DEFAULT NULL,
  `destinatarios` varchar(5000) DEFAULT NULL,
  `timestamp` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


DROP TABLE IF EXISTS `log_acesso`;

CREATE TABLE `log_acesso` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `matricula` varchar(8) DEFAULT NULL,
  `nomeFunci` varchar(200) DEFAULT NULL,
  `cargo` int(11) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `dependencia` int(11) DEFAULT NULL,
  `paginaAcessada` varchar(200) DEFAULT NULL,
  `ip` varchar(50) DEFAULT NULL,
  `timestamp` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=114364 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


DROP TABLE IF EXISTS `notaFeedbackPortal`;

CREATE TABLE `notaFeedbackPortal` (
  `id_nota` INT NOT NULL AUTO_INCREMENT,
  `descricao` VARCHAR(50) NOT NULL, 
  PRIMARY KEY (`id_nota`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


DROP TABLE IF EXISTS `motivoFeedbackPortal`;

CREATE TABLE `motivoFeedbackPortal` (
  `id_motivo` INT NOT NULL AUTO_INCREMENT,
  `descricao` VARCHAR(150) NOT NULL, 
  PRIMARY KEY (`id_motivo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

DROP TABLE IF EXISTS `logFeedbackPortal`;

CREATE TABLE `logFeedbackPortal` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `matricula` VARCHAR(8) DEFAULT NULL,
  `id_nota` INT DEFAULT NULL,
  `comentario` TEXT DEFAULT NULL,
  `timestamp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_item` INT DEFAULT NULL,      
  `id_subitem` INT DEFAULT NULL,   
  PRIMARY KEY (`id`),

  CONSTRAINT `fk_feedback_nota`
    FOREIGN KEY (`id_nota`) REFERENCES `notaFeedbackPortal` (`id_nota`)
    ON UPDATE CASCADE ON DELETE SET NULL,

  CONSTRAINT `fk_feedback_item`
    FOREIGN KEY (`id_item`) REFERENCES `cabecalho_item` (`id`)
    ON UPDATE CASCADE ON DELETE SET NULL,

  CONSTRAINT `fk_feedback_subitem`
    FOREIGN KEY (`id_subitem`) REFERENCES `cabecalho_subitem` (`id`)
    ON UPDATE CASCADE ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

DROP TABLE IF EXISTS `logFeedbackMotivo`;

CREATE TABLE `logFeedbackMotivo` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `id_feedback` INT NOT NULL,
  `id_motivo` INT NOT NULL,
  PRIMARY KEY (`id`),

  CONSTRAINT `fk_feedbackmotivo_feedback`
    FOREIGN KEY (`id_feedback`) REFERENCES `logFeedbackPortal` (`id`)
    ON UPDATE CASCADE ON DELETE CASCADE,

  CONSTRAINT `fk_feedbackmotivo_motivo`
    FOREIGN KEY (`id_motivo`) REFERENCES `motivoFeedbackPortal` (`id_motivo`)
    ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Inserindo notas padrão
INSERT INTO notaFeedbackPortal (descricao) VALUES
('Muito insatisfeito'),
('Insatisfeito'),
('Neutro'),
('Satisfeito'),
('Muito satisfeito');

-- Inserindo motivos padrão
INSERT INTO motivoFeedbackPortal (descricao) VALUES
('Sistema bom, mas pode melhorar'),
('Pequenos erros ocasionais'),
('Interface poderia ser mais intuitiva'),
('Tempo de resposta razoável'),
('Outro motivo');

