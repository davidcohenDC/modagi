<?php

class CookieManager{
    private $expireTime;

    public function __construct() {
        $this->expireTime = time() + (86400 * 30);
    }

    public function exists($cookie_name) {
        return isset($_COOKIE[$cookie_name]);
    }

    public function setCookie($cookie_name, $cookie_value) {
        setcookie($cookie_name, $cookie_value, $this->expireTime, "/");
    }

    public function getCookieValue($cookie_name) {
        return $_COOKIE[$cookie_name];
    }

}

?>