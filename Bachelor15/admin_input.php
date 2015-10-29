<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>admin access</title>

        <?php
        include 'layout/header.php';
        include 'admin_handling.php';
        ?>

        <!DOCTYPE html>

    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script>
        function getFoodList(value) {

            $.post("admin_handling.php", {partial_food: value})
                    .done(function (data) {
                        $("#result_editFood").html(data);
                    })

                    .always(function (data) {
                        //alert ("execution complete!");
                    });
        };
        function getCustomerList(value){
            $.post("admin_handling.php",{partial_customer: value})
                    .done(function(data){
                        $("#result_editCustomer").html(data);
            })
                    .always(function(data){
                        
            });
        };
    </script>
</head>



<body>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <table>
            <tr>
                <th>insert</th>
                <td>
                    <a href="?show_input=1">
                        <input type="button" value="food">
                    </a>
                </td>
                <td>
                    <a href="?show_input=2">
                        <input type="button" value="customer">
                    </a>
                </td>
                <td>
                    <a href="?show_input=3">
                        <input type="button" value="provider">
                    </a>
                </td>
            </tr>
            <tr>
                <th>edit</th>
                <td>
                    <a href="?show_input=4">
                        <input type="button" value="food">
                    </a>
                </td>
                <td>
                    <a href="?show_input=5">
                        <input type="button" value="customer">
                    </a>
                </td>
                <td>
                    <a href="?show_input=6">
                        <input type="button" value="provider">
                    </a>
                </td>
            </tr>
        </table>


        <?php
        if (insert_food()) {
            echo "success food";
        }
        if (insert_user()) {
            echo "success user";
        }
        if (insert_provider()) {
            echo "success provider";
        }
         if (edit_food()) {
          echo "success edit food";
          } 

        //JS testing
        ?>


        <?php if (show_ins_food()) : ?>
            <div id="food_insert">
                <h3>food</h3>
                <label><?php echo label_food_type; ?></label>
                <input type="text" name="food_type">
                <input type="submit" value="add">
            </div>
            <?php
            insert_food();
        endif;
        ?>

        <?php if (show_ins_customer()) : ?>
            <div id="customer_insert">
                <h3>customer</h3>
                <label><?php echo firstName_label ?></label>
                <input type="text" name="first_name_customer"><br>
                <label><?php echo lastName_label ?></label>
                <input type="text" name="last_name_customer"><br>
                <label><?php echo email_label ?></label>
                <input type="text" name="email_customer"><br>
                <label><?php echo phone_label ?></label>
                <input type="number" name="phone_customer"><br>
                <label><?php echo adress_label ?></label>
                <input type="text" name="adress_customer"><br>
                <label><?php echo zipCode_label ?></label>
                <input type="number" name="zip_customer"><br>
                <label><?php echo pw_label ?></label>
                <input type="password" name="password_customer"><br>
                <input type="submit" value="add">
            </div>
            <?php
            insert_user();
        endif;


        if (show_ins_provider()) :
            ?>
            <div id="provider_insert">
                <h3>provider</h3>
                <label><?php echo firstName_label ?></label>
                <input type="text" name="first_name_provider"><br>
                <label><?php echo lastName_label ?></label>
                <input type="text" name="last_name_provider"><br>
                <label><?php echo email_label ?></label>
                <input type="text" name="email_provider"><br>
                <label><?php echo phone_label ?></label>
                <input type="text" name="phone_provider"><br>
                <label><?php echo adress_label ?></label>
                <input type="text" name="adress_provider"><br>
                <label><?php echo zipCode_label ?></label>
                <input type="text" name="zip_provider"><br>
                <label><?php echo amount_label ?></label>
                <input type="text" name="amount_provider"><br>
                <input type="submit" value="add">
            </div>
            <?php
            insert_provider();
        endif;

        if (show_edit_food()):
            ?>
            <h4>search to find food to edit..</h4>
            <input type="text" id="search_food_admin" 
                   onkeyup="getFoodList(this.value)" placeholder="search..">
            <div id="result_editFood"></div>
            <div>
                <input type="text" name="edit_food_text" value="<?php show_picked() ?>">
                <input type="submit" value="edit" id="food_change">
            </div>
            <div><?php
            if(isset($_SESSION['changed'])):
                echo $_SESSION['changed'];
            endif;
            ?></div>

            <?php
        endif;
        if(show_edit_customer()): ?>
            <h4>search to find customer to edit..</h4>
            <input type="text" id="search_customer_admin" 
                   onkeyup="getCustomerList(this.value)" placeholder="search..">
            <div id="result_editCustomer"></div>
        <?php
        endif;
        ?>

    </form>
</body>

<?php include 'layout/footer.php'; ?> 


