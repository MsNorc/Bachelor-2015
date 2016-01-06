<?php
include 'mailsender.php';
//include ('db/config_db.php');
//echo dirname(__FILE__) . " #end#";

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
    mysqli_set_charset($db_connection, "utf8");
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
        $user_type = "user";
        $password = $user['password'];

        $sql = "INSERT INTO chrin.customer (first_name, last_name, email, 
        phone_number, adress, zip_code,user_type, password_customer) 
	VALUES ('$first_name', '$last_name', '$email', '$phone', '$adress', "
                . "'$zip','$user_type', md5('$password'))";

        $result = mysqli_query($db_connection, $sql);

        test_result($db_connection, $result);
        mysqli_close($db_connection);
    }
}

function insert_provider_info($db_connection, $food_list, $provider_id) {
    if ($food_list && $provider_id) {
        //$db_connection = get_connection();
        for ($i = 0; $i < count($food_list); $i++) {
            $catering_id = get_catering_id($db_connection, $food_list[$i]);
            //$amount_value = $amount_list[$food_list[$i]];
            $sql = "INSERT INTO provider_info (catering_id,provider_id) VALUES"
                    . "('$catering_id','$provider_id')";
            $result = mysqli_query($db_connection, $sql);
            test_result($db_connection, $result);
        }
        //mysqli_close($db_connection);
    }
}

function find_provider_id($db_connection, $email) {
    $sql = "SELECT provider_id FROM provider WHERE email = '$email'";
    $result = mysqli_query($db_connection, $sql);
    test_result($db_connection, $result);
    while ($row = mysqli_fetch_assoc($result)) {
        $provider_id = $row['provider_id'];
    }
    mysqli_free_result($result);
    return $provider_id;
}

function check_availability_provider($provider, $db_connection) {
    //$db_connection = get_connection();
    $email = $provider[2];
    $sql = "SELECT email FROM provider WHERE email = '$email'";
    $result = mysqli_query($db_connection, $sql);
    test_result($db_connection, $result);
    $data = mysqli_num_rows($result);
    mysqli_free_result($result);
    if ($data == 1) {
        mysqli_close($db_connection);
        return false;
    }
    return true;
}

function insert_providerDB($provider) {
    $db_connection = get_connection();
    if (check_availability_provider($provider, $db_connection)) {

        $first_name = $provider[0];
        $last_name = $provider[1];
        $email = $provider[2];
        $phone = $provider[3];
        $adress = $provider[4];
        $zip = $provider[5];
        $amount = $provider[6];
        $password = $provider[7];
        $food_list = $provider[8];

        $sql = "INSERT INTO provider (first_name, last_name, email, phone_number, 
        address, zip, amount_people, password) 
	VALUES ('$first_name', '$last_name', '$email', '$phone', '$adress',"
                . " '$zip', '$amount','$password')";

        $result = mysqli_query($db_connection, $sql);
        $provider_id = find_provider_id($db_connection, $email);
        insert_provider_info($db_connection, $food_list, $provider_id);

        //test_result($db_connection, $result);
        //mysqli_free_result($result);
        mysqli_close($db_connection);
    }
}

//display list of food from DB - search 
function search_FoodDB($input) {

    if ($input != "") {
        $db_connection = get_connection();
        $sql = "SELECT food_type FROM catering_list WHERE food_type LIKE '%{$input}%' LIMIT 20";
        $result = mysqli_query($db_connection, $sql);

        while ($row = mysqli_fetch_assoc($result)) {
            $output = $row['food_type'];
            echo "<a href='?show_pickedFood=$output'>" . $output . "</a><br>";
            //parent.window.location.reload();
        }
        mysqli_free_result($result);
        mysqli_close($db_connection);
    }
}

function getCustomerDB($id) {
    if ($id != null) {
        $user = array();
        $db_connection = get_connection();
        $sql = "SELECT first_name, last_name, email, phone_number,adress, zip_code "
                . "FROM customer WHERE customer_id = '$id'";
        $result = mysqli_query($db_connection, $sql);
        test_result($db_connection, $result);
        while ($row = mysqli_fetch_array($result)) {
            $user = $row;
        }
        mysqli_free_result($result);
        mysqli_close($db_connection);
        return $user;
    }
}

