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

    public function limit($query, $stop, $start = 0) {

      if($start) {
        $query = $query ." LIMIT ".$start.", ".$stop;
      } else {
        $query = $query ." LIMIT ".$stop;
      }
      return parent::Select($query);
    }

    public function getTable() {
      return $this->table;
    }

}

?>