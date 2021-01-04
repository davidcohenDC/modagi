<?php

require_once("../macro.php");
require_once("../utilis/CartManager.php");

$cartManager = new CartManager(DB_SERVER_NAME, DB_USERNAME, DB_PASSWORD, DB_NAME);
$cartManager->clearCart();

?>