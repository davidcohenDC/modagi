<?php

class NotificationManager {
    
    public function __construct($server, $username, $pass, $dbName) {
        $this->db = new mysqli($server, $username, $pass, $dbName);

        // controllo se la connessione è andata a buon fine
        if($this->db->connect_error) {
            // die interrompe tutto!!
            die("Connessione al db fallita");
        }
    }

    /**
     * Add a notification to a certain user
     */
    public function addNotification($userEmail, $notificationName, $notificationValue) {
        $stmt = $this->db->prepare("INSERT INTO `notifica`(`nome`, `contenuto`, `email`)
                                    VALUES (?, ?, ?)");

        $stmt->bind_param("sss", $notificationName, $notificationValue, $userEmail);
        return $stmt->execute();
    }

    /**
     * Get all notification for certain user
     */
    public function getAllNotification($userEmail) {
        $stmt = $this->db->prepare("SELECT `nome`, `contenuto` FROM `notifica` WHERE `email` = ? ORDER BY `id` DESC");

        $stmt->bind_param("s", $userEmail);
        $stmt->execute();

        $result = $stmt->get_result();
        $stmt->close();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    /**
     * Delete all notification of a certain user
     */
    public function clearNotification($userEmail) {
        $stmt = $this->db->prepare("DELETE FROM `notifica` WHERE `email` = ?");

        $stmt->bind_param("s", $userEmail);
        return $stmt->execute();
    }

    /**
     * Get number of all notification of a certain user
     */
    public function getNotificationCount($userEmail) {
        return count($this->getAllNotification($userEmail));
    }
}


?>