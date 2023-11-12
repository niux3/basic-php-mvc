<?php
namespace src\core\libs\db\querybuilder;

use src\core\Exception;


class InsertStrategy extends AbstractStrategy{

    protected $select;

    protected $values = [];

    public function select(){
        $this->select = new Select([
            'fields' => current(func_get_args()),
            'type' => $this->queryType
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
                if($v !== substr($paramValue, 1)){
                    throw new Exception('The list is different between select method and values method', 500);
                }
            }
        }
        return $value;
    }

    protected function orderRow(){
        $row = [];
        $row[] = $this->from;
        $row[] = is_null($this->select) ? '' : sprintf('(%s)', $this->select);
        $row[] = implode(', ', $this->values);
        return $row;
    }
}