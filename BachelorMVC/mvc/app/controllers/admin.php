<?php

include 'db/mysqli_connect.php';

if (!isset($_SESSION)) {
    session_start();
}

class Admin extends Controller {

    public function index() {

        if (!isset($_SESSION['JQUERY'])) {
            $this->view('layout/header');
            $this->view('admin/admin_view');
        }
        if (isset($_SESSION['JQUERY'])) {   //double check for jquery search to avoid duplicate views
            if ($_SESSION['JQUERY'] == 1) {
                if (!isset($_POST['tempSave'])) {
                    $this->view('layout/header');
                    $this->view('admin/admin_view');
                }
            }
        }
    }

}

/* $filePath = "/home/stud/chrnordh/public_html/Bachelor15";
  require_once ($filePath . '/db/mysqli_connect.php'); */

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

function show_ins_request() {
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

function show_edit_food() {
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

function show_edit_customer() {
    if (isset($_SESSION['displayed_admin'])) {
        if ($_SESSION['displayed_admin'] == 6) {
            return true;
        }
    }
    if (isset($_GET['show_input'])) {
        if ($_GET['show_input'] == 6) {
            $_SESSION['displayed_admin'] = 6;
            return true;
        }
    }
    return false;
}

function show_searchArea() {
    if (isset($_SESSION['displayed_admin'])) {
        if ($_SESSION['displayed_admin'] == 8) {
            return true;
        }
    }
    if (isset($_GET['show_input'])) {
        if ($_GET['show_input'] == 8) {
            $_SESSION['displayed_admin'] = 8;
            return true;
        }
    }
    return false;
}

function get_zipCodes() {
    $list = array();
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['zip_search'], $_POST['radius_km'])) {
            $zip = filter_input(INPUT_POST, 'zip_search');
            $radius = filter_input(INPUT_POST, 'radius_km');
            if (strlen($zip) === 4 && $radius < 100) {
                $list = zipCode_search($zip, $radius);
                return $list;
            }
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
    $food_list = null;
    $provider = array();
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        /* if (!empty($_POST['first_name_provider'] && $_POST['last_name_provider']
          && $_POST['email_provider'] && $_POST['phone_provider']
          && $_POST['adress_provider'] && $_POST['zip_provider']
          && $_POST['amount_provider'])) { */ //php > 5.3

        /* if (isset($_POST['first_name_provider'],$_POST['last_name_provider']
          , $_POST['email_provider'], $_POST['phone_provider'],
          $_POST['adress_provider'], $_POST['zip_provider']
          , $_POST['amount_people'])) { */



        $first_name = filter_input(INPUT_POST, 'first_name_provider');
        $last_name = filter_input(INPUT_POST, 'last_name_provider');
        $email = filter_input(INPUT_POST, 'email_provider');
        $phone = filter_input(INPUT_POST, 'phone_provider');
        $adress = filter_input(INPUT_POST, 'adress_provider');
        $zip = filter_input(INPUT_POST, 'zip_provider');
        $amount = filter_input(INPUT_POST, 'amount_provider');
        $password = filter_input(INPUT_POST, 'password_provider');
        if (isset($_SESSION['displayed'])) {
            $food_list = $_SESSION['displayed'];
        }




        if ($first_name && $last_name && $email && $phone && $adress && $zip && $amount && $food_list) {

            array_push($provider, $first_name, $last_name, $email, $phone, $adress, $zip, $amount, $password, $food_list);
            insert_providerDB($provider);
            if (isset($_SESSION['displayed'])) {
                unset($_SESSION['displayed']);
            }

            return true;
        }
        //}
    }
    return false;
}

function insert_request() {
    //if (enable_access()) {
    $request = array();
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        /* if (isset($_SESSION['user_id'], $_POST['last_name_customer']
          , $_POST['email_customer'], $_POST['phone_customer']
          , $_POST['adress_customer'], $_POST['zip_customer']
          , $_POST['password_customer'])) { */


        $adress = filter_input(INPUT_POST, 'adress_request');
        $zip = filter_input(INPUT_POST, 'zip_request');
        $date = filter_input(INPUT_POST, 'date_request');
        $quantity = filter_input(INPUT_POST, 'quantity_request');
        $status = filter_input(INPUT_POST, 'status_request');
        $customer_id = $_SESSION['show_pickedCustomer'];
        $provider_id = $_SESSION['show_pickedProvider'];
        $food_list = $_SESSION['displayed'];
        $amount_list = $_SESSION['amount'];
        //array_push($user, $first_name, $last_name, $email, $phone,$adress,$zip,$passowrd);
        $request['adress'] = $adress;
        $request['zip'] = $zip;
        $request['date'] = $date;
        $request['quantity'] = $quantity;
        $request['status'] = $status;
        $request['customer_id'] = $customer_id;
        $request['provider_id'] = $provider_id;
        $request['food_list'] = $food_list;
        $request['output_amount'] = $amount_list;
        print_r($request);


        insert_requestDB($request);
        return true;
    }
    //}
    return false;
}

/* * *** EDIT **** */
/* * FOOD* */
//populate list search food

if (isset($_POST['partial_food'])) {
    $partial_food = filter_input(INPUT_POST, 'partial_food');
    search_foodDB($partial_food);
}

//display item picked from search food
if (isset($_GET['show_pickedFood'])) {
    $show_picked = filter_input(INPUT_GET, 'show_pickedFood');
    $_SESSION['show_pickedFood'] = $show_picked;
}

