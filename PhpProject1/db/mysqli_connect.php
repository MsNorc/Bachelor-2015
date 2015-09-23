<?php

include 'db/config_db.php';

function insertTest($db_connection) {
    $sql = 'INSERT INTO test (test1, test2) 
	VALUES (2, 4)';
    $result = mysqli_query($db_connection, $sql);

    if (!$result) {
        echo "DB Error, could not query the database\n";
        echo 'MySQL Error: ' . mysqli_error();
        exit;
    }
}

function selectTest($db_connection) {
    $sql = 'SELECT test1 FROM test WHERE test2 = 3';
    $result = mysqli_query($db_connection, $sql);

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
}

//insertTest($db_connection); **WORKS*
selectTest($db_connection);


mysqli_close($db_connection);



