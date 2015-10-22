<?php
function get_connection(){
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

$output = select_common_dishes();
for ($i = 0; $i < count($output); $i++) {
    echo $output[$i];
    echo "<br>";
}
