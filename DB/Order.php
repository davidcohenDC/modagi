<?php

require_once("Database.php");

//La classe prodotto estende da table che a sua volta estende da Connection. Abbiamo tutti i getter e setter e implementiamo metodi specifici
class Order extends Database {
    private $table = "ordine";

    public function __construct() {
        //richiamo la classe setTable dalla Table
        parent::__construct();
      }

    public function getAll() {
      return parent::Select("SELECT * FROM ".$this->table);
    }

    public function countAll() {
      return parent::Select("SELECT COUNT(*) as TOT FROM ".$this->table)[0]; 
    }

    public function getTable() {
      return $this->table;
    }

    public function selectbyID($id) {
      return parent::Select("SELECT * FROM ".$this->table. " WHERE id = ".$id);
    }

    public function selectTopProduct($limit) {
        return parent::Select("SELECT idProdotto, SUM(quantita) AS quantita FROM ".$this->table." GROUP BY idProdotto ORDER BY quantita DESC LIMIT ".$limit);
    }

}

?>