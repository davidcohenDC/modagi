<?php

session_start();

require_once("macro.php");
require_once("./utilis/functions.php");
require_once("./db/Category.php");
require_once("./db/Product.php");
require_once("./DB/Brand.php");
require_once("./utilis/Paginator.php");
require_once("./DB/Colour.php");
require_once("./DB/Gender.php");
require_once("./DB/Material.php");
require_once("./DB/Size.php");

$category = new Category();
$product = new Product();
$colour = new Colour();
$brand = new Brand();
$gender = new Gender();
$material = new Material();
$size = new Size();
$paginator = new Paginator($product);
$paginator->setElementForPage(MAX_PRODUCT_FOR_PAGE);


//da inserire gli altri