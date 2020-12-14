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

function addURLParameter($url, $paramName, $paramValue) {
    $url_data = parse_url($url);
    if(!isset($url_data["query"]))
        $url_data["query"]="";

    $params = array();
    parse_str($url_data['query'], $params);
    $params[$paramName] = $paramValue;   
    $url_data['query'] = http_build_query($params);
    return build_url($url_data);
}


function build_url($url_data) {
    $url="";
    if(isset($url_data['host']))
    {
        $url .= $url_data['scheme'] . '://';
        if (isset($url_data['user'])) {
            $url .= $url_data['user'];
                if (isset($url_data['pass'])) {
                    $url .= ':' . $url_data['pass'];
                }
            $url .= '@';
        }
        $url .= $url_data['host'];
        if (isset($url_data['port'])) {
            $url .= ':' . $url_data['port'];
        }
    }
    $url .= $url_data['path'];
    if (isset($url_data['query'])) {
        $url .= '?' . $url_data['query'];
    }
    if (isset($url_data['fragment'])) {
        $url .= '#' . $url_data['fragment'];
    }
    return $url;
}