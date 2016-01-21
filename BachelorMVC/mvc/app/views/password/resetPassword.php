<?php
//include 'db/mysqli_connect.php';

if (isset($_GET['action'])) {
    //echo "action<br>";
    if ($_GET['action'] == "reset") {
        //echo "action-reset<br>";
        $encrypted = filter_input(INPUT_GET, 'encrypt');
        if (!decryptUserId($encrypted)) {
            echo "decrypt/something went wrong..";
        } else {
            ?>
            <!DOCTYPE html>
            <html>
                <head>
                    <?php include 'layout/header.php'?>
                    <meta charset="UTF-8">
                    <title>password recovery</title>
                    
                    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
                    <script>
                        $(document).ready(function () {
                            $("#reset").click(function () {
                                var pass1 = $("#password1").val();
                                var pass2 = $("#password2").val();
     
                                if (pass1 != pass2)
                                {
                                    alert("Passwords do not match");
                                    return false;
                                }
                                else
                                {
                                    alert("suc");
                                    window.location = 'home';
                                    $("#submitForm").submit();
                                    
                                }
                            });
                        });
                    </script>
                </head>
                <body>
                    <form method = "post" id="submitForm" action = "<?php echo htmlspecialchars($url[0]); ?>">
                     
                       <input type="hidden" name="encrypted" value="<?php echo $encrypted ?>">
                        <input type="text" name="password" placeholder="new password" id="password1"><br>
                        <input type="text" placeholder="repeat new password" id="password2"><br>
                        <input type="button" value="reset" id="reset">
                    </form>
                </body>
            </html>
            <?php
        }
    }
} if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //echo "post action";
    $encrypted = filter_input(INPUT_POST, 'encrypted');
    $password = filter_input(INPUT_POST, 'password');
    //echo $password . " what";
    if (decryptUserId($encrypted)) {

        //echo "password " . $password;
        if (updatePasswordUser($password, $encrypted)) {
            echo "success<br>Password updated..";
            
        } else {
            echo "something went wrong reseting your pw..";
        }
    }
}

?>


