<?php
//    error_reporting(0);
    //session_start();
    class App {

        protected $controller = 'Home';
        protected $method = 'index';
        protected $params = [];

        public function __construct() {
            $url = $this->parseUrl();

            if(file_exists('app/controllers/'.ucfirst($url[1]).'.php')){
                $this->controller=ucfirst($url[1]);
                unset($url[1]);
            }
            elseif ( !file_exists('app/controllers/'.ucfirst($url[1]).'.php') && $url[1] != '' )
                header('Location: http://localhost/404.php');

            require_once 'app/controllers/'.$this->controller.'.php';

            $this->controller = new $this->controller;
            $url2= isset($url[2]) ? $url[2] : '';
            if(isset($url2)) {
                if(method_exists($this->controller,$url2)){
                    $this->method = $url2;
                    unset($url[2]);
                }
                elseif (!method_exists($this->controller,$url2) && $url2 != '' && !(int)$url2)
                    header('Location: http://localhost/404.php');
            }
            $this->params = $url ? array_values($url) : [];
            call_user_func_array([$this->controller,$this->method],$this->params);
        }

//        public function parseUrl() {
//            if (isset($_GET['url'])) {
//                return explode('/', filter_var(
//                    rtrim($_GET['url'], '/'),
//                    FILTER_SANITIZE_STRING));
//            }
//        }

        public function parseUrl(){
            if(isset($_SERVER['REQUEST_URI'])) {
                return explode('/', filter_var(
                    $_SERVER['REQUEST_URI'],
                    FILTER_SANITIZE_STRING));
            }
        }


    }

