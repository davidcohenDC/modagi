<?php

class DatabaseCart{
    private $db;

    // costruttore
    public function __construct($servername, $username, $password, $dbname) {
        $this->db = new mysqli($servername, $username, $password, $dbname);

        // controllo se la connessione è andata a buon fine
        if($this->db->connect_error) {
            // die interrompe tutto!!
            die("Connessione al db fallita");
        }
    }

    public function getArticleDetails($articleId) {
        $stmt = $this->db->prepare("SELECT id, nome, prezzo, descrizione 
                                    FROM prodotto WHERE id = ?");
        $stmt->bind_param("s", $articleId);
        $stmt->execute();

        $result = $stmt->get_result();
        $stmt->close();

        // fetch_all recupera il risultato della query e MYSQLI_ASSOC specifico che voglio
        // che ritornare un array associativo (dizionario)
        return $result->fetch_all(MYSQLI_ASSOC)[0];
    }

    public function getTotalPrice($allArticle = []) {
        $totalPrice = 0;
        foreach ($allArticle as $key => $article) {
            $stmt = $this->db->prepare("SELECT prezzo FROM prodotto WHERE id = ?");
            $stmt->bind_param("s", $article);
            $stmt->execute();
            $result = $stmt->get_result();
            $stmt->close();
            $totalPrice = $totalPrice + (double)$result->fetch_all(MYSQLI_ASSOC)[0]["prezzo"];
        }

        return $totalPrice;
    }

}

class CookieManager{
    private $expireTime;

    public function __construct() {
        $oneDay = 86400;
        $this->expireTime = time() + $oneDay;
    }

    public function exists($cookie_name) {
        return isset($_COOKIE[$cookie_name]);
    }

    public function setCookie($cookie_name, $cookie_value) {
        setcookie($cookie_name, $cookie_value, $this->expireTime, "/");
    }

    public function getCookieValue($cookie_name) {
        if($this->exists($cookie_name)) {
            return $_COOKIE[$cookie_name];
        }
        return false;
    }

}

class CartManager {
    
    public function __construct($server, $username, $password, $dbName) {
        $this->cookie = new CookieManager();
        $this->db = new DatabaseCart($server, $username, $password, $dbName);
        $this->cart = $this->getAllProduct();
    }

    /**
     * add a product to cart, for saving it call saveCart()
     */
    public function addProduct($productId, $productSize, $productCount=1) {
        $newProductKey = $productId . "|" . $productSize;
        if(array_key_exists($newProductKey, $this->cart)) {
            $oldProductCount = $this->cart[$newProductKey];
            $newProduct = array($productId . "|" . $productSize => $oldProductCount+$productCount);
            $this->cart = array_merge($this->cart, $newProduct);
        }
        else {
            $newProduct = array($productId . "|" . $productSize => $productCount);
            $this->cart = array_merge($this->cart, $newProduct);
        }
    }

    /**
     * remove a unit of product to cart, for saving it call saveCart()
     */
    public function removeProduct($productId, $productSize, $productCount=1) {
        $newProductKey = $productId . "|" . $productSize;
        if(array_key_exists($newProductKey, $this->cart)) {
            $oldProductCount = $this->cart[$newProductKey];
            $newProduct = array($productId . "|" . $productSize => $oldProductCount-$productCount);
            $this->cart = array_merge($this->cart, $newProduct);
        }
    }

    /**
     * increase product quantity
     */
    public function increaseProduct($articleId, $articleSize) {
        $this->addProduct($articleId, $articleSize);
        $this->saveCart();

        $unitPrice = $this->getArticleDetails($articleId, $articleSize)["prezzo"];
        $newQuantity = $this->getArticleQuantity($articleId, $articleSize) + 1;
        $newArticlePrice = round($unitPrice * $newQuantity, 2);
        $newTotalPrice = round($this->getTotalPrice() + $unitPrice, 2);
        return array("articlePrice" => $newArticlePrice, "articleQuantity" => $newQuantity, "newTotalPrice" => $newTotalPrice);
    }

    /**
     * decrease product quantity
     */
    public function decreaseProduct($articleId, $articleSize) {
        $this->removeProduct($articleId, $articleSize);
        $this->saveCart();

        $unitPrice = $this->getArticleDetails($articleId, $articleSize)["prezzo"];
        $newQuantity = $this->getArticleQuantity($articleId, $articleSize) - 1;
        $newArticlePrice = round($unitPrice * $newQuantity, 2);
        $newTotalPrice = round($this->getTotalPrice() - $unitPrice, 2);
        return array("articlePrice" => $newArticlePrice, "articleQuantity" => $newQuantity, "newTotalPrice" => $newTotalPrice);
    }

    /**
     * clear the product inside the cart
     */
    public function clearCart() {
        $this->cookie->setCookie(CART_COOKIE, json_encode(array()));
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
     * get details of a specified article
     */
    public function getArticleDetails($articleId, $articleSize) {
        $allProductDetails = $this->getAllProductDetails();
        foreach ($allProductDetails as $article) {
            if(intval($article["id"]) == $articleId && intval($article["taglia"]) == $articleSize) {
                return $article;
            }
        }
        return false;
    }

    /**
     * get quantity of a specified article
     */
    public function getArticleQuantity($articleId, $articleSize) {
        $allProduct = $this->getAllProduct();
        $keyToFind = $articleId . "|" . $articleSize;
        foreach ($allProduct as $key => $articleQuantity) {
            if($key == $keyToFind) {
                return $articleQuantity;
            }
        }
        return false;
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