
<?php

include 'excel_reader.php';       // include the class
$excel = new PhpExcelReader;      // creates object instance of the class
$excel->read('postnummerxls.xls');   // reads and stores the excel file data

function getConnection() {
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

function insertIntoDB($zip_code, $area, $municipality,$county, $lat,$lon) {
    $db_connection = getConnection();
    //echo "insert: " . $zip_code . " " . $area . " " . $municipality . "<br>";
    $sql = "INSERT INTO zip_list (zip_code, area, municipality, county, latitude,longitude) 
	VALUES ('$zip_code', '$area', '$municipality','$county','$lat',$lon)";
    $result = mysqli_query($db_connection, $sql);

    //test_result($db_connection, $result);
    mysqli_close($db_connection);
}

// Test to see the excel data stored in $sheets property
echo '<pre>';
$array = /* var_export */($excel->sheets);
//echo $array[0]['cells'][1][1];
//print_r($array);

/* $db_connection = mysqli_connect($db_host, $db_user, $db_password, $db_name)
  or die("Could not connect");
  if (!mysqli_select_db($db_connection, $db_name)) {
  echo 'Could not select database';
  exit;
  } */

for ($i = 2; $i < 4819; $i++) {
    //for ($x = 1; $x < 4; $x++) {
    //echo $array[0]['cells'][$i][$x]." ";
    $zip_code = $array[0]['cells'][$i][1];
    $area = $array[0]['cells'][$i][2];
    $municipality = $array[0]['cells'][$i][3];
    $county = $array[0]['cells'][$i][4];
    $lat = $array[0]['cells'][$i][5];
    $lon = $array[0]['cells'][$i][6];
    
    echo $zip_code."<br>";
    echo $area."<br>";
    echo $municipality."<br>";
    echo $county."<br>";
    echo $lat."<br>";
    echo $lon."<br>";
    echo "<br>";

    insertIntoDB($zip_code, $area, $municipality,$county,$lat,$lon);
  //  echo $zip_code . " " . $area . " " . $municipality . "<br>";
}

//mysqli_close($db_connection);
echo "completed..";

//print_r($array);
echo '</pre>';
