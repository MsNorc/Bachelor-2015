<html>
    <head>
        <script>
            function disableIdInput() {
                document.getElementById("businessId").disabled = true;
            }
            function enableIdInput() {
                document.getElementById("businessId").disabled = false;
            }
        </script>
        <style>
            .error {color: #FF0000;}
        </style></head>
    <body>
        <?php
     if (isset($_GET['url'])) {
            ( $url = explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL)));
        }

        function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

// define variables and set to empty values
        $user_nameErr = $passwordErr = $cpasswordErr = $emailErr = $phoneErr = $zip_codeErr = $tagErr = $business_IdErr = "";
        $user_name = $password = $cpassword = $email = $phone = $zip_code = $tag = $business_Id = "";

        //Username validation
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (empty($_POST["user_name"])) {
                $user_nameErr = userName_blank;
            }

            if (NULL !=($_POST["password"]) && ($_POST["password"] == $_POST["cpassword"])) {
                $passwordErr = $cpasswordErr = least8signs;
            } else {
                $password = test_input($_POST["password"]);
                $cpassword = test_input($_POST["cpassword"]);
                if (strlen($_POST["password"]) <= '8') {
                    $passwordErr = least8signs;
                } elseif (!preg_match("#[0-9]+#", $password)) {
                    $passwordErr = least1number;
                } elseif (!preg_match("#[A-Z]+#", $password)) {
                    $passwordErr = least1bigLetter;
                } elseif (!preg_match("#[a-z]+#", $password)) {
                    $passwordErr = least1tinyLetter;
                } else if ($password != $cpassword) {
                    $cpasswordErr = passwordNotMatch;
                }
            }

            //E-mail validation
            if (NULL !=($_POST["email"])) {
                $emailErr = email_blank;
            } else {
                $email = test_input($_POST["email"]);
                // check if e-mail address is well-formed
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $emailErr = invalidEmail;
                }
            }

            //Phone Validation

                $phone = test_input($_POST["phone"]);
                $phone = preg_replace("/[^0-9]/", '', $phone);

                // check phone number length
                if (strlen($phone) != 8 || strlen($phone) != 0) {
                    $phoneErr = max8Values_Error;
                }
                // check if phone number is valid
                else if (!filter_var($phone, FILTER_VALIDATE_INT)) {
                    $phoneErr = invalidNumber;
                }

            /* Zip_code validation
              if (empty($_POST["zip_code"])) {
              $zip_codeErr = blank;
              } else {
              $zip_code = test_input($_POST["zip_code"]);
              $zip_code = preg_replace("/[^0-9]/", '', $zipCode);

              // check zip code length
              if (strlen($zip_code) != 4) {
              $zip_codeErr = max4Values_Error;
              }
              } */

            if (NULL !=($_POST["tag"])) {
                $tagErr = none;
            } else {
                $tag = test_input($_POST["tag"]);
            }

            if (NULL !=($_POST["businessId"])) {
                $business_IdErr = businessId_blank;
            } else {

                $business_Id = test_input($_POST["businessId"]);
                $business_Id = preg_replace("/[^0-9]/", '', $business_Id);

                // check phone number length
                if (strlen($business_Id) != 9) {
                    $business_IdErr = max9Values_Error;
                }
                // check if phone number contains letters and or signs
                else if (!filter_var($business_Id, FILTER_VALIDATE_INT)) {
                    $business_IdErr = invalidNumber;
                }
            }



            /*            if (isset($_POST['g-recaptcha-response']) && $_POST['g-recaptcha-response']) {
              $secret = "6Levlg8TAAAAALG8kxIJ-XuybQ14pgsQrp5C6BlA";
              $ip = $_SERVER['REMOTE_ADDR'];
              $captcha = $_POST['g-recaptcha-response'];
              $rsp = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$captcha&remoteip$ip");
              $arr = json_decode($rsp, TRUE);
              if ($arr['success']) {
              echo 'Done';
              } else {
              echo 'Failed';
              }
              }
              } */

//insert a captha check here before using this method
            if ($user_nameErr == "" && $passwordErr == "" && $cpasswordErr == "" && $emailErr == "" && $phoneErr == "" && $tagErr == "") {
               /* if ($tag == "private") {
                    echo "sucsess";
                } else if ($tag == "business" && $business_IdErr == "") {
                    echo "business sucsess";
                }*/
                echo "sucsess";
                
                $user = array("first_name" => $user_name,  "password" => $password , "email" => $email, "phone" => $phone);
                insert_userDB($user);
                
            } else {
                echo "form does not satisfy";
            }
        }
        ?>
        <h1><?php echo register_label ?></h1><br>
        <p><span class="error">* required fields.</span></p>
        <form method="post" action="<?php echo htmlspecialchars($url[0]); ?>"> 

            <!--User name-->
            <?php echo userName_label ?>:
            <input type="text" name="user_name" value="<?php echo $user_name; ?>">
            <span class="error">* <?php echo $user_nameErr; ?></span>
            <br><br>

            <!--Password-->
            <?php echo password_label ?>
            <input type="password" name="password" value="<?php echo $password ?>">
            <span class="error">*<?php echo $passwordErr; ?></span>
            <br><br>

            <?php echo cpassword_label ?>
            <input type="password" name="cpassword" value="<?php echo $cpassword ?>">
            <span class="error">*<?php echo $cpasswordErr; ?></span>
            <br><br>

            <!--E-mail-->
            <?php echo email_label ?>: 
            <input type="text" name="email" value="<?php echo $email; ?>">
            <span class="error">* <?php echo $emailErr; ?></span>
            <br><br>
                
            <!--Phone-->
            <?php echo phone_label ?>: 
            <input type="text" name="phone" value="<?php echo $phone; ?>">
            <span class="error"> <?php echo $phoneErr; ?></span>
            <br><br>

            <!-- User tag -->
            <!--
            <?php echo userTag_label ?>
            <br>
            <input type="radio" name="tag" value="private" onclick="disableIdInput()"> <?php echo privat_label ?>
            <input type="radio" name="tag" value="business" onclick="enableIdInput()"> <?php echo business_label ?>
            <span class="error">* <?php echo $tagErr; ?></span>
            <br><br>
            -->
            
            <!-- Business Id -->
            <!--
            <?php echo businessId_label ?>
            <input type="text" id="businessId" name="businessId" value="<?php echo $business_Id; ?>" disabled=""> 
            <span class="error">* <?php echo $business_IdErr; ?></span>
            <br><br>
            -->
            
            <!--Adresse-->
            <!--
            <?php echo address_label ?>: <input type="text" name="adresse"><br><br>
            
            <?php echo zipCode_label ?>: 
                        <input type="text" name="zip_code" value="<?php echo $zip_code; ?>">
                        <span class="error"> <?php echo $zip_codeErr; ?></span><br><br>
            
            <?php echo city_label ?>: <input type="text" name ="city"><br><br>      
            -->

            <script src="https://www.google.com/recaptcha/api.js" async defer></script>
            <div class="g-recaptcha" data-sitekey="6Levlg8TAAAAALG8kxIJ-XuybQ14pgsQrp5C6BlA" data-theme="dark"></div>
            <script src="grecaptcha.getResponse(opt_widget_id)"></script>
            <script src="grecaptcha.reset(opt_widget_id)"></script>
            <br/>
            <input type="submit" value="Submit">
        </form>
    </body>
</html>