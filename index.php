<?php

    require_once("./server.php");
    require_once("./utilis/Paginator.php");
    require_once("./utilis/functions.php");

    $_SESSION["marca"] = 0;
    $_SESSION["colore"] = 0;
    $_SESSION["materiale"] = 0;

    //make a filter to put into Paginator --> use Filter.php
    $selection = "SELECT * FROM prodotto ";

    $selection = filterToQuery($selection);
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

?>