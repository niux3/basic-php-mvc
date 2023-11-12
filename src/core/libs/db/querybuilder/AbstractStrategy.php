<?php
namespace src\core\libs\db\querybuilder;


abstract class AbstractStrategy implements IQueryBuilderStrategy{
    protected $queryType;
    protected $from;
    protected $row = [];

    public function __construct($type){
        $this->queryType = $type;
    }

    public function from(){
        $this->from = new From([
            "tables" => current(func_get_args()), 
            "type" => $this->queryType
        ]);
    }

    public function execute(){
        $this->row[] = $this->queryType;
        $this->row[] = implode(' ', $this->orderRow());
        $this->row[] = ';';
            
        return implode(' ', $this->row);
    }

    abstract protected function orderRow();
}