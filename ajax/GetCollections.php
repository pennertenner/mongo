<?php

/**
 * Created by PhpStorm.
 * User: Hendrik
 * Date: 06.09.2016
 * Time: 10:46
 */
class GetCollections extends Base {
    public static function run() {
        $db = self::getMongoDb();
        return json_encode($db->listCollections());
    }
}