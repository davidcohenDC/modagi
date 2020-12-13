<?php

require_once("./server.php");

if (isset($_POST["username"]) && isset($_POST["password"])) {
    $login_result = $dbh->checkLogIn($_POST["username"], $_POST["password"]);

    // login fallito
    if ($login_result[0]) {
        $_SESSION["username"] = $_POST["username"];
    } else {
        $templateParams["error"] = $login_result[1];
    }
}

if (isset($_GET["logOut"])) {
    logOut();
    header("location: user-page.php");
}

if (isUserLoggedIn()) {
    $pageTitle = "User Page";
    $pageMain = "user-home.php";
} else {
    $pageTitle = "Log In";
    $pageMain = "log-in-form.php";
}

$templateParams["title"] = $pageTitle;
$templateParams["main"] = $pageMain;

require 'templates/base.php';
require("templates/footer.php");
