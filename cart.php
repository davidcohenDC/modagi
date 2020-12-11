<?php

//TODO check if user is logged, else redirect to login page
$templateParams["title"] = "Shopping cart";
$templateParams["main"] = "./templates/cart_page.php";


require_once("cookie.php");
$cookie = new CookieManager();
define("CART_COOKIE", "CART_COOKIE");

// la setCookie la deve fare Dev quando nella main page l'utente aggiunge qualcosa al carrello
$cookie->setCookie(CART_COOKIE, json_encode(["articolo1", "articolo2"]));
$cart["articleList"] = json_decode($cookie->getCookieValue(CART_COOKIE));

require("./templates/base.php");

?>