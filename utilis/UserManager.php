<?php

require_once("./macro.php");

class UserManager {
    
    public function __construct() {
        $this->db = new mysqli(DB_SERVER_NAME, DB_USERNAME, DB_PASSWORD, DB_NAME);

        // controllo se la connessione è andata a buon fine
        if($this->db->connect_error) {
            // die interrompe tutto!!
            die("Connessione al db fallita");
        }

        $this->email = $this->getEmail();
        $this->password = $this->getPassword();
    }

    public function getEmail() {
        if (empty($_SESSION['email'])) {
            return false;
        }
        return $_SESSION['email'];
    }

    public function getPassword() {
        if (empty($_SESSION['password'])) {
            return false;
        }
        return $_SESSION['password'];
    }

    public function getUsername() {
        $this->email = $this->getEmail();
        $this->password = $this->getPassword();
        if (!$this->email || !$this->password) {
            return false;
        }
        $stmt = $this->db->prepare("SELECT username FROM user WHERE email = ? AND password = ?");

        $stmt->bind_param("ss", $this->email, $this->password);
        $stmt->execute();

        $result = $stmt->get_result();
        $stmt->close();

        return $result->fetch_all(MYSQLI_ASSOC)[0]["username"];
    }

    public function getNome() {
        $this->email = $this->getEmail();
        $this->password = $this->getPassword();
        if (!$this->email || !$this->password) {
            return false;
        }
        $stmt = $this->db->prepare("SELECT nome FROM user WHERE email = ? AND password = ?");

        $stmt->bind_param("ss", $this->email, $this->password);
        $stmt->execute();

        $result = $stmt->get_result();
        $stmt->close();

        return $result->fetch_all(MYSQLI_ASSOC)[0]["nome"];
    }

    public function getCognome() {
        $this->email = $this->getEmail();
        $this->password = $this->getPassword();
        if (!$this->email || !$this->password) {
            return false;
        }
        $stmt = $this->db->prepare("SELECT cognome FROM user WHERE email = ? AND password = ?");
        $stmt->bind_param("ss", $this->email, $this->password);
        $stmt->execute();

        $result = $stmt->get_result();
        $stmt->close();

        return $result->fetch_all(MYSQLI_ASSOC)[0]["cognome"];
    }

    public function getIndirizzo() {
        $this->email = $this->getEmail();
        $this->password = $this->getPassword();
        if (!$this->email || !$this->password) {
            return false;
        }
        $stmt = $this->db->prepare("SELECT indirizzo FROM user WHERE email = ? AND password = ?");
        $stmt->bind_param("ss", $this->email, $this->password);
        $stmt->execute();

        $result = $stmt->get_result();
        $stmt->close();

        return $result->fetch_all(MYSQLI_ASSOC)[0]["indirizzo"];
    }
}

?>