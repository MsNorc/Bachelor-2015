<?php

if(!isset($_SESSION)){
    session_start();
}

class App {

    protected $controller = 'home';
    protected $method = 'index';
    protected $params = [];

    public function __construct() {
        $url = $this->parseURL();

        //print_r($url);

        //echo dirname(__FILE__);
        if (file_exists('../app/controllers/' . $url[0] . '.php')) {
            $this->controller = $url[0];
            unset($url[0]);
        }
       
        require_once '../app/controllers/' . $this->controller . '.php';
        
        //echo $this->controller;
        //main layout
        require_once 'language/switch_language.php';
        //require_once 'layout/header.php';
        //require_once 'layout/loginTest.php';
        //require_once 'layout/dropdown_layout.php';
        //require_once 'db/mysqli_connect.php';
        //require_once '../app/public/dummy_layout.css';

        $this->controller = new $this->controller;

        if (isset($url[1])) {
            if (method_exists($this->controller, $url[1])) {
                $this->method = $url[1];
                unset($url[1]);
            }
        }


        $this->params = $url ? array_values($url) : [];
        //print_r($url);
        call_user_func_array([$this->controller, $this->method], $this->params);


        //main layout part 2
        //require_once 'layout/footer.php';
    }


    public function parseURL() {
        if (isset($_GET['url'])) {
            return $url = explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
        }
    }

}
