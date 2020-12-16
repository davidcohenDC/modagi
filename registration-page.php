<?php

require_once("./server.php");
require_once './DB/Database.php';

/* se tutti i campi sono stati messi */
if (
    isset($_POST["name"]) && isset($_POST["surname"]) && isset($_POST["address"])
    && isset($_POST["username"]) && isset($_POST["password"])
) {
    //TODO: inserire i campi nella tabella.
    $dbh = new Database();

    /* check user already exists */
    $checkUser = $dbh->Select("SELECT username FROM user WHERE username = ?;", [$user]);

    if (count($checkUser) > 0) {
        /* insert user in db */
        $dbh->Insert(
            "INSERT INTO user (username, password, admin, nome, cognome, indirizzo) VALUES (?, ?, ?, ?, ?)",
            [$_POST["username"], $_POST["password"], "N", $_POST["name"], $_POST["surname"], $_POST["address"]]
        );

        header("location: user-page.php");
    } else {
        $templateParams["error"] = "UTENTE ESISTENTE";
    }
}

$templateParams["title"] = "Registration";
$templateParams["main"] = "register-form.php";

require 'templates/base.php';
