<?php
try{
    define('ROOT', dirname(dirname(__FILE__)));
    define('SRC', sprintf('%s/src/', ROOT));
    define('STATICS', sprintf('%s/statics', ROOT));
    define('BASE_URL', dirname(dirname($_SERVER['SCRIPT_NAME'])));
    define('IS_LOCAL', strstr($_SERVER['HTTP_HOST'], 'localhost') == true ? 1 : 0);
    define('DEBUG', IS_LOCAL? true : false);

    ini_set('display_errors', IS_LOCAL);
    ini_set('display_startup_errors', IS_LOCAL);
    //error_reporting(DEBUG ? E_ALL : E_STRICT);
    error_reporting(E_ALL & ~E_NOTICE);

    require_once SRC.'core/Autoloader.php';

    $loader = new \src\core\Autoloader();
    $loader->register();
    $namespaces = [
        'src\core\libs\db' => SRC.'core/libs/db/',
        'src\core' => SRC.'core/',
        'src\controller' => SRC.'controller/',
        'src\model' => SRC.'model/',
    ];
    foreach($namespaces as $namespace => $path){
        $loader->addNamespace($namespace, $path);
    }

    $dispatcher = new \src\core\Dispatcher();
}catch(Exception $e){
    echo $e->getMessage();
}
