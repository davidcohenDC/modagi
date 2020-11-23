<?php

class DatabaseHelper{
    private $db;

    // costruttore
    public function __construct($servername, $username, $password, $dbname, $port) {
        $this->db = new mysqli($servername, $username, $password, $dbname, $port);

        // controllo se la connessione è andata a buon fine
        if($this->db->connect_error) {
            // die interrompe tutto!!
            die("Connessione al db fallita");
        }
    }

    public function getRandomPosts($n=2) {
        $stmt = $this->db->prepare("SELECT idarticolo, titoloarticolo, imgarticolo 
                                    FROM articolo ORDER BY RAND() LIMIT ?");
        $stmt->bind_param("i", $n);
        $stmt->execute();

        $result = $stmt->get_result();

        // fetch_all recupera il risultato della query e MYSQLI_ASSOC specifico che voglio
        // che ritornare un array associativo (dizionario)
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}

?>