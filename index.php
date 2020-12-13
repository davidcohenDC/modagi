<?php

    require_once("./server.php");
    require_once("./utilis/Paginator.php");

    $maxPage = 6;
    $product = new Product();
    $paginator = new Paginator($maxPage);

    $pageno = $paginator->getPage();

    $offset = ($pageno-1) * $maxPage;
    
    $totalProduct = $product->countAllProduct();
    $total_pages = ceil($totalProduct["TOT"] / $maxPage);

    $templateParams["prodotti"] = $product->Limit($offset, $maxPage);
    
    
    $templateParams["title"] = "Index";
    $templateParams["main"] = "main-page.php";
    require_once("templates/base.php");
    require_once("templates/main-page.php");
    require_once("templates/footer.php");

?>