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
      return parent::Select("SELECT P.*, SUM(quantita) as stock FROM ".$this->table." P INNER JOIN prodottitaglie PT ON
      PT.idProdotto = P.id WHERE P.id = ".$id);
    }

    public function selectQuantitaWithNSize($id) {
      return parent::Select("SELECT numero,quantita FROM Prodotto P INNER JOIN prodottitaglie PT ON PT.idProdotto= P.id 
      INNER JOIN taglia T ON PT.idTaglia = T.id WHERE P.id = ".$id. " AND PT.quantita > 0");
    }

    public function selectById($id) {
      return parent::Select("SELECT * FROM ".$this->table. " WHERE id = ".$id);
    }

    public function selectByName($name) {
      return parent::Select("SELECT * FROM ".$this->table. " WHERE nome = '".$name."'");
    }

    public function selectMaterialeByID($id) {
      return parent::Select("SELECT materiale.nome FROM materiale LEFT JOIN ".$this->table. " ON materiale.id = ".$this->table. ".idMateriale WHERE ".$this->table.".id = ".$id);
    }

    public function selectGenereByID($id) {
      return parent::Select("SELECT genere.nome FROM genere LEFT JOIN ".$this->table. " ON genere.id = ".$this->table. ".idGenere WHERE ".$this->table.".id = ".$id);
    }

    public function selectColoreByID($id) {
      return parent::Select("SELECT colore.nome FROM colore LEFT JOIN ".$this->table. " ON colore.id = ".$this->table. ".idColore WHERE ".$this->table.".id = ".$id);
    }

    public function selectMarcaByID($id) {
      return parent::Select("SELECT marca.nome FROM marca LEFT JOIN ".$this->table. " ON marca.id = ".$this->table. ".idMarca WHERE ".$this->table.".id = ".$id);
    }

    public function selectTagliaByID($id) {
      return parent::Select(("SELECT numero FROM prodottitaglie PT LEFT JOIN ".$this->table." P ON PT.idProdotto = P.id LEFT JOIN taglia T ON PT.idTaglia = T.id WHERE idProdotto = ").$id);
    }


}

?>