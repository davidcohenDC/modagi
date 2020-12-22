<?php

require_once("macro.php");
require_once("./utilis/cookie.php");
require_once("./utilis/DatabaseCart.php");

class CartManager {
    
    public function __construct() {
        $this->cookie = new CookieManager();
        $this->db = new DatabaseCart(DB_SERVER_NAME, DB_USERNAME, DB_PASSWORD, DB_NAME);
        $this->articleDetails = array();
        $this->allArticle = array();
        $this->orderCount = 0;
        $this->totalPrice = 0;

        // TODO di DEV
        $this->cookie->setCookie(CART_COOKIE, json_encode(["1", "8"]));
        
        $jsonArticle = $this->cookie->getCookieValue(CART_COOKIE);
        if($jsonArticle) {
            $this->allArticle = json_decode($jsonArticle);
        
            // get number of an article put in the cart
            $numberOfOrder = array_count_values($this->allArticle);
            // need array_unique to don't show in cart the same article more than 1 time
            foreach (array_unique($this->allArticle) as $key => $articleName) {
                $tmpArray = $this->db->getArticleDetails($articleName);
                $tmpArray["quantita"] = (int)$numberOfOrder[$articleName];
                array_push($this->articleDetails, $tmpArray);
            }
            foreach ($this->articleDetails as $key => $article) {
                $this->totalPrice = $this->totalPrice + ($article["prezzo"] * $article["quantita"]);
            }
        }
    }

    public function getArticleDetails() {
        return $this->articleDetails;
    }

    public function getTotalPrice() {
        return $this->totalPrice;
    }

    public function getOrderCount() {
        foreach ($this->allArticle as $article) {
            $this->orderCount = $this->orderCount + 1;
        }
        return $this->orderCount;
    }
}

?>