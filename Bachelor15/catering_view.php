
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>catering</title>


        <?php
        include 'layout/header.php';
        include 'layout/dropdown_layout.php';
        include 'catering_populate_view.php';
        //$_SESSION['dropdown'] = 0;
        //include 'layout/dropdown_layout.php';
        if (isset($_SESSION['user'])):
            ?>




            <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
            <script>
                function getFoodList(value) {

                    $.post("catering_populate_view.php", {partial_food: value, tempSave: true})
                            .done(function (data) {
                                $("#results").html(data);
                            })

                            .always(function (data) {

                            })
                            .click(function (data) {
                                alert("what");
                                window.location.reload();
                            });
                }
                ;
                function show_area(value) {
                    $.post("catering_populate_view.php", {zip_codeInput: value})
                            .done(function (data) {
                                $("#show_area").html(data);
                            })
                            .always(function (data) {
                                //alert("what!");
                            });
                }
                ;

            </script>




        </head>
        <body>


            <form method = "post" action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <div class = "catering_wrapper">
                    <div id = "catering_left_display">
                        <div >
                            <label><?php echo msg_insertFood ?></label>
                        </div>
                        <form action="/" id="search_food">
                            <input type="text" placeholder="search food.." 
                                   onkeyup="getFoodList(this.value)">
                            <div id="results"></div>


                            <div>
                                <h4><?php echo msg_pickFood ?></h4>

                                <?php
                                if (check_validation()) :
                                    save_input();
                                    save_amount();
                                    ?>
                                    <script>
                                        window.location = 'submit_catering.php';
                                    </script>
                                    <?php
                                endif;

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
                                        <?php
                                        //echo "<br>";

                                    endfor;
                                    //  }
                                    ?> 

                                <?php ?>


                            </div>




                    </div>
                    <div id = "catering_right_display">
                        <div id = "adress_event">
                            <label class="labels_catering">
                                <?php echo adress_event_string ?>
                            </label>

                            <input type = "text" name = "adress_event"
                                   value = "<?php echo get_adress(); ?>">
                            <span class = "error" > * <?php echo validate_adress(); ?>
                            </span>


                        </div>

                        <div id = "zip_event">
                            <label class="labels_catering">
                                <?php echo zip_event_string ?>
                            </label>
                            <input type="number" onkeyup="show_area(this.value)" class="input_catering" name="zip_code" 
                                   value="<?php echo get_zip(); ?>">
                            <span class = "error" > * <?php echo validate_zip(); ?> 
                            </span><label id="show_area"></label>

                        </div>

                        <div id = "pick_date">
                            <label class="labels_catering">
                                <?php echo select_date_string ?>
                            </label> 
                            <input type = "date" name = "date_picked"
                                   value = "<?php echo get_date(); ?>">
                            <span class = "error" > * <?php echo validate_date(); ?> </span>

                        </div>
                        <div id = "pick_amount_people">
                            <label class="labels_catering">
                                <?php echo quantity_people_string ?>
                            </label>
                            <input type="number" class="input_catering" name="quantity_people"
                                   value="<?php echo get_quantityPeople() ?>">
                            <span class = "error" > * <?php echo validate_quantity(); ?> </span>
                        </div><br>
                        <div id="notify_email">
                            <label class="labels_catering"><?php echo interest_string ."*" ?></label>
                            <input type="checkbox">
                        </div><br>
                        <div>
                            <label class="labels_catering">comment*</label>
                            <textarea rows="4" cols="30"></textarea>
                        </div><br><br>
                        <div><label class="labels_catering">click to apply</label>
                            <input type = "submit" value = "<?php echo send_btn ?>">
                        </div>

                    </div>
                </div>       
            </form>
            <div id = "catering_footer" >

                <?php
//footer
                //include 'layout/footer.php';
                ?>
            </div>
        </body>
    </html>
    <?php
endif;
if (!isset($_SESSION['user'])):
    echo msg_login;
endif;
