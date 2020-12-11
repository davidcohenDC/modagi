<?php

/**
 * Funzione per pagine user-only!
 */
function isUserLoggedIn()
{
    return !empty($_SESSION['username']);
}

function logOut()
{
    if (isUserLoggedIn()) {
        unset($_SESSION['username']);
    }
}
