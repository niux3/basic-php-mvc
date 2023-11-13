<?php
namespace src\core\libs\db\querybuilder;

use src\core\Exception;


class Set extends AbstractMethodsQueryBuilder{
    protected $expression = [];

    
    public function __construct(){
        $params = current(func_get_args());
        $this->queryType = $params['type'];
        $this->expression = $params['expression'];
        $this->check();
    }

    protected function check(){
        if(!in_array($this->queryType, ['UPDATE'])){
            throw new Exception(sprintf('set method not allowed : %s', $this->queryType), 500);
        }
    }

    public function __toString(){
        return is_array($this->expression)? implode(', ', $this->expression) : $this->expression;
    }
}

