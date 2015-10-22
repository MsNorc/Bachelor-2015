<?php

$db_host = "db.stud.aitel.hist.no";
$db_user = "chrin";
$db_password = "UZGVCsew";
$db_name = "chrin";

$con = mysqli_connect($db_host, $db_user, $db_password, $db_name)
        or die("Could not connect");
if (!mysqli_select_db($con, $db_name)) {
    echo 'Could not select database';
    exit;
}

if(isset($_POST['partial_food'])) {
    $partial_foodList = $_POST['partial_food'];
    if (!empty($partial_foodList)) {
        $sql = "SELECT food_type FROM catering_list WHERE food_type LIKE '%{$partial_foodList}%'";
        $query = mysqli_query($con, $sql);

        while ($row = mysqli_fetch_assoc($query)) {
            $output = $row['food_type'];
            echo "<a href='?show_picked=$output'>" . $output . "</a>";
            echo "<br>";
        }
    }
}


//echo json_encode($array);
?>

