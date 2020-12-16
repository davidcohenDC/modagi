<?php

require_once("./server.php");
require_once './DB/Database.php';

if (!isset($dbh)) {
    $dbh = new Database();
}

function checkLogin($user, $password, $dbh)
{
    $checkUser = $dbh->Select("SELECT username FROM user WHERE username = ?;", [$user]);

    /* prima controllo che l'utente sia nel db */
    if (count($checkUser) > 0) {

        /* controllo che la password sia giusta */
        //TODO: salare la password
        $checkPass = $dbh->Select("SELECT COUNT(username) FROM user WHERE username = ? AND password = ?;", [$user, $password]);
        return [$checkPass > "0", "PASSWORD ERRATA!"];
    }
    return [false, "USER NON TROVATO"];
}

if (isset($_POST["username"]) && isset($_POST["password"])) {
    $login_result = checkLogIn($_POST["username"], $_POST["password"], $dbh);

    if ($login_result[0]) {
        /* login riuscito */
        $_SESSION["username"] = $_POST["username"];
        $_SESSION["isVendor"] = $dbh->Select("SELECT admin FROM user WHERE username = ?;", [$_POST["username"]]);
    } else {
        /* login fallito */
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
