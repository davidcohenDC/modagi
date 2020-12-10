<?php

    //require_once("./server.php");

    if(true){
        $templateParams["title"] = "User Page";
        $templateParams["userName"] = "Luigi"; //TODO: make this query driven.
        $templateParams["main"] = "user-home.php";
    } else {
        $templateParams["title"] = "Log In";
        $templateParams["main"] = "log-in-form.php";
    }
    
    
    require 'templates/base.php';