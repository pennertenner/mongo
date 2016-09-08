<?php

/**
 * Created by PhpStorm.
 * User: Hendrik
 * Date: 08.09.2016
 * Time: 14:11
 */
class CreatePost extends \classes\Base {
    public static function run() {
        // get data to insert
        $name = $_POST['name'];
        $content = $_POST['content'];
        $tags = explode(",",$_POST['tags']);

        array_walk($tags, function($v, $k) {
            trim($v);
        });


        // get config
        $cfg = \classes\Helper::loadConfig();

        $collection = self::getPostsCollection();
        $success = $collection->insert(array(
            $cfg->getValue("posts_Attributes", "content") => $content,
            $cfg->getValue("posts_Attributes", "tag") => $tags,
            $cfg->getValue("posts_Attributes", "uid") => $name,
            $cfg->getValue("posts_Attributes", "timestamp") => time()
        ));



        return json_encode($success);
    }
}