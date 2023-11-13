<?php
namespace src\core\libs\db\querybuilder;

use src\core\Exception;


class DeleteStrategy extends AbstractStrategy{
    protected $where = [];

    public function where(){
        $this->where[] = new Where([
            'conditions' => current(func_get_args()),
            'type' => $this->queryType
        ]);
    }

    protected function orderRow(){
        $row = [];
        $row[] = $this->from;
        $row[] = 'WHERE';
        $row[] = sprintf('(%s)', implode(') AND (', $this->where));
        return $row;
    }
}