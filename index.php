<?php 

require_once("./server.php");
require_once("./utilis/Paginator.php");
require_once("./utilis/functions.php");

//make a filter to put into Paginator --> use Filter.php
$selection = bindProductUrlToQuery();
$paginator->setNewSelection($selection);
$templateParams["prodotti"] = $paginator->paging();
$templateParams["pagina"] = $paginator->getPage();
$templateParams["title"] = "Index";
$templateParams["main"] = "main-page.php";
$templateParams["marca"] = $brand->getAll();
$templateParams["taglia"] = $size->getAll();
$templateParams["colore"] = $colour->getAll();
$templateParams["genere"] = $gender->getAll();
$templateParams["materiale"] = $material->getAll();
$templateParams["Promo"] = getProductPromotion(PROMOTION_DIR);
$templateParams["migliori"] = $order->selectTopProduct(5);

require_once("templates/base.php");
require_once("templates/main-page.php");

?>