# ---------------------------------------------------------------------- #
# SET FORWARD ENGINEERING                                                #
# ---------------------------------------------------------------------- #

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

# ---------------------------------------------------------------------- #
# CREATE SCHEMA DB                                                       #
# ---------------------------------------------------------------------- #

CREATE DATABASE IF NOT EXISTS `Modagi`;
USE `Modagi`;

# ---------------------------------------------------------------------- #
# ADD TABLE "Cliente"                                                    #
# ---------------------------------------------------------------------- #

CREATE TABLE IF NOT EXISTS `ProdottiCategorie` (
    `idCategoria` INT NOT NULL,
    `idProdotto` INT NOT NULL,
    PRIMARY KEY (`idCategoria`, `idProdotto`)
) ENGINE=INNODB;

# ---------------------------------------------------------------------- #
# ADD TABLE "Categoria"                                                  #
# ---------------------------------------------------------------------- #

CREATE TABLE IF NOT EXISTS `Categoria` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `nome` CHAR(20) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=INNODB;

# ---------------------------------------------------------------------- #
# ADD TABLE "Colore"                                                     #
# ---------------------------------------------------------------------- #

CREATE TABLE IF NOT EXISTS `Colore` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `nome` CHAR(20) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=INNODB;

CREATE TABLE IF NOT EXISTS `Materiale` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `nome` CHAR(20) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=INNODB;

# ---------------------------------------------------------------------- #
# ADD TABLE "Ordine"                                                     #
# ---------------------------------------------------------------------- #

CREATE TABLE IF NOT EXISTS `Ordine` (
    `idProdotto` INT NOT NULL,
    `username` CHAR(20) NOT NULL,
    `data` DATE NOT NULL,
    `quantita` CHAR(1) NOT NULL,
    PRIMARY KEY (`idProdotto`, `username`, `Data`)
) ENGINE=INNODB;

# ---------------------------------------------------------------------- #
# ADD TABLE "Prodotto"                                                   #
# ---------------------------------------------------------------------- #

CREATE TABLE IF NOT EXISTS `Prodotto` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `prezzo` decimal(5,2) NOT NULL,
    `descrizione` VARCHAR(256) NOT NULL,
    `nome` CHAR(200) NOT NULL,
    `stock` INT NOT NULL,
    `idColore` INT NOT NULL,
    `genere` CHAR(1) NOT NULL,
    `idMateriale` INT NOT NULL,
    `idMarca` INT NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=INNODB;

# ---------------------------------------------------------------------- #
# ADD TABLE "genere"                                                      #
# ---------------------------------------------------------------------- #

CREATE TABLE IF NOT EXISTS `Genere` (
    `tipoGenere` CHAR(1) NOT NULL,
    PRIMARY KEY (`tipoGenere`)
) ENGINE=INNODB;

# ---------------------------------------------------------------------- #
# ADD TABLE "User"                                                    #
# ---------------------------------------------------------------------- #

CREATE TABLE IF NOT EXISTS `User` (
    `username` CHAR(20) NOT NULL,
    `password` CHAR(20) NOT NULL,
    `admin` CHAR NOT NULL,
    `nome` CHAR(20) NOT NULL,
    `cognome` CHAR(20) NOT NULL,
    `indirizzo` CHAR(20) NOT NULL,
    PRIMARY KEY (`username`)
) ENGINE=INNODB;

# ---------------------------------------------------------------------- #
# ADD TABLE "Marca"                                                      #
# ---------------------------------------------------------------------- #

CREATE TABLE IF NOT EXISTS `marca` ( 
     `id` INT NOT NULL AUTO_INCREMENT,
     `nome` VARCHAR(50) NOT NULL,
     PRIMARY KEY (`Id`)) ENGINE = InnoDB;

# ---------------------------------------------------------------------- #
# ADD INDEX SECTION                                                      #
# ---------------------------------------------------------------------- #


CREATE UNIQUE INDEX `PK_ProdottiCategorie`
     ON `ProdottiCategorie` (`idCategoria`, `idProdotto`);

CREATE INDEX `FK_ProCat_Prodotto`
     ON `ProdottiCategorie` (`idProdotto`);

CREATE UNIQUE INDEX `FK_ProCat_Categoria`
     ON `Categoria` (`id`);

CREATE UNIQUE INDEX `PK_Colore`
     ON `Colore` (`id`);

CREATE UNIQUE INDEX `PK_Materiale`
     ON `Materiale` (`id`);

CREATE UNIQUE INDEX `PK_Ordine`
     ON `Ordine` (`idProdotto`, `username`, `Data`);

CREATE INDEX `FK_Ordine_Username`
     ON `Ordine` (`username`);

CREATE UNIQUE INDEX `PK_Prodotto`
     ON `Prodotto` (`id`);

CREATE INDEX `FK_Prodotto_Colore`
     ON `Prodotto` (`idColore`);

CREATE INDEX `FK_Prodotto_Genere`
     ON `Prodotto` (`Genere`);

CREATE INDEX `FK_Prodotto_Materiale`
     ON `Prodotto` (`idMateriale`);

CREATE UNIQUE INDEX `PK_Genere`
     ON `Genere` (`tipoGenere`);

CREATE UNIQUE INDEX `PK_Username`
     ON `User` (`username`);

CREATE UNIQUE INDEX `PK_Marca`
     ON `Marca` (`id`);


# ---------------------------------------------------------------------- #
# FOREIGN KEY CONSTRAINTS                                                #
# ---------------------------------------------------------------------- #

ALTER TABLE `ProdottiCategorie` ADD CONSTRAINT `FK_ProCat_Prodotto`
     FOREIGN KEY (`idProdotto`)
     REFERENCES `Prodotto` (`id`);

ALTER TABLE `ProdottiCategorie` ADD CONSTRAINT `FK_ProCat_Categoria`
     FOREIGN KEY (`idCategoria`)
     REFERENCES `Categoria` (`id`);

ALTER TABLE `Ordine` ADD CONSTRAINT `FK_Ordine_Username`
     FOREIGN KEY (`username`)
     REFERENCES `User` (`username`);

ALTER TABLE `Ordine` ADD CONSTRAINT `FK_Ordine_Prodotto`
     FOREIGN KEY (`idProdotto`)
     REFERENCES `Prodotto` (`id`);

ALTER TABLE `Prodotto` ADD CONSTRAINT `FK_Prodotto_Colore`
     FOREIGN KEY (`idColore`)
     REFERENCES `Colore` (`id`);

ALTER TABLE `Prodotto` ADD CONSTRAINT `FK_Prodotto_Genere`
     FOREIGN KEY (`genere`)
     REFERENCES `Genere` (`tipoGenere`);

ALTER TABLE `Prodotto` ADD CONSTRAINT `FK_Prodotto_Materiale`
     FOREIGN KEY (`idMateriale`)
     REFERENCES `Materiale` (`id`);

ALTER TABLE `Prodotto` ADD CONSTRAINT `FK_Prodotto_Marca`
     FOREIGN KEY (`idMarca`)
     REFERENCES `Marca` (`id`);



