<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        include ("layout/header.php")
        ?>
        <?php
        include ("mysqli_connect.php")
        ?>
        <?php
        $PageTitle = "Bachelor prosjekt";

        echo "<br>";

        

        $time = date("H");

        if ($time < "10") {
            echo "Have a good morning!";
        } elseif ($time < "20") {
            echo "Have a good day!";
        } else {
            echo "Have a good night!";
        }
        ?>


        <?php
        include ("layout/footer.php")
        ?>

    </body>
</html>
