<?php

require_once("./server.php");
require_once './utilis/DatabaseUser.php';

if (!isUserLoggedIn() || !isset($_GET["action"])) {
    header("location: user-page.php");
}

$action = $_GET["action"];

switch ($action) {
    case 0: //!log out
        logOut();
        header("location: user-page.php");
        break;

    case 1: //? Storico ordini
        $templateParams["title"] = "I miei Ordini";

        if (!isset($dbh)) {
            $dbh = new DatabaseUser(DB_SERVER_NAME, DB_USERNAME, DB_PASSWORD, DB_NAME);
        }

        if ($dbh->hasOrders($_SESSION["username"])) {
            $templateParams["dates"] = $dbh->getOrdersDates($_SESSION["username"]);

            foreach ($templateParams["dates"] as $date) {
                $templateParams[$date["data"]] = $dbh->getOrdersProducts($date["data"], $_SESSION["username"]);
            }
        } else {
            $templateParams["noOrders"] = "Nessun Ordine da Mostrare";
        }

        $templateParams["main"] = "order-history.php";
        break;

    case 2: //? cambia i dati utente
        $templateParams["title"] = "Modifica Dati Utente";
        $templateParams["main"] = "form.php";
        $formParams["title"] = "Modifica Dati Utente";
        $formParams["main"] = "change-user-data.php";

        if (!isset($dbh)) {
            $dbh = new DatabaseUser(DB_SERVER_NAME, DB_USERNAME, DB_PASSWORD, DB_NAME);
        }

        if (isset($_POST["password"])) {

            if (isset($_POST["name"])) {
                $change_result[0] = $dbh->updateName($_SESSION["username"], $_POST["password"], $_POST["name"]);
            }

            if (isset($_POST["surname"])) {
                $change_result[1] = $dbh->updateSurname($_SESSION["username"], $_POST["password"], $_POST["surname"]);
            }

            if (isset($_POST["address"])) {
                $change_result[2] = $dbh->updateAddress($_SESSION["username"], $_POST["password"], $_POST["address"]);
            }

            for ($i = 0; $i < 3; $i++) {
                if (!$change_result[$i][0]) {
                    $templateParams["error"] = $change_result[$i][1];
                }
            }
            if (!isset($templateParams["error"])) {
                header("location: user-page.php");
            }
        }

        break;

    case 3: //? cambio password
        $templateParams["title"] = "Modifica Password";
        $templateParams["main"] = "form.php";
        $formParams["title"] = "Modifica Password";
        $formParams["main"] = "change-password-form.php";

        //* effettivo update query
        if (!isset($dbh)) {
            $dbh = new DatabaseUser(DB_SERVER_NAME, DB_USERNAME, DB_PASSWORD, DB_NAME);
        }

        if (isset($_POST["old-password"]) && isset($_POST["new-password"])) {
            $change_result = $dbh->updatePassword($_SESSION["username"], $_POST["old-password"], $_POST["new-password"]);

            if ($change_result[0]) {
                //* cambio password riuscito
                header("location: user-page.php");
            } else {
                $templateParams["error"] = $change_result[1];
            }
        }
        break;

    case -1: //! remove account after confirm

        $templateParams["title"] = "Rimuovi Account";
        $templateParams["main"] = "form.php";
        $formParams["title"] = "Rimuovi Account";
        $formParams["main"] = "confirm.php";

        if (!isset($dbh)) {
            $dbh = new DatabaseUser(DB_SERVER_NAME, DB_USERNAME, DB_PASSWORD, DB_NAME);
        }
        if (isset($_POST["password"])) {
            $remove_result = $dbh->removeUser($_SESSION["username"], $_POST["password"]);

            if ($remove_result[0]) {
                //! then log out
                logOut();
                header("location: registration-page.php");
            } else {
                $templateParams["error"] = $remove_result[1];
            }
        }
        break;

    default:
        $templateParams["title"] = "azione non trovata";
        echo `<div class="fw-1 text-danger"> 
                404 pagina non trovata 
              </div>`;
        break;
}

require 'templates/base.php';
