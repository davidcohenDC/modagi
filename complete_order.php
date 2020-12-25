<?php

require_once("./macro.php");
require_once("./utilis/functions.php");
require_once("./utilis/CartManager.php");
require_once("./utilis/UserManager.php");
require_once("./utilis/OrderManager.php");
require_once("./utilis/BankingSimulator.php");

$cartManager = new CartManager();
$userManager = new UserManager();
$orderManager = new OrderManager();

// Parte simulata in cui contatto la banca chiedendo il pagamento.
$bankingSimulator = new BankingSimulator($_POST["cardName"], $_POST["cardNumber"], $_POST["cardExpiration"], $_POST["cardCVV"]);
$cardAccetted = $bankingSimulator->requirePayment($cartManager->getTotalPrice());
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

    // mostra che l'ordine è andato a buon fine e reindirizza alla pagina principale dopo 5 secondi

    /*header("Location: index.php?orderStatus=" . $orderStatus);
    die();*/
}
else {
    header("Location: checkout.php?incorrectData=true#incorrectMessage");
    die();
}

?>