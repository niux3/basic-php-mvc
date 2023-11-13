<?php
    namespace src\core;

    class Request{
        private $url;

        public $controller;
        public $action;
        public $params;

        function __construct(){
            $this->url = $_SERVER['PATH_INFO'];
            if(empty($_SERVER['PATH_INFO'])){
                $this->url = '/';
            }
        }


        function getUrl(){
            return $this->url;
        }
    }
