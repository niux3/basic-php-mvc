<?php
namespace src\controller;

use src\core\Controller;


class PagesController extends Controller{
    function __construct($request){
        parent::__construct($request);
        $this->Page = $this->loadModel('Page');
    }

    function index($name=""){
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
