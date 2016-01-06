<?php
if (!isset($_SESSION)) {
    session_start();
}

include 'catering_populate_view.php';
//include 'layout/header.php';

$adress_event = $_SESSION['adress_event'];
$zip_code = $_SESSION['zip_code'];
$date_picked = $_SESSION['date_picked'];
$quantity_people = $_SESSION['quantity_people'];
$output = $_SESSION['displayed'];
$output_amount = $_SESSION['amount'];

$request_array = array();
$request_array['adress'] = $adress_event;
$request_array['zip'] = $zip_code;
$request_array['date'] = $date_picked;
$request_array['amount'] = $quantity_people;
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

        <?php include 'layout/header.php' ?>
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script>
            $(document).ready(function () {
                $("#submit_catering").click(function () {
                    alert("success..");
                    window.setTimeout(function () {
                        window.location = 'index.php'
                    }, 1000);
                });

            });

        </script>
    </head>
    <body>
        <form method = "post" action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
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
                            <li><?php echo $output[$i] . " : " . $output_amount[$output[$i]]; ?>

                                <?php
                            endfor;
                        endif;
                        ?>
                </ul>
            </div>
            <div>
                is this info correct ? 
                <input type="submit" id="submit_catering" value="ok">
            </div>
        </form>
    </body>
</html>

<?php
if (make_request($request_array)) {
    echo "success..";
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
