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
        $q = new QueryBuilder('delete');
        echo $q->from('tables')->where('id = :id OR name = :name', 'city = :city')->where('firstname = :firstname');
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
