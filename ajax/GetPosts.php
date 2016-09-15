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
        $cursor = $collection->aggregate(array(
            array(
                '$lookup' => array(
                    "from" => "user",
                    "localField" => "uid",
                    "foreignField" => "name",
                    "as" => "user"
                )
            ),
            array(
                '$limit' => 100
            ),
            array(
                '$sort' => array(
                    "date" => -1
                )
            )
        ));

        $data = $cursor["result"];
        $data = \classes\Helper::removeIdCol($data);

        return json_encode($data);
    }
}