<html>
    <head><style>
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
        $business_nameErr = $passwordErr = $cpasswordErr = $business_IdErr = $emailErr = $phoneErr = $web_pageErr = $serviceErr = "";
        $business_name = $password = $cpassword = $business_Id = $email = $phone = $web_page = $service = "";

        //define empty address values
        $addressErr = $zip_codeErr = $cityErr = "";
        $address = $zip_code = $city = "";

        //Buisnessname validation
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (NULL !=($_POST["business_name"])) {
                $business_nameErr = businessName_blank;
            }

            if (NULL !=($_POST["password"]) && ($_POST["password"] == $_POST["cpassword"])) {
                $passwordErr = least8signs;
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
                } elseif ($password != $cpassword) {
                    $cpasswordErr = passwordNotMatch;
                }
            }

            //E-mail validation
            if (NULL !=($_POST["email"])) {
                $emailErr = email_blank;
            } else {
                $email = test_input($_POST["email"]);
                // check if e-mail address satisfies email format
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $emailErr = invalidEmail;
                }
            }

            //Webpage validation
            $web_page = test_input($_POST["webPage"]);
            //check web page format
            if (!filter_var($web_page, FILTER_VALIDATE_URL)) {
                $web_pageErr = invalidWebPage;
            }

            //Phone Validation
            if (NULL !=($_POST["phone"])) {
                $phoneErr = number_blank;
            } else {

                $phone = test_input($_POST["phone"]);
                $phone = preg_replace("/[^0-9]/", '', $phone);

                // check phone number length
                if (strlen($phone) != 8) {
                    $phoneErr = max8Values_Error;
                }
                // check if phone number contains letters and or signs
                else if (!filter_var($phone, FILTER_VALIDATE_INT)) {
                    $phoneErr = invalidNumber;
                }
            }

            //BuisnessId Validation
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


            //Zipcode check
            if (NULL !=($_POST["zip_code"])) {
                $zip_codeErr = blankZipCode;
            } else {
                $zip_code = test_input($_POST["zip_code"]);
                $zip_code = preg_replace("/[^0-9]/", '', $zip_code);

                // check zip code length
                if (strlen($zip_code) != 4) {
                    $zip_codeErr = max4Values_Error;
                }
            }

            //Address check
            if (NULL !=($_POST["address"])) {
                $addressErr = blankAddress;
            } else {
                $address = test_input($_POST["address"]);
            }

            //City check
            if (NULL !=($_POST["address"])) {
                $cityErr = blankCity;
            } else {
                $city = test_input($_POST["city"]);
            }

            if ($business_nameErr == "" && $business_IdErr == "" && $passwordErr == "" && $cpasswordErr == "" && $emailErr == "" && $phoneErr == "" && $serviceErr == "" && $web_pageErr == "" && $addressErr == "" && $zip_codeErr == "") {
                echo "sucsess";
            }
        }
        ?>
        <h1><?php echo register_provider_label ?></h1><br>
        <p><span class="error">* required fields.</span></p>
        <form method="post" action="<?php echo htmlspecialchars($url[1]); ?>"> 
            <!--business name-->
            <?php echo businessName_label ?>:
            <input type="text" name="business_name" value="<?php echo $business_name; ?>">
            <span class="error">* <?php echo $business_nameErr; ?></span>
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

            <!--Business Id-->
            <?php echo businessId_label ?>
            <input type="text" name="businessId" value="<?php echo $business_Id; ?>">
            <span class="error">* <?php echo $business_IdErr; ?></span>
            <br><br>

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

            <!--Home page-->
            <?php echo webPage_label ?>:
            <input type="text" name="webPage" value="<?php echo $web_page; ?>">
            <span class ="error">* <?php echo $web_pageErr; ?></span>
            <br><br>

            <!--Service a provider delivers-->
            <?php echo service_label ?>
            <br>
            <input type="checkbox" name="service" value="catering"><?php echo catering_label ?>
            <input type="checkbox" name="service" value="facility"><?php echo facility_label ?>
            <input type="checkbox" name="service" value="sound&picture"><?php echo sound_light_label ?>
            <span class="error">* <?php echo $serviceErr; ?></span>
            <br><br>      

            <!--Address-->
            <?php echo address_label ?>: 
            <input type="text" name="address" value="<?php echo $address; ?>">
            <span class="error">* <?php echo $addressErr; ?></span>
            <br><br>

            <!--Zip Code-->
            <?php echo zipCode_label ?>:
            <input type="text" name="zip_code" value="<?php echo $zip_code; ?>">
            <span class="error">* <?php echo $zip_codeErr; ?></span>
            <br><br>

            <!-- City -->
            <!--
            <?php echo city_label ?>: 
            <input type="text" name ="city" value="<?php echo $city; ?>">
            <span class="error">* <?php echo $cityErr; ?></span>
            <br><br>
            -->

            <script src="https://www.google.com/recaptcha/api.js" async defer></script>
            <div class="g-recaptcha" data-sitekey="6Levlg8TAAAAALG8kxIJ-XuybQ14pgsQrp5C6BlA" data-theme="dark"></div> <!-- will have to register as a user at google to get site key-->
            <script src="grecaptcha.getResponse(opt_widget_id)"></script>
            <script src="grecaptcha.reset(opt_widget_id)"></script>
            <br/>
            <input type="submit" value="Submit">
        </form>
    </body>
</html>