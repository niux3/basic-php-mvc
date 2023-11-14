<?php
namespace src\core;

use src\core\libs\db\FactoryDB;
use src\core\libs\db\querybuilder\QueryBuilder;

class Model{
    protected $db = null;

    private $configDB = [];

    protected $fields = [];

    function __construct(){
        $config = Configuration::get('default', 'database');
        $this->configDB = [
            'driver' => $config->driver,
            'path' => $config->path,
            'host' => $config->host,
            'database' => $config->database,
            'user' => $config->user,
            'password' => $config->password,
        ];
        $this->db = FactoryDB::initialize($this->configDB);
    }

    protected function query($type){
        return new QueryBuilder($type);
    }

    function save($data){
        $this->beforeSave($model);
        $fields = implode(', ', $this->fields);
        $fieldsValues = implode(', ', array_map(function($k){return ':'.$k;}, $this->fields));
        $q = $this->query('insert')->from($this->table)->select($fields)->values($fieldsValues);
        $result = $this->db->query($q, $this->prepareData($data));
        $this->afterSave($model);
        return $result;
    }
    
    private function prepareData($data){
        $d = [];
        foreach($data as $k => $v){
            $d[':'.$k] = $v;
        }
        return $d;
    }

    protected function beforeSave($model){
        return;
    } 

    protected function afterSave($model){
        return;
    }
}
