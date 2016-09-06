<?php

/**
 * Created by PhpStorm.
 * User: Hendrik
 * Date: 06.09.2016
 * Time: 10:46
 */
class GetCollections extends \classes\Base {
    public static function run() {
        $db = self::getMongoDb();

        $list = $db->listCollections();
        $collArray = array();
        foreach ($list as $collection)
            $collArray[] = $collection->getName();

        return json_encode($collArray);
    }
}