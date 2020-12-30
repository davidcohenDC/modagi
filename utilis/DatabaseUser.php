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

    // UPDATES
    public function updateName($id, $password, $newName)
    {
        return $this->updateField($id, $password, "nome", $newName);
    }

    public function updateSurname($id, $password, $newSurname)
    {
        return $this->updateField($id, $password, "cognome", $newSurname);
    }

    public function updateAddress($id, $password, $newAddress)
    {
        return $this->updateField($id, $password, "indirizzo", $newAddress);
    }

    public function updateUsernmae($id, $password, $newUsername)
    {
        return $this->updateField($id, $password, "username", $newUsername);
    }

    public function updatePassword($id, $oldPassword, $newPassword)
    {
        /* l'user deve aver messo la password giusta */
        if ($this->checkPassword($id, $oldPassword)[0]) {
            if ($oldPassword != $newPassword) {
                $stmt = $this->db->prepare("UPDATE user
                                    SET password = ?
                                    WHERE email = ?");
                $stmt->bind_param("ss", $newPassword, $id);
                $stmt->execute();

                return [$this->checkLogin($id, $newPassword)[0], "CAMBIO PASSWORD NON RIUSCITO"];
            }
            return [true, ""];
        }
        return [false, "PASSWORD CORRENTE SBAGLIATA"];
    }
    /* admin */
    public function updateProduct($id, $newValue, $field)
    {
        switch ($field) {
            case 'nome':
                $params = "si";
                break;
            case 'descrizione':
                $params = "si";
                break;
            case 'idMarca':
                $params = "ii";
                break;
            case 'idColore':
                $params = "ii";
                break;
            case 'prezzo':
                $params = "ii";
                break;
            case 'idGenere':
                $params = "ii";
                break;
            case 'idMateriale':
                $params = "ii";
                break;
            default:
                # code...
                break;
        }
        $this->updateProductField($field, $id, $newValue, $params);
    }

    public function updateSize($values, $params, $prodId)
    {
        foreach ($params["sizes"] as $key) {
            if (isset($values["size-" . $key["id"]]) && $values["size-" . $key["id"]] != "") {

                $check = $this->db->prepare("SELECT * FROM ProdottiTaglie 
                                            WHERE idProdotto = ? 
                                            AND idTaglia = ?;");
                $check->bind_param("ii", $prodId, $key["id"]);
                $check->execute();

                if (count($check->get_result()->fetch_all(MYSQLI_ASSOC)) == 0) {
                    // prodotto non aveva la taglia
                    $stmt = $this->db->prepare("INSERT INTO ProdottiTaglie (idTaglia, idProdotto, quantita)
                                                VALUES (?, ?, ?);");
                    $stmt->bind_param("iii", $key["id"], $prodId, $values["quantity-" . $key["id"]]);
                } else {
                    // prodotto ha già taglia
                    $stmt = $this->db->prepare("UPDATE ProdottiTaglie 
                                                SET quantita = ?
                                                WHERE idProdotto = ? 
                                                AND idTaglia = ?;");

                    $stmt->bind_param("iii", $values["quantity-" . $key["id"]], $prodId, $key["id"]);
                }
                $stmt->execute();
            }
        }
    }

    // GETTERS
    public function getUserName($id)
    {
        $stmt = $this->db->prepare("SELECT nome FROM user WHERE email = ? ");

        $stmt->bind_param("s", $id);
        $stmt->execute();

        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC)[0]["nome"];
    }

    public function getOrdersDates($id)
    {
        $stmt = $this->db->prepare("SELECT DISTINCT data FROM ordine WHERE email = ? ");

        $stmt->bind_param("s", $id);
        $stmt->execute();

        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function getOrdersProducts($date, $email)
    {
        $stmt = $this->db->prepare("SELECT prodotto.id as id, prodotto.nome as nome, prodotto.prezzo as prezzo, ordine.quantita as quantita,
                                    genere.nome as genere, colore.nome as colore, materiale.nome as materiale, marca.nome as marca
                                    FROM colore, materiale, marca, genere, ordine, prodotto 
                                    WHERE prodotto.id = ordine.idProdotto 
                                    AND ordine.email = ? 
                                    AND ordine.data = ? 
                                    AND prodotto.idColore = colore.id
                                    AND prodotto.idGenere = genere.id
                                    AND prodotto.idMateriale = materiale.id
                                    AND prodotto.idMarca = marca.id
                                    ORDER BY ordine.data");

        $stmt->bind_param("ss", $email, $date);
        $stmt->execute();

        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function userAccessLevel($id)
    {
        $stmt = $this->db->prepare("SELECT admin as al
                                        FROM user 
                                        WHERE email = ?;");

        $stmt->bind_param("s", $id);
        $stmt->execute();

        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC)[0]["al"];
    }

    public function getOrdersStatus($id)
    {
        $stmt = $this->db->prepare("SELECT o.id as id, o.idProdotto as prodID , s.id as statID, s.nome as stato FROM ordine as o, statoordine as s WHERE s.id = o.idStato AND o.email = ? ");

        $stmt->bind_param("s", $id);
        $stmt->execute();

        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    /* admin */
    public function getAllColors()
    {
        return $this->getAll("colore");
    }

    public function getAllSizes()
    {
        return $this->getAll("taglia");
    }

    public function getAllMaterials()
    {
        return $this->getAll("materiale");
    }

    public function getAllBrands()
    {
        return $this->getAll("marca");
    }

    public function getAllCategories()
    {
        return $this->getAll("categoria");
    }

    public function getAllProducts()
    {
        return $this->getAll("prodotto");
    }

    public function getAllQuantities($prodId)
    {
        $stmt = $this->db->prepare("SELECT idTaglia, quantita FROM ProdottiTaglie WHERE idProdotto = ?");
        $stmt->bind_param("i", $prodId);
        $stmt->execute();

        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function getProduct($id)
    {
        return $this->getAll("prodotto WHERE id = " . $id)[0];
    }

    public function getCategoriesProduct($id)
    {
        return $this->getAll("ProdottiCategorie WHERE idProdotto = " . $id);
    }

    // INSERTS
    public function registerUser($email, $username, $password, $name, $surname, $address)
    {
        $stmt = $this->db->prepare("INSERT INTO user (email, username, password, admin, nome, cognome, indirizzo) VALUES (?, ?, ?, 'N', ?, ?, ?)");

        $stmt->bind_param("ssssss", $email, $username, $password, $name, $surname, $address);
        $stmt->execute();

        return [$this->userExists($username), "REGISTRAZIONE NON RIUSCITA"];
    }

    /* admin */
    public function insertNewValue($newValue, $field, $table)
    {
        //check if already in db
        $check = $this->db->prepare("SELECT * FROM " . $table . " WHERE " . $field . " = ?");
        $check->bind_param("s", $newValue);
        $check->execute();

        if (count($check->get_result()->fetch_all(MYSQLI_ASSOC)) == 0) {

            if ($field == 'numero') {
                $newId = $this->db->prepare("SELECT max(id) as id FROM " . $table);
                $newId->execute();

                $newId = $newId->get_result()->fetch_all(MYSQLI_ASSOC)[0]["id"] + 1;

                $stmt = $this->db->prepare("INSERT INTO " . $table . " (id, " . $field . " ) VALUES (?,?)");
                $stmt->bind_param("ii", $newId, $newValue);
            } else {
                $stmt = $this->db->prepare("INSERT INTO " . $table . " ( " . $field . " ) VALUES (?)");
                $stmt->bind_param("s", $newValue);
            }
            $stmt->execute();
        }
    }

    public function insertShoe($values, $params)
    {
        //inserts shoe in product
        $stmt = $this->db->prepare("INSERT INTO prodotto (prezzo, descrizione, nome, idColore, idGenere, idMateriale, idMarca) 
                                    VALUES (?, ?, ?, ?, ?, ?, ?)");

        $stmt->bind_param("sssssss", $values["price"], $values["description"], $values["name"], $values["color"], $values["gender"], $values["material"], $values["brand"]);
        $stmt->execute();

        $prodId = $this->db->prepare("SELECT id FROM prodotto WHERE nome = ?");
        $prodId->bind_param("s", $values["name"]);
        $prodId->execute();

        $prodId = $prodId->get_result()->fetch_all(MYSQLI_ASSOC)[0]["id"];

        // inserts the sizes
        foreach ($params["sizes"] as $key) {
            if (isset($values["size-" . $key["id"]]) && $values["size-" . $key["id"]] != "") {
                $stmt = $this->db->prepare("INSERT INTO ProdottiTaglie (idTaglia, idProdotto, quantita)
                                            VALUES (?, ?, ?);");

                $stmt->bind_param("iii", $key["id"], $prodId, $values["quantity-" . $key["id"]]);
                $stmt->execute();
            }
        }

        // inserts the categories
        foreach ($params["categories"] as $key) {
            if (isset($values["categories-" . $key["id"]]) && $values["categories-" . $key["id"]] != "") {
                $stmt = $this->db->prepare("INSERT INTO ProdottiCategorie (idTaglia, idProdotto) VALUES (?, ?)");

                $stmt->bind_param("ii", $key["id"], $prodId);
                $stmt->execute();
            }
        }
    }

    // REMOVES
    public function removeUser($id, $password)
    {
        if ($this->checkPassword($id, $password)[0]) {

            //* rimuovo gli ordini.
            $stmt = $this->db->prepare("DELETE FROM ordine WHERE email = ?");

            $stmt->bind_param("s", $id);
            $stmt->execute();

            //* rimuovo l'user.
            $stmt = $this->db->prepare("DELETE FROM user WHERE email = ?");

            $stmt->bind_param("s", $id);
            $stmt->execute();

            return [!$this->userExists($id), "ERRORE DURANTE LA RIMOZIONE"];
        }
        return [false, "PASSWORD ERRATA!"];
    }

    // BOOLS
    public function hasOrders($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM ordine WHERE email = ?");

        $stmt->bind_param("s", $id);
        $stmt->execute();

        $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        return count($result) != 0;
    }

    public function checkLogin($id, $password)
    {
        if ($this->userExists($id)) {

            /* utente trovato controllo la password */
            return $this->checkPassword($id, $password);
        }
        return [false, "UTENTE NON TROVATO"];
    }

    public function userExists($id)
    {
        $stmt = $this->db->prepare("SELECT username
                                        FROM User
                                        WHERE email = ?");
        $stmt->bind_param("s", $id);
        $stmt->execute();

        return count($stmt->get_result()->fetch_all(MYSQLI_ASSOC)) != 0;
    }

    public function productExists($prodId)
    {
        $stmt = $this->db->prepare("SELECT nome
                                    FROM Prodotto
                                    WHERE id = ?");
        $stmt->bind_param("i", $prodId);
        $stmt->execute();

        return count($stmt->get_result()->fetch_all(MYSQLI_ASSOC)) != 0;
    }

    // PRIVATES
    private function checkPassword($id, $password)
    {
        $stmt = $this->db->prepare("SELECT COUNT(email) as correctUsers
                                    FROM User
                                    WHERE email = ? AND password = ?");
        $stmt->bind_param("ss", $id, $password);
        $stmt->execute();

        return [$stmt->get_result()->fetch_all(MYSQLI_ASSOC)[0]["correctUsers"] != "0", "PASSWORD ERRATA!"];
    }

    private function getAll($table)
    {
        if ($table == 'taglia') {
            $stmt = $this->db->prepare("SELECT * FROM " . $table . " ORDER BY numero");
        } else {
            $stmt = $this->db->prepare("SELECT * FROM " . $table);
        }
        $stmt->execute();

        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    private function updateField($id, $password, $field, $newValue)
    {
        if ($this->checkPassword($id, $password)[0]) {
            $stmt = $this->db->prepare("UPDATE user
                                        SET " . $field . " = ?
                                        WHERE email = ?");
            $stmt->bind_param("ss", $newValue, $id);
            $stmt->execute();

            return [true, ""];
        }
        return [false, "PASSWORD CORRENTE SBAGLIATA"];
    }

    private function updateProductField($field, $id, $newValue, $params)
    {
        $stmt = $this->db->prepare("UPDATE prodotto
                                    SET " . $field . " = ?
                                    WHERE id = ?");

        $stmt->bind_param($params, $newValue, $id);
        $stmt->execute();
    }
}
