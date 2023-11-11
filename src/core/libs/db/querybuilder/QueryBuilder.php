<?php
namespace src\core\libs\db\querybuilder;


class QueryBuilder{

    private $strategy;

    protected $select;

    protected $from;
    
    protected $where;
    
    protected $group;
    
    protected $limit;
    
    protected $order;

    protected $row = [];

    protected $queryType;

    protected $params;

    public function __construct($type, $params=[]){
        $this->queryType = new QueryType($type);
        $this->params = $params;
        $className = sprintf('src\core\libs\db\querybuilder\%sStrategy', ucwords(strtolower(current(explode(' ', $this->queryType))))); 
        $this->setStrategy(new $className($this->queryType, $params));

        $this->strategy->execute();
    }


    protected function setStrategy($strategy){
        $this->strategy = $strategy;
    }


    public function select(){
        $this->select = new Select([
            "fields" => func_get_args(), 
            "type" => $this->queryType
        ]);
        return $this;
    }

    public function from(){
        $this->from = new From([
            "tables" => func_get_args(), 
            "type" => $this->queryType
        ]);
        return $this;
    }

    public function __toString(){
        $this->row[] = $this->queryType;
        return $this->strategy->execute();
    }
}

