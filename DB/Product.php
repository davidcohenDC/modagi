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

    public function selectById($id) {
      return parent::Select("SELECT * FROM ".$this->table. " WHERE id = ".$id);
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


}

?>