<?php
    namespace apps\controller;
    use apps\core\Controller;


    class PageController extends Controller{
        public function __construct(){
            $this->Page = $this->loadModel('Page');
        }


        function index(){
            $context = [
                'articles' => $this->Page->findall()
            ];
            $this->render($context);
        }


        function show(){
            $this->render(['test2' => 'bla']);
        }
    }
