<?php

require_once("./server.php");
require_once './utilis/DatabaseUser.php';

if (!isUserLoggedIn() || !isset($_GET["action"])) {
    header("location: user-page.php");
}

if (!isUserVendor()) {
    header("location: access-level-violation.php");
}

$action = $_GET["action"];

switch ($action) {
    case 1: //? Aggingi Scarpa
        $templateParams["title"] = "Aggiungi Articolo";
        $templateParams["main"] = "form.php";
        $formParams["title"] = "Aggiungi Articolo";
        $formParams["main"] = "add-article-form.php";

        if (!isset($dbh)) {
            $dbh = new DatabaseUser(DB_SERVER_NAME, DB_USERNAME, DB_PASSWORD, DB_NAME);
        }

        $formParams["colors"] = $dbh->getAllColors();
        $formParams["sizes"] = $dbh->getAllSizes();
        break;

    default:
        $templateParams["title"] = "Access Violation";
        echo `<div class="fw-1 text-danger"> 
                404 pagina non trovata 
              </div>`;
        break;
}

require 'templates/base.php';
