<?php

require_once("./server.php");
require_once("utilis/cartManager.php");

$cartManager = new CartManager();

if(isUserLoggedIn() && isset($_GET["modal"])) {
    $cartManager->addProduct($_GET["prodotto"],$_GET["taglia"],$_GET["quantita"]);
    $cartManager->saveCart();
}

$templateParams["main"] = "product-page.php";
$templateParams["prodotto"] = $product->selectByIdWithQuantity($idprodotto)[0];
$templateParams["title"] = $templateParams["prodotto"]["nome"];
$templateParams["taglia"] = $product->selectTagliaByID($idprodotto);
$templateParams["idMateriale"] = $product->selectMaterialeByID($idprodotto)[0];
$templateParams["idGenere"] = $product->selectGenereByID($idprodotto)[0];
$templateParams["idColore"] = $product->selectColoreByID($idprodotto)[0];
$templateParams["idMarca"] = $product->selectMarcaByID($idprodotto)[0];
$templateParams["quantitaTaglia"] = $product->selectQuantitaWithNSize($idprodotto);

require_once('templates/base.php');
require_once("templates/product-page.php");

if(isset($_GET["modal"])) {
    require_once("templates/modal_abandoned_cart.php");
    require_once("templates/modal_not_user_logged.php");
}

?>