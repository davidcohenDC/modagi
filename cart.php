<?php

require_once("macro.php");
require_once("cookie.php");

//TODO check if user is logged, else redirect to login page
$templateParams["title"] = "Shopping cart";
$templateParams["main"] = "./templates/cart_page.php";
$templateParams["cssFileName"] = "cart.css";

$cookie = new CookieManager();
// la setCookie la deve fare Dev quando nella main page l'utente aggiunge qualcosa al carrello
$cookie->setCookie(CART_COOKIE, json_encode(["articolo1", "articolo2"]));
$cart["articleList"] = json_decode($cookie->getCookieValue(CART_COOKIE));

require("./templates/base.php");

?>