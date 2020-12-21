<?php

require_once("macro.php");
require_once("./utilis/CartManager.php");
require_once("./utilis/functions.php");

$templateParams["title"] = "Checkout";
$templateParams["cssFileName"] = "checkout/checkout.css";


// nel caso in cui è loggato usi un form, nell'altro caso un altro (in questo momento per debug ho messo il !)
if(!isUserLoggedIn()) {
    $templateParams["main"] = "./templates/checkout_page.php";
    
    $cartManager = new CartManager();
    $cart["articleDetails"] = $cartManager->getArticleDetails();
    $cart["totalPrice"] = $cartManager->getTotalPrice();
    
    // crea array con dati personali dalla session
}
else {
    $templateParams["main"] = "./templates/go_to_login_page.php";
}

require("./templates/base.php");

?>