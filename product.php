<?php

require_once("./server.php");
require_once("utilis/cookie.php");

if(isset($_GET["prodotto"])) {
    $idprodotto = $_GET["prodotto"];
} else {
    $idprodotto = 1;
}

$cart = array();

$cookie = new CookieManager();
if($cookie->exists(CART_COOKIE)) {
     $cart = json_decode($cookie->getCookieValue(CART_COOKIE));
}


//to do
// array_push($cart, "8");
// array_push($cart, "1");
// array_push($cart, "2");
// $cookie->setCookie(CART_COOKIE, json_encode($cart));
//

$templateParams["main"] = "product-page.php";
$templateParams["prodotto"] = $product->selectById($idprodotto)[0];
$templateParams["title"] = $templateParams["prodotto"]["nome"];
$templateParams["taglia"] = $product->selectTagliaByID($idprodotto);
$templateParams["idMateriale"] = $product->selectMaterialeByID($idprodotto)[0];
$templateParams["idGenere"] = $product->selectGenereByID($idprodotto)[0];
$templateParams["idColore"] = $product->selectColoreByID($idprodotto)[0];
$templateParams["idMarca"] = $product->selectMarcaByID($idprodotto)[0];


if (isset($_GET["modal"])) {
    array_push($cart, $templateParams["prodotto"]["id"]);
    $cookie->setCookie(CART_COOKIE, json_encode($cart));
}

require_once('templates/base.php');
require_once("templates/product-page.php");

?>