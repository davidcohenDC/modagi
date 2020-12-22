<?php

require_once("macro.php");
require_once("./utilis/CartManager.php");
require_once("./utilis/functions.php");
require_once("./utilis/UserManager.php");

$templateParams["title"] = "Checkout";
$templateParams["cssFileName"] = "checkout/checkout.css";


// nel caso in cui è loggato usi un form, nell'altro caso un altro (in questo momento per debug ho messo il !)
if(!isUserLoggedIn()) {
    $templateParams["main"] = "./templates/checkout_page.php";
    
    $cartManager = new CartManager();
    $cart["articleDetails"] = $cartManager->getArticleDetails();
    $cart["totalPrice"] = $cartManager->getTotalPrice();
    $cart["orderCount"] = $cartManager->getOrderCount();

    // for debugging (parte di gigi)
    $_SESSION["username"] = "More";
    $_SESSION["password"] = "lorenzomorelli";
    $userManager = new UserManager();
    $user["nome"] = $userManager->getNome();
    $user["username"] = $userManager->getUsername();
    $user["cognome"] = $userManager->getCognome();
    $user["indirizzo"] = $userManager->getIndirizzo();
    if(!$user["nome"] || !$user["username"] || !$user["cognome"] || !$user["indirizzo"]) {
        $templateParams["main"] = "./templates/go_to_login_page.php";
    }
}
else {
    $templateParams["main"] = "./templates/go_to_login_page.php";
}

require("./templates/base.php");

?>