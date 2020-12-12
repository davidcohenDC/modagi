<?php

require_once("Database.php");

//La classe prodotto estende da table che a sua volta estende da Connection. Abbiamo tutti i getter e setter e implementiamo metodi specifici
class Product extends Database {
    private $table;
    public function __construct($table) {
        //richiamo la classe setTable dalla Table
        parent::__construct();
        $this->table = $table;
      }

    public function selectAll() {
      return parent::Select("SELECT * FROM ".$this->table);
    }

}

?>