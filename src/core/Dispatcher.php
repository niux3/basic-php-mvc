<?php
namespace src\core;


class Dispatcher{
    private $request;

    function __construct(){
        try{
            $this->request = new Request();
            Router::connect($this->request->getUrl(), $this->request);

            if(!file_exists(sprintf('%s/controller/%sController.php', SRC, ucfirst($this->request->controller)))){
                throw new \Exception(sprintf('file not found : %sController.php', $this->request->controller));
            }

            $controller = $this->loadController();
            if(!in_array($this->request->action, get_class_methods($controller))){
                throw new \Exception(sprintf('method not found : %s', $this->request->action));
            }
            call_user_func_array([$controller, $this->request->action], $this->request->params);
        }catch(\Exception $e){
            header('HTTP/1.0 404 Not Found');
            if(DEBUG){
                echo $e->getMessage();
            }else{
                $controller = new Controller();
                $controller->render([], 'errors/404');
            }
            die;
        }
    }

    function loadController(){
        $name = sprintf('\src\controller\%sController', ucfirst($this->request->controller));
        return new $name($this->request);
    }
}
