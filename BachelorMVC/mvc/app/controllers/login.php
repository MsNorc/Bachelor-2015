<?php

if (!isset($_SESSION)) {
    session_start();
}

include 'db/mysqli_connect.php';

class Login extends Controller {

    public function index() {
        if (!isset($_SESSION['login'])) {
            $this->view('layout/header');
            $this->view('layout/dropdown');
        }
        if (isset($_SESSION['login'])) {   //double check for jquery search to avoid duplicate views
            if ($_SESSION['login'] == 1) {
                if (!isset($_POST['tempSave'])) {
                    $this->view('layout/header');
                    $this->view('layout/dropdown');
                }
            }
        }
    }

}

function check_dropdown() {

    if ($_SESSION['dropdown'] == 0) {
        $_SESSION['dropdown'] = 1;
    }
}

if (isset($_POST['tempSave'])) {
    login();
}

function login() {
    $output = "please insert your credentials..";
    if (isset($_POST['email1'], $_POST['password1'])) {
        $email = $_POST['email1']; // Fetching Values from URL.
        $password = ($_POST['password1']); // Password Encryption, If you like you can also leave sha1.
        if ($email != null) {

            $email = filter_var($email, FILTER_SANITIZE_EMAIL); // sanitizing email
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $output = "invalid email..";
            } else {
                $output = loginDB($email, $password);
            }
        }
    }
    echo $output;
}

//echo $output;
?>



