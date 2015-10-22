<?php

//start session and db calls 
if (!isset($_SESSION)) {
    session_start();
}


$accessed = 0;

include 'db/mysqli_connect.php';

//functions hide and display 
function show_ins_food() {
    if (isset($_SESSION['displayed_admin'])) {
        if ($_SESSION['displayed_admin'] == 1) {
            return true;
        }
    }
    if (isset($_GET['show_input'])) {
        if ($_GET['show_input'] == 1) {
            $_SESSION['displayed_admin'] = 1;
            return true;
        }
    }
    return false;
}

function show_ins_customer() {
    if (isset($_SESSION['displayed_admin'])) {
        if ($_SESSION['displayed_admin'] == 2) {
            return true;
        }
    }
    if (isset($_GET['show_input'])) {
        if ($_GET['show_input'] == 2) {
            $_SESSION['displayed_admin'] = 2;
            return true;
        }
    }
    return false;
}

function show_ins_provider() {
    if (isset($_SESSION['displayed_admin'])) {
        if ($_SESSION['displayed_admin'] == 3) {
            return true;
        }
    }
    if (isset($_GET['show_input'])) {
        if ($_GET['show_input'] == 3) {
            $_SESSION['displayed_admin'] = 3;
            return true;
        }
    }
    return false;
}

function show_edit_food() {
    if (isset($_SESSION['displayed_admin'])) {
        if ($_SESSION['displayed_admin'] == 4) {
            return true;
        }
    }
    if (isset($_GET['show_input'])) {
        if ($_GET['show_input'] == 4) {
            $_SESSION['displayed_admin'] = 4;
            return true;
        }
    }
    return false;
}

function show_edit_customer() {
    if (isset($_SESSION['displayed_admin'])) {
        if ($_SESSION['displayed_admin'] == 5) {
            return true;
        }
    }
    if (isset($_GET['show_input'])) {
        if ($_GET['show_input'] == 5) {
            $_SESSION['displayed_admin'] = 5;
            return true;
        }
    }
    return false;
}

function insert_food() {
    $food_type = "";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        //if (!empty($_POST['food_type'])) { php > 5.3 || fuck php 5.3
        if (isset($_POST['food_type'])) {
            $food_type = filter_input(INPUT_POST, 'food_type');
            if ($food_type) {
                insert_foodDB($food_type);
                return true;
            }
        }
    }
    return false;
}

function insert_user() {
    //if (enable_access()) {
    $user = array();
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        /* if (!empty($_POST['first_name_customer'] && $_POST['last_name_customer']
          && $_POST['email_customer'] && $_POST['phone_customer']
          && $_POST['adress_customer'] && $_POST['zip_customer']
          && $_POST['password_customer'])) { */

        if (isset($_POST['first_name_customer'], $_POST['last_name_customer']
                        , $_POST['email_customer'], $_POST['phone_customer']
                        , $_POST['adress_customer'], $_POST['zip_customer']
                        , $_POST['password_customer'])) {


            $first_name = $_POST['first_name_customer'];
            $last_name = $_POST['last_name_customer'];
            $email = $_POST['email_customer'];
            $phone = $_POST['phone_customer'];
            $adress = $_POST['adress_customer'];
            $zip = $_POST['zip_customer'];
            $passowrd = $_POST['password_customer'];
            //array_push($user, $first_name, $last_name, $email, $phone,$adress,$zip,$passowrd);
            $user['first_name'] = $first_name;
            $user['last_name'] = $last_name;
            $user['email'] = $email;
            $user['phone'] = $phone;
            $user['adress'] = $adress;
            $user['zip'] = $zip;
            $user['password'] = $passowrd;

            insert_userDB($user);
            return true;
        }
    }
    return false;
}

function insert_provider() {
    //enable_access();
    $provider = array();
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        /* if (!empty($_POST['first_name_provider'] && $_POST['last_name_provider']
          && $_POST['email_provider'] && $_POST['phone_provider']
          && $_POST['adress_provider'] && $_POST['zip_provider']
          && $_POST['amount_provider'])) { */ //php > 5.3
        if (isset($_POST['first_name_provider'], $_POST['last_name_provider']
                        , $_POST['email_provider'], $_POST['phone_provider'], $_POST['adress_provider'], $_POST['zip_provider']
                        , $_POST['amount_people'])) {


            $first_name = $_POST['first_name_provider'];
            $last_name = $_POST['last_name_provider'];
            $email = $_POST['email_provider'];
            $phone = $_POST['phone_provider'];
            $adress = $_POST['adress_provider'];
            $zip = $_POST['zip_provider'];
            $amount = $_POST['amount_provider'];

            if ($first_name && $last_name && $email && $phone && $adress && $zip && $amount) {

                array_push($provider, $first_name, $last_name, $email, $phone, $adress, $zip, $amount);
                insert_providerDB($provider);
                return true;
            }
        }
    }
    return false;
}

//populate list search food
if (isset($_POST['partial_food'])) {
    $partial_food = $_POST['partial_food'];
    search_foodDB($partial_food);
}

//display item picked from search food
if (isset($_GET['show_picked'])) {
    $show_picked = $_GET['show_picked'];
    $_SESSION['show_picked'] = $show_picked;
}

function show_picked() {
    if (isset($_SESSION['show_picked'])) {
        echo $_SESSION['show_picked'];
    }
}

function edit_food() {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['edit_food_text'])) {
            $edit_food = filter_input(INPUT_POST, 'edit_food_text');
            edit_foodDB($edit_food);
            return true;
        }
    }
    return false;
}
