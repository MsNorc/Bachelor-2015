<?php

if(!isset($_SESSION)){
    session_start();
}

class App {

    protected $controller = 'home';
    protected $method = 'index';
    //protected $params = []; //not working php 5.3, original code
    protected $params = array();

    public function __construct() {
        $url = $this->parseURL();

        if (file_exists('../app/controllers/' . $url[0] . '.php')) {
            $this->controller = $url[0];
            unset($url[0]);
        }
       
        require_once '../app/controllers/' . $this->controller . '.php';
        
        //universal language files
        require_once 'language/switch_language.php';

        $this->controller = new $this->controller;
        
        if (isset($url[1])) {
            if (method_exists($this->controller, $url[1])) {
                $this->method = $url[1];
                //echo "second url: " . $url[1] . "<br>";
                unset($url[1]);
            }
        }
        
        //php 5.3 fix
        $ctrlMethod = array();
        array_push($ctrlMethod, $this->controller, $this->method);
        /*print_r($ctrlMethod);
        echo "ctrl <br>";*/
      
        //just empty array php 5.3 workaround
        $empty = array();
        ($this->params = $url ? array_values($url) : $empty);

        call_user_func_array($ctrlMethod, $this->params); //php 5.3
        //call_user_func_array([$this->controller, $this->method], $this->params);
        
    }
    
    public function parseURL() {
        if (isset($_GET['url'])) {
            return $url = explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
        }
    }

}
