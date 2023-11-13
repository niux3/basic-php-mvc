<?php
namespace src\core;


class Controller{
    private $request;
    private $data;
    function __construct($request=null){
        $this->request = $request;
    }

    function render($data=[], $template=""){
        $directory = strtolower($this->request->controller);
        $viewFile = $this->request->action;

        if(!empty(trim($template))){
            if(is_string(strstr($template, '/')) === true){
                list($directory, $viewFile) = explode('/', trim($template, '/'));
            }else{
                $viewFile = $template;
            }
        }

        $view = new View($directory, str_replace('.php', '', $viewFile));
        $view->render($data);
    }


    protected function loadModel($modelName){
        if(!file_exists(sprintf('%s/model/%s.php', SRC, $modelName))){
            throw new Exception(sprintf('impossible chargement model : %s.php', $modelName), 500);
        }
        $classModel = sprintf('src\model\%s', $modelName);
        return new $classModel();
    }
}
