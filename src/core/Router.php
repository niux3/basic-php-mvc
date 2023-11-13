<?php
namespace src\core;


class Router{
    static function connect($url, $request){
        foreach(Configuration::get('routes') as $k => $v){
            if(in_array($_SERVER['REQUEST_METHOD'], $v->method)){
                $v->url = $v->url[0] !== '/'? sprintf('/%s', $v->url) : $v->url;
                if($v->url === $url){
                    list($action, $controller) = explode('@', $k);
                    $request->controller = $controller;
                    $request->action = $action;
                    $request->params = [];
                    return true;
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
                        return true;
                    }
                }
            }
        }
        throw new Exception(sprintf('route not found : %s', $url), 404);
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
