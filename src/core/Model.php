<?php
namespace src\core;


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
        $this->db = \src\core\libs\db\FactoryDB::initialize($this->params);
    }
}
