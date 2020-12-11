<?php

class Connection{
    //connections fields
    private $connection;
    private $username = "root";
    private $password = "";
    private $serverName = "modagi";
    private $serverHost = "127.0.0.1";
    private $serverPort = 3306;

    public function __construct() {
        $this->connection = new mysqli($this->serverHost, $this->username, $this->password, $this->serverName, $this->serverPort);

        if($this->connection->connect_error) {
            // die interrompe tutto!!
            die("Connection fail!");
        }
      }

      public function query($sql) {
        return $this->connection->query($sql);
      }
    }

?>