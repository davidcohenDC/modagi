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

    case 2: //?cambia password
        $templateParams["title"] = "Cambio Password";
        $templateParams["main"] = "change-password-form.php";
        break;

    default:
        $templateParams["title"] = "azione non trovata";
        echo `<div class="fw-1 text-danger"> 
                404 pagina non trovata 
              </div>`;
        break;
}

require 'templates/base.php';
