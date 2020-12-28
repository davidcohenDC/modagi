<?php

require_once("./macro.php");
require_once("./utilis/functions.php");
require_once("./utilis/CartManager.php");
require_once("./utilis/UserManager.php");
require_once("./utilis/OrderManager.php");
require_once("./utilis/BankingSimulator.php");

$templateParams["title"] = "Checkout";
$templateParams["main"] = "./templates/complete_order_page.php";
$templateParams["cssFileName"] = "./complete_order/complete_order.css";

$cartManager = new CartManager();
$userManager = new UserManager();
$orderManager = new OrderManager();

if(empty($_POST["cardName"]) || empty($_POST["cardNumber"]) || empty($_POST["cardExpiration"]) || empty($_POST["cardCVV"])) {
    header("Location: checkout.php?incorrectData=inseriti tutti i dati richiesti per il pagamento#incorrectMessage");
    die();
}
elseif($cartManager->getOrderCount() <= 0) {
    header("Location: checkout.php?incorrectData=il carrello è vuoto#incorrectMessage");
    die();
}
else {
    // Parte simulata in cui contatto la banca chiedendo il pagamento.
    $bankingSimulator = new BankingSimulator($_POST["cardName"], $_POST["cardNumber"], $_POST["cardExpiration"], $_POST["cardCVV"]);
    $cardAccetted = $bankingSimulator->requirePayment($cartManager->getTotalPrice());
    if(!$cardAccetted) {
        header("Location: checkout.php?incorrectData=la carta non è stata accettata#incorrectMessage");
        die();
    }
    else {
        // prendo i dati per far la query
        $userEmail = $userManager->getEmail();

        $cart["articleDetails"] = $cartManager->getAllProductDetails();
        foreach ($cart["articleDetails"] as $article) {
            // query per inserimento dell'ordine nel DB
            $orderStatus = $orderManager->addOrder($userEmail, $article["id"], $article["taglia"], $article["quantita"]);
            // se qualcosa va storto rimando sulla index.php segnalando l'errore
            if(!$orderStatus) {
                header("Location: index.php?orderStatus=" . $orderStatus);
                die();
            }
        }

        $cartManager->clearCart();
        require("./templates/base.php");
    }
}

?>