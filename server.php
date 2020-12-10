<?php

    $db_user = "root";
    $db_password = "";
    $db_name = "modagi";
    $host = "127.0.0.1";

    require("./DB/database.php");

    $dbh = new DatabaseHelper($host, $db_user, $db_password, $db_name, 3306);

    define("CSS_FILE", "./css/");
    define("JS_FILE", "./js/");
?>