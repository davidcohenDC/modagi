<?php

require_once("./server.php");
require_once("utilis/cartManager.php");

if(isset($_GET["prodotto"])) {
    $idprodotto = $_GET["prodotto"];
} else {
    $idprodotto = 1;
}

$cartManager = new CartManager();


//to do
// array_push($cart, "8");
// array_push($cart, "1");
// array_push($cart, "2");
// $cookie->setCookie(CART_COOKIE, json_encode($cart));
//

$templateParams["main"] = "product-page.php";
$templateParams["prodotto"] = $product->selectByIdWithQuantity($idprodotto)[0];
$templateParams["title"] = $templateParams["prodotto"]["nome"];
$templateParams["taglia"] = $product->selectTagliaByID($idprodotto);
$templateParams["idMateriale"] = $product->selectMaterialeByID($idprodotto)[0];
$templateParams["idGenere"] = $product->selectGenereByID($idprodotto)[0];
$templateParams["idColore"] = $product->selectColoreByID($idprodotto)[0];
$templateParams["idMarca"] = $product->selectMarcaByID($idprodotto)[0];
$templateParams["quantitaTaglia"] = $product->selectQuantitaWithNSize($idprodotto);

if (isset($_GET["modal"])) {
    $cartManager->addProduct("$idprodotto",$_GET["taglia"],$_GET["quantita"]);
    
    $cartManager->saveCart();
}

require_once('templates/base.php');
require_once("templates/product-page.php");

?>