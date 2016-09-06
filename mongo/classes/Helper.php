<?php
/**
 * Created by PhpStorm.
 * User: Hendrik
 * Date: 06.09.2016
 * Time: 14:31
 */

namespace classes;


class Helper {
    public static function removeIdCol($data) {
        array_walk($data, function (&$v, $k) {
            unset($v["_id"]); // remove id value from array
        });
        return $data;
    }

    public static function loadConfig() {
        $path = realpath(dirname(__FILE__)) . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . "mongo.ini";
        $cfg = new \classes\ConfigLoader($path);
        return $cfg;
    }
}