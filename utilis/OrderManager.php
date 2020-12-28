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

    public function addOrder($userEmail, $productId, $taglia, $productQuantity) {
        $date = date("Y-m-d");
        $orderOKid = 1;

        $stmt = $this->db->prepare("INSERT INTO `ordine`(`idProdotto`, `email`, `data`, `quantita`, `idStato`)
                                    VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $productId, $userEmail, $date, $productQuantity, $orderOKid);
        if($stmt->execute()) {
            $stmt = $this->db->prepare("SELECT `id` FROM `taglia` WHERE `numero` = ?");
            $stmt->bind_param("s", $taglia);
            if($stmt->execute()) {
                $idTaglia = $stmt->get_result()->fetch_all(MYSQLI_ASSOC)[0]["id"];

                $stmt = $this->db->prepare("SELECT `quantita` FROM `prodottitaglie` WHERE `idTaglia` = ? AND `idProdotto` = ?");
                $stmt->bind_param("ss", $idTaglia, $productId);
                if($stmt->execute()) {
                    $currentQuantity = $stmt->get_result()->fetch_all(MYSQLI_ASSOC)[0]["quantita"];
                    $finalQuantity = $currentQuantity - $productQuantity;

                    $stmt = $this->db->prepare("UPDATE `prodottitaglie` SET `quantita`= ? WHERE `idTaglia` = ? AND `idProdotto` = ?");
                    $stmt->bind_param("sss", $finalQuantity, $idTaglia, $productId);
                    return $stmt->execute();
                }
            }
        }
        return false;
    }
}

?>