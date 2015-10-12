<html>
    <body>
        <?php

        function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

// define variables and set to empty values
        $firstNameErr = $lastNameErr = $emailErr = $numberErr = $adresseErr = $zipCodeErr = $cityErr = "";
        $firstName = $lastName = $email = $number = $adresse = $zipCode = $city = "";

        if (filter_input(INPUT_SERVER, 'SERVER_NAME', FILTER_SANITIZE_STRING) == "POST") {

            if (empty(filter_input(INPUT_POST,'firstName'))) {
                $firstNameErr = "First name is required";
            } else {
                $name = test_input(filter_input(INPUT_POST, 'firstame'));
                if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
                    $firstNameErr = "Only letters and white space allowed";
                }
            }

            if (empty(filter_input(INPUT_POST,'lastName'))) {
                $lastNameErr = "Last name is required";
            } else {
                $lastName = test_input(filter_input(INPUT_POST, 'lastName'));
                if (!preg_match("/^[a-zA-Z ]*$/", $lastName)) {
                    $lastNameErr = "Only letters and white space allowed";
                }
            }


            if (empty(filter_input(INPUT_POST,'email'))) {
                $emailErr = "Email is required";
            } else {
                $email = $name = test_input(filter_input(INPUT_POST, 'email'));
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $emailErr = "Invalid email format";
                }
            }

            $number = test_input(filter_input(INPUT_POST, 'number'));
            $adresse = test_input(filter_input(INPUT_POST, 'adresse'));
            $zipCode = test_input(filter_input(INPUT_POST, 'zipcode'));
            $City = test_input(filter_input(INPUT_POST, 'city'));
        }
        ?>
        <form action="registerUser.php" method="post">
            <p><span class="error">* required field.</span></p>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
            First Name: <input type="text" name="firstName"><span class="error">* <?php echo $firstNameErr; ?></span><br>
            Last Name: <input type="text" name="lastName"><span class="error">* <?php echo $lastNameErr; ?></span><br>
            E-mail: <input type="text" name="email"><br>
            Number: <input type="text" name="number"><br>
            Adresse: <input type="text" name="adresse"><br>
            Zip Code: <input type="text" name="zipCode"><br>
            City: <input type="text" name ="city"><br>
            <input type="submit">
        </form>
    </body>
</html>