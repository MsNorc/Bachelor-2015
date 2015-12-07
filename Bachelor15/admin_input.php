<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>admin access</title>
        

        <?php
        //include '../controller.php';
        //echo dirname(__FILE__);
        include 'layout/header.php';
        include 'layout/dropdown_layout.php';
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
        }
        ;
        function getCustomerList(value) {
            $.post("admin_handling.php", {partial_customer: value})
                    .done(function (data) {
                        $("#result_editCustomer").html(data);
                    })
                    .always(function (data) {
                        //alert("whawt");
                    });
        }
        ;
        function getProviderList(value) {
            $.post("admin_handling.php", {partial_provider: value})
                    .done(function (data) {
                        $("#result_editProvider").html(data);
                    })
                    .always(function (data) {
                        //alert("test");
                    });
        }
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
                <td>
                    <a href="?show_input=4">
                        <input type="button" value="request">
                    </a>
                </td>
            </tr>
            <tr>
                <th>edit</th>
                <td>
                    <a href="?show_input=5">
                        <input type="button" value="food">
                    </a>
                </td>
                <td>
                    <a href="?show_input=6">
                        <input type="button" value="customer">
                    </a>
                </td>
                <td>
                    <a href="?show_input=7">
                        <input type="button" value="provider">
                    </a>
                </td>
            </tr>
            <tr>
                <th>search</th>
                <td>
                    <a href="?show_input=8">
                        <input type="button" value="radius">
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
        if (edit_customer()) {
            echo "success edit customer" . "<br>";
        }


        if (isset($_SESSION['here'])) {
            //  print_r($_SESSION['here']);
            // echo $_SESSION['here'];
        }

        //JS testing
        ?>

        <div class="admin_wrapper">

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
                    <label><?php echo password_label ?></label>
                    <input type="password" name="password_provider"><br>
                    <input type="submit" value="add">

                    <h4>search food and pick what you supply</h4>
                    <input type="text" id="search_food_admin" 
                           onkeyup="getFoodList(this.value)" placeholder="search food..">
                    <div id="result_editFood"></div><br>
                    <?php
                    cancel_picked();
                    $display_array = show_picked();

                    for ($i = 0; $i < count($display_array); $i++) :
                        $display_array[$i];
                        ?>
                        <div id="items_picked">
                            <a href="?cancelled=<?php echo $display_array[$i] ?>">
                                <input type = "button" value = "X">
                            </a>
                            <?php echo $display_array[$i] ?>
                            </div>
                            <?php
                            //echo "<br>";

                        endfor;
                        ?>
                        <?php
                        insert_provider();
                    endif;

                    if (show_ins_request()):
                        ?>
                    <div id="show_insert_admin">
                        <h4>insert request</h4>
                        <div id="left_admin"><h4>find customer</h4>
                            <input type="text" onkeyup="getCustomerList(this.value)" placeholder="search customer..">
                            <div id="result_editCustomer"></div><br>
                            <?php
                            if (isset($_SESSION['show_pickedCustomer'])) :
                                for ($i = 0; $i < 3; $i++) :
                                    ?>
                           
                            <label><?php show_pickedCustomer($i) ?></label><br>
                                    <?php
                                endfor;
                                ?>
                                 <!--<a href="?cancelCustomer=<?php //show_pickedCustomer($i) ?>">
                                <input type="button" value="X"></a> -->
                                    <?php
                            endif;
                            
                         
                            
                            ?>
                            <h4>find provider</h4>
                            <input type="text" onkeyup="getProviderList(this.value)" placeholder="search provider..">
                            <div id="result_editProvider"></div><br>
                            <?php
                            if (isset($_SESSION['show_pickedProvider'])) :
                                for ($i = 0; $i < 3; $i++) :
                                    ?>
                                    <a> <?php show_pickedProvider($i) ?> </a><br>
                                    <?php
                                endfor;
                            endif;
                            ?>
                            <h4>search food</h4>
                            <input type="text" id="search_food_admin" 
                                   onkeyup="getFoodList(this.value)" placeholder="search food..">
                            <div id="result_editFood"></div><br>
                            <?php
                            cancel_picked();
                            $display_array = show_picked();

                            for ($i = 0; $i < count($display_array); $i++) :
                                $display_array[$i];
                                ?>
                                <div id="items_picked">
                                    <a href="?cancelled=<?php echo $display_array[$i] ?>">
                                        <input type = "button" value = "X">
                                    </a>
                                    <?php echo $display_array[$i] ?>
                                    <input type="number" id="amount_input_food" 
                                           name="<?php echo "amount" . $display_array[$i] ?>"></div>
                                    <?php echo $display_array[$i] ?>
                                    <?php
                                    //echo "<br>";

                                endfor;
                                ?>
                        </div>
                        <div id="right_admin">
                            <label><?php echo adress_event_string ?></label>
                            <input type="text" name="adress_request"><br>
                            <label><?php echo zipCode_label ?></label>
                            <input type="number" name="zip_request"><br>
                            <label>date</label>
                            <input type="date" name="date_request">
                            <label><?php echo quantity_people_string ?></label>
                            <input type="number" name="quantity_request"><br>
                            <label>status - checked if provider ??</label>
                            <input type="checkbox" name="status_request">
                            <input type="submit" value="add">
                        </div>
                    </div>
                    <?php
                    save_amount();
                    insert_request();
                endif;

                if (show_edit_food()):
                    ?>
                    <h4>search to find food to edit..</h4>
                    <input type="text" id="search_food_admin" 
                           onkeyup="getFoodList(this.value)" placeholder="search food..">
                    <div id="result_editFood"></div><br>
                    <div>
                        <input type="text" name="edit_food_text" value="<?php show_pickedFood() ?>">
                        <input type="submit" value="edit">
                    </div>
                    <div><?php
                        if (isset($_SESSION['changed'])):
                            echo $_SESSION['changed'];
                        endif;
                        ?></div>

                    <?php
                endif;
                if (show_edit_customer()):
                    ?>
                    <h4>search to find customer to edit..</h4>
                    <input type="text" id="search_customer_admin" 
                           onkeyup="getCustomerList(this.value)" placeholder="search customer..">
                    <div id="result_editCustomer"></div><br>
                    <div>
                        <?php for ($i = 0; $i < 6; $i++): ?>
                            <input type="text" name="<?php echo "edit" . $i ?>"
                                   value="<?php show_pickedCustomer($i) ?>"><br>                  
                               <?php endfor; ?>
                        <input type="submit" value="edit">
                    </div>

                    <?php
                    if (isset($_SESSION['changed'])):
                        echo $_SESSION['changed'];
                    endif;
                endif;
                if (show_searchArea()):
                    if ($list = show_area()):
                        ?>
                        <div class="area_search_head">
                            <table><tr>
                                    <th>zip code</th>
                                    <th>area</th>
                                </tr>
                            </table>
                        </div>
                        <div class="area_search">
                            <table>
        <?php for ($i = 0; $i < count($list); $i++) : ?>
                                    <tr>
                                        <td><?php echo $list[$i];
            $i++; ?></td>
                                        <td><?php echo $list[$i]; ?></td>
                                    </tr>

                        <?php endfor; ?>
                            </table>
                        </div>
    <?php endif;
    ?>
                    <input type="number" placeholder="zip.." name="zip_search">
                    <input type="number" placeholder="km radius.." name="radius_km">
                    <input type="submit" value="search"><br>


<?php endif;
?>
            </div>
    </form>
    <div>
<?php //include 'layout/footer.php';     ?> 
    </div>
</body>




