<?php
if (!isset($_SESSION)) {
    session_start();
}

//include 'controllers/catering_controller.php';
//include 'layout/header.php';

$adress_event = $_SESSION['adress_event'];
$zip_code = $_SESSION['zip_code'];
$date_picked = $_SESSION['date_picked'];
//$quantity_people = $_SESSION['quantity_people'];
$output = $_SESSION['displayed'];
$output_amount = $_SESSION['amount'];

$request_array = array();
$request_array['adress'] = $adress_event;
$request_array['zip'] = $zip_code;
$request_array['date'] = $date_picked;
//$request_array['amount'] = $quantity_people;
$request_array['food_list'] = $output;
$request_array['amount_list'] = $output_amount;
//print_r($output_amount);
//print_r($request_array);
//function send_request($request_array){
//print_r(make_request($request_array));
//include 'db/mysqli_connect.php';
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

        <?php //include 'layout/header.php' ?>
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script>
            $(document).ready(function () {
                $("#submit_catering").click(function () {
                    //alert("what");
                    location.replace('home');

                });

            });

<?php
if (isset($_GET['url'])) {
    ( $url = explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL)));
}
?>

        </script>
    </head>
    <body>

        <form method = "post" action = "<?php echo htmlspecialchars($url[1]); ?>">

            <div id="summary">
                <h3><?php echo summary_label ?></h3>
                <div>
                    <a><label><?php echo adress_label . ": " ?></label>
<?php echo $adress_event ?>
                    </a>
                </div>
                <div>
                    <a><label><?php echo zipCode_label . ": " ?></label>
<?php echo $zip_code ?>
                    </a>
                </div>
                <div>
                    <a><label><?php echo date_label . ": " ?></label>
<?php echo $date_picked ?>
                    </a>
                </div>
                <!-- quantity
                <div>
                    <a><label>people:</label>
<?php //echo $quantity_people   ?>
                    </a>
                </div>-->
                <div>
                    <label><?php item_label ?></label>
                    <ul>
<?php
if (isset($_SESSION['displayed'])):
    $sumDishes = 0;
    $output = $_SESSION['displayed'];
    for ($i = 0; $i < count($output); $i++) :
        ?>
                                <li><?php echo $output[$i] . " : " . $output_amount[$output[$i]]; ?></li>
                                <?php $sumDishes+=$output_amount[$output[$i]]; ?>
                                <?php
                            endfor;
                        endif;
                        ?>
                    </ul>
                    <div><?php echo combined_amount . " : " . $sumDishes ?></div>
                </div><br>
                <div>
<?php echo correct_info ?> 
                    <input type="submit" id="submit_catering" value="ok">
                </div>
            </div>
        </form>
    </body>
</html>

<?php
$request_array['amount'] = $sumDishes;
//print_r($request_array);
if (make_request($request_array)) {
    echo "success, you created an event!";
} else {
    //echo "Something went wrong..Try again!";
}
//send request to db handler ..
//make_request($request_array);



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
