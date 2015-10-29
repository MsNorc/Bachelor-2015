<?php

//include ('db/config_db.php');

function insert_test() {
    $db_connection = get_connection();
    $sql = 'INSERT INTO test (test1, test2) 
	VALUES (2, 4)';
    $result = mysqli_query($db_connection, $sql);

    if (!$result) {
        echo "DB Error, could not query the database\n";
        echo 'MySQL Error: ' . mysqli_error($db_connection);
        exit;
    }
}

function get_connection() {  //annen måte å gjøre dette på ??
    $db_host = "db.stud.aitel.hist.no";
    $db_user = "chrin";
    $db_password = "UZGVCsew";
    $db_name = "chrin";

    $db_connection = mysqli_connect($db_host, $db_user, $db_password, $db_name)
            or die("Could not connect");
    if (!mysqli_select_db($db_connection, $db_name)) {
        echo 'Could not select database';
        exit;
    }

    return $db_connection;
}

function test_result($db_connection, $result) {
    if (!$result) {
        echo "DB Error, could not query the database\n";
        echo 'MySQL Error: ' . mysqli_error($db_connection);
        exit;
    }
}

//select provider / catering
function select_provider($provider_id) { //WORKS!! :D
    $db_connection = get_connection();
    $sql = "SELECT first_name FROM provider WHERE provider_id = '$provider_id'";
    $result = mysqli_query($db_connection, $sql);

    test_result($db_connection, $result);

    while ($row = mysqli_fetch_assoc($result)) {
        echo $row["first_name"];
    }

    //echo json_encode($row)

    mysqli_free_result($result);
    mysqli_close($db_connection);
}

//select dishes / catering
function select_common_dishes() {
    $db_connection = get_connection();
    $sql = "SELECT food_type FROM catering_list";
    $result = mysqli_query($db_connection, $sql);
    $results = array();

    test_result($db_connection, $result);

    while ($row = mysqli_fetch_assoc($result)) {
        //echo $row['food_type'];
        $results[] = $row['food_type'];
    }
    //array_pop($results);
    mysqli_free_result($result);
    mysqli_close($db_connection);
    return $results;
}

function check_availability_food($food_check) {
    $db_connection = get_connection();
    $sql = "SELECT food_type FROM catering_list WHERE food_type = '$food_check'";
    $result = mysqli_query($db_connection, $sql);
    test_result($db_connection, $result);
    $data = mysqli_num_rows($result);
    if ($data == 1) {
        return false;
    }
    return true;
}

//insert functions
function insert_foodDB($food_type) {
    if (check_availability_food($food_type)) {
        $db_connection = get_connection();
        $sql = "INSERT INTO catering_list (food_type) VALUES('$food_type')";
        $result = mysqli_query($db_connection, $sql);

        test_result($db_connection, $result);
        mysqli_close($db_connection);
    }
}

function check_availability_customer($user) {
    $db_connection = get_connection();
    $email = $user['email'];
    $sql = "SELECT email FROM customer WHERE email = '$email'";
    $result = mysqli_query($db_connection, $sql);
    $data = mysqli_num_rows($result);
    if ($data == 1) {
        return false;
    }
    return true;
}

function insert_userDB($user) {
    if (check_availability_customer($user)) {
        $db_connection = get_connection();

        $first_name = $user['first_name'];
        $last_name = $user['last_name'];
        $email = $user['email'];
        $phone = $user['phone'];
        $adress = $user['adress'];
        $zip = $user['zip'];
        $password = $user['password'];

        $sql = "INSERT INTO chrin.customer (first_name, last_name, email, 
        phone_number, adress, zip_code, password_customer) 
	VALUES ('$first_name', '$last_name', '$email', '$phone', '$adress', "
                . "'$zip', '$password')";

        $result = mysqli_query($db_connection, $sql);

        test_result($db_connection, $result);
        mysqli_close($db_connection);
    }
}

