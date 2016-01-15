<?php

if (!isset($_SESSION)) {
    session_start();
}

class Controller {

    public function model($model) {
        require_once '../app/models/' . $model . '.php';
        return new $model();
    }

    public function view($view, $data = array()) {
        //echo "<br>this is view : " . $view . "<br>";
        require_once '../app/views/' . $view . '.php';
    }

}
