<?php

session_start();

require_once("macro.php");
require_once("./utilis/functions.php");
require_once("./db/Category.php");
require_once("./db/Product.php");

$category = new Category("categoria");
$product = new Product("prodotto");

$templateParams["categorie"] = $category->selectAll();
$templateParams["prodotti"] = $product->selectAll();
$templateParams["promozioni"] = 2;
//da inserire gli altri