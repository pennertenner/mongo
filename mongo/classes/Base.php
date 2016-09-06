<?php

/**
 * Created by PhpStorm.
 * User: Hendrik
 * Date: 06.09.2016
 * Time: 10:47
 */
namespace classes;

abstract class Base {
    protected final function getMongoDb() {
        // load config file
        $path = realpath(dirname(__FILE__)) . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . "mongo.ini";
        $cfg = new \classes\ConfigLoader($path);

        // connect to mongo server
        $mClient = new \MongoClient("mongodb://".$cfg->getValue("ServerConnection", "ip").":".$cfg->getValue("ServerConnection", "port"));

        // connect to mongo db
        $db = new \MongoDB($mClient, $cfg->getValue("ServerConnection", "db"));
        return $db;
    }

    protected final function getPostsCollection() {
        // load config file
        $path = realpath(dirname(__FILE__)) . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . "mongo.ini";
        $cfg = new \classes\ConfigLoader($path);

        $db = self::getMongoDb();
        return $db->selectCollection($cfg->getValue("Collections", "collection")[1]);
    }

    /**
     * @return JSON-String
     */
    abstract static function run();
}