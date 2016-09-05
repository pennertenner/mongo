<?php
/**
 * Created by PhpStorm.
 * User: Hendrik
 * Date: 05.09.2016
 * Time: 12:19
 */
// includes
include_once 'classes/ConfigLoader.php';

// load config file
$cfg = new ConfigLoader("config/mongo.ini");

// connect to mongo server
$mClient = new MongoClient("mongodb://".$cfg->getValue("ServerConnection", "ip").":".$cfg->getValue("ServerConnection", "port"));

// connect to mongo db
$db = new MongoDB($mClient, $cfg->getValue("ServerConnection", "db"));

$list = $db->listCollections();
echo "Anzahl Collections: " . count($list) . "<br>";
foreach ($list as $collection) {
    echo "Collection: " . $collection ."<br>";
    foreach($collection->find() as $cur) {
        var_dump($cur);
    }
}
