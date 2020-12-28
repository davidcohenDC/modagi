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
        
    }

    /**
     * Get all notification for certain user
     */
    public function getAllNotification($userEmail) {
        return array(array("nome" => "acquisto avvenuto", "contenuto" => "il tuo acquisto è avvenuto con successo!!"));
    }

    /**
     * Delete all notification of a certain user
     */
    public function clearNotification($userEmail) {
        echo "ciao";
    }

    /**
     * Get number of all notification of a certain user
     */
    public function getNotificationCount() {
        return 1;
    }
}


?>