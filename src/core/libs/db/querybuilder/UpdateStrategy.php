<?php
namespace src\core\libs\db\querybuilder;

use src\core\Exception;


class UpdateStrategy extends AbstractStrategy{
    protected $where = [];
    protected $set = [];

    public function where(){
        $this->where[] = new Where([
            'conditions' => current(func_get_args()),
            'type' => $this->queryType
        ]);
    }

    public function set(){
        $this->set[] = new Set([
            'expression' => current(func_get_args()),
            'type' => $this->queryType
        ]);
    }

    protected function orderRow(){
        $row = [];
        $row[] = $this->from;
        $row[] = 'SET';
        $row[] = sprintf('%s', implode(', ', $this->set));
        $row[] = 'WHERE';
        $row[] = sprintf('(%s)', implode(') AND (', $this->where));
        return $row;
    }
}