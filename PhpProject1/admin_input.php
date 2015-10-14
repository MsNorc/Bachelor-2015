<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>admin access</title>
        
        <?php
        include 'layout/header.php';
        ?>
        
    </head>
    <body>
        
        <div>
            <label><?php echo label_food_type; ?></label>
            <input type="text" name="food_type">
            <input type="button" value="ok">
        </div>
        <div>
            <input type="text" name="first_name_customer"><br>
            <input type="text" name="last_name_customer"><br>
            <input type="text" name="email_customer"><br>
            <input type="number" name="phone_customer"><br>
        </div>
        <div>
            <input type="text" name="first_name_provider"><br>
            <input type="text" name="last_name_provider"><br>
            <input type="text" name="email_provider"><br>
            <input type="text" name="phone_provider"><br>
            <input type="text" name="adress_provider"><br>
            <input type="text" name="zip_provider"><br>
            <input type="text" name="amount_people_provider"><br>
        </div>
    </body>


