<?php

require_once("macro.php");
require_once("./utilis/CartManager.php");

//TODO check if user is logged, else redirect to login page
$templateParams["title"] = "Shopping cart";
$templateParams["main"] = "./templates/cart_page.php";
$templateParams["cssFileName"] = "cart/cart.css";

$cartManager = new CartManager();
$cart["articleDetails"] = $cartManager->getArticleDetails();
$cart["totalPrice"] = $cartManager->getTotalPrice();

require("./templates/base.php");

?>