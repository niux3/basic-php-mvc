<?php
namespace src\core\libs\db\querybuilder;

use src\core\Exception;


class Where extends AbstractMethodsQueryBuilder{
    protected $conditions = [];

    
    public function __construct(){
        $params = current(func_get_args());
        $this->queryType = $params['type'];
        $this->conditions = $params['conditions'];
        $this->check();
    }

    protected function check(){
        if(in_array($this->queryType, ['INSERT'])){
            throw new Exception(sprintf('insert method not allowed : %s', $this->queryType), 500);
        }
    }

    public function __toString(){
        return is_array($this->conditions)? implode(') AND (', $this->conditions) : $this->conditions;
    }
}

