<?php
/**
 * Created by PhpStorm.
 * User: Hendrik
 * Date: 06.09.2016
 * Time: 10:43
 */

$function = $_POST['action'];

if(file_exists('ajax/' . $function . '.php')) {
    include_once 'ajax/' . $function . '.php';
    $function::run();
}
else {
    die("-1");
}