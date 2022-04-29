<?php

require_once("Database.php");

//La classe prodotto estende da table che a sua volta estende da Connection. Abbiamo tutti i getter e setter e implementiamo metodi specifici
class Product extends Database {
    private $table = "Prodotto";

    public function __construct() {
        //richiamo la classe setTable dalla Table
        parent::__construct();
      }

    public function getAll() {
      return parent::Select("SELECT * FROM ".$this->table);
    }

    public function countAllProduct() {
      return parent::Select("SELECT COUNT(*) as TOT FROM ".$this->table)[0]; 
    }

    public function getTable() {
      return $this->table;
    }

    public function selectByIdWithQuantity($id) {
      return parent::Select("SELECT P.*, SUM(quantita) as stock FROM ".$this->table." P INNER JOIN ProdottiTaglie PT ON
      PT.idProdotto = P.id WHERE P.id = ?",["i",$id]);
    }

    public function selectQuantitaWithNSize($id) {
      return parent::Select("SELECT numero,quantita FROM Prodotto P INNER JOIN ProdottiTaglie PT ON PT.idProdotto= P.id 
      INNER JOIN Taglia T ON PT.idTaglia = T.id WHERE P.id = ? AND PT.quantita > 0",["i",$id]);
    }

    public function selectById($id) {
      return parent::Select("SELECT * FROM ".$this->table. " WHERE id = ?",["i",$id]);
    }

    public function selectByName($name) {
      return parent::Select("SELECT * FROM ".$this->table. " WHERE nome = ?",["s",$name]);
    }

    public function selectMaterialeByID($id) {
      return parent::Select("SELECT Materiale.nome FROM Materiale LEFT JOIN ".$this->table. " ON Materiale.id = ".$this->table. ".idMateriale WHERE ".$this->table.".id = ?",["i",$id]);
    }

    public function selectGenereByID($id) {
      return parent::Select("SELECT Genere.nome FROM Genere LEFT JOIN ".$this->table. " ON Genere.id = ".$this->table. ".idGenere WHERE ".$this->table.".id = ?",["i",$id]);
    }

    public function selectColoreByID($id) {
      return parent::Select("SELECT Colore.nome FROM Colore LEFT JOIN ".$this->table. " ON Colore.id = ".$this->table. ".idColore WHERE ".$this->table.".id = ?",["i",$id]);
    }

    public function selectMarcaByID($id) {
      return parent::Select("SELECT Marca.nome FROM Marca LEFT JOIN ".$this->table. " ON Marca.id = ".$this->table. ".idMarca WHERE ".$this->table.".id = ?",["i",$id]);
    }

    public function selectTagliaByID($id) {
      return parent::Select("SELECT numero FROM ProdottiTaglie PT LEFT JOIN ".$this->table." P ON PT.idProdotto = P.id LEFT JOIN Taglia T ON PT.idTaglia = T.id WHERE idProdotto = ?",["i",$id]);
    }

    public function selectQuantitaTaglia($id, $taglia) {
    return parent::Select("SELECT quantita FROM ProdottiTaglie PT 
                          INNER JOIN ". $this->table ." P ON PT.idProdotto = P.id 
                          INNER JOIN Taglia T ON PT.idTaglia = T.id 
                          WHERE P.id = ? AND T.numero = ?",["ii",$id,$taglia]);

    }
}

?>