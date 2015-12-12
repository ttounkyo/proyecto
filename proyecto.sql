-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema ttounkyo
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema ttounkyo
-- -----------------------------------------------------
DROP DATABASE IF EXISTS `ttounkyo`;
CREATE SCHEMA IF NOT EXISTS `ttounkyo` DEFAULT CHARACTER SET utf8 ;
USE `ttounkyo` ;

-- -----------------------------------------------------
-- Table `ttounkyo`.`categorias`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ttounkyo`.`categorias` (
  `idcategoria` INT(11) NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`idcategoria`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `ttounkyo`.`productos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ttounkyo`.`productos` (
  `idproducto` INT(11) NOT NULL AUTO_INCREMENT,
  `titulo` VARCHAR(45) NULL DEFAULT NULL,
  `descripcion` VARCHAR(45) NULL DEFAULT NULL,
  `precio` DECIMAL(10,0) NULL DEFAULT NULL,
  `marca` VARCHAR(45) NULL DEFAULT NULL,
  `ruta` VARCHAR(100) NULL DEFAULT NULL,
  `cantidad` INT(11) NOT NULL DEFAULT 1,
  `createdAt` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idproducto`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `ttounkyo`.`categorias_productos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ttounkyo`.`categorias_productos` (
  `idcategoria` INT(11) NOT NULL,
  `idproducto` INT(11) NOT NULL,
  PRIMARY KEY (`idcategoria`, `idproducto`),
  INDEX `fk_categorias_has_productos_productos1_idx` (`idproducto` ASC),
  INDEX `fk_categorias_has_productos_categorias1_idx` (`idcategoria` ASC),
  CONSTRAINT `fk_categorias_has_productos_categorias1`
    FOREIGN KEY (`idcategoria`)
    REFERENCES `ttounkyo`.`categorias` (`idcategoria`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_categorias_has_productos_productos1`
    FOREIGN KEY (`idproducto`)
    REFERENCES `ttounkyo`.`productos` (`idproducto`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `ttounkyo`.`media`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ttounkyo`.`media` (
  `idimagen` INT(11) NOT NULL AUTO_INCREMENT,
  `path` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`idimagen`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `ttounkyo`.`usuarios`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ttounkyo`.`usuarios` (
  `username` VARCHAR(45) NOT NULL,
  `nombre` VARCHAR(45) NULL DEFAULT NULL,
  `apellidos` VARCHAR(45) NULL DEFAULT NULL,
  `datealta` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `email` VARCHAR(45) NULL DEFAULT NULL,
  `telefono` VARCHAR(45) NULL DEFAULT NULL,
  `direccion` VARCHAR(45) NULL DEFAULT NULL,
  `rol` VARCHAR(45) NULL DEFAULT 'cliente',
  `password` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`username`),
  UNIQUE INDEX `email_UNIQUE` (`email` ASC))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `ttounkyo`.`pedidos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ttounkyo`.`pedidos` (
  `idpedido` INT(11) NOT NULL AUTO_INCREMENT,
  `idmetodopago` VARCHAR(45) NOT NULL,
  `estado` VARCHAR(20) NULL DEFAULT NULL,
  `fecha` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `username` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idpedido`),
  INDEX `fk_compras_usuarios1_idx` (`username` ASC),
  CONSTRAINT `fk_compras_usuarios1`
    FOREIGN KEY (`username`)
    REFERENCES `ttounkyo`.`usuarios` (`username`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
    )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `ttounkyo`.`pedidos_has_productos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ttounkyo`.`pedidos_has_productos` (
  `pedidos_idpedidos` INT(11) NOT NULL,
  `productos_idproducto` INT(11) NOT NULL,
  PRIMARY KEY (`pedidos_idpedidos`, `productos_idproducto`),
  INDEX `fk_pedidos_has_productos_productos1_idx` (`productos_idproducto` ASC),
  INDEX `fk_pedidos_has_productos_pedidos1_idx` (`pedidos_idpedidos` ASC),
  CONSTRAINT `fk_pedidos_has_productos_pedidos1`
    FOREIGN KEY (`pedidos_idpedidos`)
    REFERENCES `ttounkyo`.`pedidos` (`idpedido`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_pedidos_has_productos_productos1`
    FOREIGN KEY (`productos_idproducto`)
    REFERENCES `ttounkyo`.`productos` (`idproducto`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
    )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `ttounkyo`.`productos_has_media`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ttounkyo`.`productos_has_media` (
  `productos_idproducto` INT(11) NOT NULL,
  `media_idimagen` INT(11) NOT NULL,
  PRIMARY KEY (`productos_idproducto`, `media_idimagen`),
  INDEX `fk_productos_has_media_media1_idx` (`media_idimagen` ASC),
  INDEX `fk_productos_has_media_productos1_idx` (`productos_idproducto` ASC),
  CONSTRAINT `fk_productos_has_media_productos1`
    FOREIGN KEY (`productos_idproducto`)
    REFERENCES `ttounkyo`.`productos` (`idproducto`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_productos_has_media_media1`
    FOREIGN KEY (`media_idimagen`)
    REFERENCES `ttounkyo`.`media` (`idimagen`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

INSERT INTO usuarios(username,password) VALUES("boss", "1234");
INSERT INTO `usuarios`(`username`, `nombre`, `apellidos`, `email`, `telefono`, `direccion`, `password`) VALUES ('antonio','Antonio','Delgado','aa.antonio.delgado@gmail.com','680840609','Crr Sant Carlos','1234');

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
