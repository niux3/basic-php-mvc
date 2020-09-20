<?php
    namespace apps\core\libs\db;

    class Sqlite extends DB{
        public function __construct($params){
            $pathToDatabase = APPS.$params['path'];
            if(file_exists($pathToDatabase)){
                $args = [
                    'dns'       => sprintf('sqlite:%s', $pathToDatabase),
                    'user'      => null,
                    'password'  => null
                ];
                parent::__construct($args);
            }
        }
    }