function insert_providerDB($provider) {
    $db_connection = get_connection();

    $first_name = $provider[0];
    $last_name = $provider[1];
    $email = $provider[2];
    $phone = $provider[3];
    $adress = $provider[4];
    $zip = $provider[5];
    $amount = $provider[6];



    $sql = "INSERT INTO provider (first_name, last_name, email, phone_number, 
        address, zip, amount_people) 
	VALUES ('$first_name', '$last_name', '$email', '$phone', '$adress',"
            . " '$zip', '$amount')";

    $result = mysqli_query($db_connection, $sql);

    test_result($db_connection, $result);
    mysqli_free_result($result);
    mysqli_close($db_connection);
}

//display list of food from DB - search 
function search_FoodDB($input) {

    if ($input != "") {
        $db_connection = get_connection();
        $sql = "SELECT food_type FROM catering_list WHERE food_type LIKE '%{$input}%'";
        $result = mysqli_query($db_connection, $sql);

        while ($row = mysqli_fetch_assoc($result)) {
            $output = $row['food_type'];
            echo "<a href='?show_picked=$output'>" . $output . "</a>";
            echo "<br>";
        }
        mysqli_free_result($result);
        mysqli_close($db_connection);
    }
}

function edit_foodDB($new_value) {
    if ($new_value != "") {
        $db_connection = get_connection();
        $old_value = $_SESSION['show_picked'];
        $sql = "SELECT catering_id FROM catering_list WHERE food_type = '$old_value'";
        $query = mysqli_query($db_connection, $sql);
        $data = mysqli_num_rows($query);
        if ($data == 1) {
            while ($row = mysqli_fetch_assoc($query)) {
                $food_id = $row["catering_id"];
            }
            //$food_id = $query['catering_id'];
            $sql2 = "UPDATE catering_list SET food_type = '$new_value' WHERE catering_id = '$food_id'";
            $query = mysqli_query($db_connection, $sql2);
            $_SESSION['changed'] = $old_value . " is set to : " . $new_value;
            return true;
        }
        mysqli_free_result($query);
        mysqli_close($db_connection);
    }
    return false;
}

function check_duplicate_request($adress, $customer_id) {
    if ($adress != "") {
        $db_connection = get_connection();
        $sql = "SELECT adress, customer_id FROM request WHERE adress = '$adress'"
                . "AND customer_id = '$customer_id'";
        $result = mysqli_query($db_connection, $sql);
        $data = mysqli_num_rows($result);
        if ($data == 1) {
            mysqli_free_result($result);
            mysqli_close($db_connection);
            return true;
        }
        mysqli_free_result($result);
        mysqli_close($db_connection);
        return false;
    }
    return true;
}

function get_catering_id($db_connection, $food_type) {
    //$catering_id = "";
    //if($food_type != ""){
    //$db_connection = get_connection();
    $sql = "SELECT catering_id FROM catering_list WHERE food_type = '$food_type'";
    $result = mysqli_query($db_connection, $sql);
    test_result($db_connection, $result);
    while ($row = mysqli_fetch_assoc($result)) {
        $catering_id = $row['catering_id'];
    }
    mysqli_free_result($result);
    //mysqli_close($db_connection);
    return $catering_id;
    //}
}

function insert_request_info($db_connection, $food_list, $amount_list, $request_id) {
    if ($food_list && $amount_list) {
        //$db_connection = get_connection();
        for ($i = 0; $i < count($food_list); $i++) {
            $catering_id = get_catering_id($db_connection, $food_list[$i]);
            $amount_value = $amount_list[$food_list[$i]];
            $sql = "INSERT INTO request_info (request_id,catering_id,amount) VALUES"
                    . "('$request_id','$catering_id','$amount_value')";
            $result = mysqli_query($db_connection, $sql);
            test_result($db_connection, $result);
        }
        //mysqli_close($db_connection);
    }
}

