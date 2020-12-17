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

    case 2: //? cambio password
        $templateParams["title"] = "Cambio Password";
        $templateParams["main"] = "change-password-form.php";

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

    default:
        $templateParams["title"] = "azione non trovata";
        echo `<div class="fw-1 text-danger"> 
                404 pagina non trovata 
              </div>`;
        break;
}

require 'templates/base.php';
