<?php
session_start();

$adress_event = $_SESSION['adress_event'];
$zip_code = $_SESSION['zip_code'];
$date_picked = $_SESSION['date_picked'];
$quantity_people = $_SESSION['quantity_people'];
echo $adress_event;
echo "<br>";
echo $zip_code;
echo "<br>";
echo $date_picked;
echo "<br>";
echo $quantity_people;
echo "<br>";
?>
