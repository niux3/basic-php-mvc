<?php
    define('ROOT', dirname(__FILE__));
    define('APPS', sprintf('%s/apps/', ROOT));
    define('STATICS', sprintf('%s/statics/', ROOT));
    try{
        require_once APPS.'core/Autoloader.php';

        $loader = new \apps\core\Autoloader();
        $loader->register();
        $loader->addNamespace('apps\core', APPS.'/core');
        $loader->addNamespace('apps\controller', APPS.'/controller');
        $loader->addNamespace('apps\model', APPS.'/model');
        
        $router = new \apps\core\Router();
        $router->executeRequest();
    }catch(Exception $e){
        echo $e->getMessage();
    }
