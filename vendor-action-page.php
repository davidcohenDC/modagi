<?php

require_once("./server.php");
require_once './utilis/DatabaseUser.php';

if (!isUserLoggedIn() || !isset($_GET["action"]) || !isUserVendor()) {
    header("location: user-page.php");
}

$action = $_GET["action"];

if (isset($_GET["new-value"]) && $action > 1 && $action < 7) {
    $newValue = $_GET["new-value"];
}

if (!isset($dbh)) {
    $dbh = new DatabaseUser(DB_SERVER_NAME, DB_USERNAME, DB_PASSWORD, DB_NAME);
}

if (isset($_GET["prev"])) {
    $previous = $_GET["prev"];
}

switch ($action) {
    case 1: //? Aggingi Scarpa
        $templateParams["title"] = "Aggiungi Articolo";
        $templateParams["main"] = "form.php";
        $formParams["title"] = "Aggiungi Articolo";
        $formParams["main"] = "add-article-form.php";

        $formParams["colors"] = $dbh->getAllColors();
        $formParams["sizes"] = $dbh->getAllSizes();
        $formParams["materials"] = $dbh->getAllMaterials();
        $formParams["brands"] = $dbh->getAllBrands();
        $formParams["categories"] = $dbh->getAllCategories();

        if (isArticleSet($formParams, $_POST)) {
            //* upload img
            $imgResult = uploadImage(IMG_DIR, $_FILES["shoe-img"], $_POST["name"]);

            if (!$imgResult[0]) {
                $templateParams["error"] = $imgResult[1];
            }

            //* insert data in sql db
            $insertResult = $dbh->insertShoe($_POST, $formParams);

            if (!isset($templateParams["error"])) {
                header("location: user-page.php");
            }
        }
        break;

    case 7: //? aggiungi promozioni

        $templateParams["title"] = "Aggiungi Promozione";
        $templateParams["main"] = "form.php";
        $formParams["title"] = "Aggiungi Promozione";
        $formParams["main"] = "add-promotion-form.php";

        $formParams["shoes"] = $dbh->getAllProducts();

        if (isset($_FILES["promo-img"]) && isset($_POST["shoe"])) {
            //* upload img
            $imgResult = uploadImage(IMG_DIR . "/promotion/", $_FILES["promo-img"], "promo_" . $_POST["shoe"]);

            if (!$imgResult[0]) {
                $templateParams["error"] = $imgResult[1];
            }

            if (!isset($templateParams["error"])) {
                header("location: user-page.php");
            }
        }
        break;

    case 8: //? modifica prodotto
        $templateParams["title"] = "Modifica Scarpa";
        $templateParams["main"] = "form.php";
        $formParams["main"] = "modify-product.php";

        if (isset($_GET["product"])) {
            if ($dbh->productExists($_GET["product"])) {
                //* prodotto esiste
                $productID = $_GET["product"];
            } else {
                //!product not exists
                $templateParams["error"] = "Il porodotto non esiste";
                header("location: vendor-action-page.php?action=1");
            }
        } else {
            //!no product
            $templateParams["error"] = "nessun prodotto da modificare";
            header("location: user-page.php");
        }

        $changes = 0;

        //? get All
        $formParams["colors"] = $dbh->getAllColors();
        $formParams["materials"] = $dbh->getAllMaterials();
        $formParams["brands"] = $dbh->getAllBrands();
        $formParams["categories"] = $dbh->getAllCategories();

        //? get Current
        $formParams["current"] = $dbh->getProduct($productID);
        $formParams["currentCategories"] = $dbh->getCategoriesProduct($productID);
        $formParams["title"] = $formParams["current"]["nome"];

        $key = array("name", "nome");
        if (isset($_POST[$key[0]]) && $_POST[$key[0]] != "" && $_POST[$key[0]] != $formParams["current"][$key[1]]) {

            // modifica nome 
            $updateResult = $dbh->updateProduct($productID, $_POST[$key[0]], $key[1]);
            $changes++;

            if (isset($_FILES["shoe-img"])) {
                //* cambio nome e immagine

                // rimuovo la vecchia 
                removeImg(IMG_DIR, $formParams["current"][$key[1]]);

                $imgResult = uploadImage(IMG_DIR, $_FILES["shoe-img"], $_POST[$key[0]]);

                if (!$imgResult[0]) {
                    $templateParams["error"] = $imgResult[1];
                }
            } else {
                //* cambio nome e basta quindi devo rinominare l'immagine
                renameImage(IMG_DIR, $formParams["current"][$key[1]], $_POST[$key[0]]);
            }
        } elseif (isset($_POST[$key[0]]) && $_POST[$key[0]] == $formParams["current"][$key[1]] && isset($_FILES["shoe-img"])) {
            //* cambio solo l'immagine
            $changes++;
            // rimuovo la vecchia 
            removeImg(IMG_DIR, $formParams["current"][$key[1]]);

            $imgResult = uploadImage(IMG_DIR, $_FILES["shoe-img"], $formParams["current"][$key[1]]);

            if (!$imgResult[0]) {
                $templateParams["error"] = $imgResult[1];
            }
        }



        foreach (array(
            array("description", "descrizione"),
            array("brand", "idMarca"),
            array("color", "idColore"),
            array("price", "prezzo"),
            array("material", "idMateriale"),
            array("gender", "idGenere")
        ) as $key) {
            if (isset($_POST[$key[0]]) && $_POST[$key[0]] != "" && $_POST[$key[0]] != $formParams["current"][$key[1]]) {
                // modifica descrizione
                $dbh->updateProduct($productID, $_POST[$key[0]], $key[1]);
                $changes++;
            }
        }

        if ($changes) {
            if (!isset($templateParams["error"])) {
                header("location: user-page.php");
            }
        }
        break;

    case 9: //? aggiungi rimuovi taglie
        $templateParams["title"] = "Aggiungi Quantità";
        $templateParams["main"] = "form.php";
        $formParams["title"] = "Nome Scarpa";
        $formParams["main"] = "add-product-sizes.php";

        if (isset($_GET["product"])) {
            if ($dbh->productExists($_GET["product"])) {
                //* prodotto esiste
                $productID = $_GET["product"];
            } else {
                //!product not exists
                $templateParams["error"] = "Il porodotto non esiste";
                header("location: vendor-action-page.php?action=1");
            }
        } else {
            //!no product
            $templateParams["error"] = "nessun prodotto da modificare";
            header("location: user-page.php");
        }

        //? get Current
        $formParams["current"] = $dbh->getProduct($productID);
        $formParams["title"] = $formParams["current"]["nome"];

        $formParams["sizes"] = $dbh->getAllSizes();
        $formParams["quantities"] = $dbh->getAllQuantities($productID);

        //TODO: modify db

        break;

    case 2: //? materiale
        $dbh->insertNewValue($newValue, "nome", "materiale");
        break;
    case 3: //? marca
        $dbh->insertNewValue($newValue, "nome", "marca");
        break;
    case 4: //? taglia
        $dbh->insertNewValue($newValue, "numero", "taglia");
        break;
    case 5: //? colore
        $dbh->insertNewValue($newValue, "nome", "colore");
        break;
    case 6: //? categorie
        $dbh->insertNewValue($newValue, "nome", "categoria");
        break;

    default:
        $templateParams["title"] = "Access Violation";
        echo `<div class="fw-1 text-danger"> 
                404 pagina non trovata 
              </div>`;
        break;
}


if ($action > 1 && $action < 7) {
    if (isset($previous)) {
        header("location: vendor-action-page.php?action=" . $previous);
    } else {
        header("location: vendor-action-page.php?action=1");
    }
}

require 'templates/base.php';
