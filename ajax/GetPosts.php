<?php

/**
 * Created by PhpStorm.
 * User: Hendrik
 * Date: 06.09.2016
 * Time: 14:09
 */
class GetPosts extends \classes\Base{
    public static function run() {
        $collection = self::getPostsCollection();
        $cursor = $collection->find();

        $data = array_values(iterator_to_array($cursor));
        array_walk($data, function (&$v, $k) {
            unset($v["_id"]); // remove id value from array
        });

        return json_encode($data);
    }
}