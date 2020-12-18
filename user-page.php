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
    $pageTitle = "User Page";
    $pageMain = "user-home.php";
} else {
    $pageTitle = "Log In";
    $pageMain = "log-in-form.php";
}

$templateParams["title"] = $pageTitle;
$templateParams["main"] = $pageMain;

require 'templates/base.php';

/*//TODO: mettere modali per comunicare gli errori
<div class="modal-dialog modal-sm">...</div>*/