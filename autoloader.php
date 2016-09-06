<?php
/**
 * Created by PhpStorm.
 * User: Hendrik
 * Date: 06.09.2016
 * Time: 10:56
 */

spl_autoload_register( 'mongo_autoloader' );
function mongo_autoloader( $class_name ) {
    $classes_dir = realpath( dirname( __FILE__ ) ) . DIRECTORY_SEPARATOR . 'mongo' . DIRECTORY_SEPARATOR;
    $class_file = str_replace( '\\', DIRECTORY_SEPARATOR, $class_name ) . '.php';
    require_once $classes_dir . $class_file;
}