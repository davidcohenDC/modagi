<?php

require_once("./server.php");
require_once './utilis/DatabaseUser.php';

if (!isUserLoggedIn() || !isset($_GET["action"])) {
    header("location: user-page.php");
}

$action = $_GET["action"];

if (!isset($dbh) && $action != 0) {
    $dbh = new DatabaseUser(DB_SERVER_NAME, DB_USERNAME, DB_PASSWORD, DB_NAME);
}

switch ($action) {
    case 0: //!log out
        logOut();
        header("location: user-page.php");
        break;

    case 1: //? Storico ordini
        $templateParams["title"] = "I miei Ordini";
        if (isset($_GET["status"])) {
            switch ($_GET["status"]) {
                case 0:
                    $filter = "";
                    break;

                case 1:
                    $filter = " AND idStato = " . $_GET["status"] . " ";
                    break;

                case 2:
                    $filter = " AND idStato = " . $_GET["status"] . " ";
                    break;

                case 3:
                    $filter = " AND idStato = " . $_GET["status"] . " ";
                    break;

                case 4:
                    $filter = " AND idStato < 3 ";
                    break;

                default:
                    $filter = "";
                    break;
            }
        } else {
            $filter = "";
        }

        if ($dbh->hasOrders($_SESSION["id"])) {
            $templateParams["dates"] = $dbh->getOrdersDates($_SESSION["id"], $filter);

            foreach ($templateParams["dates"] as $date) {
                $templateParams[$date["data"]] = $dbh->getOrdersProducts($date["data"], $_SESSION["id"], $filter);
            }

            $icons["size"] = 30;
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

        if (isset($_POST["p"])) {

            if (isset($_POST["name"]) && $_POST["name"] != "") {
                $change_result[0] = $dbh->updateName($_SESSION["id"], $_POST["p"], $_POST["name"]);
            }

            if (isset($_POST["surname"]) && $_POST["surname"] != "") {
                $change_result[1] = $dbh->updateSurname($_SESSION["id"], $_POST["p"], $_POST["surname"]);
            }

            if (isset($_POST["address"]) && $_POST["address"] != "") {
                $change_result[2] = $dbh->updateAddress($_SESSION["id"], $_POST["p"], $_POST["address"]);
            }

            if (isset($_POST["username"]) && $_POST["username"] != "") {
                $change_result[3] = $dbh->updateUsernmae($_SESSION["id"], $_POST["p"], $_POST["username"]);
            }
            if (isset($change_result)) {
                for ($i = 0; $i < array_key_last($change_result) + 1; $i++) {
                    if (!$change_result[$i][0]) {
                        $templateParams["error"] = $change_result[$i][1];
                    }
                }
            }

            if (!isset($templateParams["error"])) {
                if (isset($_POST["name"])) {
                    $_SESSION["username"] = $_POST["name"];
                }
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
        if (isset($_POST["old"]) && isset($_POST["new"])) {
            $change_result = $dbh->updatePassword($_SESSION["id"], $_POST["old"], $_POST["new"]);

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

        $confirmParams["title"]  = "Sei sicuro di voler cancellare l'account?";
        $confirmParams["msg"] = "Una volta premuto conferma l'account non potra essere ripristinato.\nSarà necessario registrarsi nuovamente";
        $confirmParams["cancel"] = "user-page.php";

        if (isset($_POST["p"])) {
            $remove_result = $dbh->removeUser($_SESSION["id"], $_POST["p"]);

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
