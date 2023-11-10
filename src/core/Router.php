<?php
namespace src\core;


class Router{
    static function connect($url, $request){
        foreach(Configuration::get('routes') as $k => $v){
            if(in_array($_SERVER['REQUEST_METHOD'], $v->method)){
                if($v->url === $url){
                    list($action, $controller) = explode('@', $k);
                    $request->controller = $controller;
                    $request->action = $action;
                    $request->params = [];
                    break;
                }
                if(is_string(strstr($v->url, ':')) === true){
                    $pattern = $v->url;
                    foreach($v->params as $key => $value){
                        $pattern = str_replace($key, $value, $pattern);
                    }
                    if(preg_match_all('#'.$pattern.'#', $url, $matches)){
                        list($action, $controller) = explode('@', $k);
                        $request->controller = $controller;
                        $request->action = $action;
                        $request->params = array_map(function($e){ return current($e); },array_slice($matches, 1));
                        break;
                    }
                }
            }
        }
    }

    static function url($name, $params=[]){
        foreach(Configuration::get('routes') as $k => $v){
            if($k === $name){
                if(is_string(strstr($v->url, ':')) === true){
                    $output = $v->url;
                    foreach($params as $key => $value){
                        $pattern = '#('.$key.')#';
                        $output = preg_replace($pattern, $value, $output);
                    }
                    return $output;
                }else{
                    return $v->url;
                }
            }
        }
    }
}