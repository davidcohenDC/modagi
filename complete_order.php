<?php

require_once("./macro.php");
require_once("./utilis/functions.php");
require_once("./utilis/CartManager.php");
require_once("./utilis/UserManager.php");
require_once("./utilis/OrderManager.php");
require_once("./utilis/BankingSimulator.php");
require_once("./utilis/NotificationManager.php");

$templateParams["title"] = "Checkout";
$templateParams["main"] = "./templates/complete_order_page.php";
$templateParams["cssFileName"] = "./complete_order/complete_order.css";

$cartManager = new CartManager(DB_SERVER_NAME, DB_USERNAME, DB_PASSWORD, DB_NAME);
$userManager = new UserManager(DB_SERVER_NAME, DB_USERNAME, DB_PASSWORD, DB_NAME);
$orderManager = new OrderManager();
$notificationManager = new NotificationManager(DB_SERVER_NAME, DB_USERNAME, DB_PASSWORD, DB_NAME);

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
            $orderQuantity = $orderManager->getOrderStockQuantity($orderManager->getIdTagliaFromTaglia($article["taglia"]), $article["id"]);
            if($orderQuantity <= 0) {
                $allAdminEmail = $userManager->getAllAdminEmail();
                foreach ($allAdminEmail as $adminEmail) {
                    $notificationManager->addNotification($adminEmail["email"], "Articolo esaurito!",
                                                        "L'articolo '" . $article["nome"] . "' è esaurito nel magazzino.");
                }
            }
            if($article["quantita"] > 1) {
                $notificationManager->addNotification($userEmail, "Ordini ricevuti!", 
                                                        "Il tuoi " . $article["quantita"] . " ordini: " . $article["nome"] . " sono andati a buon fine.");
            }
            else {
                $notificationManager->addNotification($userEmail, "Ordine ricevuto!", "Il tuo ordine: " . $article["nome"] . " è andato a buon fine.");
            }
            // se qualcosa va storto rimando sulla index.php segnalando l'errore
            if(!$orderStatus) {
                header("Location: index.php");
                $notificationManager->addNotification($userEmail, "Errore durante il completamento dell'ordine",
                                                        "Il tuo ordine: " . $article["nome"] . " è esaurito!");
                die();
            }
        }

        $cartManager->clearCart();
        require("./templates/base.php");
    }
}

?>