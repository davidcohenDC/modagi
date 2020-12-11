<?php

class ProductsDAO extends Connection {
    private $table = 'Prodotto';

    public function getAll() {
        $products = array();
        $result = parent::query("SELECT * FROM ". $this->table );

        while($record = $result->fetch_object()) {
            array_push($products, $record);
        }

        $result = $products;
        return $result;
    }

}

?>