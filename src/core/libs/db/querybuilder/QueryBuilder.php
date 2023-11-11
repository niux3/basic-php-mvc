<?php
namespace src\core\libs\db\querybuilder;


class QueryBuilder{

    protected $select;

    protected $from;
    
    protected $where;
    
    protected $group;
    
    protected $limit;
    
    protected $order;

    protected $row = [];

    protected $queryType;

    public function __construct($type){
        $this->queryType = new QueryType($type);
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
        $this->row[] = $this->select;
        $this->row[] = $this->from;

        return implode(" ", $this->row);

    }
}

