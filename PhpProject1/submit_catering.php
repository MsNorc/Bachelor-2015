<?php
session_start();
//include 'db/mysqli_connect.php';

$adress_event = $_SESSION['adress_event'];
$zip_code = $_SESSION['zip_code'];
$date_picked = $_SESSION['date_picked'];
$quantity_people = $_SESSION['quantity_people'];


//echo "food picked...";
if (isset($_SESSION['displayed'])) {
    $output = $_SESSION['displayed'];
    for ($i = 0; $i < count($output); $i++) {
        echo $output[$i];
        echo "<br>";
    }
}
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>catering request</title>
    </head>
    <body>
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
            <?php
            if (isset($_SESSION['displayed'])):
                $output = $_SESSION['displayed'];
                for ($i = 0; $i < count($output); $i++) :
                    ?>
                    <div><?php echo $output[$i]; ?></div>
                    <?php
                endfor;
            endif;
            ?>
        </div>
    </body>
</html>

<?php
$request_array = array();
array_push($request_array, $adress_event, $zip_code, $date_picked, $quantity_people);
array_push($request_array, $output);
print_r($request_array);

for ($i = 0; $i < count($request_array); $i++) {
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
}
?>
