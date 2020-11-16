<?php

    $db_user = "root";
    $db_password = "";
    $db_name = "modagi";
    $host = "127.0.0.1";

    // apre la connessione
    $conn = new mysqli($host, $db_user, $db_password);

    // controllo se la connessione è stabilita
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    else {
        echo "Connection successful";
    }

    // query con i prepared statement (in modo da evitare mysql injection)
        // imposto la query
    $query_preparator = $conn->prepare("SELECT * FROM table WHERE columnname = ?");
        // sostituisco il ? con il valore della variabile (normalmente una input di form)
    $variabile = "nome_colonna";
    $query_preparator->bind_param('s', $variabile);
        // eseguo la query
    $query_preparator->execute();
        // chiudo il preparatore
    $query_preparator->close();

    // chiude la connessione
    $conn->close();
?>