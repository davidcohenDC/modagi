<?php

require_once("./macro.php");
require_once("./utilis/CartManager.php");

$templateParams["title"] = "Shopping cart";
$templateParams["main"] = "./templates/cart_page.php";
$templateParams["cssFileName"] = "cart/cart.css";

$cartManager = new CartManager(DB_SERVER_NAME, DB_USERNAME, DB_PASSWORD, DB_NAME);
$cart["articleDetails"] = $cartManager->getAllProductDetails();
$cart["totalPrice"] = $cartManager->getTotalPrice();

require("./templates/base.php");

?>