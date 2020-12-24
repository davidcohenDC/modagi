<?php

require_once("macro.php");
require_once("./utilis/CartManager.php");

//TODO check if user is logged, else redirect to login page
$templateParams["title"] = "Shopping cart";
$templateParams["main"] = "./templates/cart_page.php";
$templateParams["cssFileName"] = "cart/cart.css";

$cartManager = new CartManager();
// parte per debug
/*$cartManager->addProduct("1", "45");
$cartManager->addProduct("1", "44");
$cartManager->addProduct("1", "43");
$cartManager->addProduct("1", "43");
$cartManager->saveCart();*/
//var_dump($cartManager->getAllProduct());
// fine parte per debug
$cart["articleDetails"] = $cartManager->getAllProductDetails();
$cart["totalPrice"] = $cartManager->getTotalPrice();

require("./templates/base.php");

?>