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
        'src\core\libs\db\querybuilder' => SRC.'core/libs/db/querybuilder/',
        'src\core' => SRC.'core/',
        'src\controller' => SRC.'controller/',
        'src\model' => SRC.'model/',
    ];
    foreach($namespaces as $namespace => $path){
        $loader->addNamespace($namespace, $path);
    }
    $dispatcher = new \src\core\Dispatcher();
    die;
}catch(\src\core\Exception $e){
    $e->getError();
}catch(\Throwable $th){
    header("HTTP/1.0 500 Internal Server Error");
    if(DEBUG){
        $mask = '
            <h1>Exception error</h1>
            <ul>
                <li><strong>code error</strong> : %s</li>
                <li><strong>file</strong> : %s</li>
                <li><strong>line</strong> : %s<br><br></li>
                <li><strong>message</strong> : %s<br><br></li>
            </ul>
        ';
        $args = [
            $th->getCode(), 
            $th->getFile(),
            $th->getLine(),
            $th->getMessage(),
        ];
        vprintf($mask, $args);
    }else{
        $ctrl = new \src\core\Controller();
        $ctrl->render([], 'errors/500');
    }
    die;
    echo '<pre>';
    var_dump($th);
    echo '</pre>';
}
