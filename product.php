<?php

require_once("./server.php");



if(isset($_GET["prodotto"])) {
    $idprodotto = $_GET["prodotto"];
} else {
    $idprodotto = 1;
}

$templateParams["prodotto"] = $product->selectById($idprodotto)[0];
$templateParams["idMateriale"] = $product->selectMaterialeByID($idprodotto)[0];
$templateParams["idGenere"] = $product->selectGenereByID($idprodotto)[0];
$templateParams["idColore"] = $product->selectColoreByID($idprodotto)[0];
$templateParams["idMarca"] = $product->selectMarcaByID($idprodotto)[0];
require_once('templates/base.php');
require_once("templates/product-page.php");
require_once("templates/footer.php");

?>