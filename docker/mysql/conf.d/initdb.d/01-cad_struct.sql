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

INSERT INTO `squads` (`id`, `idSetor`, `squad`, `descricaoSquad`, `ativo`) VALUES
(1, 4, 'Agronegócios', NULL, 0),
(2, 1, 'Inteligência Analítica', 'Construção/Atualização de painéis que auxiliem no processo de curadoria e retroalimentação do nosso modelo de NLP.<br><br>Elaboração de novos processos de ETL visando a possibilidade de consultas mais rápidas e construção de novos painéis.<br><br>Manutenção/Monitoria dos processos de ETL criados pelo CAD.<br><br>Pesquisa de novos modelos de arquitetura de dados para facilitar as consultas e criações de painéis.<br><br>Elaboração de Estudos Estruturantes que auxiliem no processo de curadoria e retroalimentação do nosso modelo de NLP.', 1),
(3, 4, 'Atendimento', NULL, 0),
(4, 4, 'Campanhas', NULL, 0),
(5, 4, 'Cartão', NULL, 0),
(6, 4, 'Consórcio', NULL, 0),
(7, 4, 'Conta PF', NULL, 0),
(8, 4, 'Crédito PF', NULL, 0),
(9, 6, 'Curadoria e Qualidade', 'Curadoria das jornadas dos bots do BB, acompanhamento de indicadores e atipicidades, realização de correções de curadoria, elaboração de documentação e reports diários de curadoria e proposição de novos diálogos/soluções.', 1),
(10, 2, 'Experimentação e Pesquisa', 'Experimentação de novas jornadas, realização de testes A/B voltados para UX, descoberta e solução de problemas de usabilidade.', 0),
(11, 4, 'Investimento', NULL, 0),
(12, 4, 'Minhas Finanças', NULL, 0),
(13, 4, 'Open Finance', NULL, 0),
(14, 4, 'Pagamentos e Transferências', NULL, 0),
(15, 4, 'Pessoa Jurídica', NULL, 0),
(16, 4, 'Renegociação', NULL, 0),
(17, 4, 'Segurança', NULL, 0),
(18, 4, 'Seguridade', NULL, 0),
(19, 4, 'Shopping BB', NULL, 0),
(20, 4, 'Voz', NULL, 0),
(21, 2, 'Inovação e Novas Tecnologias', 'Evolução e tendências tecnológicas relacionadas a assistentes virtuais, realização de POC\'s, NIA, pesquisas, experimentação de novas jornadas e novo ferramental.', 1),
(22, 1, 'Administrativo e Pessoas', 'Controle das demandas administrativas do CAD:<br>Gestão de Contratos, Gestão de Materiais e Bens, Orçamento, Ambiência, BB Atende / Resolve e Inventário.', 1),
(23, 2, 'Portal Web', 'Desenvolvimento, atualização e manutenção do Portal do CAD.', 1),
(24, 5, 'Desenvolvimento e Inteligência Artificial', NULL, 0),
(25, 5, 'Design da Experiência do Usuário', NULL, 0),
(26, 4, 'Setor Público', NULL, 0),
(27, 6, 'Melhores Práticas e Documentação', NULL, 1),
(28, 2, 'Formação, Mentoria e Comunicação', 'Realização de treinamentos internos/externos (formação), organização de imersões (mentorias) e estratégias de comunicação interna e externa do CAD.', 1),
(29, 4, 'Design da Experiência do Usuário', 'É aqui, em contato direto com os gestores de cada produto, onde acontece a ideação, desenvolvimento e implementação/atualização de jornadas conversacionais de transações, informações/orientações, induções ativas ou reativas de texto/voz para clientes no WhatsApp PF e PJ no número (61)4004-0001.', 1);


INSERT INTO `squads_funcionarios` (`matricula`, `idSquad`) VALUES
('A1051305', 22),
('A1051465', 22),
('F0285739', 23),
('F0427670', 6),
('F0427670', 12),
('F0427670', 18),
('F0427670', 29),
('F0493211', 5),
('F0493211', 10),
('F0493211', 28),
('F0720422', 20),
('F0720422', 21),
('F0720422', 28),
('F0733742', 29),
('F0733755', 23),
('F0733761', 29),
('F0738486', 22),
('F1482039', 9),
('F1482039', 24),
('F2258758', 6),
('F2258758', 9),
('F2258758', 12),
('F2258758', 13),
('F2258758', 27),
('F2276108', 29),
('F2332062', 2),
('F3210146', 3),
('F3210146', 9),
('F3210146', 14),
('F3210146', 16),
('F3295827', 2),
('F3859098', 9),
('F4038579', 1),
('F4038579', 3),
('F4038579', 9),
('F4100899', 2),
('F4117657', 1),
('F4117657', 2),
('F4117657', 13),
('F4117657', 20),
('F4959239', 3),
('F4959239', 8),
('F4959239', 16),
('F4959239', 29),
('F5009076', 10),
('F5009076', 21),
('F5009076', 23),
('F5009076', 28),
('F6001811', 9),
('F6002054', 4),
('F6002054', 11),
('F6002054', 29),
('F6066052', 26),
('F6066052', 29),
('F6072957', 5),
('F6072957', 11),
('F6072957', 12),
('F6072957', 29),
('F6263688', 7),
('F6263688', 9),
('F6263688', 15),
('F6323180', 21),
('F6323180', 23),
('F6323180', 28),
('F6771297', 1),
('F6771297', 14),
('F6771297', 29),
('F6813849', 29),
('F6818927', 29),
('F6875001', 1),
('F6875001', 7),
('F6875001', 8),
('F6875001', 9),
('F6875001', 27),
('F6999404', 10),
('F6999404', 15),
('F6999404', 17),
('F6999404', 19),
('F6999404', 21),
('F8251819', 9),
('F8351391', 1),
('F8351391', 17),
('F8351391', 19),
('F8351391', 22),
('F8527673', 4),
('F8527673', 9),
('F8527673', 13),
('F8527696', 10),
('F8527696', 21),
('F8601338', 2),
('F8711732', 2),
('F8916438', 29),
('F9099999', 21),
('F9132354', 2),
('F9140463', 4),
('F9140463', 18),
('F9140463', 29),
('F9342782', 2),
('F9523195', 9),
('F9840919', 16),
('F9840919', 21),
('F9934829', 5),
('F9934829', 10),
('F9934829', 20),
('F9934829', 23);
