<?php
namespace src\core\libs\db\querybuilder;

use src\core\Exception;


class QueryBuilder{

    private $strategy;

    protected $queryType;

    public function __construct($type){
        $this->queryType = new QueryType($type);
        $className = sprintf('src\core\libs\db\querybuilder\%sStrategy', ucwords(strtolower(current(explode(' ', $this->queryType))))); 
        $this->strategy = new $className($this->queryType);
    }

    public function __call($name, $args){
        if(!in_array($name, get_class_methods($this->strategy))){
            throw new Exception(sprintf("this method %s doesn't found", $name), 500);
        }
        $this->strategy->$name($args);
        return $this;
    }

    public function __toString(){
        return $this->strategy->execute();
    }
}
