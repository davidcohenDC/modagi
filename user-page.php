<?php

require_once("./server.php");
require_once './utilis/DatabaseUser.php';

if (!isset($dbh)) {
    $dbh = new DatabaseUser(DB_SERVER_NAME, DB_USERNAME, DB_PASSWORD, DB_NAME);
}

if (isset($_POST["email"]) && isset($_POST["p"])) {

    $login_result = $dbh->checkLogIn($_POST["email"], $_POST["p"]);

    if ($login_result[0]) {
        /* login riuscito */
        $_SESSION["id"] = $_POST["email"];
        $_SESSION["username"] = $dbh->getUserName($_POST["email"]);
        $_SESSION["isVendor"] = $dbh->userAccessLevel($_POST["email"]);
    } else {
        /* login fallito */
        $templateParams["error"] = $login_result[1];
    }
}

if (isUserLoggedIn()) {
    if (isUserVendor()) {
        $pageTitle = "Vendor Page";
        $templateParams["userActions"] = "vendor-actions.php";
    } else {
        $pageTitle = "User Page";
        $templateParams["userActions"] = "user-actions.php";
    }
    $pageMain = "user-home.php";
} else {
    $pageTitle = "Log In";
    $pageMain = "form.php";
    $formParams["title"] = "Accedi!";
    $formParams["main"] = "log-in-form.php";
}

$templateParams["title"] = $pageTitle;
$templateParams["main"] = $pageMain;

require 'templates/base.php';
