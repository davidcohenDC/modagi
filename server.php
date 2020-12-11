<?php

session_start();

require_once("macro.php");
require_once("./utilis/functions.php");

require("./DB/Product.php");

$product = new Product();
//da inserire gli altri
