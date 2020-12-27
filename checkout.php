<?php

require_once("./macro.php");
require_once("./utilis/CartManager.php");
require_once("./utilis/functions.php");
require_once("./utilis/UserManager.php");

$templateParams["title"] = "Checkout";
$templateParams["main"] = "./templates/checkout_page.php";

if(empty($_GET["incorrectData"])) {
    $incorrectData = false;
}
else {
    $incorrectData = "Attenzione, " . $_GET["incorrectData"];
}

$cartManager = new CartManager();
$cart["articleDetails"] = $cartManager->getAllProductDetails();
$cart["totalPrice"] = $cartManager->getTotalPrice();
$cart["orderCount"] = $cartManager->getOrderCount();

$userManager = new UserManager();
$user["email"] = $userManager->getEmail();
$user["nome"] = $userManager->getNome();
$user["username"] = $userManager->getUsername();
$user["cognome"] = $userManager->getCognome();
$user["indirizzo"] = $userManager->getIndirizzo();

require("./templates/base.php");

?>