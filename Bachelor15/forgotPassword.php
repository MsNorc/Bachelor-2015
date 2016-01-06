<?php
include 'db/mysqli_connect.php';
include 'mailsender.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //echo "test";
    //echo $_POST['email'];
    $email = filter_input(INPUT_POST, 'email');
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = "Invalid email address please type a valid email!!";
    } else {
        $encryptedEmail = getUserId($email);
        //echo "this ".$encryptedEmail;
        if ($encryptedEmail == true) {
            sendRecoveryMail($email, $encryptedEmail);
            echo "recovery mail sent to : " . $email;
        }else{
            echo "something went wrong, try again..";
        }
        
    }
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>forgot password</title>

        <?php
        include 'layout/header.php';
        ?>
    </head>
    <body>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div>
                <input type="text" placeholder="your@email.com" name="email">
                <input type="submit" value="send">
            </div>
        </form>
    </body>
</html>
