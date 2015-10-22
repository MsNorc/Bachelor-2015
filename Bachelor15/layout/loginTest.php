<?php

if (!isset($_SESSION)) {
    session_start();
}

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
$output = "please insert your credentials..";
if (isset($_POST['email1'], $_POST['password1'])) {
    $email = $_POST['email1']; // Fetching Values from URL.
    $password = ($_POST['password1']); // Password Encryption, If you like you can also leave sha1.

    $email = filter_var($email, FILTER_SANITIZE_EMAIL); // sanitizing email(Remove unexpected symbol like <,>,?,#,!, etc.)
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $output = "invalid email..";
    } else {

        $sql = ("SELECT email, password_customer FROM customer where email = '$email' AND password_customer = '$password'");
        $result = mysqli_query($db_connection, $sql);
        //$data = mysql_num_rows($result);
        $data = mysqli_num_rows($result);
        if ($data == 1) {
            $output = "logged in..";
            $_SESSION['user'] = $email;
        } else {
            $output = "email or pw wrong..";
        }
    }
}


echo $output;
mysqli_close($db_connection); // Connection Closed.
?>

