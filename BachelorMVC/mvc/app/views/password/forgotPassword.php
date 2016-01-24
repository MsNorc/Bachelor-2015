<?php
/*include 'db/mysqli_connect.php';
include 'mailsender.php';*/
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
            //$msg = "recovery mail sent to : " . $email;
            echo "recovery mail sent to : " . $email;
        }else{
            //$msg = "something went wrong, try again..";
            echo "something went wrong, try again..";
        }
        
    }
}

if (isset($_GET['url'])) {
            ( $url = explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL)));
        }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>forgot password</title>

        <?php

        ?>
    </head>
    <body>
        <form method="post" action="<?php echo htmlspecialchars($url[0]); ?>">
            <div>
                <input type="text" placeholder="your@email.com" name="email">
                <input type="submit" value="send">
            </div>
        </form>
    </body>
</html>
