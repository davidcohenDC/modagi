<?php

    require_once("./server.php");
    require_once("./utilis/Paginator.php");

    $filter = "SELECT * FROM prodotto ";
    $productForPage = 6;


    $paginator = new Paginator($product,$filter,$productForPage);
    $templateParams["prodotti"] = $paginator->paging();
    $templateParams["pagina"] = $paginator->getPage();
    $templateParams["title"] = "Index";
    $templateParams["main"] = "main-page.php";
    $templateParams["categorie"] = $category->selectAll();
    $templateParams["promozioni"] = 2;

    require_once("templates/base.php");
    require_once("templates/main-page.php");
    require_once("templates/footer.php");

?>