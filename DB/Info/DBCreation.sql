# ---------------------------------------------------------------------- #
# SET FORWARD ENGINEERING                                                #
# ---------------------------------------------------------------------- #
SET @OLD_UNIQUE_CHECKS = @@UNIQUE_CHECKS,
     UNIQUE_CHECKS = 0;
SET @OLD_FOREIGN_KEY_CHECKS = @@FOREIGN_KEY_CHECKS,
     FOREIGN_KEY_CHECKS = 0;
SET @OLD_SQL_MODE = @@SQL_MODE,
     SQL_MODE = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';
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
) ENGINE = INNODB;
# ---------------------------------------------------------------------- #
# ADD TABLE "Taglia"                                                     #
# ---------------------------------------------------------------------- #
CREATE TABLE IF NOT EXISTS `Taglia` (
     `id` INT NOT NULL,
     `numero` INT NOT NULL,
     PRIMARY KEY (`id`)
) ENGINE = INNODB;
# ---------------------------------------------------------------------- #
# ADD TABLE "ProdottiTaglia"                                                    #
# ---------------------------------------------------------------------- #
CREATE TABLE IF NOT EXISTS `ProdottiTaglie` (
     `idTaglia` INT NOT NULL,
     `idProdotto` INT NOT NULL,
     `quantita` INT NOT NULL,
     PRIMARY KEY (`idTaglia`, `idProdotto`)
) ENGINE = INNODB;
# ---------------------------------------------------------------------- #
# ADD TABLE "Categoria"                                                  #
# ---------------------------------------------------------------------- #
CREATE TABLE IF NOT EXISTS `Categoria` (
     `id` INT NOT NULL AUTO_INCREMENT,
     `nome` CHAR(20) NOT NULL,
     PRIMARY KEY (`id`)
) ENGINE = INNODB;
# ---------------------------------------------------------------------- #
# ADD TABLE "Colore"                                                     #
# ---------------------------------------------------------------------- #
CREATE TABLE IF NOT EXISTS `Colore` (
     `id` INT NOT NULL AUTO_INCREMENT,
     `nome` CHAR(20) NOT NULL,
     PRIMARY KEY (`id`)
) ENGINE = INNODB;
CREATE TABLE IF NOT EXISTS `Materiale` (
     `id` INT NOT NULL AUTO_INCREMENT,
     `nome` CHAR(20) NOT NULL,
     PRIMARY KEY (`id`)
) ENGINE = INNODB;
# ---------------------------------------------------------------------- #
# ADD TABLE "Ordine"                                                     #
# ---------------------------------------------------------------------- #
CREATE TABLE IF NOT EXISTS `Ordine` (
	 `id` INT NOT NULL AUTO_INCREMENT,
     `idProdotto` INT NOT NULL,
     `email` CHAR(20) NOT NULL,
     `data` DATE NOT NULL,
     `quantita` INT NOT NULL,
     `idStato` INT NOT NULL,
     PRIMARY KEY (`id`)
) ENGINE = INNODB;


# ---------------------------------------------------------------------- #
# ADD TABLE "StatoOrdine"                                                #
# ---------------------------------------------------------------------- #
CREATE TABLE IF NOT EXISTS `StatoOrdine` (
	`id` INT NOT NULL AUTO_INCREMENT,
     `nome` INT NOT NULL,
     PRIMARY KEY (`id`)
) ENGINE = INNODB;

