<?php
/**
 * Created by PhpStorm.
 * User: Arafeh
 * Date: 7/30/2019
 * Time: 1:09 PM
 */

$errors = [];

function get($key, $def = false)
{
    if (isset($_GET[$key])) {
        return $key;
    }
    return $def;
}

function post($key = null, $def = false)
{
    if ($key === null) {
        return $_POST;
    }
    if (isset($_POST[$key])) {
        return $_POST[$key];
    }
    return $def;
}

function url($page, $params = [])
{
    $result = "index.php?r=$page";
    foreach ($params as $key => $val) {
        $result .= "&" . $key . "=" . $val;
    }
    return $result;
}

function error($error)
{
    $GLOBALS['errors'][] = $error;
}

function errors()
{
    return $GLOBALS['errors'];
}


function session($key = null, $val = null)
{
    if ($key === null) {
        return $_SESSION;
    }
    if ($val === null) {
        return isset($_SESSION[$key]) ? $_SESSION[$key] : null;
    } else {
        $_SESSION[$key] = $val;
        return $val;
    }
}

function charge($minQ)
{
    switch (strtolower($minQ)) {
        case 's':
            return 10;
        case 'a':
            return 8;
        case 'b':
            return 6;
        case 'c':
            return 4;
        case 'd':
            return 2;
        default:
            return 1;
    }
}

function alert($content, $type = "alert-danger", $style = 'style=""')
{
    echo <<<html
<div class="alert $type" role="alert" $style>
$content
</div>
html;
}