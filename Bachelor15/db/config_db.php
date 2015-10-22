<?php

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