function search_customerDB($input) {
    if (strlen($input) > 2) {
        $db_connection = get_connection();
        $sql = "SELECT * FROM customer WHERE first_name LIKE '%{$input}%' "
                . "OR last_name LIKE '%{$input}%' OR email LIKE '%{$input}%'"
                . " LIMIT 20;";
        $result = mysqli_query($db_connection, $sql);
        test_result($db_connection, $result);
        while ($row = mysqli_fetch_assoc($result)) {
            $customer_id = $row['customer_id'];
            $first_name = $row['first_name'];
            $last_name = $row['last_name'];
            $email = $row['email'];
            echo "<a href='?show_pickedCustomer=$customer_id'>" . $first_name . " "
            . $last_name . " | " . $email . "</a><br>";
        }
        mysqli_free_result($result);
        mysqli_close($db_connection);
    }
}

function edit_customerDB($user) {
    $db_connection = get_connection();
    $customer_id = $_SESSION['show_pickedCustomer'];
    $old_user = $_SESSION['old_user'];
    $first = $user['first_name'];
    $last = $user['last_name'];
    $email = $user['email'];
    $phone = $user['phone'];
    $adress = $user['adress'];
    $zip = $user['zip'];
    $sql = "UPDATE customer SET first_name = '$first',last_name = '$last',"
            . " email = '$email', phone_number ='$phone', adress = "
            . "'$adress', zip_code = '$zip' WHERE customer_id = '$customer_id'";
    $result = mysqli_query($db_connection, $sql);
    test_result($db_connection, $result);
    //$_SESSION['changed'] = print_r($old_user) . " is set to : " . print_r($user);
    //mysqli_free_result($query);
    mysqli_close($db_connection);
    return true;
}

