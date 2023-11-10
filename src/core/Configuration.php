<?php
namespace src\core;


class Configuration {
    static function get($file, $section=null) {
        $raw = file_get_contents(sprintf('%s/configuration/%s.json', SRC, $file));
        $config = json_decode($raw, false);
        return !is_null($section)? $config->$section : $config;
    }
}
