<?php

class DatabaseCart{
    private $db;

    // costruttore
    public function __construct($servername, $username, $password, $dbname) {
        $this->db = new mysqli($servername, $username, $password, $dbname);

        // controllo se la connessione è andata a buon fine
        if($this->db->connect_error) {
            // die interrompe tutto!!
            die("Connessione al db fallita");
        }
    }

    public function getArticleDetails($articleId) {
        $stmt = $this->db->prepare("SELECT id, nome, prezzo, descrizione 
                                    FROM prodotto WHERE id = ?");
        $stmt->bind_param("s", $articleId);
        $stmt->execute();

        $result = $stmt->get_result();
        $stmt->close();

        // fetch_all recupera il risultato della query e MYSQLI_ASSOC specifico che voglio
        // che ritornare un array associativo (dizionario)
        return $result->fetch_all(MYSQLI_ASSOC)[0];
    }

    public function getTotalPrice($allArticle = []) {
        $totalPrice = 0;
        foreach ($allArticle as $key => $article) {
            $stmt = $this->db->prepare("SELECT prezzo FROM prodotto WHERE id = ?");
            $stmt->bind_param("s", $article);
            $stmt->execute();
            $result = $stmt->get_result();
            $stmt->close();
            $totalPrice = $totalPrice + (double)$result->fetch_all(MYSQLI_ASSOC)[0]["prezzo"];
        }

        return $totalPrice;
    }

}

?>