<?php
    namespace apps\controller;
    use apps\core\Controller;
    class PageController extends Controller{

        function index(){
            $this->render(['test' => 'bla']);
        }


        function show(){
            $this->render(['test2' => 'bla']);
        }
    }
