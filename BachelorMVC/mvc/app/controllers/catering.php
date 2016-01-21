<?php

require_once 'db/mysqli_connect.php';

if (!isset($_SESSION)) {
    session_start();
}

//echo "this tempSave = " . $_POST['tempSave'];

//echo $_SESSION['displayed_view'];
class Catering extends Controller {

    public function index() {

        if (!isset($_SESSION['JQUERY'])) {
            $this->view('layout/header');
            $this->view('catering/catering_view');
        }
        if (isset($_SESSION['JQUERY'])) {   //double check for jquery search to avoid duplicate views
            if ($_SESSION['JQUERY'] == 1) {
                if (!isset($_POST['tempSave'])) {
                    $this->view('layout/header');
                    $this->view('catering/catering_view');
                }
            }
        }
    }

    public function request() {
        $this->view('layout/header');
        $this->view('catering/catering_view');
        //$this->model('catering_handling');
    }

    public function summary() {
        $this->view('layout/header');
        $this->view('catering/summaryCatering_view');
    }
    
    public function home(){
        if (isset($_GET['url'])) {
            ( $url = explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL)));
        }
        $this->view('layout/header');
        $this->view('home/index');
    }

}

//$accessed = 0;

/* if (isset($_SESSION['accessed'])) {
  $accessed = $_SESSION['accessed'];
  } */
//$filePath = "/home/stud/chrnordh/public_html/Bachelor15";
//include $filePath . '/db/mysqli_connect.php';
/* if ($accessed != 1) {
  include '/db/mysqli_connect.php';

  $show_dishes = select_common_dishes();
  $_SESSION['show_dishes_save'] = $show_dishes;
  $accessed = 1;
  $_SESSION['accessed'] = $accessed;
  } */

//

/* function redirect($url) {
  ob_start();
  header('Location: ' . $url);
  ob_end_flush();
  die();
  } */



function check_dishes() {
    $show_dishes = $_SESSION['show_dishes_save'];
    return $show_dishes;
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function get_adress() {
    $adress_event = "";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["adress_event"])) {

            $adress_event = filter_input(INPUT_POST, 'adress_event');
//return $adress_event;
        }
        return $adress_event;
    }
    if (isset($_SESSION['adress_event'])) {
        return $_SESSION['adress_event'];
    }
    $_SESSION['adress_event'] = filter_input(INPUT_POST, 'adress_event');
}

function validate_adress() {
    $adressErr = "";
    $dummy = array(); //for php < 5.3
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
//if (isset($_POST["adress_event"])) {
//$adress_event = filter_input(INPUT_POST, 'adress_event');
        if (get_adress()) {
            $adress_event = test_input($_POST["adress_event"]);
            if (!preg_match_all("/^[a-zA-Z]*[0-9]*[a-zA-Z]*$/", $adress_event, $dummy)) {
                $adressErr = "example veien10a";
            }
        }
//  }
        return $adressErr;
    }
}

function get_zip() {
    $zip_code = "";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['zip_code'])) {
            $zip_code = filter_input(INPUT_POST, 'zip_code');
        }
        return $zip_code;
    }
}

//zip
function validate_zip() {
    $zipErr = "";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $zip_code = filter_input(INPUT_POST, 'zip_code');
        if (get_zip()) {
            $zip_code = test_input($_POST["zip_code"]);
            if (!preg_match("/^[0-9]{4}$/", $zip_code)) {
                $zipErr = "4 digit zip";
            }
            if (!check_zipDB($zip_code)) {
                $zipErr = "zip doesn't exist";
            }
        }
    }
    return $zipErr;
}

function get_date() {
    $date_picked = "";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $date_picked = filter_input(INPUT_POST, 'date_picked');
    }
    return $date_picked;
}

//date
function validate_date() {
    $dateErr = "";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (get_date()) {
//date check to be made soon^tm
            $date_picked = test_input($_POST["date_picked"]);
        }
    }
    return $dateErr;
}

function get_quantityPeople() {
    $quantity_people = "";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $quantity_people = filter_input(INPUT_POST, 'quantity_people');
    }
    return $quantity_people;
}

//quantity
function validate_quantity() {
    $quantityErr = "";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (get_quantityPeople()) {
            $quantity_people = test_input($_POST["quantity_people"]);
            if (!preg_match("/^[0-9]{1,3}$/", $quantity_people)) {
                $quantityErr = "between 1-999";
            }
        }
    }
    return $quantityErr;
}

function check_validation() {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        /* if (!empty(validate_adress() && get_adress() 
          && validate_date() && get_date()
          && validate_quantity() && get_quantityPeople()
          && (validate_zip()) && get_zip())) { */ //php > 5.3
        if ((!validate_adress() && get_adress() && !validate_date() && get_date() &&
                /* !validate_quantity() && get_quantityPeople() && */
                !validate_zip() && get_zip()) && isset($_SESSION['displayed'])) {

            return true;
        }
    }
    return false;
}

if (isset($_POST['tempSave'])) {
    save_input();
}

function save_input() {
    $_SESSION['adress_event'] = get_adress();
    $_SESSION['zip_code'] = get_zip();
//$_SESSION['quantity_people'] = get_quantityPeople();
    $_SESSION['date_picked'] = get_date();
}

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

/*function test_array() {
    $comp = "fullfort";
    $a = array("test", "er", "kanskje");
    array_push($a, $comp);
    print_r($a);
}*/

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

if (isset($_POST['partial_food'])) {
    $partial_food = $_POST['partial_food'];
    search_foodDB($partial_food);
}
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

function make_request($request) {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if(make_requestDB($request)){
            return true;
        }
        return false;
    }
}

//receive from JS function
if (isset($_POST['zip_codeInput'])) {
    $input = $_POST['zip_codeInput'];
    get_area($input);
}

function get_area($zip) {
//$_SESSION['testen'] = "get_area";
    get_areaDB($zip);
}

/* function set_location($zip){ //NOT USED
  $substr = substr($zip, 0,2);
  if($substr <= 12){
  $region = "oslo";
  }


  } */
?>



