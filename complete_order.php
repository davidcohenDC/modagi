<?php

require_once("macro.php");
require_once("./utilis/functions.php");

require("./templates/complete_order_page.php");

var_dump($_POST);
if(empty($_POST["cardName"]) || empty($_POST["cardNumber"]) || empty($_POST["cardExpiration"]) || empty($_POST["cardCVV"])) {
    header("Location: checkout.php?incorrectData=true#incorrectMessage");
    die();
}

// query per inserimento dell'ordine nel 

// se tutto ok fai un alert JS e da li la redirect alla pagina principale
// altrimenti ritorni su checkout

?>