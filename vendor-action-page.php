<?php

require_once("./server.php");
require_once("./utilis/NotificationManager.php");
require_once './utilis/DatabaseUser.php';

if (!isUserLoggedIn() || !isset($_GET["action"]) || !isUserVendor()) {
    header("location: user-page.php");
}

$action = $_GET["action"];

if (!isset($dbh)) {
    $dbh = new DatabaseUser(DB_SERVER_NAME, DB_USERNAME, DB_PASSWORD, DB_NAME);
}

// controlli per pagine con modali
if (isset($_GET["prev"])) {
    $previous = $_GET["prev"];
}
if (isset($_GET["new-value"]) && $action > 1 && $action < 7) {
    $newValue = $_GET["new-value"];
}

// controllo di ridirezione per pagine con prodotti
if ($action > 7 && $action < 11) {
    if (isset($_GET["product"])) {
        if ($dbh->productExists($_GET["product"])) {
            //* prodotto esiste
            $productID = $_GET["product"];
        } else {
            //!product not exists
            $templateParams["error"] = "Il prodotto non esiste";
            header("location: vendor-action-page.php?action=1");
        }
    } else {
        //!no product
        $templateParams["error"] = "nessun prodotto da modificare";
        header("location: user-page.php");
    }
}
switch ($action) {
    case 1: //? Aggingi Scarpa
        $templateParams["title"] = "Aggiungi Articolo";
        $templateParams["main"] = "form.php";
        $formParams["title"] = "Aggiungi Articolo";
        $formParams["main"] = "add-article-form.php";
        $formParams["previousAction"] = $action;

        $formParams["colors"] = $dbh->getAllColors();
        $formParams["sizes"] = $dbh->getAllSizes();
        $formParams["materials"] = $dbh->getAllMaterials();
        $formParams["brands"] = $dbh->getAllBrands();
        $formParams["categories"] = $dbh->getAllCategories();

        if (isArticleSet($formParams, $_POST)) {
            //* insert data in sql db
            $insertResult = $dbh->insertShoe($_POST, $formParams);

            if (!$insertResult[0]) {
                $templateParams["error"] = $insertResult[1];
            }

            $prodID = $dbh->getProductId($_POST["name"])["id"];

            //* upload img
            $imgResult = uploadImage(IMG_DIR, $_FILES["shoe-img"], $prodID);

            if (!$imgResult[0]) {
                $templateParams["error"] = $imgResult[1];
            }

            if (!isset($templateParams["error"])) {
                header("location: index.php");
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

            $prodID = $dbh->getProductId($_POST["shoe"])["id"];
            //* upload img
            $imgResult = uploadImage(IMG_DIR . "/promotion/", $_FILES["promo-img"], "promo_" . $prodID);

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
        $formParams["previousAction"] = $action;

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

        // il nome è diverso dal precedente
        if (isset($_POST[$key[0]]) && $_POST[$key[0]] != "" && $_POST[$key[0]] != $formParams["current"][$key[1]]) {

            if (isset($_FILES["shoe-img"]) && $_FILES["shoe-img"]["name"] != "") {

                $prodID = $dbh->getProductId($formParams["current"][$key[1]])["id"];

                // rimuovo la vecchia 
                if (image_exists(IMG_DIR . $prodID)) {
                    $rmvResult = removeImg(IMG_DIR, $prodID);

                    if (!$rmvResult[0]) {
                        $templateParams["error"] = $rmvResult[1];
                    }
                }

                $prodID = $dbh->getProductId($_POST[$key[0]])["id"];

                // inserisco la nuova
                $imgResult = uploadImage(IMG_DIR, $_FILES["shoe-img"], $prodID);

                if (!$imgResult[0]) {
                    $templateParams["error"] = $imgResult[1];
                }
            } else {
                $oldProdID = $dbh->getProductId($formParams["current"][$key[1]])["id"];
                $newProdID = $dbh->getProductId($_POST[$key[0]])["id"];

                // cambio nome e basta quindi devo rinominare l'immagine
                $rnmResult = renameImage(IMG_DIR, $oldProdID, $newProdID);

                if (!$rnmResult[0]) {
                    $templateParams["error"] = $rnmResult[1];
                }
            }

            // modifica nome 
            $updateResult = $dbh->updateProduct($productID, $_POST[$key[0]], $key[1]);
            $changes++;

            if (!$updateResult[0]) {
                $templateParams["error"] = $updateResult[1];
            }
        } elseif (
            isset($_POST[$key[0]]) && $_POST[$key[0]] == $formParams["current"][$key[1]]
            && isset($_FILES["shoe-img"]) && $_FILES["shoe-img"]["name"] != ""
        ) {

            // cambio solo l'immagine  e non il nome
            $changes++;

            $prodID = $dbh->getProductId($formParams["current"][$key[1]])["id"];

            // rimuovo la vecchia 
            if (image_exists(IMG_DIR . $prodID)) {
                $rmvResult = removeImg(IMG_DIR, $prodID);

                if (!$rmvResult[0]) {
                    $templateParams["error"] = $rmvResult[1];
                }
            }

            // metto la nuova
            $imgResult = uploadImage(IMG_DIR, $_FILES["shoe-img"], $prodID);

            if (!$imgResult[0]) {
                $templateParams["error"] = $imgResult[1];
            }
        }

        // modifico gli altri parametri solo se sono diversi da prima 
        foreach (array(
            array("description", "descrizione"),
            array("brand", "idMarca"),
            array("color", "idColore"),
            array("price", "prezzo"),
            array("material", "idMateriale"),
            array("gender", "idGenere")
        ) as $key) {
            if (isset($_POST[$key[0]]) && $_POST[$key[0]] != "" && $_POST[$key[0]] != $formParams["current"][$key[1]]) {
                $updateResult = $dbh->updateProduct($productID, $_POST[$key[0]], $key[1]);
                $changes++;

                if (!$updateResult[0]) {
                    $templateParams["error"] = $updateResult[1];
                }
            }
        }

        // modifico categorie scelte
        if (isset($_POST["categories"])) {
            $updateResult = $dbh->updateProduct($productID, $_POST["categories"], "categorie");
            $changes++;

            if (!$updateResult[0]) {
                $templateParams["error"] = $updateResult[1];
            }
        }

        if ($changes) {
            if (!isset($templateParams["error"])) {
                header("location: product.php?prodotto=" . $productID);
            }
            $changes = 0;
        }
        break;

    case 9: //? aggiungi rimuovi taglie
        $templateParams["title"] = "Aggiungi Quantità";
        $templateParams["main"] = "form.php";
        $formParams["title"] = "Nome Scarpa";
        $formParams["main"] = "add-product-sizes.php";

        $changes = 0;

        //? get Current
        $formParams["current"] = $dbh->getProduct($productID);
        $formParams["title"] = $formParams["current"]["nome"];

        $formParams["sizes"] = $dbh->getAllSizes();
        $formParams["quantities"] = $dbh->getAllQuantities($productID);

        foreach ($formParams["sizes"] as $size) {
            if (isset($_POST["quantity-" . $size['id']]) && $_POST["quantity-" . $size['id']] != "") {
                $dbh->updateSize($size['id'], $_POST["quantity-" . $size['id']], $productID);
                $changes++;
            }
        }

        if ($changes) {
            if (!isset($templateParams["error"])) {
                header("location: vendor-action-page.php?action=8&product=" . $productID);
            }
            $changes = 0;
        }
        break;

    case 10: //! rimuovi prodotto
        $templateParams["title"] = "Rimuovi Prodotto";
        $templateParams["main"] = "form.php";

        $productName = $dbh->getProduct($productID)["nome"];

        $formParams["title"] = "Rimuovi " . $productName;
        $formParams["main"] = "confirm.php";

        $confirmParams["title"] = "Sei sicuro di voler rimuovere il prodotto \n'" . $productName . "'";
        $confirmParams["msg"] = "Una volto rimosso il prodotto non potrà essere ripristinato e verrà rimosso dalle cronologie degli ordini dei tuoi clienti.\nSe vuoi modificare le quantità del prodotto presenti <a href='vendor-action-page.php?action=9&product=" . $productID . "'>clicca qui!</a>";
        $confirmParams["cancel"] = "vendor-action-page.php?action=8&product=" . $productID;

        if (isset($_POST["p"])) {

            if (!$dbh->hasPendingOrders($productID)) {
                $remove_result = $dbh->removeProduct($_SESSION["id"], $_POST["p"], $productID);

                if ($remove_result[0]) {
                    // rimuovo la vecchia 
                    if (image_exists(IMG_DIR . $productID)) {
                        removeImg(IMG_DIR, $productID);
                    }

                    //! then go home
                    header("location: index.php");
                } else {
                    $templateParams["error"] = $remove_result[1];
                }
            } else {
                $templateParams["error"] = "IMPOSSIBILE RIMUOVERE '" . $productName . "' IN QUANTO PRESENTE IN ORDINI NON COMPLETATI";
            }
        }

        break;
    case 11: //* ordini in sospeso
        $templateParams["title"] = "Ordini in sospeso";
        $templateParams["main"] = "pending-orders.php";

        $pendingOrders = $dbh->getPendingOrders();

        if (count($pendingOrders) > 0) {
            $templateParams["dates"] = $dbh->getOrdersDates($_SESSION["id"]);

            foreach ($templateParams["dates"] as $date) {
                $templateParams[$date["data"]] = $dbh->getOrdersProducts($date["data"], $_SESSION["id"]);
            }

            $templateParams["stati"] = $dbh->getOrdersStatus($_SESSION["id"]);
            $icons["size"] = 30;
        } else {
            $templateParams["noOrders"] = "Nessun ordine non correttamente consegnato da mostrare.";
        }

        break;

    case 12:
        if (isset($_GET["order"]) && isset($_GET["status"]) && isset($_GET["email"])) {
            $userID = $_GET["email"];
            $orderID = $_GET["order"];
            $statusId = $_GET["status"] + 1;

            $statusName = $dbh->getStatusName($statusId);
            $statusResult = $dbh->updateOrder($orderID, $statusId);

            if (!$statusResult[0]) {
                $templateParams["error"] = $statusResult[1];
            }
            // TODO: dopo di questo lo stato è aggiornato e va mandata una modifica
            $notificationManager = new NotificationManager(DB_SERVER_NAME, DB_USERNAME, DB_PASSWORD, DB_NAME);
            $notificationTitle = "Ordine " . strtolower($statusName);
            $notificationMsg = "Il tuo ordine " . $orderID . " è stato " . strtolower($statusName);
            $notificationManager->addNotification($userID, $notificationTitle, $notificationMsg);
        }
        if (!isset($templateParams["error"])) {
            header("location: vendor-action-page.php?action=11");
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

    default:
        $templateParams["title"] = "Access Violation";
        break;
}


if ($action > 1 && $action < 7) {
    if (isset($previous)) {
        $url = "location: vendor-action-page.php?action=" . $previous;
        if (isset($_GET["product"])) {
            $url .= "&product=" . $_GET["product"];
        }
        header($url);
    } else {
        header("location: user-page.php");
    }
}

require 'templates/base.php';
