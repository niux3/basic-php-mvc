<?php
namespace src\core\libs\db\querybuilder;
use src\core\Exception;


class QueryType{
    private $categories = ['SELECT', 'UPDATE', 'INSERT', 'DELETE'];
    protected $output;

    
    public function __construct($category){
        if(!in_array(strtoupper($category), $this->categories)){
            throw new Exception('please choice between select, update, delete, insert', 500);
        }
        $this->output = $category;
    }

    public function __toString(){
        if($this->output === 'insert'){
            $this->output = 'INSERT INTO';
        }

        return strtoupper($this->output);
    }
}

