<?php

//include ('/db/config_db.php');

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

//insert functions
function insert_foodDB($food_type) {
    $db_connection = get_connection();
    $sql = "INSERT INTO catering_list (food_type) VALUES('$food_type')";
    $result = mysqli_query($db_connection, $sql);

    if (!$result) {
        echo "DB Error, could not query the database\n";
        echo 'MySQL Error: ' . mysqli_error($db_connection);
        exit;
    }
}

function insert_userDB($user) {
    $db_connection = get_connection();

    $first_name = $user[0];
    $last_name = $user[1];
    $email = $user[2];
    $phone = $user[3];

    $sql = "INSERT INTO customer (first_name, last_name, email, phone_number) "
            . "VALUES ('$first_name', '$last_name', '$email', '$phone')";

    $result = mysqli_query($db_connection, $sql);

    if (!$result) {
        echo "DB Error, could not query the database\n";
        echo 'MySQL Error: ' . mysqli_error($db_connection);
        exit;
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
}

function search_FoodDB($input){
    if (!empty($input)) {
        $con = get_connection();
        //$sql = "SELECT * FROM catering_list";
        $sql = "SELECT food_type FROM catering_list WHERE food_type LIKE '%{$input}%'";
        $query = mysqli_query($con, $sql);

        while ($row = mysqli_fetch_assoc($query)) {
            $output = $row['food_type'];
            echo "<a href='?show_picked=$output'>" . $output . "</a>";
            echo "<br>";
        }
    }
    return false;
}
