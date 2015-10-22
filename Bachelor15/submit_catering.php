<?php
if (!isset($_SESSION)) {
    session_start();
}

//include 'db/mysqli_connect.php';

$adress_event = $_SESSION['adress_event'];
$zip_code = $_SESSION['zip_code'];
$date_picked = $_SESSION['date_picked'];
$quantity_people = $_SESSION['quantity_people'];


//echo "food picked...";
/* if (isset($_SESSION['displayed'])) {
  $output = $_SESSION['displayed'];
  for ($i = 0; $i < count($output); $i++) {
  echo $output[$i];
  echo "<br>";
  }
  } */
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>catering request</title>
    </head>
    <body>
        <h3>your info..</h3>
        <div>
            <a><label>adress:</label>
                <?php echo $adress_event ?>
            </a>
        </div>
        <div>
            <a><label>zip:</label>
                <?php echo $zip_code ?>
            </a>
        </div>
        <div>
            <a><label>date:</label>
                <?php echo $date_picked ?>
            </a>
        </div>
        <div>
            <a><label>people:</label>
                <?php echo $quantity_people ?>
            </a>
        </div>
        <div>
            <label>items:</label>
            <ul>
                <?php
                if (isset($_SESSION['displayed'])):
                    $output = $_SESSION['displayed'];
                    for ($i = 0; $i < count($output); $i++) :
                        ?>
                        <li><?php echo $output[$i]; ?></li>
                        <?php
                    endfor;
                endif;
                ?>
            </ul>
        </div>
        <div>
            is this info correct ? 
            <input type="button" value="ok">
        </div>
    </body>
</html>

<?php
$request_array = array();
$request_array['adress'] = $adress_event;
$request_array['zip'] = $zip_code;
$request_array['date'] = $date_picked;
$request_array['amount'] = $quantity_people;
$request_array['food_list'] = $output;

//array_push($request_array, $adress_event, $zip_code, $date_picked, $quantity_people);
//array_push($request_array, $output);
print_r($request_array);

/* for ($i = 0; $i < count($request_array); $i++) {
  $limit = 4;
  if ($i != 4) {
  echo "<br>";
  echo $request_array[$i];
  } else {
  for ($y = 0; $y < count($request_array[$i]); $y++) {
  echo "<br>";
  echo $request_array[$i][$y];
  }
  }
  } */
?>
