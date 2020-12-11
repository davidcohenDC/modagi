<?php

//La classe prodotto estende da table che a sua volta estende da Connection. Abbiamo tutti i getter e setter e implementiamo metodi specifici
class Product extends Table {
    public function __construct() {
        //richiamo la classe setTable dalla Table
        parent::__construct("`Prodotto`");
      }

    public function getAll() {
        //creo un nuovo array per i prodotti
        $products = array();
        //effettuo al query estesa dalla Connection e la metto in result
        $result = parent::query("SELECT * FROM ". $this->table );

        //inserisco nell'array tutti i gli oggetti
        while($record = $result->fetch_object()) {
            array_push($products, $record);
        }

        //ritorno il risultato
        $result = $products;
        return $result;
    }
}

?>