<?php
    namespace src\core\libs\db;

    class Sqlite extends DB{
        public function __construct($params){
            $pathToDatabase = SRC.$params['path'];
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
