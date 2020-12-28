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
        $formParams["title"] = "Modifica Scarpa";
        $formParams["main"] = "modify-product.php";

        //TODO: pagina per modificare il prodotto.
        break;
    default:
        $templateParams["title"] = "Access Violation";
        echo `<div class="fw-1 text-danger"> 
                404 pagina non trovata 
              </div>`;
        break;
}


if ($action > 1 && $action < 7) {
    header("location: vendor-action-page.php?action=1");
}

require 'templates/base.php';
