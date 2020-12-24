<?php

require_once("./macro.php");
require_once("./utilis/CookieManager.php");
require_once("./utilis/DatabaseCart.php");

class CartManager {
    
    public function __construct() {
        $this->cookie = new CookieManager();
        $this->db = new DatabaseCart(DB_SERVER_NAME, DB_USERNAME, DB_PASSWORD, DB_NAME);
        $this->cart = $this->getAllProduct();
    }

    /**
     * add a product to cart, for save it call saveProduct()
     */
    public function addProduct($productId, $productSize) {
        $newProductKey = $productId . "|" . $productSize;
        if(array_key_exists($newProductKey, $this->cart)) {
            $productCount = $this->cart[$newProductKey];
            $newProduct = array($productId . "|" . $productSize => $productCount+1);
            $this->cart = array_merge($this->cart, $newProduct);
        }
        else {
            $newProduct = array($productId . "|" . $productSize => 1);
            $this->cart = array_merge($this->cart, $newProduct);
        }
    }

    /**
     * get from cookie all product in the cart
     */
    public function getAllProduct() {
        $jsonAllArticle = $this->cookie->getCookieValue(CART_COOKIE);
        if($jsonAllArticle) {
            $allProductToCheck = json_decode($jsonAllArticle, true);
            $finalAllProduct = array();
            foreach ($allProductToCheck as $key => $productCount) {
                if($productCount > 0) {
                    $newProduct = array($key => $productCount);
                    $finalAllProduct = array_merge($finalAllProduct, $newProduct);
                }
            }
            return $finalAllProduct;
        }
        return array();
    }

    /**
     * save into cookie the added product
     */
    public function saveCart() {
        $this->cookie->setCookie(CART_COOKIE, json_encode($this->cart));
    }

    /**
     * get all product details in the cart from DB
     */
    public function getAllProductDetails() {
        $allProduct = $this->getAllProduct();

        $allArticleDetails = array();
        foreach ($allProduct as $key => $articleCount) {
            $divisorIndex = strpos($key, "|");
            $articleId = substr($key, 0, $divisorIndex);
            $articleSize = substr($key, $divisorIndex+1);

            $articleDetails = $this->db->getArticleDetails($articleId);
            $articleDetails["quantita"] = (int)$articleCount;
            $articleDetails["taglia"] = $articleSize;
            array_push($allArticleDetails, $articleDetails);
        }
        return $allArticleDetails;
    }

    /**
     * calculate and get the total price of all product in the cart
     */
    public function getTotalPrice() {
        $totalPrice = 0;
        $allProductDetails = $this->getAllProductDetails();
        foreach ($allProductDetails as $article) {
            $totalPrice = $totalPrice + ($article["prezzo"] * $article["quantita"]);
        }
        return $totalPrice;
    }

    /**
     * get order count, note that multiple order of same product are not count
     */
    public function getOrderCount() {
        return count($this->getAllProduct());
    }
}

?>