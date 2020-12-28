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

    case 8:
        $templateParams["title"] = "Modifica Scarpa";
        $templateParams["main"] = "form.php";
        $formParams["title"] = "Nome Scarpa";
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

        //TODO: pagina per modificare il prodotto.
        break;

    case 9:
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

        $formParams["sizes"] = $dbh->getAllSizes();
        $formParams["quantities"] = $dbh->getAllQuantities($productID);

        //TODO: pagina per aggiungere taglie.
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