function show_pickedFood() {
    if (isset($_SESSION['show_pickedFood'])) {
        echo $_SESSION['show_pickedFood'];
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

/** CUSTOMER * */
//populate list search customer
if (isset($_POST['partial_customer'])) {
    $partial_customer = filter_input(INPUT_POST, 'partial_customer');
    search_customerDB($partial_customer);
}

//display item picked from search customer
if (isset($_GET['show_pickedCustomer'])) {

    $show_picked = filter_input(INPUT_GET, 'show_pickedCustomer');
    $_SESSION['show_pickedCustomer'] = $show_picked;
}

function show_pickedCustomer($i) {
    if (isset($_SESSION['show_pickedCustomer'])) {
        $id = $_SESSION['show_pickedCustomer'];
        $user = getCustomerDB($id);
        $_SESSION['old_user'] = $user;
        echo $user[$i];
    }
}

function edit_customer() {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['edit0'])) {

            $edit_user = array();
            $edit_user['first_name'] = filter_input(INPUT_POST, 'edit0');
            $edit_user['last_name'] = filter_input(INPUT_POST, 'edit1');
            $edit_user['email'] = filter_input(INPUT_POST, 'edit2');
            $edit_user['phone'] = filter_input(INPUT_POST, 'edit3');
            $edit_user['adress'] = filter_input(INPUT_POST, 'edit4');
            $edit_user['zip'] = filter_input(INPUT_POST, 'edit5');

            edit_customerDB($edit_user);
            return true;
        }
    }
    return false;
}

/** PROVIDER * */
//populate list search provider
if (isset($_POST['partial_provider'])) {
    $partial_provider = filter_input(INPUT_POST, 'partial_provider');
    search_providerDB($partial_provider);
}

//display item picked from search customer
if (isset($_GET['show_pickedProvider'])) {

    $show_picked = filter_input(INPUT_GET, 'show_pickedProvider');
    $_SESSION['show_pickedProvider'] = $show_picked;
}

function show_pickedProvider($i) {
    if (isset($_SESSION['show_pickedProvider'])) {
        $id = $_SESSION['show_pickedProvider'];
        $provider = getProviderDB($id);
        $_SESSION['old_provider'] = $provider;
        echo $provider[$i];
    }
}

function edit_provider() {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['edit0'])) {

            $edit_user = array();
            $edit_user['first_name'] = filter_input(INPUT_POST, 'edit0');
            $edit_user['last_name'] = filter_input(INPUT_POST, 'edit1');
            $edit_user['email'] = filter_input(INPUT_POST, 'edit2');
            $edit_user['phone'] = filter_input(INPUT_POST, 'edit3');
            $edit_user['adress'] = filter_input(INPUT_POST, 'edit4');
            $edit_user['zip'] = filter_input(INPUT_POST, 'edit5');

            edit_providerDB($edit_user);
            return true;
        }
    }
    return false;
}

//food ADMIN

function cancel_picked() {

    if (isset($_GET['cancelled'])) {

        $displayed_array = $_SESSION['displayed'];

        $cancel = filter_input(INPUT_GET, 'cancelled');

        if (in_array($cancel, $displayed_array)) {
            $delete = array_search($cancel, $displayed_array);
            unset($displayed_array[$delete]);
            $new_array = array_values($displayed_array);
            $displayed_array = $new_array;
            $_SESSION['displayed'] = $displayed_array;
        }
    }

    show_picked();
    //return $displayed_array;
}

function submit_hold() {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        //if (!empty(isset($_SESSION['displayed']))) { // php > 5.3
        if (isset($_SESSION['displayed'])) {//5.3
            $displayed = $_SESSION['displayed']; //5.3
            if ($displayed) {
                return true;
            }
        }
        return false;
    }
}

//displays food_types choosen on the left sidebar
function show_picked() {
    $display = "";
    $displayed_array = array();

    if (submit_hold()) {
        return $_SESSION['displayed'];
    }

    if (isset($_GET['cancelled'])) {
        //if (!empty(isset($_SESSION['displayed']))) { //**php>5.3**
        if (isset($_SESSION['displayed'])) {
            return $_SESSION['displayed'];
        }
    }

    if (isset($_GET['show_pickedFood'])) {
        //$display = array($_GET['show_picked']); old for backup
        $display = filter_input(INPUT_GET, 'show_pickedFood');
        if (isset($_SESSION['displayed'])) {
            $displayed_array = $_SESSION['displayed'];
            $display = filter_input(INPUT_GET, 'show_pickedFood');

            if (in_array($display, $displayed_array)) {

                //return $test;
                $_SESSION['displayed'] = $displayed_array;

                return $displayed_array;
            } else {

                array_push($displayed_array, $display);
                //dump_displayed();
                $_SESSION['displayed'] = $displayed_array;

                return $displayed_array;
            }
        }
        array_push($displayed_array, $display);
        $_SESSION['displayed'] = $displayed_array;
        return $displayed_array;
    }
}

/* if (isset($_POST['partial_food'])) {
  $partial_food = $_POST['partial_food'];
  search_foodDB($partial_food);
  } */
/* function search_food($input){
  search_foodDB($input);
  //$array = $_SESSION['show_dishes_save'];

  } */

function save_amount() {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $amount_list = array();
        $displayed_items = $_SESSION['displayed'];
        for ($i = 0; $i < count($displayed_items); $i++) {
            $amount[$i] = filter_input(INPUT_POST, "amount" . $displayed_items[$i]);
            $amount_list[$displayed_items[$i]] = $amount[$i];
        }
        $_SESSION['amount'] = $amount_list;
    }
}
