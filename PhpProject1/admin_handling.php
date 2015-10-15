<?php

//start session and db calls 
session_start();

$accessed = 0;

//require_once '/db/mysqli_connect.php';

//functions hide and display 
function show_ins_food() {
    if($_SESSION['displayed_admin'] == 1){
        return true;
    }
    if (isset($_GET['show_input'])) {
        if($_GET['show_input'] == 1){
            $_SESSION['displayed_admin'] = 1;
            return true;    
        }
    }
    return false;
}

function show_ins_customer(){
    if($_SESSION['displayed_admin'] == 2){
        return true;
    }
    if (isset($_GET['show_input'])) {
        if($_GET['show_input'] == 2){
            $_SESSION['displayed_admin'] = 2;
            return true;
        }
    }
    return false;
}

function show_ins_provider(){
    if($_SESSION['displayed_admin'] == 3){
        return true;
    }
    if (isset($_GET['show_input'])) {
        if($_GET['show_input'] == 3){
            $_SESSION['displayed_admin'] = 3;
            return true;
        }
    }
    return false;
}

function insert_food() {
    //enable_access();
    $food_type = "";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (!empty($_POST['food_type'])) {
            $food_type = $_POST['food_type'];
            insert_foodDB($food_type);
            return true;
        }
    }
    return false;
}

function insert_user() {
    //if (enable_access()) {
    $user = array();
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (!empty($_POST['first_name_customer'] && $_POST['last_name_customer']
                && $_POST['email_customer'] && $_POST['phone_customer'])) {


            $first_name = $_POST['first_name_customer'];
            $last_name = $_POST['last_name_customer'];
            $email = $_POST['email_customer'];
            $phone = $_POST['phone_customer'];
            array_push($user, $first_name, $last_name, $email, $phone);

            insert_userDB($user);
            //return true;
        }
    }
    //return false;
}

function insert_provider() {
    //enable_access();
    $provider = array();
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (!empty($_POST['first_name_provider'] && $_POST['last_name_provider']
                        && $_POST['email_provider'] && $_POST['phone_provider']
                        && $_POST['adress_provider'] && $_POST['zip_provider']
                        && $_POST['amount_provider'])) {


            $first_name = $_POST['first_name_provider'];
            $last_name = $_POST['last_name_provider'];
            $email = $_POST['email_provider'];
            $phone = $_POST['phone_provider'];
            $adress = $_POST['adress_provider'];
            $zip = $_POST['zip_provider'];
            $amount = $_POST['amount_provider'];

            array_push($provider, $first_name, $last_name, $email, $phone, $adress, $zip, $amount);
            insert_providerDB($provider);
            return true;
        }
    }
    return false;
}
