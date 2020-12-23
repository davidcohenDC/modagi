<?php

/**
 * Funzione per pagine user-only!
 */
function isUserLoggedIn()
{
    return !empty($_SESSION['id']);
}

function isUserVendor()
{
    return isUserLoggedIn() && $_SESSION['isVendor'] == 'S';
}

function isArticleSet($formParams, $post)
{
    $check = false;

    foreach ($formParams["categories"] as $category) {
        if (isset($post["category-" . $category["id"]]) && $post["category-" . $category["id"]] != "") {
            $check = true;
        }
    }

    if (!$check) {
        return false;
    }

    $check = false;

    foreach ($formParams["sizes"] as $size) {
        if (isset($post["size-" . $size["id"]]) && $post["size-" . $size["id"]] != "") {
            $check = true;
        }
    }

    return $check &&
        isset($post["name"]) &&
        isset($post["description"]) &&
        isset($post["material"]) &&
        isset($post["brand"]) &&
        isset($post["color"]) &&
        isset($post["gender"]) &&
        isset($post["price"]);
}

function uploadImage($path, $image, $name)
{
    $imageName = basename($image["name"]);
    $extension = end(explode(".", $image["name"]));

    $fullPath = $path . $imageName;

    $maxKB = 500;
    $acceptedExtensions = array("jpg", "jpeg", "png", "gif");

    $result = false;
    $msg = "";

    //Controllo se immagine è veramente un'immagine
    $imageSize = getimagesize($image["tmp_name"]);
    if ($imageSize === false) {
        $msg .= "File caricato non è un'immagine! ";
    }
    //Controllo dimensione dell'immagine < 500KB
    if ($image["size"] > $maxKB * 1024) {
        $msg .= "File caricato pesa troppo! Dimensione massima è $maxKB KB. ";
    }

    //Controllo estensione del file
    $imageFileType = strtolower(pathinfo($fullPath, PATHINFO_EXTENSION));
    if (!in_array($imageFileType, $acceptedExtensions)) {
        $msg .= "Accettate solo le seguenti estensioni: " . implode(",", $acceptedExtensions);
    }

    //Controllo se esiste file con stesso nome ed eventualmente lo rinomino
    if (file_exists($fullPath)) {
        $msg .= "File $fullPath esiste già";
    }

    //Se non ci sono errori, sposto il file dalla posizione temporanea alla cartella di destinazione
    if (strlen($msg) == 0) {
        if (!move_uploaded_file($image["tmp_name"], $fullPath)) {
            $msg .= "Errore nel caricamento dell'immagine.";
        } else {
            $result = true;
            $msg = $imageName;
        }
    }

    rename($fullPath, $path . $name . "." . $extension);

    return array($result, $msg);
}


function logOut()
{
    if (isUserLoggedIn()) {
        unset($_SESSION['id']);
        unset($_SESSION['username']);
        unset($_SESSION['isVendor']);
    }
}

function removeParam($url, $param)
{
    $url = preg_replace('/(&|\?)' . preg_quote($param) . '=[^&]*$/', '', $url);
    $url = preg_replace('/(&|\?)' . preg_quote($param) . '=[^&]*&/', '$1', $url);
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

function addUrlParameters($url, $paramName, $paramValue)
{

    if (isset($_GET["pag"])) {
        $url = removeParam($url, "pag");
    }

    if (isset($_GET["filter"])) {
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

        //before filter find a possbile new selection

        if (isset($_GET["taglia"])) {
            $selection = "SELECT * FROM prodottitaglie PT LEFT JOIN prodotto P ON PT.idProdotto = P.id WHERE PT.idTaglia = " . $_GET["taglia"];
            $count++;
        }


        foreach ($result as $name => $value) {

            if ($name == "pag" || $name == "filter" || $name == "taglia") {
                //nothing
            } else if ($name == "genere" && $value == 3) {
                if ($count >= 1) {
                    $filter =  $filter . " AND id" . $name . " IN (1,2,3)";
                } else {
                    $filter = $filter . " WHERE id" . $name . " IN (1,2,3)";
                }

                $count++;
            } else if ($name == "prezzo") {
                if ($count >= 1) {
                    $filter =  $filter . " AND " . $name . " >= " . $value;
                } else {
                    $filter = $filter . " WHERE " . $name . " >= " . $value;
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

        //after filtering select the order
        if (isset($_GET["filter"])) {
            switch ($_GET["filter"]) {
                case 'ultimi_arrivi':
                    $filter = $filter . " ORDER BY id DESC";
                    break;
                case 'prezzo_crescente':
                    $filter = $filter . " ORDER BY prezzo ASC";
                    break;
                case 'prezzo_decrescente':
                    $filter = $filter . " ORDER BY prezzo DESC";
                    break;
            }
        }

        $selection = $selection . $filter;
        return $selection;
    }
}

function getProductPromotion($dir)
{

    $promotions = array();
    foreach (scandir($dir) as $img) {
        if (!is_dir($img)) {
            
            $img = str_replace("promo_", '', $img);
            $img = substr($img, 0, strrpos($img, "."));
            array_push($promotions, $img);
        }
    }

    return $promotions;
}

function getPromotionsUrl($dir)
{
    $promotions = array();
    foreach (scandir($dir) as $img) {
        if (!is_dir($img)) {
            $img = $dir . $img;
            array_push($promotions, $img);
        }
    }
    return $promotions;
}
