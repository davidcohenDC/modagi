<?php
class DbInfo {

    private $username = "root";
    private $password = "";
    private $name = "modagi";
    private $host = "127.0.0.1";
    private $port = 3306;

    public function getUsername() {
        return $this->username;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getName() {
        return $this->name;
    }

    public function getHost() {
        return $this->host;
    }

    public function getPort() {
        return $this->port;
    }
}
?>
