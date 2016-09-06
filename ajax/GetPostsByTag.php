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
        $cursor = $collection->find(array($cfg->getValue("posts_Attributes", "tag") => new \MongoRegex('/'.$tag.'/i'))); // find tag case insensitiv

        $data = array_values(iterator_to_array($cursor));
        $data = \classes\Helper::removeIdCol($data);

        return json_encode($data);
    }
}