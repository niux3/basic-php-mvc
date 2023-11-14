<?php
namespace src\core\libs\db\querybuilder;

class SelectStrategy extends AbstractStrategy{
    
    protected $select;
    protected $where = [];

    public function select(){
        $this->select = new Select([
            'fields' => current(func_get_args()),
            'type' => $this->queryType
        ]);
    }

    public function where(){
        $this->where[] = new Where([
            'conditions' => current(func_get_args()),
            'type' => $this->queryType
        ]);
    }

    protected function orderRow(){
        $row = [];
        $row[] = is_null($this->select) ? '' : sprintf('%s', $this->select);
        $row[] = $this->from;
        $row[] = 'WHERE';
        $row[] = sprintf('(%s)', implode(') AND (', $this->where));
        return $row;
    }
}