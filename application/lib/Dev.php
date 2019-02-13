<?php

ini_set('display_errors', 1);
//Показывать ошибки
error_reporting(E_ALL);
//Выводить все ошибки, включая нотификейшны

function debug($str) {
    echo '<pre>';
    var_dump($str);
    echo '</pre>';
    exit;
}
?>