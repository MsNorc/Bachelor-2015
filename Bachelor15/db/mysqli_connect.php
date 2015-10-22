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

//select provider / catering
function select_provider($provider_id) { //WORKS!! :D
    $db_connection = get_connection();
    $sql = "SELECT first_name FROM provider WHERE provider_id = '$provider_id'";
    $result = mysqli_query($db_connection, $sql);

    if (!$result) {
        echo "DB Error, could not query the database\n";
        echo 'MySQL Error: ' . mysqli_error($db_connection);
        exit;
    }

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
    if (!$result) {
        echo "DB Error, could not query the database\n";
        echo 'MySQL Error: ' . mysqli_error($db_connection);
        exit;
    }

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

        if (!$result) {
            echo "DB Error, could not query the database\n";
            echo 'MySQL Error: ' . mysqli_error($db_connection);
            exit;
        }
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

        if (!$result) {
            echo "DB Error, could not query the database\n";
            echo 'MySQL Error: ' . mysqli_error($db_connection);
            exit;
        }
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

    if (!$result) {
        echo "DB Error, could not query the database\n";
        echo 'MySQL Error: ' . mysqli_error($db_connection);
        exit;
    }
    mysqli_free_result($result);
    mysqli_close($db_connection);
}

//display list of food from DB - search 
function search_FoodDB($input) {

    if ($input != "") {
        $db_connection = get_connection();
        $sql = "SELECT food_type FROM catering_list WHERE food_type LIKE '%{$input}%'";
        $query = mysqli_query($db_connection, $sql);

        while ($row = mysqli_fetch_assoc($query)) {
            $output = $row['food_type'];
            echo "<a href='?show_picked=$output'>" . $output . "</a>";
            echo "<br>";
        }
        mysqli_free_result($query);
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
            $_SESSION['changed'] = $old_value ." is set to : ". $new_value;
            return true;
        }
        mysqli_free_result($query);
        mysqli_close($db_connection);
    }
    return false;
}