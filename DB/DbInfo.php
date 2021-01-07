<?php
class DbInfo {

    private $username = DB_USERNAME;
    private $password = DB_PASSWORD;
    private $name = DB_NAME;
    private $host = DB_SERVER_NAME;
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
