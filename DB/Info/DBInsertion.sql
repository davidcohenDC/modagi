USE `Modagi`;
# ---------------------------------------------------------------------- #
# ADD VALUES "Colore"                                                    #
# ---------------------------------------------------------------------- #
INSERT INTO `colore` (`id`, `nome`)
VALUES ('1', 'Bianco'),
    ('2', 'Nero'),
    ('3', 'Rosso'),
    ('4', 'Giallo'),
    ('5', 'Blu'),
    ('6', 'Viola'),
    ('7', 'Marrone'),
    ('8', 'Verde'),
    ('9', 'Grigio');
# ---------------------------------------------------------------------- #
# ADD VALUES "Materiale"                                                 #
# ---------------------------------------------------------------------- #
INSERT INTO `materiale` (`id`, `nome`)
VALUES ('1', 'Cuoio'),
    ('2', 'Sintentico'),
    ('3', 'Pelle'),
    ('4', 'Tessuto');
# ---------------------------------------------------------------------- #
# ADD VALUES "Taglia"                                                    #
# ---------------------------------------------------------------------- #
INSERT INTO `taglia` (`id`, `numero`)
VALUES ('1', '39'),
    ('2', '40'),
    ('3', '41'),
    ('4', '42'),
    ('5', '43'),
    ('6', '44'),
    ('7', '45');
# ---------------------------------------------------------------------- #
# ADD VALUES "Genere"                                                    #
# ---------------------------------------------------------------------- #
INSERT INTO `Genere` (`id`, `nome`)
VALUES ('1', 'Uomo'),
    ('2', 'Donna'),
    ('3', 'Unisex');
# ---------------------------------------------------------------------- #
# ADD VALUES "User"                                                      #
# ---------------------------------------------------------------------- #
INSERT INTO `user` (
        `email`,
        `username`,
        `password`,
        `admin`,
        `nome`,
        `cognome`,
        `indirizzo`
    )
VALUES (
        'dev@gmail.com',
        'Dev',
        'davidcohen',
        'S',
        'David',
        'Cohen',
        'Via Roma 1'
    ),
    (
        'more@gmail.com',
        'More',
        'lorenzomorelli',
        'S',
        'Lorenzo',
        'Morelli',
        'Via Test 1'
    ),
    (
        'gigi@gmail.com',
        'Gigi',
        'luigiolivieri',
        'S',
        'Luigi',
        'Olivieri',
        'Via Test 2'
    );
INSERT INTO `user` (
        `email`,
        `username`,
        `password`,
        `admin`,
        `nome`,
        `cognome`,
        `indirizzo`
    )
VALUES (
        'test@gmail.com',
        'test',
        'test',
        'N',
        'testNome',
        'TestCognome',
        'Via Test 3'
    );
# ---------------------------------------------------------------------- #
# ADD VALUES "Categoria"                                                 #
# ---------------------------------------------------------------------- #
INSERT INTO `categoria` (`id`, `nome`)
VALUES ('1', 'Running'),
    ('2', 'Mocassini'),
    ('3', 'Tacchi'),
    ('4', 'Stivali'),
    ('5', 'Classica'),
    ('6', 'Trekking');
# ---------------------------------------------------------------------- #
# ADD VALUES "Marca"                                                     #
# ---------------------------------------------------------------------- #
INSERT INTO `marca` (`id`, `nome`)
VALUES ('1', 'Nike'),
    ('2', 'Timberland'),
    ('4', 'Anna Field'),
    ('5', 'Adidas'),
    ('6', 'New Balance');
# ---------------------------------------------------------------------- #
# ADD VALUES "Prodotto"                                                  #
# ---------------------------------------------------------------------- #
INSERT INTO `prodotto` (
        `id`,
        `prezzo`,
        `descrizione`,
        `nome`,
        `stock`,
        `idColore`,
        `idGenere`,
        `idMateriale`,
        `idMarca`
    )
VALUES (
        '1',
        '74.99',
        'Se vuoi dire la tua in fatto di moda e dimostrare che te ne intendi, scegli le sneakers bianche AIR FORCE 1',
        'Air Max 1',
        '50',
        '1',
        '3',
        '4',
        '1'
    ),
    (
        '2',
        '49.99',
        '',
        'Revolution 5',
        '30',
        '2',
        '1',
        '4',
        '1'
    ),
    (
        '3',
        '104.99',
        '',
        'Af1 Pixel',
        '',
        '4',
        '2',
        '4',
        '4'
    ),
    (
        '4',
        '104.99',
        '',
        'Euro Sprint Hiker',
        '10',
        '7',
        '1',
        '1',
        '2'
    ),
    (
        '5',
        '84.99',
        '',
        'New Balance',
        '5',
        '9',
        '1',
        '4',
        '6'
    ),
    (
        '6',
        '84.99',
        '',
        'ZOOM',
        '30',
        '1',
        '1',
        '2',
        '1'
    ),
    (
        '7',
        '26.59',
        '',
        'Trochetti',
        '45',
        '2',
        '2',
        '3',
        '4'
    ),
    (
        '8',
        '111.99',
        '',
        'Air Max 2090',
        '80',
        '9',
        '1',
        '2',
        '1'
    ),
    (
        '9',
        '16.99',
        '',
        'Pantofole',
        '5',
        '1',
        '2',
        '4',
        '4'
    ),
    (
        '10',
        '124.99',
        '',
        'Air Barrage',
        '60',
        '7',
        '3',
        '4',
        '1'
    );
# ---------------------------------------------------------------------- #
# ADD VALUES "Ordine"                                                    #
# ---------------------------------------------------------------------- #
INSERT INTO `ordine` (`idProdotto`, `email`, `data`, `quantita`)
VALUES ('2', 'test@gmail.com', '2020-12-10', '1'),
    ('1', 'test@gmail.com', '2020-12-10', '2');
INSERT INTO `prodottitaglie` (`idTaglia`, `idProdotto`)
VALUES ('1', '10'),
    ('2', '10'),
    ('3', '10'),
    ('4', '10'),
    ('5', '10'),
    ('1', '2'),
    ('2', '3'),
    ('3', '6'),
    ('5', '7'),
    ('6', '9')