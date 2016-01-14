<?php

if(!isset($_SESSION)){
    session_start();
}
//session_start();

class Home extends Controller {

    public function index() {

        $this->view('layout/header');
        $this->view('home/index');
    }
    
    public function login(){
        $this->view('layout/header');
        $this->view('layout/dropdown');
        $this->view('home/index');
    }

    public function logout() {
        $this->view('layout/header');
        $this->view('logout');
    }

}


