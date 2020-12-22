<?php

require_once("./server.php");
require_once './utilis/DatabaseUser.php';

if (!isset($dbh)) {
    $dbh = new DatabaseUser(DB_SERVER_NAME, DB_USERNAME, DB_PASSWORD, DB_NAME);
}

if (isset($_POST["username"]) && isset($_POST["password"])) {
    $login_result = $dbh->checkLogIn($_POST["username"], $_POST["password"]);

    if ($login_result[0]) {
        /* login riuscito */
        $_SESSION["username"] = $_POST["username"];
        $_SESSION["isVendor"] = $dbh->userAccessLevel($_POST["username"]);
    } else {
        /* login fallito */
        $templateParams["error"] = $login_result[1];
    }
}

if (isUserLoggedIn()) {
    if (isUserVendor()) {
        $pageTitle = "Vendor Page";
        $pageMain = "vendor-home.php";
    } else {
        $pageTitle = "User Page";
        $pageMain = "user-home.php";
    }
} else {
    $pageTitle = "Log In";
    $pageMain = "form.php";
    $formParams["title"] = "Accedi!";
    $formParams["main"] = "log-in-form.php";
}

$templateParams["title"] = $pageTitle;
$templateParams["main"] = $pageMain;

require 'templates/base.php';
