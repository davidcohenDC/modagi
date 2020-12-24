<?php

require_once("./macro.php");

class OrderManager {
    
    public function __construct() {
        $this->db = new mysqli(DB_SERVER_NAME, DB_USERNAME, DB_PASSWORD, DB_NAME);

        // controllo se la connessione è andata a buon fine
        if($this->db->connect_error) {
            // die interrompe tutto!!
            die("Connessione al db fallita");
        }
    }

    public function addOrder($userEmail, $productId, $productCount) {
        $date = date("Y-m-d");
        return 1;
    }
}

?>