<?php

require_once("./macro.php");
require_once("./server.php");
require_once("utilis/cartManager.php");

if(isset($_GET["prodotto"])) {
    $idprodotto = $_GET["prodotto"];
} else {
    $idprodotto = 1;
}

//vendor-action-page.php?action=8&prodotto=1

$cartManager = new CartManager(DB_SERVER_NAME, DB_USERNAME, DB_PASSWORD, DB_NAME);

$templateParams["main"] = "product-page.php";
$templateParams["prodotto"] = $product->selectByIdWithQuantity($idprodotto)[0];
$templateParams["title"] = $templateParams["prodotto"]["nome"];
$templateParams["taglia"] = $product->selectTagliaByID($idprodotto);
$templateParams["idMateriale"] = $product->selectMaterialeByID($idprodotto)[0];
$templateParams["idGenere"] = $product->selectGenereByID($idprodotto)[0];
$templateParams["idColore"] = $product->selectColoreByID($idprodotto)[0];
$templateParams["idMarca"] = $product->selectMarcaByID($idprodotto)[0];
$templateParams["quantitaTaglia"] = $product->selectQuantitaWithNSize($idprodotto);
$templateParams["migliori"] = $order->selectTopProduct(5);


if(isset($_GET["modal"]) && $_GET["quantita"] > 0 ) {
    $cartManager->addProduct($_GET["prodotto"],$_GET["taglia"],$_GET["quantita"]);
    $cartManager->saveCart();
}


require_once('templates/base.php');
require_once("templates/product-page.php");

if(isset($_GET["modal"])) {
    require_once("templates/modals/modal_abandoned_cart.php");
    require_once("templates/modals/modal_product_no_quantity.php");
}

?>