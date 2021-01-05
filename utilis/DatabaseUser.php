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

    public function updateOrder($id, $status)
    {
        $stmt = $this->db->prepare("UPDATE ordine SET idStato = ? WHERE id = ?");
        $stmt->bind_param("ii", $status, $id);
        $stmt->execute();
    }

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
            case 'categorie':

                $stmt = $this->db->prepare("SELECT idCategoria FROM ProdottiCategorie WHERE idProdotto = ?");
                $stmt->bind_param("i", $id);
                $stmt->execute();

                $currentCategories = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

                foreach ($newValue as $newCategory) {
                    if (!in_array($newCategory, $currentCategories)) {
                        // insert new ones
                        $stmt = $this->db->prepare("INSERT INTO ProdottiCategorie (idCategoria, idProdotto) VALUES (?,?)");
                        $stmt->bind_param("ii", $newCategory, $id);
                        $stmt->execute();
                    }
                }

                foreach ($currentCategories as $oldValue) {
                    if (!in_array($oldValue['idCategoria'], $newValue)) {
                        // delete not selected ones
                        $stmt = $this->db->prepare("DELETE FROM ProdottiCategorie WHERE idCategoria = ? AND idProdotto = ?");
                        $stmt->bind_param("ii", $oldValue['idCategoria'], $id);
                        $stmt->execute();
                    }
                }

                $stmt = $this->db->prepare("SELECT idCategoria FROM ProdottiCategorie WHERE idProdotto = ?");
                $stmt->bind_param("i", $id);
                $stmt->execute();

                $currentCategories = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

                // controllo che le nuove categorie siano state inserite correttamente 
                foreach ($newValue as $newCategory) {
                    if (in_array($newCategory, $currentCategories)) {
                        echo $newCategory . "NO";
                        return [false, "CATEGORIE NON AGGIORNATE CORRETTAMENTE"];
                    }
                }
                return [true, ""];
            default:
                # code...
                break;
        }
        return $this->updateProductField($field, $id, $newValue, $params);
    }

    public function updateSize($size, $quantity, $prodId)
    {


        $check = $this->db->prepare("SELECT * FROM ProdottiTaglie 
                                            WHERE idProdotto = ? 
                                            AND idTaglia = ?;");
        $check->bind_param("ii", $prodId, $size);
        $check->execute();

        if (count($check->get_result()->fetch_all(MYSQLI_ASSOC)) == 0) {
            // prodotto non aveva la taglia
            $stmt = $this->db->prepare("INSERT INTO ProdottiTaglie (idTaglia, idProdotto, quantita)
                                                VALUES (?, ?, ?);");
            $stmt->bind_param("iii", $size, $prodId, $quantity);
        } else {
            // prodotto ha già taglia
            if ($quantity == 0) {
                $stmt = $this->db->prepare("DELETE FROM ProdottiTaglie 
                                            WHERE idProdotto = ? 
                                            AND idTaglia = ?;");

                $stmt->bind_param("ii", $prodId,  $size);
            } else {
                $stmt = $this->db->prepare("UPDATE ProdottiTaglie 
                SET quantita = ?
                WHERE idProdotto = ? 
                AND idTaglia = ?;");

                $stmt->bind_param("iii", $quantity, $prodId,  $size);
            }
        }

        $stmt->execute();
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
        if (isUserVendor()) {
            $stmt = $this->db->prepare("SELECT DISTINCT data FROM ordine WHERE idStato < 3 ORDER BY data DESC");
        } else {
            $stmt = $this->db->prepare("SELECT DISTINCT data FROM ordine WHERE email = ? ORDER BY data DESC");
            $stmt->bind_param("s", $id);
        }

        $stmt->execute();

        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function getOrdersProducts($date, $email)
    {
        if (isUserVendor()) {
            $stmt = $this->db->prepare("SELECT user.email as email user.nome as user, user.indirizzo as indirizzo, prodotto.id as id, prodotto.nome as nome, prodotto.prezzo as prezzo, ordine.quantita as quantita,
                                    genere.nome as genere, colore.nome as colore, materiale.nome as materiale, marca.nome as marca, ordine.id as orderID
                                    FROM colore, materiale, marca, genere, ordine, prodotto, user 
                                    WHERE prodotto.id = ordine.idProdotto  
                                    AND ordine.data = ? 
                                    AND ordine.email = user.email
                                    AND prodotto.idColore = colore.id
                                    AND prodotto.idGenere = genere.id
                                    AND prodotto.idMateriale = materiale.id
                                    AND prodotto.idMarca = marca.id
                                    ORDER BY ordine.data");

            $stmt->bind_param("s", $date);
        } else {
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
        }
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
        if (isUserVendor()) {
            $stmt = $this->db->prepare("SELECT o.id as id, o.idProdotto as prodID , s.id as statID, s.nome as stato FROM ordine as o, statoordine as s WHERE s.id = o.idStato AND o.idStato < 3 ORDER BY o.data DESC");
        } else {
            $stmt = $this->db->prepare("SELECT o.id as id, o.idProdotto as prodID , s.id as statID, s.nome as stato FROM ordine as o, statoordine as s WHERE s.id = o.idStato AND o.email = ? ORDER BY o.data DESC");
            $stmt->bind_param("s", $id);
        }
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


    public function getProductId($name)
    {
        $stmt = $this->db->prepare("SELECT id FROM prodotto WHERE nome = ?");
        $stmt->bind_param("s", $name);
        $stmt->execute();

        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC)[0];
    }

    public function getProduct($id)
    {
        return $this->getAll("prodotto WHERE id = " . $id)[0];
    }

    public function getCategoriesProduct($id)
    {
        return $this->getAll("ProdottiCategorie WHERE idProdotto = " . $id);
    }

    public function getPendingOrders()
    {
        $stmt = $this->db->prepare("SELECT * FROM ordine WHERE idStato < 3");
        $stmt->execute();

        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
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
        $check =  $this->db->prepare("SELECT * FROM prodotto WHERE nome = ?");
        $check->bind_param("s", $values["name"]);
        $check->execute();

        // una scarpa ha già quel nome 
        if (count($check->get_result()->fetch_all(MYSQLI_ASSOC)) < 1) {
            //inserts shoe in product
            $stmt = $this->db->prepare("INSERT INTO prodotto (prezzo, descrizione, nome, idColore, idGenere, idMateriale, idMarca) 
                                    VALUES (?, ?, ?, ?, ?, ?, ?)");

            $stmt->bind_param("sssssss", $values["price"], $values["description"], $values["name"], $values["color"], $values["gender"], $values["material"], $values["brand"]);
            $stmt->execute();

            $prodId = $this->db->prepare("SELECT id FROM prodotto WHERE nome = ?");
            $prodId->bind_param("s", $values["name"]);
            $prodId->execute();
            $prodId = $prodId->get_result()->fetch_all(MYSQLI_ASSOC);
            //controllo che l'insert sia avvenuta
            if (count($prodId) > 0) {

                $prodId = $prodId[0]["id"];

                // inserts the sizes
                foreach ($params["sizes"] as $key) {
                    if (isset($values["quantity-" . $key["id"]]) && $values["quantity-" . $key["id"]] != "") {
                        $stmt = $this->db->prepare("INSERT INTO ProdottiTaglie (idTaglia, idProdotto, quantita)
                                            VALUES (?, ?, ?);");

                        $stmt->bind_param("iii", $key["id"], $prodId, $values["quantity-" . $key["id"]]);
                        $stmt->execute();
                    }
                }

                // controllo l'inserimento delle taglie
                $check =  $this->db->prepare("SELECT idProdotto FROM ProdottiTaglie WHERE idProdotto = ?");
                $check->bind_param("s", $prodId);
                $check->execute();

                if (count($check->get_result()->fetch_all(MYSQLI_ASSOC)) == 0) {
                    return [false, "Errore durante l'inserimento delle taglie"];
                }

                // inserts the categories


                for ($i = 0; $i < count($values["categories"]); $i++) {
                    $stmt = $this->db->prepare("INSERT INTO ProdottiCategorie (idCategoria, idProdotto) VALUES (?, ?)");

                    $stmt->bind_param("ii", $values["categories"][$i], $prodId);
                    $stmt->execute();
                }

                // controllo l'inserimento delle categorie
                $check =  $this->db->prepare("SELECT idProdotto FROM ProdottiCategorie WHERE idProdotto = ?");
                $check->bind_param("s", $prodId);
                $check->execute();

                if (count($check->get_result()->fetch_all(MYSQLI_ASSOC)) < 1) {
                    return [false, "Errore durante l'inserimento delle categorie"];
                } else {
                    // non ci sono stati problemi
                    return [true, ""];
                }
            }
            return [false, "Errore durante l'inserimento del prodotto"];
        }
        return [false, "Esiste già un prodotto con questo nome"];
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

    public function removeProduct($user, $password, $prodID)
    {
        if ($this->checkPassword($user, $password)[0]) {

            // rimuovo in prodotto categoria
            $stmt = $this->db->prepare("DELETE FROM ProdottiCategorie WHERE idProdotto = ?");

            $stmt->bind_param("i", $prodID);
            $stmt->execute();

            $check = $this->db->prepare("SELECT idProdotto FROM ProdottiCategorie WHERE idProdotto = ?");
            $check->bind_param("i", $prodID);
            $check->execute();

            if (count($check->get_result()->fetch_all(MYSQLI_ASSOC)) != 0) {
                return [false, "ERRORE NEL RIMUOVERE LE CATEGORIE APPARTENTI"];
            }

            // rimuovo in prodotto taglia
            $stmt = $this->db->prepare("DELETE FROM ProdottiTaglie WHERE idProdotto = ?");

            $stmt->bind_param("i", $prodID);
            $stmt->execute();

            $check = $this->db->prepare("SELECT idProdotto FROM ProdottiTaglie WHERE idProdotto = ?");
            $check->bind_param("i", $prodID);
            $check->execute();

            if (count($check->get_result()->fetch_all(MYSQLI_ASSOC)) != 0) {
                return [false, "ERRORE NEL RIMUOVERE LE TAGLIE APPARTENTI"];
            }

            //rimuovo in ordine 
            $stmt = $this->db->prepare("DELETE FROM ordine WHERE idProdotto = ?");

            $stmt->bind_param("i", $prodID);
            $stmt->execute();

            $check = $this->db->prepare("SELECT idProdotto FROM ordine WHERE idProdotto = ?");
            $check->bind_param("i", $prodID);
            $check->execute();

            if (count($check->get_result()->fetch_all(MYSQLI_ASSOC)) != 0) {
                return [false, "ERRORE NEL RIMUOVERE GLI ORDINI IN CUI COMPARIVA L'ORDINE"];
            }

            //rimuovo il prodotto
            $stmt = $this->db->prepare("DELETE FROM prodotto WHERE id = ?");

            $stmt->bind_param("i", $prodID);
            $stmt->execute();

            return [!$this->productExists($prodID), "PRODOTTO NON RIMOSSO CORRETTAMENTE"];
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

    public function hasPendingOrders($prodID)
    {
        $stmt = $this->db->prepare("SELECT idStato
                                    FROM ordine
                                    WHERE idProdotto = ? AND NOT idStato = 3");
        $stmt->bind_param("i", $prodId);
        $stmt->execute();

        return count($stmt->get_result()->fetch_all(MYSQLI_ASSOC)) != 0;
    }

    // PRIVATES
    private function checkPassword($id, $password)
    {

        // method with hashing
        $stmt = $this->db->prepare("SELECT password
                                    FROM User
                                    WHERE email = ?");
        $stmt->bind_param("s", $id);
        $stmt->execute();

        $cryptedPass = password_hash($stmt->get_result()->fetch_all(MYSQLI_ASSOC)[0]["password"], PASSWORD_DEFAULT);

        return [password_verify($password, $cryptedPass), "PASSWORD ERRATA!"];
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

        $check = $this->db->prepare("SELECT " . $field . " FROM prodotto WHERE id = ? AND " . $field . " = ?");
        $check->bind_param($params, $id, $newValue);
        $check->execute();

        $update = $check->get_result()->fetch_all(MYSQLI_ASSOC);
        return [count($update) != 0, "Campo " . $field . " non aggiornato correttamente"];
    }
}
