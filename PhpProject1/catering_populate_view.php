<?php

//if (!isset($_SESSION)) {
session_start();
//}

$accessed = 0;

/*if (isset($_SESSION['accessed'])) {
    $accessed = $_SESSION['accessed'];
}*/

include 'db/mysqli_connect.php';
/*if ($accessed != 1) {
    include '/db/mysqli_connect.php';

    $show_dishes = select_common_dishes();
    $_SESSION['show_dishes_save'] = $show_dishes;
    $accessed = 1;
    $_SESSION['accessed'] = $accessed;
}*/

//



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
    //$adress_event = "";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["adress_event"])) {
            $adress_event = "";
        } else {
            $adress_event = $_POST["adress_event"];
            //return $adress_event;
        }
        return $adress_event;
    }
}

function validate_adress() {
    $adressErr = "";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["adress_event"])) {
            $adressErr = "";
        } else {
            $adress_event = test_input($_POST["adress_event"]);
            if (!preg_match("/^[a-zA-Z ]*$/", $adress_event)) {
                $adressErr = "only letters pls";
            }
        }
        return $adressErr;
    }
    return $adressErr;
}

function get_zip() {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["zip_code"])) {
            $zip_code = "";
        } else {
            $zip_code = $_POST["zip_code"];
            //return $adress_event;
        }
        return $zip_code;
    }
}

//zip
function validate_zip() {
    $zipErr = "";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["zip_code"])) {
            $zipErr = "";
        } else {
            $zip_code = test_input($_POST["zip_code"]);

            if (!preg_match("/^[0-9]*$/", $zip_code)) {
                $zipErr = "only numbers pls";
            }
        }
        return $zipErr;
    }
    return $zipErr;
}

function get_date() {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["date_picked"])) {
            $date_picked = "";
        } else {
            $date_picked = $_POST["date_picked"];
            //return $adress_event;
        }
        return $date_picked;
    }
}

//date
function validate_date() {
    $dateErr = "";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["date_picked"])) {
            $dateErr = "";
        } else {
            $date_picked = test_input($_POST["date_picked"]);
        }
        return $dateErr;
    }
    return $dateErr;
}

function get_quantityPeople() {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["quantity_people"])) {
            $quantity_people = "";
        } else {
            $quantity_people = $_POST["quantity_people"];
            //return $adress_event;
        }
        return $quantity_people;
    }
}

//quantity
function validate_quantity() {
    $quantityErr = "";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["quantity_people"])) {
            $quantityErr = "";
        } else {
            $quantity_people = test_input($_POST["quantity_people"]);
            if (!preg_match("/^[0-9]*$/", $quantity_people)) {
                $quantityErr = "only letters pls";
            }
        }
        return $quantityErr;
    }
    return $quantityErr;
}

function check_validation() {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty(validate_adress()) && !empty(get_adress())
                && empty(validate_date()) && !empty(get_date())
                && empty(validate_quantity()) && !empty(get_quantityPeople())
                && empty(validate_zip()) && !empty(get_zip())) {

            return true;
        }
        return false;
    }
}

function save_input(){
    $_SESSION['adress_event'] = get_adress();
    $_SESSION['zip_code'] = get_zip();
    $_SESSION['quantity_people'] = get_quantityPeople();
    $_SESSION['date_picked'] = get_date();
}

function cancel_picked() {
    $test = "match found..";
    $fail = "no match.. ";
    $a_test = array("testen", "blir");
    $b_test = array("blir");
    $i_test = "testen";

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

function test_array() {
    $comp = "fullfort";
    $a = array("test", "er", "kanskje");
    array_push($a, $comp);
    print_r($a);
}

function submit_hold() {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (!empty(isset($_SESSION['displayed']))) {
            return true;
        }
        return false;
    }
}

function show_picked() {
    $test = "what";
    $display = "";
    $displayed_array = array();

    if (submit_hold()) {
        return $_SESSION['displayed'];
    }

    if (isset($_GET['cancelled'])) {
        if (!empty(isset($_SESSION['displayed']))) {
            return $_SESSION['displayed'];
        }
    }

    if (isset($_GET['show_picked'])) {
        //$display = array($_GET['show_picked']); old for backup
        $display = filter_input(INPUT_GET, 'show_picked');
        if (isset($_SESSION['displayed'])) {
            $displayed_array = $_SESSION['displayed'];
            $display = filter_input(INPUT_GET, 'show_picked');

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

if(isset($_POST['partial_food'])){
    $partial_food = $_POST['partial_food'];
    search_foodDB($partial_food);
}
/*function search_food($input){
    search_foodDB($input);
    //$array = $_SESSION['show_dishes_save'];
    
}*/
?>

