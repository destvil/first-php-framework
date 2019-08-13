<?php

function debug($arr, $die = false)
{
    echo '<pre>' . print_r($arr, true) . '</pre>';
    if($die) die;
}

function redirect($http = false) {
    if($http) {
        $redirect = $http;
    } else {
        $redirect = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : PATH;
    }
    header("Location: $redirect");
    exit;
}

function hsc($str) {
    return htmlspecialchars($str, ENT_QUOTES);
}

function logs($data) {
    $file_get = TMP . '/myLogs.txt';
    $fw = fopen($file_get, "a");
    fwrite($fw, date() . var_export($data, true));
    fclose($fw);
}
