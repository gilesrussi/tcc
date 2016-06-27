# Host: localhost  (Version: 5.6.24)
# Date: 2015-11-25 09:29:58
# Generator: MySQL-Front 5.3  (Build 4.234)

/*!40101 SET NAMES latin1 */;

#
# Structure for table "curso"
#

DROP TABLE IF EXISTS `curso`;
CREATE TABLE `curso` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` varchar(45) NOT NULL,
  `nome` varchar(45) NOT NULL,
  `codigo_estruturado` varchar(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `codigo_UNIQUE` (`codigo`),
  UNIQUE KEY `codigo_estruturado_UNIQUE` (`codigo_estruturado`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Data for table "curso"
#


#
# Structure for table "disciplina"
#

DROP TABLE IF EXISTS `disciplina`;
CREATE TABLE `disciplina` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` varchar(45) NOT NULL,
  `nome` varchar(45) NOT NULL,
  `carga_horaria_total` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `codigo_UNIQUE` (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Data for table "disciplina"
#


#
# Structure for table "periodo"
#

DROP TABLE IF EXISTS `periodo`;
CREATE TABLE `periodo` (
  `id` int(11) NOT NULL,
  `descricao` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `descricao_UNIQUE` (`descricao`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Data for table "periodo"
#


#
# Structure for table "situacao"
#

DROP TABLE IF EXISTS `situacao`;
CREATE TABLE `situacao` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `descricao_UNIQUE` (`descricao`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Data for table "situacao"
#


#
# Structure for table "ppc"
#

DROP TABLE IF EXISTS `ppc`;
CREATE TABLE `ppc` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `curso_id` int(11) NOT NULL,
  `situacao_id` int(11) NOT NULL,
  `numero` varchar(20) NOT NULL,
  `carga_horaria_total_curso` int(11) DEFAULT NULL,
  `credito_total` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `curso_id` (`curso_id`,`numero`),
  KEY `fk_ppt_curso_idx` (`curso_id`),
  KEY `fk_ppt_situacao1_idx` (`situacao_id`),
  CONSTRAINT `fk_ppt_curso` FOREIGN KEY (`curso_id`) REFERENCES `curso` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_ppt_situacao1` FOREIGN KEY (`situacao_id`) REFERENCES `situacao` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Data for table "ppc"
#


#
# Structure for table "situacao_curriculo"
#

DROP TABLE IF EXISTS `situacao_curriculo`;
CREATE TABLE `situacao_curriculo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `descricao_UNIQUE` (`descricao`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Data for table "situacao_curriculo"
#


#
# Structure for table "teste"
#

DROP TABLE IF EXISTS `teste`;
CREATE TABLE `teste` (
  `COD_CURSO` varchar(255) DEFAULT NULL,
  `NOME_UNIDADE` varchar(255) DEFAULT NULL,
  `COD_ESTRUTURADO` varchar(255) DEFAULT NULL,
  `COD_DISCIPLINA` varchar(255) DEFAULT NULL,
  `NOME_DISCIPLINA` varchar(255) DEFAULT NULL,
  `PERIODO_IDEAL` double DEFAULT NULL,
  `CH` double DEFAULT NULL,
  `CH_TOTAL` double DEFAULT NULL,
  `TIPO_AULA` varchar(255) DEFAULT NULL,
  `TIPO_DISCIPLINA` varchar(255) DEFAULT NULL,
  `NUM_VERSAO` varchar(255) DEFAULT NULL,
  `SIT_VERSAO` varchar(255) DEFAULT NULL,
  `TOTAL_CH` double DEFAULT NULL,
  `TOTAL_CR` double DEFAULT NULL,
  `CH_TOTAL_CURSO` double DEFAULT NULL,
  `SIT_CURRICULO` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

#
# Data for table "teste"
#


#
# Structure for table "tipo_aula"
#

DROP TABLE IF EXISTS `tipo_aula`;
CREATE TABLE `tipo_aula` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(45) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `descricao` (`descricao`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Data for table "tipo_aula"
#


#
# Structure for table "tipo_aula_has_disciplina"
#

DROP TABLE IF EXISTS `tipo_aula_has_disciplina`;
CREATE TABLE `tipo_aula_has_disciplina` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `disciplina_id` int(11) NOT NULL,
  `tipo_aula_id` int(11) DEFAULT NULL,
  `carga_horaria` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `disciplina_id` (`disciplina_id`,`tipo_aula_id`),
  KEY `fk_tipo_aula_has_disciplina_disciplina1_idx` (`disciplina_id`),
  KEY `fk_tipo_aula_has_disciplina_tipo_aula1_idx` (`tipo_aula_id`),
  CONSTRAINT `fk_tipo_aula_has_disciplina_disciplina1` FOREIGN KEY (`disciplina_id`) REFERENCES `disciplina` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_tipo_aula_has_disciplina_tipo_aula1` FOREIGN KEY (`tipo_aula_id`) REFERENCES `tipo_aula` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Data for table "tipo_aula_has_disciplina"
#


#
# Structure for table "tipo_disciplina"
#

DROP TABLE IF EXISTS `tipo_disciplina`;
CREATE TABLE `tipo_disciplina` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `descricao_UNIQUE` (`descricao`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Data for table "tipo_disciplina"
#


#
# Structure for table "ppc_has_tipo_disciplina"
#

DROP TABLE IF EXISTS `ppc_has_tipo_disciplina`;
CREATE TABLE `ppc_has_tipo_disciplina` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ppc_id` int(11) NOT NULL,
  `tipo_disciplina_id` int(11) NOT NULL,
  `carga_horaria_total_tipo_disciplina` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ppc_id` (`ppc_id`,`tipo_disciplina_id`),
  KEY `fk_ppt_has_tipo_disciplina_tipo_disciplina1_idx` (`tipo_disciplina_id`),
  KEY `fk_ppt_has_tipo_disciplina_ppt1_idx` (`ppc_id`),
  CONSTRAINT `fk_ppt_has_tipo_disciplina_ppt1` FOREIGN KEY (`ppc_id`) REFERENCES `ppc` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_ppt_has_tipo_disciplina_tipo_disciplina1` FOREIGN KEY (`tipo_disciplina_id`) REFERENCES `tipo_disciplina` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Data for table "ppc_has_tipo_disciplina"
#


#
# Structure for table "ppc_has_tipo_disciplina_has_disciplina"
#

DROP TABLE IF EXISTS `ppc_has_tipo_disciplina_has_disciplina`;
CREATE TABLE `ppc_has_tipo_disciplina_has_disciplina` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ppc_has_tipo_disciplina_id` int(11) NOT NULL,
  `disciplina_id` int(11) NOT NULL,
  `periodo_id` int(11) NOT NULL,
  `situacao_curriculo_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ppc_has_tipo_disciplina_id` (`ppc_has_tipo_disciplina_id`,`disciplina_id`),
  KEY `fk_ppt_has_tipo_disciplina_has_disciplina_disciplina1_idx` (`disciplina_id`),
  KEY `fk_ppt_has_tipo_disciplina_has_disciplina_ppt_has_tipo_disc_idx` (`ppc_has_tipo_disciplina_id`),
  KEY `fk_ppt_has_tipo_disciplina_has_disciplina_periodo1_idx` (`periodo_id`),
  KEY `fk_ppt_has_tipo_disciplina_has_disciplina_situacao_curricul_idx` (`situacao_curriculo_id`),
  CONSTRAINT `fk_ppt_has_tipo_disciplina_has_disciplina_disciplina1` FOREIGN KEY (`disciplina_id`) REFERENCES `disciplina` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_ppt_has_tipo_disciplina_has_disciplina_periodo1` FOREIGN KEY (`periodo_id`) REFERENCES `periodo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_ppt_has_tipo_disciplina_has_disciplina_ppt_has_tipo_discip1` FOREIGN KEY (`ppc_has_tipo_disciplina_id`) REFERENCES `ppc_has_tipo_disciplina` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_ppt_has_tipo_disciplina_has_disciplina_situacao_curriculo1` FOREIGN KEY (`situacao_curriculo_id`) REFERENCES `situacao_curriculo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Data for table "ppc_has_tipo_disciplina_has_disciplina"
#


#
# Trigger "AtualizaDisciplinaDelete"
#

DROP TRIGGER IF EXISTS `AtualizaDisciplinaDelete`;
CREATE DEFINER='root'@'localhost' TRIGGER `pgbd`.`AtualizaDisciplinaDelete` AFTER DELETE ON `pgbd`.`tipo_aula_has_disciplina`
  FOR EACH ROW UPDATE disciplina d SET d.carga_horaria_total = (SELECT SUM(td.carga_horaria) FROM tipo_aula_has_disciplina td WHERE td.disciplina_id = OLD.disciplina_id) WHERE d.id = OLD.disciplina_id;

#
# Trigger "AtualizaDisciplinaInsert"
#

DROP TRIGGER IF EXISTS `AtualizaDisciplinaInsert`;
CREATE DEFINER='root'@'localhost' TRIGGER `pgbd`.`AtualizaDisciplinaInsert` BEFORE INSERT ON `pgbd`.`tipo_aula_has_disciplina`
  FOR EACH ROW BEGIN
  DECLARE temp integer;
  SET @temp := (SELECT SUM(td.carga_horaria) FROM tipo_aula_has_disciplina td WHERE td.disciplina_id = NEW.disciplina_id);
  IF @temp IS NULL THEN
    UPDATE disciplina d SET d.carga_horaria_total = NEW.carga_horaria WHERE d.id = NEW.disciplina_id;
  ELSE
    UPDATE disciplina d SET d.carga_horaria_total = NEW.carga_horaria + (SELECT SUM(td.carga_horaria) FROM tipo_aula_has_disciplina td WHERE td.disciplina_id = NEW.disciplina_id) WHERE d.id = NEW.disciplina_id;
  END IF;
END;

#
# Trigger "AtualizaDisciplinaUpdate"
#

DROP TRIGGER IF EXISTS `AtualizaDisciplinaUpdate`;
CREATE DEFINER='root'@'localhost' TRIGGER `pgbd`.`AtualizaDisciplinaUpdate` AFTER UPDATE ON `pgbd`.`tipo_aula_has_disciplina`
  FOR EACH ROW BEGIN
  DECLARE temp integer;
  SET @temp := (SELECT SUM(td.carga_horaria) FROM tipo_aula_has_disciplina td WHERE td.disciplina_id = NEW.disciplina_id);
  IF @temp IS NULL THEN
    UPDATE disciplina d SET d.carga_horaria_total = NEW.carga_horaria WHERE d.id = NEW.disciplina_id;
  ELSE
    UPDATE disciplina d SET d.carga_horaria_total = (SELECT SUM(td.carga_horaria) FROM tipo_aula_has_disciplina td WHERE td.disciplina_id = NEW.disciplina_id) WHERE d.id = NEW.disciplina_id;
  END IF;
END;

#
# Trigger "completaperiodo"
#

DROP TRIGGER IF EXISTS `completaperiodo`;
CREATE DEFINER='root'@'localhost' TRIGGER `pgbd`.`completaperiodo` BEFORE INSERT ON `pgbd`.`periodo`
  FOR EACH ROW BEGIN
  IF NEW.id < 90 THEN
    SET NEW.descricao = CONCAT(NEW.id, 'º SEMESTRE');
  ELSE
    SET NEW.descricao = 'QUALQUER';
  END IF;
END;
