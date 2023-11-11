<?php
namespace src\core;


class Configuration {
    static function get($file, $section=null) {
        $path = sprintf('%s/configuration/%s.json', SRC, $file);
        if(!file_exists($path)){
            throw new Exception(sprintf('configuration file not found : %s', $path), 500);
        }

        $raw = file_get_contents($path);
        $config = json_decode($raw, false);
        return !is_null($section)? $config->$section : $config;
    }
}
