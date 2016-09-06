<?php

/**
 * Created by PhpStorm.
 * User: Hendrik
 * Date: 06.09.2016
 * Time: 10:47
 */
abstract class Base {
    protected final function getMongoDb() {
        include_once '../classes/ConfigLoader.php';

        // load config file
        $cfg = new ConfigLoader("config/mongo.ini");

        // connect to mongo server
        $mClient = new MongoClient("mongodb://".$cfg->getValue("ServerConnection", "ip").":".$cfg->getValue("ServerConnection", "port"));

        // connect to mongo db
        $db = new MongoDB($mClient, $cfg->getValue("ServerConnection", "db"));

        return $db;
    }

    abstract static function run();
}