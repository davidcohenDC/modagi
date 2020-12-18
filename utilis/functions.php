<?php

/**
 * Funzione per pagine user-only!
 */
function isUserLoggedIn()
{
    return !empty($_SESSION['username']);
}

function isUserVendor()
{
    return !empty($_SESSION['isVendor']) && $_SESSION['isVendor'] == 'S';
}

function logOut()
{
    if (isUserLoggedIn()) {
        unset($_SESSION['username']);
        unset($_SESSION['isVendor']);
    }
}

function removeParam($url, $param) {
    $url = preg_replace('/(&|\?)'.preg_quote($param).'=[^&]*$/', '', $url);
    $url = preg_replace('/(&|\?)'.preg_quote($param).'=[^&]*&/', '$1', $url);
    return $url;
}

function change_url_parameter($url, $parameter, $parameterValue)
{
    $url = parse_url($url);
    parse_str($url["query"], $parameters);
    unset($parameters[$parameter]);
    $parameters[$parameter] = $parameterValue;
    return  $url["path"] . "?" . http_build_query($parameters);
}

function addURLParameter($url, $paramName, $paramValue)
{
    $url_data = parse_url($url);
    if (!isset($url_data["query"]))
        $url_data["query"] = "";

    $params = array();
    parse_str($url_data['query'], $params);
    $params[$paramName] = $paramValue;
    $url_data['query'] = http_build_query($params);
    return build_url($url_data);
}

function addUrlParameters($url, $paramName, $paramValue) {

    if(isset($_GET["pag"])) {
        $url = removeParam($url, "pag");
    } 

    if(isset($_GET["filter"])) {
        $url = removeParam($url, "filter");
    } 

    return addURLParameter($url, $paramName, $paramValue);
}

function removeqsvar($url, $varname)
{
    list($urlpart, $qspart) = array_pad(explode('?', $url), 2, '');
    parse_str($qspart, $qsvars);
    unset($qsvars[$varname]);
    $newqs = http_build_query($qsvars);
    return $urlpart . '?' . $newqs;
}


function build_url($url_data)
{
    $url = "";
    if (isset($url_data['host'])) {
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

/*
// Filter All table of product and binding into the corrispective query
*/
function bindProductUrlToQuery()
{
    //the main selection for prodotto with all corrispecti
    $selection = "SELECT * FROM prodotto ";
    $filter = "";
    $count = 0;

    if ($_SERVER["REQUEST_URI"] == "/") {
        return $selection;
    } else {
        $url = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        $query = parse_url($url);

        if (!isset($query["query"])) {
            return $selection;
        }

        $url = $query["query"];
        parse_str($url, $result);

        foreach ($result as $name => $value) {
            if ($name == "pag" || $name == "filter") {
                //nothing
            } else if ($name == "genere" && $value == 3) {
                if ($count >= 1) {
                    $filter =  $filter . " AND id" . $name . " IN (1,2,3)";
                } else {
                    $filter = $filter . " WHERE id" . $name . " IN (1,2,3)";
                }

                $count++;
            } else {
                if ($count >= 1) {
                    $filter =  $filter . " AND id" . $name . " = " . $value;
                } else {
                    $filter = $filter . " WHERE id" . $name . " = " . $value;
                }
                $count++;
            }
        }

        //select the filter
        if(isset($_GET["filter"])) {
            switch ($_GET["filter"]) {
              case 'last_product':
                $filter = $filter . " ORDER BY prodotto.id DESC";
                break;
              case 'price_ascending':
                $filter = $filter . " ORDER BY prodotto.prezzo ASC";
                break;
              case 'price_discending':
                $filter = $filter . " ORDER BY prodotto.prezzo DESC";
                break;    
            }
          } 

        $selection = $selection . $filter;
        return $selection;
    }
}