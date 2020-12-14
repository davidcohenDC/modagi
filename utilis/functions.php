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

function change_url_parameter($url,$parameter,$parameterValue)
{
    $url=parse_url($url);
    parse_str($url["query"],$parameters);
    unset($parameters[$parameter]);
    $parameters[$parameter]=$parameterValue;
    return  $url["path"]."?".http_build_query($parameters);
}
