<?php 
    namespace src\core\libs\db;
    use src\core\Controller;

    class FactoryDB{
        private static $_instance = null;

        private function __construct(){}
        private function __clone(){}


        public static function initialize($params){
            if(is_null(self::$_instance)) {
                try{
                    switch(ucfirst(strtolower($params['driver']))){
                        case 'Sqlite':
                            self::$_instance = new Sqlite($params);
                            break;
                        case 'Mysql':
                            self::$_instance = new Mysql($params);
                            break;
                        default:
                            throw new \Exception("Could not find the driver");
                            break;
                    }
                }catch(\Exception $e){
                    if(DEBUG){
                        echo $e->getMessage();
                    }else{
                        header("HTTP/1.0 500 Internal Server Error");
                        $controller = new Controller(null);
                        $controller->render([], 'errors/500');
                    }
                    die;
                }
            }

            return self::$_instance;
        }
    }
