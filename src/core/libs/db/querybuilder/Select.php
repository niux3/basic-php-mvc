<?php
namespace src\core\libs\db\querybuilder;

use src\core\Exception;


class Select{
    protected $fields = [];
    protected $queryType;

    
    public function __construct(){
        $params = current(func_get_args());
        $this->queryType = $params['type'];
        $this->fields = $params['fields'];
        $this->check();
    }

    private function check(){
        if(in_array($this->queryType, ['UPDATE', 'DELETE'])){
            throw new Exception(sprintf('select method not allowed : %s', $this->queryType), 500);
        }
        $this->fields = current($this->fields) === '*' || count($this->fields) === 0? '*' : $this->fields;
        if(in_array($this->queryType, ['UPDATE', 'DELETE', 'INSERT INTO']) && $this->fields === '*'){
            throw new Exception(sprintf("can't accept * (everything) with this type : %s", $this->queryType), 500);
        }
    }

    public function __toString(){
        return is_array($this->fields)? implode(', ', $this->fields) : $this->fields;
    }
}

