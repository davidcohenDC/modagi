<?php

//La classe prodotto estende da table che a sua volta estende da Connection. Abbiamo tutti i getter e setter e implementiamo metodi specifici
class Product extends Table {
    public function __construct() {
        //richiamo la classe setTable dalla Table
        parent::__construct("`Prodotto`");
      }

}

?>