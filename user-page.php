<?php

    require_once("./server.php");
    
    if (isset($_POST["username"]) && isset($_POST["password"])) {
        $login_result = $dbh->checkLogIn($_POST["username"], $_POST["password"]);
    }


    if(isset($login_result[0])){
        if ($login_result[0]){
        
            /* login con successo */
            $templateParams["title"] = "User Page";
            $_SESSION["username"] = "Luigi"; //TODO: make this query driven.
            $templateParams["main"] = "user-home.php";
        
        } else {

            /* login fallito */
            $templateParams["title"] = "Log In";
            $templateParams["error"] = $login_result[1];
            $templateParams["main"] = "log-in-form.php";
        }
    } else { 
        
        /* user non ha effetuato log in */
        $templateParams["title"] = "Log In";
        $templateParams["main"] = "log-in-form.php";
    }
    
    
    require 'templates/base.php';