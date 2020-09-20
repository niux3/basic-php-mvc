<?php 
    namespace apps\core\libs\db;

    class FactoryDB{
        private static $_instance = null;

        private function __construct(){}
        private function __clone(){}


        public static function initialize($params){
            if(is_null(self::$_instance)) {
                switch(ucfirst(strtolower($params['driver']))){
                    case 'Sqlite':
                        self::$_instance = new Sqlite($params);
                        break;
                    case 'Mysql':
                        self::$_instance = new Mysql($params);
                        break;
                    default:
                        throw new Exception("Could not find the driver");
                        break;
                }
            }

            return self::$_instance;
        }
    }