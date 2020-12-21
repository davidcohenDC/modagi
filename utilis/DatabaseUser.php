<?php

class DatabaseUser
{

    private $db;

    // costruttore
    public function __construct($servername, $username, $password, $dbname)
    {
        $this->db = new mysqli($servername, $username, $password, $dbname);

        // controllo se la connessione è andata a buon fine
        if ($this->db->connect_error) {
            // die interrompe tutto!!
            die("Connessione al db fallita");
        }
    }

    public function userAccessLevel($username)
    {
        $stmt = $this->db->prepare("SELECT admin 
                                    FROM user 
                                    WHERE username = ?;");

        $stmt->bind_param("s", $username);
        $stmt->execute();

        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function updateName($username, $password, $newName)
    {
        if ($this->checkPassword($username, $password)[0]) {
            $stmt = $this->db->prepare("UPDATE user
                                        SET nome = ?
                                        WHERE username = ?");
            $stmt->bind_param("ss", $newName, $username);
            $stmt->execute();

            return [true, ""];
        }
        return [false, "PASSWORD CORRENTE SBAGLIATA"];
    }

    public function updateSurname($username, $password, $newSurname)
    {
        if ($this->checkPassword($username, $password)[0]) {
            $stmt = $this->db->prepare("UPDATE user
                                        SET cognome = ?
                                        WHERE username = ?");
            $stmt->bind_param("ss", $newSurname, $username);
            $stmt->execute();

            return [true, ""];
        }
        return [false, "PASSWORD CORRENTE SBAGLIATA"];
    }

    public function updateAddress($username, $password, $newAddress)
    {
        if ($this->checkPassword($username, $password)[0]) {
            $stmt = $this->db->prepare("UPDATE user
                                        SET indirizzo = ?
                                        WHERE username = ?");
            $stmt->bind_param("ss", $newAddress, $username);
            $stmt->execute();

            return [true, ""];
        }
        return [false, "PASSWORD CORRENTE SBAGLIATA"];
    }

    public function updatePassword($username, $oldPassword, $newPassword)
    {
        /* l'user deve aver messo la password giusta */
        if ($this->checkPassword($username, $oldPassword)[0]) {
            if ($oldPassword != $newPassword) {
                $stmt = $this->db->prepare("UPDATE user
                                    SET password = ?
                                    WHERE username = ?");
                $stmt->bind_param("ss", $newPassword, $username);
                $stmt->execute();

                return [$this->checkLogin($username, $newPassword)[0], "CAMBIO PASSWORD NON RIUSCITO"];
            }
            return [true, ""];
        }
        return [false, "PASSWORD CORRENTE SBAGLIATA"];
    }

    public function userExists($username)
    {
        $stmt = $this->db->prepare("SELECT username
                                    FROM User
                                    WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();

        return count($stmt->get_result()->fetch_all(MYSQLI_ASSOC)) != 0;
    }

    public function registerUser($username, $password, $name, $surname, $address)
    {
        $stmt = $this->db->prepare("INSERT INTO user (username, password, admin, nome, cognome, indirizzo) VALUES (?, ?, 'N', ?, ?, ?)");

        $stmt->bind_param("sssss", $username, $password, $name, $surname, $address);
        $stmt->execute();

        return [$this->userExists($username), "REGISTRAZIONE NON RIUSCITA"];
    }

    public function checkLogin($username, $password)
    {
        if ($this->userExists($username)) {

            /* utente trovato controllo la password */
            return $this->checkPassword($username, $password);
        }
        return [false, "UTENTE NON TROVATO"];
    }

    public function removeUser($username, $password)
    {
        if ($this->checkPassword($username, $password)[0]) {

            //* rimuovo gli ordini.
            $stmt = $this->db->prepare("DELETE FROM ordine WHERE username = ?");

            $stmt->bind_param("s", $username);
            $stmt->execute();

            //* rimuovo l'user.
            $stmt = $this->db->prepare("DELETE FROM user WHERE username = ?");

            $stmt->bind_param("s", $username);
            $stmt->execute();

            return [!$this->userExists($username), "ERRORE DURANTE LA RIMOZIONE"];
        }
        return [false, "PASSWORD ERRATA!"];
    }

    public function hasOrders($username)
    {
        $stmt = $this->db->prepare("SELECT * FROM ordine WHERE username = ?");

        $stmt->bind_param("s", $username);
        $stmt->execute();

        $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        return count($result) != 0;
    }

    public function getOrdersDates($username)
    {
        $stmt = $this->db->prepare("SELECT DISTINCT data FROM ordine WHERE username = ? ");

        $stmt->bind_param("s", $username);
        $stmt->execute();

        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function getOrdersProducts($date, $username)
    {
        $stmt = $this->db->prepare("SELECT prodotto.nome as nome, prodotto.prezzo as prezzo, ordine.quantita as quantita,
                                    genere.nome as genere, colore.nome as colore, materiale.nome as materiale, marca.nome as marca
                                    FROM colore, materiale, marca, genere, ordine, prodotto 
                                    WHERE prodotto.id = ordine.idProdotto 
                                    AND ordine.username = ? 
                                    AND ordine.data = ? 
                                    AND prodotto.idColore = colore.id
                                    AND prodotto.idGenere = genere.id
                                    AND prodotto.idMateriale = materiale.id
                                    AND prodotto.idMarca = marca.id
                                    ORDER BY ordine.data");

        $stmt->bind_param("ss", $username, $date);
        $stmt->execute();

        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    private function checkPassword($username, $password)
    {
        $stmt = $this->db->prepare("SELECT COUNT(username) as correctUsers
                                    FROM User
                                    WHERE username = ? AND password = ?");
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();

        return [$stmt->get_result()->fetch_all(MYSQLI_ASSOC)[0]["correctUsers"] != "0", "PASSWORD ERRATA!"];
    }
}
