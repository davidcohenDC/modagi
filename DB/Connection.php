<?php

class Connection{
    private $connection;
    private $servername = getenv('DB_HOST');
    private $username = getenv('DB_USER');
    private $password = getenv('DB_PASS');

    public function __construct() {
        $this->connection = new mysqli($this->servername, $this->username, $this->password, $this->db);

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