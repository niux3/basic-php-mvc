<?php
namespace src\model;

use src\core\Model;


class Page extends Model{
    protected $table = 'pages';
    protected $primaryKey = 'id';

    function fetchAll(){
        $sql = "SELECT * FROM ".$this->table;
        return $this->db->query($sql)->fetch();
    }

    function fetch($id){
        $sql = "select * from pages where id=:id";
        return $this->db->query($sql, [':id' => $id])->fetch();
    }

    function save($data){
        $keys = array_keys($data);
        $q = $this->query('insert')
            ->from($this->table)
            ->select(implode(', ', $keys))
            ->values(implode(', ', array_map(function($e){return ':'.$e;}, $keys)));
        $d = [];
        foreach($data as $k => $v){
            $d[':'.$k] = $v;
        }
        return $this->db->query($q, $d);
    }
}
    
