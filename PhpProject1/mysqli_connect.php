<?php

$db_host = "db.stud.aitel.hist.no";
$db_user = "chrin";
$db_password = "UZGVCsew";
$db_name = "chrin";

$link = mysqli_connect($db_host, $db_user, $db_password, $db_name)
        or die("Could not connect");

        
//test queries
if (!mysqli_select_db($link, $db_name)) {
    echo 'Could not select database';
    exit;
}

$sql    = 'SELECT test1 FROM test WHERE test2 = 3';
$result = mysqli_query($link, $sql);

if (!$result) {
    echo "DB Error, could not query the database\n";
    echo 'MySQL Error: ' . mysqli_error();
    exit;
}

while ($row = mysqli_fetch_assoc($result)) {
    echo "fetched from database .. ";
    echo $row['test1'];
}

mysqli_free_result($result);

mysqli_close($link);



