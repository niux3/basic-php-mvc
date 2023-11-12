<?php
namespace src\controller;

use src\core\Controller;
use src\core\libs\db\querybuilder\QueryBuilder;


class PagesController extends Controller{
    function __construct($request){
        parent::__construct($request);
        $this->Page = $this->loadModel('Page');
    }

    function index($name=""){
        $q = new QueryBuilder('insert');
        echo $q->from('table')->select('id', 'name')->values(':id', ':name');
        $this->render([
            'rows' => $this->Page->fetchAll(),
        ]);
    }

    function show($id){
        $this->render([
            'row' => current($this->Page->fetch($id))
        ]);
    }
}
