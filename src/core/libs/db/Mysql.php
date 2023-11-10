<?php
    namespace src\core\libs\db;

    class Mysql extends DB{
        public function __construct($params){
            $args = [
                'dns'       => sprintf('mysql:host=%s;dbname=%s;charset=utf8', $params['host'], $params['database']),
                'user'      => $params['user'],
                'password'  => $params['password']
            ];
            parent::__construct($args);//, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")
        }
    }
