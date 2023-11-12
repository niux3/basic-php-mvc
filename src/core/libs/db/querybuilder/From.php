<?php
namespace src\core\libs\db\querybuilder;

use src\core\Exception;


class From extends AbstractMethodsQueryBuilder{
    protected $tables = [];
    
    public function __construct(){
        $params = current(func_get_args());
        $this->queryType = $params['type'];
        $this->tables = $params['tables'];
        $this->check();
    }
    
    protected function check(){
        if(count($this->tables) === 0){
            throw new Exception('you must have only one table', 500);
        }

        if(count($this->tables) > 1 && $this->queryType == 'INSERT INTO'){
            throw new Exception('you must have one table on INSERT INTO', 500);
        }
    }

    public function __toString(){
        $isFrom = !preg_match('#UPDATE|INSERT INTO#', $this->queryType) ? 'FROM ': ''; 
        $tables = count($this->tables) > 1? implode(', ', $this->tables) : current($this->tables);
        return sprintf('%s%s', $isFrom, $tables);
    }
}

