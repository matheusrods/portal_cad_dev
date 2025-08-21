-- MySQL 8 compatible init script for database: cad
-- Charset/collation padronizados para utf8mb4 / utf8mb4_0900_ai_ci

SET NAMES utf8mb4;
SET time_zone = '+00:00';

CREATE DATABASE IF NOT EXISTS `cad`
  DEFAULT CHARACTER SET utf8mb4
  COLLATE utf8mb4_0900_ai_ci;

USE `cad`;

-- ----------------------------
-- Table: desenvolvedores
-- ----------------------------
DROP TABLE IF EXISTS `desenvolvedores`;
CREATE TABLE `desenvolvedores` (
  `matricula` varchar(8) NOT NULL,
  `ativo` int NOT NULL DEFAULT 1,
  PRIMARY KEY (`matricula`)
) ENGINE=InnoDB
  DEFAULT CHARSET=utf8mb4
  COLLATE=utf8mb4_0900_ai_ci;

-- ----------------------------
-- Table: funcionarios
-- ----------------------------
DROP TABLE IF EXISTS `funcionarios`;
CREATE TABLE `funcionarios` (
  `matricula` varchar(8) NOT NULL,
  `nome` varchar(100) DEFAULT NULL,
  `nomeGuerra` varchar(100) DEFAULT NULL,
  `mci` int DEFAULT NULL,
  `cpf` varchar(100) DEFAULT NULL,
  `prefixo` int DEFAULT NULL,
  `idComissao` int DEFAULT NULL,
  `comissao` varchar(50) DEFAULT NULL,
  `nascimento` date DEFAULT NULL,
  `ativo` int DEFAULT NULL,
  PRIMARY KEY (`matricula`)
) ENGINE=InnoDB
  DEFAULT CHARSET=utf8mb4
  COLLATE=utf8mb4_0900_ai_ci;

-- ----------------------------
-- Table: funcoes
-- ----------------------------
DROP TABLE IF EXISTS `funcoes`;
CREATE TABLE `funcoes` (
  `idFuncao` int NOT NULL,
  `nomeFuncao` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idFuncao`)
) ENGINE=InnoDB
  DEFAULT CHARSET=utf8mb4
  COLLATE=utf8mb4_0900_ai_ci;

-- ----------------------------
-- Table: setores
-- ----------------------------
DROP TABLE IF EXISTS `setores`;
CREATE TABLE `setores` (
  `id` int NOT NULL AUTO_INCREMENT,
  `setor` varchar(100) DEFAULT NULL,
  `descricaoSetor` varchar(1000) DEFAULT NULL,
  `ativo` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB
  AUTO_INCREMENT=7
  DEFAULT CHARSET=utf8mb4
  COLLATE=utf8mb4_0900_ai_ci;

-- ----------------------------
-- Table: squads
-- ----------------------------
DROP TABLE IF EXISTS `squads`;
CREATE TABLE `squads` (
  `id` int NOT NULL,
  `idSetor` int DEFAULT NULL,
  `squad` varchar(50) DEFAULT NULL,
  `descricaoSquad` varchar(1000) DEFAULT NULL,
  `ativo` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB
  DEFAULT CHARSET=utf8mb4
  COLLATE=utf8mb4_0900_ai_ci;

-- ----------------------------
-- Table: squads_funcionarios
-- ----------------------------
DROP TABLE IF EXISTS `squads_funcionarios`;
CREATE TABLE `squads_funcionarios` (
  `matricula` varchar(8) NOT NULL,
  `idSquad` int NOT NULL,
  PRIMARY KEY (`matricula`, `idSquad`)
) ENGINE=InnoDB
  DEFAULT CHARSET=utf8mb4
  COLLATE=utf8mb4_0900_ai_ci;

-- ----------------------------
-- Table: squads_gerentes
-- ----------------------------
DROP TABLE IF EXISTS `squads_gerentes`;
CREATE TABLE `squads_gerentes` (
  `idSquad` int NOT NULL,
  `matricula` varchar(8) NOT NULL,
  PRIMARY KEY (`idSquad`, `matricula`)
) ENGINE=InnoDB
  DEFAULT CHARSET=utf8mb4
  COLLATE=utf8mb4_0900_ai_ci;

-- ----------------------------
-- Table: vagas
-- ----------------------------
DROP TABLE IF EXISTS `vagas`;
CREATE TABLE `vagas` (
  `codVaga` varchar(15) NOT NULL,
  `qtdVagas` int DEFAULT NULL,
  `codFuncao` int DEFAULT NULL,
  `descricaoFuncao` varchar(100) DEFAULT NULL,
  `ordem` int DEFAULT NULL,
  `ativo` int DEFAULT NULL,
  PRIMARY KEY (`codVaga`)
) ENGINE=InnoDB
  DEFAULT CHARSET=utf8mb4
  COLLATE=utf8mb4_0900_ai_ci;