function get_areaDB($zip) {
    $area = "";
    $db_connection = get_connection();
    $sql = "SELECT area FROM zip_list WHERE zip_code = '$zip'";
    $result = mysqli_query($db_connection, $sql);
    test_result($db_connection, $result);
    $data = mysqli_num_rows($result);
    if ($data == 1) {
        while ($row = mysqli_fetch_assoc($result)) {
            $area = $row['area'];
            echo "<label>" . $area . "</label>";
            //$_SESSION['testen'] = "what";
        }
    }

    mysqli_free_result($result);
    mysqli_close($db_connection);
    return $area;
}

function find_request_id($db_connection, $customer_id, $adress) {
    //$request_id ="";
    $sql = "SELECT request_id FROM request WHERE adress = '$adress' AND "
            . "customer_id = '$customer_id'";
    $result = mysqli_query($db_connection, $sql);
    test_result($db_connection, $result);
    while ($row = mysqli_fetch_assoc($result)) {
        $request_id = $row['request_id'];
    }
    mysqli_free_result($result);
    return $request_id;
}

//insert a catering request into DB
function make_requestDB($request) {
    if ($request != null) {
        $db_connection = get_connection();

        $adress = $request['adress'];
        $zip = $request['zip'];
        $date = $request['date'];
        $amount = $request['amount'];
        $customer_id = $_SESSION['user_id'];
        //$food_list = $request['food_list']; //list of items picked, soon^tm
        if (!check_duplicate_request($adress, $customer_id)) {
            $sql = "INSERT INTO request (adress, zip_code, date_event, quantity_people, customer_id)"
                    . "VALUES ('$adress','$zip','$date','$amount', '$customer_id')";
            $result = mysqli_query($db_connection, $sql);
            $request_id = find_request_id($db_connection, $customer_id, $adress);
            //mysqli_close($db_connection);
            $food_list = $request['food_list'];
            $amount_list = $request['amount_list'];
            print_r($amount_list);
            insert_request_info($db_connection, $food_list, $amount_list, $request_id);
            mysqli_close($db_connection);
            return true;
        }
    }
    mysqli_close($db_connection);
    return false;
}

function get_requestDB($user_id) {
    $db_connection = get_connection();
    $requests = array(); //outer array
    /* $adresses = array();
      $zip_codes = array();
      $dates = array();
      $quantity = array();
      $food_list = array(); //inner array, list of food connected to a request */

    $sql = "SELECT r.adress AS adress, r.zip_code AS zip, date_event,"
            . "quantity_people, food_type, amount FROM request r "
            . "JOIN customer c ON c.customer_id = r.customer_id "
            . "JOIN request_info ri ON ri.request_id = r.request_id "
            . "JOIN catering_list cl ON cl.catering_id = ri.catering_id "
            . "WHERE c.customer_id = $user_id";
    $result = mysqli_query($db_connection, $sql);
    test_result($db_connection, $result);

    while ($row = mysqli_fetch_row($result)) {
        array_push($requests, $row);
        /* $adress = $row['adress'];
          $zip = $row['zip'];
          $date = $row['date_event'];
          $quantity_people = $row['quantity_people'];
          $food_type = $row['food_type'];
          $amount = $row['amount']; */

        //$requests['adress'] = $adress;
        //$requests['zip'] = $zip;

        /* array_push($adresses, $adress);
          array_push($zip_codes, $zip);
          array_push($dates, $date);
          array_push($quantity, $quantity_people);
          array_push($food_list, $food_type, $amount); */
        //array_push($requests, $adress,$zip,$date,$quantity_people,$food_type);
    }

    mysqli_free_result($result);
    mysqli_close($db_connection);
    /* $requests['adress'] = $adress;
      $requests['zip'] = $zip;
      $requests['date_event'] = $date;
      $requests['quantity'] = $quantity_people;
      $requests['food_list'] = $food_list; */
    print_r($requests);
    return $requests;
}
