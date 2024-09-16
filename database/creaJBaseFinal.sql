-- MySQL Script generated by MySQL Workbench
-- Sat Sep 11 12:21:05 2021
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema calificador_creaj
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema calificador_creaj
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `calificador_creaj` DEFAULT CHARACTER SET utf8 ;
USE `calificador_creaj` ;

-- -----------------------------------------------------
-- Table `calificador_creaj`.`usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `calificador_creaj`.`usuario` (
  `idUsuario` INT NOT NULL AUTO_INCREMENT,
  `usuario` VARCHAR(45) NULL,
  `nombres` VARCHAR(50) NULL,
  `apellidos` VARCHAR(50) NULL,
  `rol` VARCHAR(1) NULL,
  `password` VARCHAR(40) NULL,
  `email` VARCHAR(70) NULL,
  PRIMARY KEY (`idUsuario`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_spanish2_ci;


-- -----------------------------------------------------
-- Table `calificador_creaj`.`nivel`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `calificador_creaj`.`nivel` (
  `idnivel` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NULL,
  PRIMARY KEY (`idnivel`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_spanish2_ci;


-- -----------------------------------------------------
-- Table `calificador_creaj`.`grado`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `calificador_creaj`.`grado` (
  `idgrado` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NULL,
  `nivel_idnivel` INT NOT NULL,
  PRIMARY KEY (`idgrado`, `nivel_idnivel`),
  INDEX `fk_grado_nivel1_idx` (`nivel_idnivel` ASC) ,
  CONSTRAINT `fk_grado_nivel1`
    FOREIGN KEY (`nivel_idnivel`)
    REFERENCES `calificador_creaj`.`nivel` (`idnivel`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_spanish2_ci;


-- -----------------------------------------------------
-- Table `calificador_creaj`.`estudiante`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `calificador_creaj`.`estudiante` (
  `idestudiante` VARCHAR(8) NOT NULL,
  `nombre` VARCHAR(45) NULL,
  `apellidos` VARCHAR(45) NULL,
  `grado_idgrado` INT NOT NULL,
  PRIMARY KEY (`idestudiante`, `grado_idgrado`),
  INDEX `fk_estudiante_grado1_idx` (`grado_idgrado` ASC) ,
  CONSTRAINT `fk_estudiante_grado1`
    FOREIGN KEY (`grado_idgrado`)
    REFERENCES `calificador_creaj`.`grado` (`idgrado`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_spanish2_ci;


-- -----------------------------------------------------
-- Table `calificador_creaj`.`materia`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `calificador_creaj`.`materia` (
  `idmateria` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NULL,
  PRIMARY KEY (`idmateria`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_spanish2_ci;


-- -----------------------------------------------------
-- Table `calificador_creaj`.`proyecto`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `calificador_creaj`.`proyecto` (
  `idproyecto` INT NOT NULL AUTO_INCREMENT,
  `nombreProyecto` LONGTEXT NULL,
  `descripcion` MEDIUMTEXT NULL,
  `grado_idgrado` INT NOT NULL,
  `materia_idmateria` INT NOT NULL,
  PRIMARY KEY (`idproyecto`, `grado_idgrado`, `materia_idmateria`),
  INDEX `fk_proyecto_grado1_idx` (`grado_idgrado` ASC) ,
  INDEX `fk_proyecto_materia1_idx` (`materia_idmateria` ASC) ,
  CONSTRAINT `fk_proyecto_grado1`
    FOREIGN KEY (`grado_idgrado`)
    REFERENCES `calificador_creaj`.`grado` (`idgrado`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_proyecto_materia1`
    FOREIGN KEY (`materia_idmateria`)
    REFERENCES `calificador_creaj`.`materia` (`idmateria`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_spanish2_ci;


-- -----------------------------------------------------
-- Table `calificador_creaj`.`equipo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `calificador_creaj`.`equipo` (
  `idequipo` INT NOT NULL AUTO_INCREMENT,
  `estudiante_idestudiante` VARCHAR(8) NOT NULL,
  `proyecto_idproyecto` INT NOT NULL,
  PRIMARY KEY (`idequipo`, `estudiante_idestudiante`, `proyecto_idproyecto`),
  INDEX `fk_equipo_estudiante_idx` (`estudiante_idestudiante` ASC) ,
  INDEX `fk_equipo_proyecto1_idx` (`proyecto_idproyecto` ASC) ,
  CONSTRAINT `fk_equipo_estudiante`
    FOREIGN KEY (`estudiante_idestudiante`)
    REFERENCES `calificador_creaj`.`estudiante` (`idestudiante`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_equipo_proyecto1`
    FOREIGN KEY (`proyecto_idproyecto`)
    REFERENCES `calificador_creaj`.`proyecto` (`idproyecto`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_spanish2_ci;


-- -----------------------------------------------------
-- Table `calificador_creaj`.`rubrica`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `calificador_creaj`.`rubrica` (
  `idrubrica` VARCHAR(15) NOT NULL,
  `nombre` VARCHAR(45) NULL,
  `materia_idmateria` INT NOT NULL,
  `grado_idgrado` INT NOT NULL,
  PRIMARY KEY (`idrubrica`, `materia_idmateria`, `grado_idgrado`),
  INDEX `fk_rubrica_materia1_idx` (`materia_idmateria` ASC) ,
  INDEX `fk_rubrica_grado1_idx` (`grado_idgrado` ASC) ,
  CONSTRAINT `fk_rubrica_materia1`
    FOREIGN KEY (`materia_idmateria`)
    REFERENCES `calificador_creaj`.`materia` (`idmateria`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_rubrica_grado1`
   FOREIGN KEY (`grado_idgrado`)
    REFERENCES `calificador_creaj`.`grado` (`idgrado`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_spanish2_ci;


-- -----------------------------------------------------
-- Table `calificador_creaj`.`criterios`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `calificador_creaj`.`criterios` (
  `idcriterios` INT NOT NULL AUTO_INCREMENT,
  `titulo` VARCHAR(45) NULL,
  `puntaje` INT NULL,
  `rubrica_idrubrica` VARCHAR(15) NOT NULL,
  PRIMARY KEY (`idcriterios`, `rubrica_idrubrica`),
  INDEX `fk_criterios_rubrica1_idx` (`rubrica_idrubrica` ASC) ,
  CONSTRAINT `fk_criterios_rubrica1`
    FOREIGN KEY (`rubrica_idrubrica`)
    REFERENCES `calificador_creaj`.`rubrica` (`idrubrica`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_spanish2_ci;


-- -----------------------------------------------------
-- Table `calificador_creaj`.`asignacionJ`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `calificador_creaj`.`asignacionJ` (
  `idasignacionJ` INT NOT NULL AUTO_INCREMENT,
  `usuario_idUsuario` INT NOT NULL,
  `materia_idmateria` INT NOT NULL,
  `grado_idgrado` INT NOT NULL,
  PRIMARY KEY (`idasignacionJ`, `usuario_idUsuario`, `materia_idmateria`, `grado_idgrado`),
  INDEX `fk_asignacionJ_usuario1_idx` (`usuario_idUsuario` ASC) ,
  INDEX `fk_asignacionJ_materia1_idx` (`materia_idmateria` ASC) ,
  INDEX `fk_asignacionJ_grado1_idx` (`grado_idgrado` ASC) ,
  CONSTRAINT `fk_asignacionJ_usuario1`
    FOREIGN KEY (`usuario_idUsuario`)
    REFERENCES `calificador_creaj`.`usuario` (`idUsuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_asignacionJ_materia1`
    FOREIGN KEY (`materia_idmateria`)
    REFERENCES `calificador_creaj`.`materia` (`idmateria`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_asignacionJ_grado1`
    FOREIGN KEY (`grado_idgrado`)
    REFERENCES `calificador_creaj`.`grado` (`idgrado`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_spanish2_ci;


-- -----------------------------------------------------
-- Table `calificador_creaj`.`puntaje`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `calificador_creaj`.`puntaje` (
  `idpuntaje` INT NOT NULL AUTO_INCREMENT,
  `proyecto_idproyecto` INT NOT NULL,
  `usuario_idUsuario` INT NOT NULL,
  `puntaje` FLOAT NULL,
  PRIMARY KEY (`idpuntaje`, `proyecto_idproyecto`, `usuario_idUsuario`),
  INDEX `fk_puntaje_proyecto1_idx` (`proyecto_idproyecto` ASC) ,
  INDEX `fk_puntaje_usuario1_idx` (`usuario_idUsuario` ASC) ,
  CONSTRAINT `fk_puntaje_proyecto1`
    FOREIGN KEY (`proyecto_idproyecto`)
    REFERENCES `calificador_creaj`.`proyecto` (`idproyecto`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_puntaje_usuario1`
    FOREIGN KEY (`usuario_idUsuario`)
    REFERENCES `calificador_creaj`.`usuario` (`idUsuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_spanish2_ci;


-- -----------------------------------------------------
-- Table `calificador_creaj`.`Ranking`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `calificador_creaj`.`Ranking` (
  `idRanking` INT NOT NULL AUTO_INCREMENT,
  `proyecto_idproyecto` INT NOT NULL,
  `grado_idgrado` INT NOT NULL,
  `materia_idmateria` INT NOT NULL,
  `notafinal` FLOAT NULL,
  PRIMARY KEY (`idRanking`, `proyecto_idproyecto`, `grado_idgrado`, `materia_idmateria`),
  INDEX `fk_Ranking_proyecto1_idx` (`proyecto_idproyecto` ASC) ,
  INDEX `fk_Ranking_materia1_idx` (`materia_idmateria` ASC) ,
  INDEX `fk_Ranking_grado1_idx` (`grado_idgrado` ASC) ,
  CONSTRAINT `fk_Ranking_proyecto1`
    FOREIGN KEY (`proyecto_idproyecto`)
    REFERENCES `calificador_creaj`.`proyecto` (`idproyecto`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Ranking_materia1`
    FOREIGN KEY (`materia_idmateria`)
    REFERENCES `calificador_creaj`.`materia` (`idmateria`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Ranking_grado1`
    FOREIGN KEY (`grado_idgrado`)
    REFERENCES `calificador_creaj`.`grado` (`idgrado`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_spanish2_ci;


-- -----------------------------------------------------
-- Table `calificador_creaj`.`naprobacion`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `calificador_creaj`.`naprobacion` (
  `idnaprobacion` INT NOT NULL AUTO_INCREMENT,
  `descripcion` LONGTEXT NULL,
  `rango` VARCHAR(45) NULL,
  `nota` FLOAT NULL,
  `criterios_idcriterios` INT NOT NULL,
  PRIMARY KEY (`idnaprobacion`, `criterios_idcriterios`),
  INDEX `fk_naprovacion_criterios1_idx` (`criterios_idcriterios` ASC) ,
  CONSTRAINT `fk_naprovacion_criterios1`
    FOREIGN KEY (`criterios_idcriterios`)
    REFERENCES `calificador_creaj`.`criterios` (`idcriterios`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `calificador_creaj`.`parametros`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `calificador_creaj`.`parametros` (
  `idparametros` INT NOT NULL,
  `nombre` VARCHAR(100) NULL,
  `paramFecha` DATE NULL DEFAULT '2021/01/01',
  `paramFechaF` DATE NULL DEFAULT '2021/12/31',
  PRIMARY KEY (`idparametros`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `calificador_creaj`.`puntos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `calificador_creaj`.`puntos` (
  `idpuntos` INT NOT NULL AUTO_INCREMENT,
  `usuario_idUsuario` INT NOT NULL,
  `criterios_idcriterios` INT NOT NULL,
  `proyecto_idproyecto` INT NOT NULL,
  `puntos` VARCHAR(45) NULL,
  PRIMARY KEY (`idpuntos`, `usuario_idUsuario`, `criterios_idcriterios`, `proyecto_idproyecto`),
  INDEX `fk_puntos_criterios1_idx` (`criterios_idcriterios` ASC) ,
  INDEX `fk_puntos_proyecto1_idx` (`proyecto_idproyecto` ASC) ,
  INDEX `fk_puntos_usuario1_idx` (`usuario_idUsuario` ASC) ,
  CONSTRAINT `fk_puntos_criterios1`
    FOREIGN KEY (`criterios_idcriterios`)
    REFERENCES `calificador_creaj`.`criterios` (`idcriterios`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_puntos_proyecto1`
    FOREIGN KEY (`proyecto_idproyecto`)
    REFERENCES `calificador_creaj`.`proyecto` (`idproyecto`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_puntos_usuario1`
    FOREIGN KEY (`usuario_idUsuario`)
    REFERENCES `calificador_creaj`.`usuario` (`idUsuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;



INSERT INTO usuario (usuario, nombres, apellidos, rol, password, email)
 VALUES ( 'Admin' , 'Administrador', 'CDB','a','827ccb0eea8a706c4c34a16891f84e7b', 'trabajosocialhelp@gmail.com');


INSERT INTO nivel VALUES (1, 'UNDEFINED');

INSERT INTO grado VALUES (1, 'UNDEFINED',1);

INSERT INTO materia VALUES (1, 'UNDEFINED');


INSERT INTO parametros VALUES (1, 'Ingreso de estudiantes', '2021-01-01', '2021-12-31'),
(2, 'Ingreso de proyectos', '2021-01-01', '2021-12-31'), 
(3, 'Ingreso de rubricas', '2021-01-01', '2021-12-31'),
(4, 'Limite de calificacion','2021-01-01', '2021-12-31'),
(5, 'Ingreso de nuevos usuarios', '2021-01-01','2021-12-31');

ALTER TABLE calificador_creaj.criterios modify column titulo longtext;