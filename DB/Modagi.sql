-- Database Section
-- ________________ 

create database Modagi;
use Modagi;


-- Tables Section
-- _____________ 

create table AppartenenzaProdCat (
	idCategoria int not null,
	idProdotto int not null,
	primary key (idCategoria, idProdotto)
);

create table Categoria (
    idCategoria int not null AUTO_INCREMENT,
    nomeCategoria char(20) not null,
    primary key (idCategoria)
);

create table Colore (
    idColore int not null AUTO_INCREMENT,
    nomeColore char(20) not null,
    primary key (idColore)
);

create table Materiale (
    idMateriale int not null AUTO_INCREMENT,
    nomeMateriale char(20) not null,
    primary key (idMateriale)
);

create table Ordine (
    idProdotto int not null,
    username char(20) not null,
    data date not null,
    quantita char(1) not null,
    primary key (idProdotto, username, data)
);

create table Prodotto (
    idProdotto int not null AUTO_INCREMENT,
    prezzo decimal(5,2) not null,
    descrizione varchar(256) not null,
    nome char(20) not null,
    disponibilita int not null,
    idColore int not null,
    sesso char(1) not null,
    idMateriale int not null,
    primary key (idProdotto)
);

create table SESSO (
    tipoSesso char(1) not null,
    primary key (tipoSesso)
);

create table User (
    username char(20) not null,
    password char(20) not null,
    admin char not null,
    nome char(20) not null,
    cognome char(20) not null,
    indirizzo char(20) not null,
    primary key (username)
);


alter table AppartenenzaProdCat
	foreign key (idCategoria) references Categoria(idCategoria);

alter table AppartenenzaProdCat
	foreign key (idProdotto) references Prodotto(idProdotto);

alter table Ordine
	foreign key (idProdotto) references Prodotto(idProdotto);

alter table Ordine
	foreign key (username) references User(username)

alter table Prodotto
	foreign key (idColore) references Colore(idColore)

alter table Prodotto
	foreign key (sesso) references SESSO(tipoSesso)

alter table Prodotto
	foreign key (idMateriale) references Materiale(idMateriale)