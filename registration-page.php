<?php

require_once("./server.php");

/* se tutti i campi sono stati messi */
if (
    isset($_POST["name"]) && isset($_POST["surname"]) && isset($_POST["address"])
    && isset($_POST["username"]) && isset($_POST["password"])
) {
    //TODO: inserire i campi nella tabella.

}

$templateParams["title"] = "Registration";
$templateParams["main"] = "register-form.php";

require 'templates/base.php';
