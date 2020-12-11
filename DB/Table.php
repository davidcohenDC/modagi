<?php

// Classe per le tabelle, contiene il nome della tabella e la connessione
//permette di implementare i metodi standard per tutte le tabelle
class Table extends Connection {

  private $table;
  private $connection;
 
  public function __construct($table) {
    $this->setTable($table);
    $this->connection = new Connection();
  }

  // Define get/set
  public function getTable() { 
    return $this->table; 
    }

  public function setTable($name) { 
    $this->table = "`" . $name . "`";
    }

  public function getConnection() { 
      return $this->connection; 
    }

    public function getAll() {
      //creo un nuovo array per i prodotti
      $row = array();
      //effettuo al query estesa dalla Connection e la metto in result
      $result = parent::query("SELECT * FROM ". $this->table );

      //inserisco nell'array tutti i gli oggetti
      while($record = $result->fetch_object()) {
          array_push($row, $record);
      }
      //ritorno il risultato
      $result = $row;
      return $result;
  }

  //da implementare
  public function getById() { }
  public function deleteById() { }

}

?>