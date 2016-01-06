<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>home</title>
        
    </head>
    <body>
        <?php
        //echo dirname(__FILE__) . " #end#";
        //require_once 'controller.php';
        //setPageIndex();
       
        //include 'config.php';
        //include(VIEW_HEADER);
        
        //echo dirname(__FILE__);
        include ("layout/header.php");
        include 'layout/dropdown_layout.php';
        ?>
        <?php
        //include ("db/mysqli_connect.php")
        ?>
        <?php
        $PageTitle = "Bachelor prosjekt";
        
        if(isset($_SESSION['dropdown'])){
            //echo $_SESSION['dropdown'];
            /*echo $_SESSION['user'];
            echo "<br>";
            echo $_SESSION['user_id'];
            echo "<br>";*/
        }
        
        
        echo "<br>";

        $time = date("H");

        if ($time < "10") {
            echo "Have a good morning!";
        } elseif ($time < "20") {
            echo "Have a good day!";
        } else {
            echo "Have a good night!  ";
        }
        
       // session_start();
        
        
       // echo time();

        include 'layout/frontpage_options.php';
        ?>


<?php
include ("layout/footer.php")
?>

    </body>
</html>
