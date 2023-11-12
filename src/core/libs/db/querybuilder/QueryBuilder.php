<?php
namespace src\core\libs\db\querybuilder;


class QueryBuilder{

    private $strategy;

    protected $queryType;

    public function __construct($type){
        $this->queryType = new QueryType($type);
        $className = sprintf('src\core\libs\db\querybuilder\%sStrategy', ucwords(strtolower(current(explode(' ', $this->queryType))))); 
        $this->strategy = new $className($this->queryType);
    }

    public function __call($name, $args){
        $this->strategy->$name($args);
        return $this;
    }

    public function __toString(){
        return $this->strategy->execute();
    }
}
