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

    public function checkLogIn($username, $password){

        $stmt = $this->db->prepare("SELECT username
                                    FROM User
                                    WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        
        /* prima controllo che l'utente sia nel db */
        if (count($stmt->get_result()->fetch_all(MYSQLI_ASSOC)) > 0) {
            
            /* controllo che la password sia giusta */
            return $this->checkPassword($username, $password);   
        } 
        return [false,"USER NON TROVATO"];
    }

    //TODO: salare la password
    private function checkPassword($username, $password){
        $stmt = $this->db->prepare("SELECT COUNT(username)
                                    FROM User
                                    WHERE username = ? AND password = ?");
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();

        return [$stmt->get_result() > "0","PASSWORD ERRATA!"];
    }
}

?>