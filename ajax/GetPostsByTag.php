<?php

/**
 * Created by PhpStorm.
 * User: Hendrik
 * Date: 06.09.2016
 * Time: 14:29
 */
class GetPostsByTag extends \classes\Base {
    public static function run() {
        // get searched tag
        $tag = $_GET['tag'];

        // get config
        $cfg = \classes\Helper::loadConfig();

        $collection = self::getPostsCollection();
        $cursor = $collection->aggregate(array(
            array(
                '$match' => array(
                    $cfg->getValue("posts_Attributes", "tag") => new \MongoRegex('/'.$tag.'/i')
                )
            ),
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