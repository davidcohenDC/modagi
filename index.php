<?php

    require_once("./server.php");
    require_once("./utilis/Paginator.php");
    require_once("./utilis/functions.php");

    $value = [];

    //make a filter to put into Paginator --> use Filter.php
    $selection = "SELECT * FROM prodotto ";
    //filter = filter->filter();
    if(isset($_GET["marca"])) {
        $filter = "WHERE id = ".$_GET["marca"]." ";
        $selection = $selection.$filter;
    }
 
    if(isset($_GET["colore"])) {
        $filter = "AND id = ".$_GET["marca"]." ";
        $selection = $selection.$filter;
    }

    //setting the Paginator
    $paginator->setElementForPage(MAX_PRODUCT_FOR_PAGE);
    $paginator->setNewSelection($selection);
    
    $templateParams["prodotti"] = $paginator->paging();
    $templateParams["pagina"] = $paginator->getPage();
    $templateParams["title"] = "Index";
    $templateParams["main"] = "main-page.php";
    $templateParams["marca"] = $brand->getAll();
    $templateParams["colori"] = $colour->getAll();
    $templateParams["generi"] = $gender->getAll();
    $templateParams["materiali"] = $material->getAll();
    $templateParams["promozioni"] = 2;

    require_once("templates/base.php");
    require_once("templates/main-page.php");
    require_once("templates/footer.php");

?>