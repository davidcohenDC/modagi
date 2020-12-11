<?php


require("./DbInfo.php");

class Connection{
    //connections fields
    private $connection;

    public function __construct() {
      $dbInfo = new DbInfo();
      $this->connection = new mysqli($dbInfo->getHost(), $dbInfo->getUsername(), $dbInfo->getUsername(), $dbInfo->getName(), $dbInfo->getPort());

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