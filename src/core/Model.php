<?php
namespace src\core;

use src\core\libs\db\FactoryDB;

abstract class Model{
    protected $db = null;

    private $params = [];

    function __construct(){
        $config = Configuration::get('default', 'database');
        $this->params = [
            'driver' => $config->driver,
            'path' => $config->path,
            'host' => $config->host,
            'database' => $config->database,
            'user' => $config->user,
            'password' => $config->password,
        ];
        $this->db = FactoryDB::initialize($this->params);
    }
}
