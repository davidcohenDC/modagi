<?php

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
        return FALSE;
    }

}

?>