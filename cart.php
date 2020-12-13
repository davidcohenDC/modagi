<?php

require_once("macro.php");
require_once("cookie.php");
require_once("utilis/DatabaseCart.php");

//TODO check if user is logged, else redirect to login page
$templateParams["title"] = "Shopping cart";
$templateParams["main"] = "./templates/cart_page.php";
$templateParams["cssFileName"] = "cart/cart.css";

$cookie = new CookieManager();
// la setCookie la deve fare Dev quando nella main page l'utente aggiunge qualcosa al carrello
$cookie->setCookie(CART_COOKIE, json_encode(["Air Max 1", "Af1 Pixel"]));
$allArticle = json_decode($cookie->getCookieValue(CART_COOKIE));

$db = new DatabaseCart(DB_SERVER_NAME, DB_USERNAME, DB_PASSWORD, DB_NAME);
$cart["articleDetails"] = array();

foreach ($allArticle as $key => $articleName) {
    array_push($cart["articleDetails"], $db->getArticleDetails($articleName));
}

$cart["totalPrice"] = $db->getTotalPrice($allArticle);

require("./templates/base.php");
require("./templates/footer.php");

?>