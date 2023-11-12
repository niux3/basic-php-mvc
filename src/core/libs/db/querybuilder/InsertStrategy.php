<?php
namespace src\core\libs\db\querybuilder;

use src\core\Exception;


class InsertStrategy implements IQueryBuilderStrategy{

    protected $from;

    protected $select;

    protected $values = [];

    protected $queryType;

    protected $row = [];

    public function __construct($type){
        $this->queryType = $type;
    }

    public function select(){
        $this->select = new Select([
            'fields' => current(func_get_args()),
            'type' => $this->queryType
        ]);
    }

    public function from(){
        $this->from = new From([
            "tables" => current(func_get_args()), 
            "type" => $this->queryType
        ]);
    }

    public function values(){
        $instance = new Values([
            'fields' => current(func_get_args()),
            'type' => $this->queryType
        ]);
        $this->values[] = $this->check($instance);
    }

    protected function check($value){
        if(!is_null($this->select)){
            $fieldsSelect = explode(', ', $this->select);
            $paramsValues = explode(', ', $value);
            if(count($paramsValues) !== count($fieldsSelect)){
                throw new Exception('count select must have the same count values', 500);
            }
            foreach($fieldsSelect as $k => $v){
                $paramValue = str_replace('VALUES(', '', str_replace(')', '', $paramsValues[$k]));
                if($paramValue[0] !== ':'){
                    throw new Exception('The values param must start with ":"', 500);
                }
                if($v !== substr($paramValue, 1)){
                    throw new Exception('The list is different between select method and values method', 500);
                }
            }
        }
        return $value;
    }

    public function execute(){
        $this->row[] = $this->queryType;
        $this->row[] = $this->from;
        $this->row[] = is_null($this->select) ? '' : sprintf('(%s)', $this->select);
        $this->row[] = implode(', ', $this->values);
        $this->row[] = ';';
            
        return implode(' ', $this->row);
    }
}