<html>
    <head><style>
            .error {color: #FF0000;}
        </style></head>
    <body>
        <?php
        include '/layout/header.php';
        include '/db/mysqli_connect.php';

        function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

// define variables and set to empty values
        $provider_nameErr = "";
        $provider_name = "";

        //Provider name validation
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (empty($_POST["provider_name"])) {
                $provider_nameErr = firstName_blank;
            }
        }

        //E-mail validation
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (empty($_POST["email"])) {
                $emailErr = email_blank;
            } else {
                $email = test_input($_POST["email"]);
                // check if e-mail address is well-formed
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $emailErr = invalidEmail;
                }
            }
        }

        //Phone Validation
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (empty($_POST["phone"])) {
                $phoneErr = number_blank;
            } else {

                $phone = test_input($_POST["phone"]);
                $phone = preg_replace("/[^0-9]/", '', $phone);

                // check phone number length
                if (strlen($phone) != 8) {
                    $phoneErr = max8Values_Error;
                }
                // check if phone number is valid
                else if (!filter_var($phone, FILTER_VALIDATE_INT)) {
                    $phoneErr = invalidNumber;
                }
            }
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (empty($_POST["zip_code"])) {
                $zip_codeErr = blank;
            } else {
                $zip_code = test_input($_POST["zip_code"]);
                $zip_code = preg_replace("/[^0-9]/", '', $zipCode);

                // check zip code length
                if (strlen($zip_code) != 4) {
                    $zip_codeErr = max4Values_Error;
                }
            }
        }
        ?>
        <h1><?php echo register_label ?></h1><br>
        <p><span class="error">* required field.</span></p>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"> 
            <!--Provider name-->
            <?php echo provider_label ?>:
            <input type="text" name="provider_name" value="<?php echo $provider_name; ?>">
            <span class="error">* <?php echo $provider_nameErr; ?></span>
            <br><br>
            
            <?php echo service_label ?>:
            <input type="radio" name="sevice_type" value="sound">
            <input type="radio" name="sevice_type" value="picture">
            <input type="radio" name="sevice_type" value="both">
            
            <!--E-mail-->
            <?php echo email_label ?>: 
            <input type="text" name="email" value="<?php echo $email; ?>">
            <span class="error">* <?php echo $emailErr; ?></span>
            <br><br>
            
            <!--Phone-->
            <?php echo phone_label ?>: 
            <input type="text" name="phone" value="<?php echo $phone; ?>">
            <span class="error">* <?php echo $phoneErr; ?></span>
            <br><br>


            <!-- User adress-->
            <?php echo adresse_label ?>: <input type="text" name="adresse"><br><br>
            
            <?php echo zipCode_label ?>: 
                        <input type="text" name="zip_code" value="<?php echo $zip_code; ?>">
                        <span class="error"> <?php echo $zip_codeErr; ?></span><br><br>
            
            <?php echo city_label ?>: <input type="text" name ="city"><br><br>            
            <br/>
            <input type="submit" value="Submit">
        </form>