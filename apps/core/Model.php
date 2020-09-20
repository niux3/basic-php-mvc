<?php 
    namespace apps\core;

    class Model{

        public $db = null;

        public function __construct(){
            $params = [
                'driver' => Configuration::get('driver'),
                'path' => Configuration::get('path'),
                'host' => Configuration::get('host'),
                'database' => Configuration::get('database'),
                'user' => Configuration::get('user'),
                'password' => Configuration::get('password'),
            ];

            $this->db = \apps\core\libs\db\FactoryDB::initialize($params);
        }
    }