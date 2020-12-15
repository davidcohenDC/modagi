<?php

require_once("macro.php");
require_once("utilis/cookie.php");
require_once("utilis/DatabaseCart.php");

//TODO check if user is logged, else redirect to login page
$templateParams["title"] = "Shopping cart";
$templateParams["main"] = "./templates/cart_page.php";
$templateParams["cssFileName"] = "cart/cart.css";

$cookie = new CookieManager();
// la setCookie la deve fare Dev quando nella main page l'utente aggiunge qualcosa al carrello
// ora si usa per testare, quindi il + - e cestino del carrello sono un po buggati per questa riga
$cookie->setCookie(CART_COOKIE, json_encode(["Air Max 1", "Af1 Pixel", "Air Max 1"]));
// array of article name
$allArticle = json_decode($cookie->getCookieValue(CART_COOKIE));

$db = new DatabaseCart(DB_SERVER_NAME, DB_USERNAME, DB_PASSWORD, DB_NAME);
$cart["articleDetails"] = array();

// get number of an article put in the cart
$numberOfOrder = array_count_values($allArticle);
// need array_unique to don't show in cart the same article more than 1 time
foreach (array_unique($allArticle) as $key => $articleName) {
    array_push($cart["articleDetails"], [$db->getArticleDetails($articleName), $numberOfOrder[$articleName]]);
}

$cart["totalPrice"] = 0;
foreach ($cart["articleDetails"] as $key => $article) {
    $cart["totalPrice"] = $cart["totalPrice"] + ($article[0]["prezzo"] * $article[1]) ;
}

require("./templates/base.php");

?>