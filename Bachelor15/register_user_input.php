<html>
    <head><style>
            .error {color: #FF0000;}
        </style></head>
    <body>
        <?php
        include 'layout/header.php';
        include 'db/mysqli_connect.php';

        function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

// define variables and set to empty values
        $first_nameErr = $last_nameErr = $emailErr = $phoneErr = $zip_codeErr = "";
        $first_name = $last_name = $email = $phone = $zip_code = "";

        //Firstname validation
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (empty($_POST["first_name"])) {
                $first_nameErr = firstName_blank;
            } else {
                $first_name = test_input($_POST["first_name"]);
                // check if name only contains letters and whitespace
                if (!preg_match("/^[a-zA-Z ]*$/", $first_name)) {
                    $first_nameErr = invalidName;
                }
            }
        }

        //Lastname validation
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (empty($_POST["last_name"])) {
                $last_nameErr = lastName_blank;
            } else {
                $last_name = test_input($_POST["last_name"]);
                // check if name only contains letters and whitespace
                if (!preg_match("/^[a-zA-Z ]*$/", $last_name)) {
                    $last_nameErr = invalidName;
                }
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
            <!--First name-->
            <?php echo firstName_label ?>:
            <input type="text" name="first_name" value="<?php echo $first_name; ?>">
            <span class="error">* <?php echo $first_nameErr; ?></span>
            <br><br>

            <!--Last name-->
            <?php echo lastName_label ?>:
            <input type="text" name="last_name" value="<?php echo $last_name; ?>">
            <span class="error">* <?php echo $last_nameErr; ?></span>
            <br><br>

            <!--E-mail-->
            <?php echo email_label ?>: 
            <input type="text" name="email" value="<?php echo $email; ?>">
            <span class="error">* <?php echo $emailErr; ?></span>
            <br><br>

            <?php echo phone_label ?>: 
            <input type="text" name="phone" value="<?php echo $phone; ?>">
            <span class="error">* <?php echo $phoneErr; ?></span>
            <br><br>


            <!-- User adress
            <?php echo adresse_label ?>: <input type="text" name="adresse"><br><br>
            
            <?php echo zipCode_label ?>: 
                        <input type="text" name="zip_code" value="<?php echo $zip_code; ?>">
                        <span class="error"> <?php echo $zip_codeErr; ?></span><br><br>
            
            <?php echo city_label ?>: <input type="text" name ="city"><br><br>
            -->
            <script src="https://www.google.com/recaptcha/api.js" async defer></script>
            <div class="g-recaptcha" data-sitekey="6Levlg8TAAAAALG8kxIJ-XuybQ14pgsQrp5C6BlA"></div>
            <script src="grecaptcha.getResponse(opt_widget_id)"></script>
            <script src="grecaptcha.reset(opt_widget_id)"></script>
            <br/>
            <input type="submit" value="Submit">
        </form>

        <?php
        $user = array("first_name" => $first_name, "last_name" => $last_name, "email" => $email, "phone" => $phone);

        if ($first_nameErr == "" && $last_nameErr == "" && $emailErr == "" && $phoneErr == "" && $first_name != "" && $last_name != "" && $email != "" && $phone != "") {
            echo finished_label;
        }
        ?>
    </body>
</html>