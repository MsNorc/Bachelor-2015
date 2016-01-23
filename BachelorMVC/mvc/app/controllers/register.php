<?php

include "db/mysqli_connect.php";

class Register extends Controller {

    public function index() {
        $this->view('layout/header');
        $this->view('register/register_user_input');
    }

    public function user() {
        
        $this->view('register/register_user_input');
    }

    public function provider() {
        $this->view('layout/header');
        $this->view('register/register_provider_input');
    }

    public function home() {
        $this->view('layout/header');
        $this->view('home/index');
    }

}
