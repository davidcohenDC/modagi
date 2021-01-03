<?php

require_once("../macro.php");
require_once("../utilis/CartManager.php");

if(isset($_POST["id"]) && isset($_POST["size"])) {
    $articleId = $_POST["id"];
    $articleSize = $_POST["size"];

    $cartManager = new CartManager(DB_SERVER_NAME, DB_USERNAME, DB_PASSWORD, DB_NAME);
    $newProduct = $cartManager->increaseProduct($articleId, $articleSize);

    echo json_encode($newProduct);
}

?>