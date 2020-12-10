CREATE DATABASE IF NOT EXISTS `Modagi`;


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
     `nome` CHAR(200) NOT NULL,
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
# ADD INDEX SECTION                                                      #
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
# ADD VALUES tipoSesso "Colore"                                          #
# ---------------------------------------------------------------------- #

INSERT INTO `colore` (`id`, `nomeColore`) 
VALUES ('1', 'Bianco'), ('2', 'Nero'), ('3', 'Rosso'), ('4', 'Giallo'), ('5', 'Blu'), ('6', 'Viola'), ('7', 'Marrone'), ('8', 'Verde'), ('9', 'Grigio');

# ---------------------------------------------------------------------- #
# ADD VALUES tipoSesso "Materiale"                                       #
# ---------------------------------------------------------------------- #

INSERT INTO `materiale` (`idMateriale`, `nomeMateriale`) 
VALUES ('1', 'Cuoio'), ('2', 'Sintentico'), ('3', 'Pelle'), ('4', 'Tessuto');

# ---------------------------------------------------------------------- #
# ADD VALUES tipoSesso "Sesso"                                           #
# ---------------------------------------------------------------------- #

INSERT INTO `sesso` (`tipoSesso`) 
VALUES ('M'), ('F');

# ---------------------------------------------------------------------- #
# ADD VALUES tipoSesso "User"                                            #
# ---------------------------------------------------------------------- #

INSERT INTO `user` (`username`, `password`, `Admin`, `Nome`, `Cognome`, `Indirizzo`) 
VALUES ('Dev', 'davidcohehn', 'S', 'David', 'Cohen', 'Via Roma 1'), ('More', 'lorenzomorelli', 
'S', 'Lorenzo', 'Morelli', 'Via Test 1'), ('Gigi', 'luigiolivieri', 'S', 'Luigi', 'Olivieri', 'Via Test 2');

INSERT INTO `user` (`username`, `password`, `Admin`, `Nome`, `Cognome`, `Indirizzo`) 
VALUES ('test', 'test', 'N', 'testNome', 'TestCognome', 'Via Test 3');

# ---------------------------------------------------------------------- #
# ADD VALUES tipoSesso "Categoria"                                       #
# ---------------------------------------------------------------------- #

INSERT INTO `categoria` (`idCategoria`, `nomeCategoria`) 
VALUES ('1', 'Running'), ('2', 'Mocassini'), ('3', 'Tacchi'), ('4', 'Stivali'), ('5', 'Classica'), ('6', 'Trekking');

# ---------------------------------------------------------------------- #
# ADD VALUES tipoSesso "Prodotto"                                        #
# ---------------------------------------------------------------------- #

INSERT INTO `prodotto` (`id`, `prezzo`, `descrizione`, `nome`, `stock`, `idColore`, `sesso`, `idMateriale`) 
VALUES ('1', '149,99', 'Niente è più elegante, confortevole e affidabile. Nike Air Max 90 resta fedele alle origini da running della prima edizione 
grazie all\'iconica suola con motivo waffle, agli strati esterni cuciti e alle iconiche linee di design.', 
'Nike Air Max 90', '50', '1', 'M', '4'), ('2', '89,99', 'Chukka da uomo con tomaia in pelle Better Leather proveniente da fonti 
ecosostenibili e fodera in tessuto ReBOTL™ realizzata con almeno il 50% di plastica riciclata per un ridotto impatto ambientale. 
Sistema Aerocore™ integrato per una maggiore durata e un effetto ammortizzante a ritorno di energia.', 'Timberland Chukka', '30', '7', 'M', '1');

# ---------------------------------------------------------------------- #
# ADD VALUES tipoSesso "Ordine"                                          #
# ---------------------------------------------------------------------- #

INSERT INTO `ordine` (`idProdotto`, `username`, `Data`, `quantita`) 
VALUES ('2', 'test', '2020-12-10', '1'), ('1', 'test', '2020-12-10', '2');

