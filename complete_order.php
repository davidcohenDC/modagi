<?php

require_once("macro.php");
require_once("./utilis/functions.php");
require_once("./utilis/CartManager.php");
require_once("./utilis/UserManager.php");
require_once("./utilis/OrderManager.php");

require("./templates/complete_order_page.php");

$cartManager = new CartManager();
$userManager = new UserManager();
$orderManager = new OrderManager();

if(empty($_POST["cardName"]) || empty($_POST["cardNumber"]) || empty($_POST["cardExpiration"]) || empty($_POST["cardCVV"])) {
    header("Location: checkout.php?incorrectData=true#incorrectMessage");
    die();
}
else {
    // Parte simulata in cui contatto la banca chiedendo il pagamento.
    // sleep...
    $cart["totalPrice"] = $cartManager->getTotalPrice();

    $cardAccetted = true;
}

if($cardAccetted) {
    // prendo i dati per far la query
    $userEmail = $userManager->getEmail();

    $cart["articleDetails"] = $cartManager->getAllProductDetails();
    foreach ($cart["articleDetails"] as $article) {
        // query per inserimento dell'ordine nel DB
        $orderStatus = $orderManager->addOrder($userEmail, $article["id"], $article["quantita"]);
        // se qualcosa va storto rimando sulla index.php segnalando l'errore
        if(!$orderStatus) {
            header("Location: index.php?orderStatus=" . $orderStatus);
            die();
        }
    }

    /*header("Location: index.php?orderStatus=" . $orderStatus);
    die();*/
}

?>