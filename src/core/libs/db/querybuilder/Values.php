<?php
namespace src\core\libs\db\querybuilder;

use src\core\Exception;


class Values extends AbstractMethodsQueryBuilder{
    protected $fields = [];
    
    public function __construct(){
        $params = current(func_get_args());
        $this->queryType = $params['type'];
        $this->fields = $params['fields'];
        $this->check();
    }
    
    protected function check(){
        foreach($this->fields as $e){
            if(!strstr($e, ':')){
                throw new Exception(sprintf('fields (%s) must have a prefixe ":"', 500));
            }
        }
    }

    public function __toString(){
        return sprintf('VALUES(%s)', implode(', ', $this->fields));
    }
}

