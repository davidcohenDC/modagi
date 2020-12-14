<?php

    require_once("./server.php");
    require_once("./utilis/Paginator.php");
    require_once("./utilis/functions.php");

    $value = [];

    //make a filter to put into Paginator
    $filter = "SELECT * FROM prodotto ";

    if(isset($_GET["marca"])) {
        $filter = $filter."WHERE IdMarca = ".$_GET["marca"];
    }
 
    if(isset($_GET["colore"])) {
        $filter = $filter." AND IdColore = ".$_GET["colore"];
    }

    //setting the Paginator
    $paginator = new Paginator($product);
    $paginator->setElementForPage(MAX_PRODUCT_FOR_PAGE);
    $paginator->setNewFilter($filter);
    
    $templateParams["prodotti"] = $paginator->paging();
    $templateParams["pagina"] = $paginator->getPage();
    $templateParams["title"] = "Index";
    $templateParams["main"] = "main-page.php";
    $templateParams["marca"] = $marca->getAll();
    $templateParams["colori"] = $colour->getAll();
    $templateParams["promozioni"] = 2;

    require_once("templates/base.php");
    require_once("templates/main-page.php");
    require_once("templates/footer.php");

?>