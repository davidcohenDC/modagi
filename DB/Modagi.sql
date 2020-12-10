CREATE DATABASE IF NOT EXISTS `ShopOnline`;


# ---------------------------------------------------------------------- #
# ADD TABLE "Cliente"                                                    #
# ---------------------------------------------------------------------- #

CREATE TABLE `ProdottiCategorie` (
     `idCategoria` INT NOT NULL,
     `idProdotto` INT NOT NULL,
     PRIMARY KEY (`idCategoria`, `idProdotto`)
) ENGINE=INNODB;

# ---------------------------------------------------------------------- #
# ADD TABLE "Categoria"                                                  #
# ---------------------------------------------------------------------- #

CREATE TABLE `Categoria` (
     `idCategoria` INT NOT NULL,
     `nomeCategoria` CHAR(20) NOT NULL,
     PRIMARY KEY (`idCategoria`)
) ENGINE=INNODB;
# ---------------------------------------------------------------------- #
# ADD TABLE "Colore"                                                     #
# ---------------------------------------------------------------------- #

CREATE TABLE `Colore` (
     `id` INT NOT NULL,
     `nomeColore` CHAR(20) NOT NULL,
     PRIMARY KEY (`id`)
) ENGINE=INNODB;

CREATE TABLE `Materiale` (
     `idMateriale` INT NOT NULL,
     `nomeMateriale` CHAR(20) NOT NULL,
     PRIMARY KEY (`idMateriale`)
) ENGINE=INNODB;

# ---------------------------------------------------------------------- #
# ADD TABLE "Ordine"                                                     #
# ---------------------------------------------------------------------- #

CREATE TABLE `Ordine` (
     `idProdotto` INT NOT NULL,
     `username` CHAR(20) NOT NULL,
     `Data` DATE NOT NULL,
     `quantita` CHAR(1) NOT NULL,
     PRIMARY KEY (`idProdotto`, `username`, `Data`)
) ENGINE=INNODB;

# ---------------------------------------------------------------------- #
# ADD TABLE "Prodotto"                                                   #
# ---------------------------------------------------------------------- #

CREATE TABLE `Prodotto` (
     `id` INT NOT NULL,
     `prezzo` decimal(5,2) NOT NULL,
     `descrizione` VARCHAR(256) NOT NULL,
     `nome` CHAR(20) NOT NULL,
     `stock` INT NOT NULL,
     `idColore` INT NOT NULL,
     `sesso` CHAR(1) NOT NULL,
     `idMateriale` INT NOT NULL,
     PRIMARY KEY (`id`)
) ENGINE=INNODB;

# ---------------------------------------------------------------------- #
# ADD TABLE "Sesso"                                                      #
# ---------------------------------------------------------------------- #

CREATE TABLE `SESSO` (
     `tipoSesso` CHAR(1) NOT NULL,
     PRIMARY KEY (`tipoSesso`)
) ENGINE=INNODB;

# ---------------------------------------------------------------------- #
# ADD TABLE "User"                                                    #
# ---------------------------------------------------------------------- #

CREATE TABLE `User` (
     `username` CHAR(20) NOT NULL,
     `password` CHAR(20) NOT NULL,
     `Admin` CHAR NOT NULL,
     `Nome` CHAR(20) NOT NULL,
     `Cognome` CHAR(20) NOT NULL,
     `Indirizzo` CHAR(20) NOT NULL,
     PRIMARY KEY (`username`)
) ENGINE=INNODB;

# ---------------------------------------------------------------------- #
# ADD View "INDEX SECTION"                                               #
# ---------------------------------------------------------------------- #


CREATE UNIQUE INDEX `PK_ProdottiCategorie`
     ON `ProdottiCategorie` (`idCategoria`, `idProdotto`);

CREATE INDEX `FK_ProCat_Prodotto`
     ON `ProdottiCategorie` (`idProdotto`);

CREATE UNIQUE INDEX `FK_ProCat_Categoria`
     ON `Categoria` (`idCategoria`);

CREATE UNIQUE INDEX `PK_Colore`
     ON `Colore` (`id`);

CREATE UNIQUE INDEX `PK_Materiale`
     ON `Materiale` (`idMateriale`);

CREATE UNIQUE INDEX `PK_Ordine`
     ON `Ordine` (`idProdotto`, `username`, `Data`);

CREATE INDEX `FK_Ordine_Username`
     ON `Ordine` (`username`);

CREATE UNIQUE INDEX `PK_Prodotto`
     ON `Prodotto` (`id`);

CREATE INDEX `FK_Prodotto_Colore`
     ON `Prodotto` (`idColore`);

CREATE INDEX `FK_Prodotto_Sesso`
     ON Prodotto (sesso);

CREATE INDEX `FK_Prodotto_Materiale`
     ON `Prodotto` (`idMateriale`);

CREATE UNIQUE INDEX `PK_Sesso`
     ON `SESSO` (`tipoSesso`);

CREATE UNIQUE INDEX `PK_Username`
     ON `User` (`username`);


# ---------------------------------------------------------------------- #
# FOREIGN KEY CONSTRAINTS                                                #
# ---------------------------------------------------------------------- #

ALTER TABLE `ProdottiCategorie` ADD CONSTRAINT `FK_ProCat_Prodotto`
     FOREIGN KEY (`idProdotto`)
     REFERENCES `Prodotto` (`id`);

ALTER TABLE `ProdottiCategorie` ADD CONSTRAINT `FK_ProCat_Categoria`
     FOREIGN KEY (`idCategoria`)
     REFERENCES `Categoria` (`idCategoria`);

ALTER TABLE `Ordine` ADD CONSTRAINT `FK_Ordine_Username`
     FOREIGN KEY (`username`)
     REFERENCES `User` (`username`);

ALTER TABLE `Ordine` ADD CONSTRAINT `FK_Ordine_Prodotto`
     FOREIGN KEY (`idProdotto`)
     REFERENCES `Prodotto` (`id`);

ALTER TABLE `Prodotto` ADD CONSTRAINT `FK_Prodotto_Colore`
     FOREIGN KEY (`idColore`)
     REFERENCES `Colore` (`id`);

ALTER TABLE `Prodotto` ADD CONSTRAINT `FK_Prodotto_Sesso`
     FOREIGN KEY (`sesso`)
     REFERENCES `SESSO` (`tipoSesso`);

ALTER TABLE `Prodotto` ADD CONSTRAINT `FK_Prodotto_Materiale`
     FOREIGN KEY (`idMateriale`)
     REFERENCES `Materiale` (`idMateriale`);



# ---------------------------------------------------------------------- #
# ADD info INTo "Cliente"                                                #
# ---------------------------------------------------------------------- #

# ---------------------------------------------------------------------- #
# ADD View "Ricerca Sito Web Libero"                                     #
# ---------------------------------------------------------------------- #
