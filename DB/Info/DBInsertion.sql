USE `Modagi`;

# ---------------------------------------------------------------------- #
# ADD VALUES "Colore"                                          #
# ---------------------------------------------------------------------- #

INSERT INTO `colore` (`idColore`, `nomeColore`) 
VALUES ('1', 'Bianco'), ('2', 'Nero'), ('3', 'Rosso'), ('4', 'Giallo'), ('5', 'Blu'), ('6', 'Viola'), ('7', 'Marrone'), ('8', 'Verde'), ('9', 'Grigio');

# ---------------------------------------------------------------------- #
# ADD VALUES "Materiale"                                       #
# ---------------------------------------------------------------------- #

INSERT INTO `materiale` (`idMateriale`, `nomeMateriale`) 
VALUES ('1', 'Cuoio'), ('2', 'Sintentico'), ('3', 'Pelle'), ('4', 'Tessuto');

# ---------------------------------------------------------------------- #
# ADD VALUES "Genere"                                           #
# ---------------------------------------------------------------------- #

INSERT INTO `Genere` (`tipoGenere`) 
VALUES ('M'), ('F'), ('UNISEX');

# ---------------------------------------------------------------------- #
# ADD VALUES "User"                                            #
# ---------------------------------------------------------------------- #

INSERT INTO `user` (`username`, `password`, `Admin`, `Nome`, `Cognome`, `Indirizzo`) 
VALUES ('Dev', 'davidcohehn', 'S', 'David', 'Cohen', 'Via Roma 1'), ('More', 'lorenzomorelli', 
'S', 'Lorenzo', 'Morelli', 'Via Test 1'), ('Gigi', 'luigiolivieri', 'S', 'Luigi', 'Olivieri', 'Via Test 2');

INSERT INTO `user` (`username`, `password`, `Admin`, `Nome`, `Cognome`, `Indirizzo`) 
VALUES ('test', 'test', 'N', 'testNome', 'TestCognome', 'Via Test 3');

# ---------------------------------------------------------------------- #
# ADD VALUES "Categoria"                                       #
# ---------------------------------------------------------------------- #

INSERT INTO `categoria` (`idCategoria`, `nomeCategoria`) 
VALUES ('1', 'Running'), ('2', 'Mocassini'), ('3', 'Tacchi'), ('4', 'Stivali'), ('5', 'Classica'), ('6', 'Trekking');

# ---------------------------------------------------------------------- #
# ADD VALUES "Prodotto"                                        #
# ---------------------------------------------------------------------- #

INSERT INTO `prodotto` (`idProdotto`, `prezzo`, `descrizione`, `nome`, `stock`, `idColore`, `genere`, `idMateriale`) 
VALUES ('1', '149,99', 'Niente è più elegante, confortevole e affidabile. Nike Air Max 90 resta fedele alle origini da running della prima edizione 
grazie all\'iconica suola con motivo waffle, agli strati esterni cuciti e alle iconiche linee di design.', 
'Nike Air Max 90', '50', '1', 'M', '4'), ('2', '89,99', 'Chukka da uomo con tomaia in pelle Better Leather proveniente da fonti 
ecosostenibili e fodera in tessuto ReBOTL™ realizzata con almeno il 50% di plastica riciclata per un ridotto impatto ambientale. 
Sistema Aerocore™ integrato per una maggiore durata e un effetto ammortizzante a ritorno di energia.', 'Timberland Chukka', '30', '7', 'M', '1');

# ---------------------------------------------------------------------- #
# ADD VALUES "Ordine"                                          #
# ---------------------------------------------------------------------- #

INSERT INTO `ordine` (`idProdotto`, `username`, `Data`, `quantita`) 
VALUES ('2', 'test', '2020-12-10', '1'), ('1', 'test', '2020-12-10', '2');