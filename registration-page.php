<?php

require_once("./server.php");
require_once './utilis/DatabaseUser.php';

/* se tutti i campi sono stati messi */
if (
    isset($_POST["email"]) && isset($_POST["name"]) && isset($_POST["surname"]) && isset($_POST["address"])
    && isset($_POST["username"]) && isset($_POST["p"])
) {

    $dbh = new DatabaseUser(DB_SERVER_NAME, DB_USERNAME, DB_PASSWORD, DB_NAME);

    /* check user already exists */
    if (!$dbh->userExists($_POST["email"])) {

        /* insert user in db */
        $register_result = $dbh->registerUser($_POST["email"], $_POST["username"], $_POST["p"], $_POST["name"], $_POST["surname"], $_POST["address"]);

        if ($register_result[0]) {
            $_SESSION["registrationSuccess"] = 1;
            header("location: user-page.php");
        } else {
            $templateParams["error"] = $register_result[1];
        }
    } else {
        $templateParams["error"] = "UTENTE ESISTENTE";
    }
}

$templateParams["title"] = "Registration";
$templateParams["main"] = "form.php";
$formParams["title"] = "Registrazione";
$formParams["main"] = "register-form.php";

require 'templates/base.php';
