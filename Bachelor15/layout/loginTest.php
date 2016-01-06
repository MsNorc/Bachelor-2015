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

        $sql = ("SELECT email, password_customer, customer_id FROM customer where "
                . "email = '$email' AND password_customer =  md5('$password') ");
        $result = mysqli_query($db_connection, $sql);
        //$data = mysql_num_rows($result);
        $data = mysqli_num_rows($result);

        if ($data == 1) {
            $output = "success..";
            $_SESSION['user'] = $email;
            while ($row = mysqli_fetch_assoc($result)) {
                $_SESSION['user_id'] = $row["customer_id"];
                $_SESSION['dropdown'] = 0;
            }
        } else {
            $sql = ("SELECT email, password, provider_id FROM provider where "
                    . "email = '$email' AND password = '$password' ");
            $result = mysqli_query($db_connection, $sql);
            $data = mysqli_num_rows($result);
            if ($data == 1) {
                $output = "success..";
                $_SESSION['user'] = $email;
                while ($row = mysqli_fetch_assoc($result)) {
                    $_SESSION['user_id'] = $row["provider_id"];
                    $_SESSION['user_type'] = "provider";
                    $_SESSION['dropdown'] = 0;
                }
            }else{
                $output = "email or pw wrong..";
            }
            
        }
    }
}


echo $output;
mysqli_free_result($result);
mysqli_close($db_connection); // Connection Closed.
?>

