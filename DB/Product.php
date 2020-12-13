<?php

require_once("Database.php");

//La classe prodotto estende da table che a sua volta estende da Connection. Abbiamo tutti i getter e setter e implementiamo metodi specifici
class Product extends Database {
    private $table = "Prodotto";
    private $nProductForPage = 10;

    public function __construct() {
        //richiamo la classe setTable dalla Table
        parent::__construct();
      }

    public function selectAll() {
      return parent::Select("SELECT * FROM ".$this->table);
    }

    public function getNumberOfRecordPerPage() {
      return $this->nProductForPage;
    }

    public function setNumberOfRecordPerPage($nProductForPage) {
      $this->nProductForPage =$nProductForPage;
    }

    public function getTotalPages() {
      $rows = parent::Select("SELECT COUNT(*) as TOT FROM ".$this->table)[0]; 
      $total_pages = ceil($rows["TOT"] / $this->nProductForPage);
      return $total_pages;
    }

    public function Pagination($offset) {
      return parent::Select("SELECT * FROM ".$this->table." LIMIT ".$offset.", ".$this->nProductForPage);
    }

}

?>