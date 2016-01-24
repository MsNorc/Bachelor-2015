<?php

//require_once 'db/mysqli_connect.php';
require_once 'db/mysqli_connect.php';
require_once 'mailsender.php';

class Password extends Controller {

    public function index() {
        $this->view('layout/header');
        $this->view('password/forgotPassword');
    }
    
    public function forgot(){
        $this->view('layout/header');
        $this->view('password/resetPassword');
    }

}
