<?php

/**
 * Created by PhpStorm.
 * User: Hendrik
 * Date: 07.09.2016
 * Time: 14:45
 */
class GetPostsByContent extends \classes\Base
{
    public static function run() {
        // get searched tag
        $content = $_GET['content'];

        // get config
        $cfg = \classes\Helper::loadConfig();

        $collection = self::getPostsCollection();
        $cursor = $collection->find(array($cfg->getValue("posts_Attributes", "content") => new \MongoRegex('/'.$content.'/i'))); // find tag case insensitiv

        $data = array_values(iterator_to_array($cursor));
        $data = \classes\Helper::removeIdCol($data);

        return json_encode($data);
    }
}