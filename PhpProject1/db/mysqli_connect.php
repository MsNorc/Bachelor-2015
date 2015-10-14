<?php

include 'db/config_db.php';


function insert_user($db_connection) {
    $sql = 'INSERT INTO test (test1, test2) 
	VALUES (2, 4)';
    $result = mysqli_query($db_connection, $sql);

    if (!$result) {
        echo "DB Error, could not query the database\n";
        echo 'MySQL Error: ' . mysqli_error($db_connection);
        exit;
    }
}

function get_connection(){  //annen måte å gjøre dette på ??
    global $db_connection;
    return $db_connection;
}

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

    mysqli_free_result($result);
    mysqli_close($db_connection);
}

function select_common_dishes(){
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

//select_common_dishes();