function edit_foodDB($new_value) {
    if ($new_value != "") {
        $db_connection = get_connection();
        $old_value = $_SESSION['show_pickedFood'];
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
            //mysqli_free_result($query);
            mysqli_close($db_connection);
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
            //print_r($amount_list);
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

    $sql = "SELECT r.request_id,r.adress AS adress, r.zip_code AS zip, date_event,"
            . "quantity_people, food_type, amount FROM request r "
            . "JOIN customer c ON c.customer_id = r.customer_id "
            . "JOIN request_info ri ON ri.request_id = r.request_id "
            . "JOIN catering_list cl ON cl.catering_id = ri.catering_id "
            . "WHERE c.customer_id = $user_id AND r.provider_id IS NULL";
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
    //print_r($requests);
    return $requests;
}

function show_ProvidersForRequestDB($request_id) {
    $provider_list = array();
    $db_connection = get_connection();
    $sql = "SELECT rp.provider_id,p.email FROM request_providers rp JOIN provider p "
            . "ON p.provider_id = rp.provider_id WHERE request_id = '$request_id'";
    $result = mysqli_query($db_connection, $sql);
    test_result($db_connection, $result);
    $data = mysqli_num_rows($result);
    if ($data > 0) {
        while ($row = mysqli_fetch_row($result)) {
            array_push($provider_list, $row);
        }
        print_r($provider_list);
        mysqli_free_result($result);
        mysqli_close($db_connection);
        return $provider_list;
    }
    mysqli_free_result($result);
    mysqli_close($db_connection);
}

function setProviderRequestDB($request_id, $provider_id) {
    if ($request_id && $provider_id) {
        $db_connection = get_connection();
        $sql = "UPDATE request SET provider_id = '$provider_id' "
                . "WHERE request_id = '$request_id'";
        $result = mysqli_query($db_connection, $sql);
        $sql2 = "UPDATE request_providers SET status = 1 WHERE request_id "
                . "='$request_id'";
        $result2 = mysqli_query($db_connection, $sql2);
        test_result($db_connection, $result2);
        mysqli_close($db_connection);
        return true;
    }
    return false;
}

function check_zipDB($zip) {
    if ($zip != null) {
        $db_connection = get_connection();
        $sql = "SELECT zip_code FROM zip_list WHERE zip_code = '$zip'";
        $result = mysqli_query($db_connection, $sql);
        $data = mysqli_num_rows($result);
        if ($data == 1) {
            return true;
        }
    }
    return false;
}

function get_requestsForProvider($provider_id, $zip, $limit) {
    $array = array();
    $trimZip = array();
    $zip_list = get_providers_in($zip, $limit);
    for ($i = 0; $i < count($zip_list); $i++) {
        array_push($trimZip, $zip_list[$i]);
        $i = $i + 1;
    }
    $trimZip = implode("', '", $trimZip);

    /* foreach ($zip_list as $param) {
      $placeholders[] = '?';
      }
      $sql_string = implode(', ', $placeholders);
      echo $sql_string; */

    $db_connection = get_connection();
    //$sql = "SELECT * FROM zip_list WHERE zip_code IN ('$trimZip')";
    // for($i=0; $i<count($trimZip); $i++){
    $sql = "SELECT DISTINCT r.request_id,r.date_event,r.adress, r.zip_code, quantity_people, cl.food_type,ri.amount "
            . "FROM provider p JOIN provider_info pi "
            . "ON p.provider_id = pi.provider_id INNER JOIN request r "
            . "ON r.quantity_people <= p.amount_people JOIN zip_list zl "
            . "ON r.zip_code IN ('$trimZip') "
            . "JOIN request_info ri "
            . "ON ri.request_id = r.request_id "
            . "AND pi.catering_id = ri.catering_id JOIN catering_list cl "
            . "ON cl.catering_id = ri.catering_id "
            . "WHERE p.provider_id = '$provider_id' AND r.request_id "
            . "NOT IN (SELECT request_id FROM request_providers rp "
            . "WHERE rp.provider_id = '$provider_id') ORDER BY r.request_id";
    $result = mysqli_query($db_connection, $sql);

    test_result($db_connection, $result);
    while ($row = mysqli_fetch_row($result)) {
        array_push($array, $row);
    }
    // }
    //$new_array = array_merge_recursive($array,$zip_list);
    mysqli_free_result($result);
    mysqli_close($db_connection);
    return $array;
}

function setJobOfferDB($provider_id, $request_id) {
    $db_connection = get_connection();
    if (!check_duplicateOffer($provider_id, $request_id, $db_connection)) {
        $sql = "INSERT INTO request_providers (provider_id,request_id) VALUES "
                . "('$provider_id','$request_id')";
        $result = mysqli_query($db_connection, $sql);
        mysqli_close($db_connection);
        return true;
    }
    mysqli_close($db_connection);
    return false;
}

function check_duplicateOffer($provider_id, $request_id, $db_connection) {
    $sql = "SELECT provider_id,request_id FROM request_providers WHERE "
            . "provider_id = '$provider_id' AND request_id = '$request_id'";
    $result = mysqli_query($db_connection, $sql);
    test_result($db_connection, $result);
    $data = mysqli_num_rows($result);
    mysqli_free_result($result);
    if ($data === 1) {
        return true;
    }
    return false;
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

function get_providerAppliedJobsDB($provider_id) {
    $array = array();
    $db_connection = get_connection();
    $sql = "SELECT * FROM request_providers rp JOIN request r ON r.request_id "
            . "= rp.request_id AND rp.provider_id = '$provider_id' "
            . "WHERE rp.status = 0";
    $result = mysqli_query($db_connection, $sql);
    while ($row = mysqli_fetch_row($result)) {
        array_push($array, $row);
    }
    mysqli_free_result($result);
    mysqli_close($db_connection);
    return $array;
}

function get_providers_in($zip, $limit) {
    if (strlen($zip) === 4) {
        if (check_zipDB($zip)) {
            $list = array();
            $db_connection = get_connection();
            $sql = "SELECT latitude,longitude FROM zip_list WHERE zip_code = '$zip'";
            $result1 = mysqli_query($db_connection, $sql);
            test_result($db_connection, $result1);
            while ($row = mysqli_fetch_assoc($result1)) {
                $lat = $row['latitude'];
                $lon = $row['longitude'];
            }
            mysqli_free_result($result1);

            //check radius algorithm
            $sql = "SELECT zip_code,area,municipality, "
                    . "(6371 * acos (cos ( radians('$lat') )"
                    . "* cos( radians( latitude ) )* cos( radians( longitude ) "
                    . "- radians('$lon') )+ sin ( radians('$lat') )"
                    . "* sin( radians( latitude ) ))) AS distance FROM zip_list"
                    . " HAVING distance < '$limit' ORDER BY distance;";
            $result = mysqli_query($db_connection, $sql);
            test_result($db_connection, $result);
            while ($row = mysqli_fetch_assoc($result)) {
                $zip = $row['zip_code'];
                $area = $row['area'];
                array_push($list, $zip, $area);
            }
            mysqli_free_result($result);
            mysqli_close($db_connection);
            return $list;
        }
    }
}

function getProvider_idDB($provider_name) {
    if ($provider_name != null) {
        $db_connection = get_connection();
        $sql = "SELECT provider_id FROM provider WHERE email = '$provider_name'";
        $result = mysqli_query($db_connection, $sql);
        test_result($db_connection, $result);
        $data = mysqli_num_rows($result);
        if ($data == 1) {
            while ($row = mysqli_fetch_assoc($result)) {
                $provider_id = $row['provider_id'];
            }
            mysqli_free_result($result);
            mysqli_close($db_connection);
            return $provider_id;
        }
        mysqli_free_result($result);
        mysqli_close($db_connection);
    }
}

//pre sending recovery mail
function encryptUserId($id){
    $encrypt = md5(1290*3+$id);
    return $encrypt;
}

//after receiving recovery mail
function decryptUserIdmail($encryptedId){
    $id = md5($encryptedId - 1290*3);
    return $id;
}

function decryptUserId($encrypted){
    $db_connection = get_connection();
    //$id = decryptUserId($encrypted);
    $sql = "SELECT customer_id FROM customer where md5(1290*3+customer_id)='".$encrypted."'";
        $result = mysqli_query($db_connection,$sql);
        test_result($db_connection, $result);
        $data = mysqli_fetch_array($result);
        if(count($data)>=1){
            $msg = true;
        }else{
            $msg = false;
        }
        mysqli_free_result($result);
        mysqli_close($db_connection);
        return $msg;
}

function getUserId($email) {
    $db_connection = get_connection();
    //$encrypt = "";
    $sql = "SELECT customer_id FROM customer where email='$email'";
    $result = mysqli_query($db_connection, $sql);
    //test_result($db_connection, $result);
    $data = mysqli_fetch_array($result);
    if (count($data) >=1) {
        $encrypt = encryptUserId($data['customer_id']);
    }
    mysqli_free_result($result);
    mysqli_close($db_connection);
    return $encrypt;
}

function updatePasswordUser($password, $encryptedId){
    $db_connection = get_connection();
    $sql = "update customer set password_customer='" . md5($password) . "' where md5(1290*3+customer_id)='$encryptedId'";
    $result = mysqli_query($db_connection, $sql);
    test_result($db_connection, $result);
    mysqli_close($db_connection);
    return true;
}

function sendEmail_pickedProviderDB($provider_id){
    $db_connection = get_connection();
    $sql = "SELECT * FROM request WHERE provider_id = '$provider_id' AND status "
            . "''";
}

function getZipUserDB($user_id) {
    $user_zip = "";
    $db_connection = get_connection();
    $sql = "SELECT zip FROM provider WHERE provider_id = '$user_id'";
    $result = mysqli_query($db_connection, $sql);
    test_result($db_connection, $result);
    while ($row = mysqli_fetch_assoc($result)) {
        $user_zip = $row['zip'];
    }
    mysqli_free_result($result);
    mysqli_close($db_connection);
    return $user_zip;
}

function getProviderDB($id) {
    if ($id != null) {
        $provider = array();
        $db_connection = get_connection();
        $sql = "SELECT first_name, last_name, email, phone_number,address, zip,amount_people "
                . "FROM provider WHERE provider_id = '$id'";
        $result = mysqli_query($db_connection, $sql);
        test_result($db_connection, $result);
        while ($row = mysqli_fetch_array($result)) {
            $provider = $row;
        }
        mysqli_free_result($result);
        mysqli_close($db_connection);
        return $provider;
    }
}

function search_providerDB($input) {
    if (strlen($input) > 2) {
        $db_connection = get_connection();
        $sql = "SELECT * FROM provider WHERE first_name LIKE '%{$input}%' "
                . "OR last_name LIKE '%{$input}%' OR email LIKE '%{$input}%'"
                . " LIMIT 20;";
        $result = mysqli_query($db_connection, $sql);
        test_result($db_connection, $result);
        while ($row = mysqli_fetch_assoc($result)) {
            $provider_id = $row['provider_id'];
            $first_name = $row['first_name'];
            $last_name = $row['last_name'];
            $email = $row['email'];
            echo "<a href='?show_pickedProvider=$provider_id'>" . $first_name . " "
            . $last_name . " | " . $email . "</a><br>";
        }
        mysqli_free_result($result);
        mysqli_close($db_connection);
    }
}

function insert_requestDB($request) {
    $adress = $request['adress'];
    $zip = $request['zip'];
    $date = $request['date'];
    $quantity = $request['quantity'];
    $status = $request['status'];
    $customer_id = $request['customer_id'];
    $provider_id = $request['provider_id'];
    $food_list = $request['food_list'];
    $amount_list = $request['output_amount'];

    $db_connection = get_connection();
    if (!check_duplicate_request($adress, $customer_id)) {
        $sql = "INSERT INTO request (adress, zip_code,date_event,"
                . "quantity_people,customer_id,provider_id) "
                . "VALUES ('$adress','$zip','$date','$quantity',"
                . "'$customer_id','$provider_id')";
        $result = mysqli_query($db_connection, $sql);
        //test_input($result);

        $request_id = find_request_id($db_connection, $customer_id, $adress);
        insert_request_info($db_connection, $food_list, $amount_list, $request_id);
    }
    //mysqli_free_result($result);
    mysqli_close($db_connection);
}
