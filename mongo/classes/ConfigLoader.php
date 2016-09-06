<?php

/**
 * Created by PhpStorm.
 * User: Hendrik
 * Date: 05.09.2016
 * Time: 12:53
 */
namespace classes;

class ConfigLoader {
    private $config;

    public function __construct($configFile) {
        $this->config = parse_ini_file($configFile, TRUE);
    }

    public function getConfig() {
        return $this->config;
    }

    public function getGroup($group) {
        if(array_key_exists($group, $this->config))
            return $this->config[$group];

        return false;
    }

    public function getValue($group, $attribute) {
        $gr = $this->getGroup($group);
        if($gr===false) return false;

        if(array_key_exists($attribute, $gr))
            return $gr[$attribute];
        return false;
    }
}