# ---------------------------------------------------------------------- #
# ADD TABLE "Prodotto"                                                   #
# ---------------------------------------------------------------------- #
CREATE TABLE IF NOT EXISTS `Prodotto` (
     `id` INT NOT NULL AUTO_INCREMENT,
     `prezzo` decimal(5, 2) NOT NULL,
     `descrizione` VARCHAR(256) NOT NULL,
     `nome` CHAR(200) NOT NULL,
     `idColore` INT NOT NULL,
     `idGenere` INT NOT NULL,
     `idMateriale` INT NOT NULL,
     `idMarca` INT NOT NULL,
     PRIMARY KEY (`id`)
) ENGINE = INNODB;
# ---------------------------------------------------------------------- #
# ADD TABLE "genere"                                                      #
# ---------------------------------------------------------------------- #
CREATE TABLE IF NOT EXISTS `Genere` (
     `id` INT NOT NULL AUTO_INCREMENT,
     `nome` CHAR(20) NOT NULL,
     PRIMARY KEY (`id`)
) ENGINE = INNODB;
# ---------------------------------------------------------------------- #
# ADD TABLE "User"                                                    #
# ---------------------------------------------------------------------- #
CREATE TABLE IF NOT EXISTS `User` (
     `email` CHAR(40) NOT NULL,
     `username` CHAR(20) NOT NULL,
     `password` CHAR(20) NOT NULL,
     `admin` CHAR NOT NULL,
     `nome` CHAR(20) NOT NULL,
     `cognome` CHAR(20) NOT NULL,
     `indirizzo` CHAR(20) NOT NULL,
     PRIMARY KEY (`email`)
) ENGINE = INNODB;
# ---------------------------------------------------------------------- #
# ADD TABLE "Marca"                                                      #
# ---------------------------------------------------------------------- #
CREATE TABLE IF NOT EXISTS `marca` (
     `id` INT NOT NULL AUTO_INCREMENT,
     `nome` VARCHAR(50) NOT NULL,
     PRIMARY KEY (`Id`)
) ENGINE = InnoDB;
# ---------------------------------------------------------------------- #
# ADD INDEX SECTION                                                      #
# ---------------------------------------------------------------------- #
CREATE UNIQUE INDEX `PK_ProdottiCategorie` ON `ProdottiCategorie` (`idCategoria`, `idProdotto`);
CREATE INDEX `FK_ProCat_Prodotto` ON `ProdottiCategorie` (`idProdotto`);
CREATE INDEX `FK_ProCat_Categoria` ON `ProdottiCategorie` (`idCategoria`);
CREATE UNIQUE INDEX `PK_ProdottiTaglie` ON `ProdottiTaglie` (`idTaglia`, `idProdotto`);
CREATE INDEX `FK_ProTag_Prodotto` ON `ProdottiTaglie` (`idProdotto`);
CREATE INDEX `FK_ProTag_Taglia` ON `ProdottiTaglie` (`idTaglia`);
CREATE UNIQUE INDEX `PK_Colore` ON `Colore` (`id`);
CREATE UNIQUE INDEX `PK_Colore` ON `Taglia` (`id`);
CREATE UNIQUE INDEX `PK_Materiale` ON `Materiale` (`id`);
CREATE UNIQUE INDEX `PK_Ordine` ON `Ordine` (`id`);
CREATE INDEX `FK_Ordine_Email` ON `Ordine` (`email`);
CREATE INDEX `FK_Ordine_Stato` ON `Ordine` (`idStato`);
CREATE UNIQUE INDEX `PK_Prodotto` ON `Prodotto` (`id`);
CREATE INDEX `FK_Prodotto_Colore` ON `Prodotto` (`idColore`);
CREATE INDEX `FK_Prodotto_Genere` ON `Prodotto` (`idGenere`);
CREATE INDEX `FK_Prodotto_Materiale` ON `Prodotto` (`idMateriale`);
CREATE UNIQUE INDEX `PK_Genere` ON `Genere` (`id`);
CREATE UNIQUE INDEX `PK_Email` ON `User` (`email`);
CREATE UNIQUE INDEX `PK_Marca` ON `Marca` (`id`);
CREATE UNIQUE INDEX `PK_Stato` ON `StatoOrdine` (`id`);

# ---------------------------------------------------------------------- #
# FOREIGN KEY CONSTRAINTS                                                #
# ---------------------------------------------------------------------- #
ALTER TABLE `ProdottiCategorie`
ADD CONSTRAINT `FK_ProCat_Prodotto` FOREIGN KEY (`idProdotto`) REFERENCES `Prodotto` (`id`);
ALTER TABLE `ProdottiCategorie`
ADD CONSTRAINT `FK_ProCat_Categoria` FOREIGN KEY (`idCategoria`) REFERENCES `Categoria` (`id`);
ALTER TABLE `ProdottiTaglie`
ADD CONSTRAINT `FK_ProTag_Prodotto` FOREIGN KEY (`idProdotto`) REFERENCES `Prodotto` (`id`);
ALTER TABLE `ProdottiTaglie`
ADD CONSTRAINT `FK_ProTag_Taglia` FOREIGN KEY (`idTaglia`) REFERENCES `Taglia` (`id`);
ALTER TABLE `Ordine`
ADD CONSTRAINT `FK_Ordine_Email` FOREIGN KEY (`email`) REFERENCES `User` (`email`);
ALTER TABLE `Ordine`
ADD CONSTRAINT `FK_Ordine_Prodotto` FOREIGN KEY (`idProdotto`) REFERENCES `Prodotto` (`id`);
ALTER TABLE `Ordine`
ADD CONSTRAINT `FK_Ordine_Stato` FOREIGN KEY (`idStato`) REFERENCES `StatoOrdine` (`id`);
ALTER TABLE `Prodotto`
ADD CONSTRAINT `FK_Prodotto_Colore` FOREIGN KEY (`idColore`) REFERENCES `Colore` (`id`);
ALTER TABLE `Prodotto`
ADD CONSTRAINT `FK_Prodotto_Genere` FOREIGN KEY (`idGenere`) REFERENCES `Genere` (`id`);
ALTER TABLE `Prodotto`
ADD CONSTRAINT `FK_Prodotto_Materiale` FOREIGN KEY (`idMateriale`) REFERENCES `Materiale` (`id`);
ALTER TABLE `Prodotto`
ADD CONSTRAINT `FK_Prodotto_Marca` FOREIGN KEY (`idMarca`) REFERENCES `Marca` (`id`);