
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>catering</title>


        <?php
        include 'layout/header.php';
        include 'catering_populate_view.php';
        //include '/language/lang_no.php';
        ?>

        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script>
            function getFoodList(value) {
               
                $.post("catering_populate_view.php", {partial_food: value})
                        .done(function (data) {
                            $("#results").html(data);
                        })

                        .always(function (data) {
                    //alert ("execution time.." + time);
                        });
            };
            
        </script>



    </head>
    <body>

        <link rel = "stylesheet" type = "text/css" href = "css/search_catering.css">
        <form method = "post" action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class = "catering_wrapper">
                <div id = "catering_left_display">
                    <div >
                        <input type = "checkbox" id = "checkbox_city_trd" value = "trd">
                        <label for="checkbox_city_trd" ><?php echo city_trd ?> </label>
                    </div>

                    <div>
                        <?php
                            if (check_validation()) :
                                save_input();
                                header('Location: submit_catering.php');
                            endif;
                            
                            cancel_picked();
                            $display_array = show_picked();

                            for ($i = 0; $i < count($display_array); $i++) :
                                $display_array[$i];
                                ?>
                                <a href="?cancelled=<?php echo $display_array[$i] ?>">
                                    <input type = "button" value = "X">
                                </a>
                                <?php echo $display_array[$i] ?>
                                <!--<input type = "number" name="amount<?php echo $i ?>">-->
                                <?php
                                echo "<br>";
                            endfor;
                            //  }
                            ?> 

                        <?php
                        //script testing
                        ?>


                    </div>



                    <div >
                        <input type = "submit" value = "<?php echo send_btn ?>">
                    </div>
                </div>
                <div id = "catering_right_display">
                    <div id = "adress_event">
                        <label>
                            <?php echo adress_event_string ?>
                        </label>

                        <input type = "text" name = "adress_event"
                               value = "<?php echo get_adress(); ?>">
                        <span class = "error" > * <?php echo validate_adress(); ?>
                        </span>


                    </div>
                    <div id = "zip_event">
                        <label >
                            <?php echo zip_event_string ?>
                        </label>
                        <input type="number" name="zip_code" 
                               value="<?php echo get_zip();?>">
                        <span class = "error" > * <?php echo validate_zip(); ?> 
                        </span>

                    </div>

                    <div id = "pick_date">
                        <label>
                            <?php echo select_date_string ?>
                        </label> 
                        <input type = "date" name = "date_picked"
                               value = "<?php echo get_date(); ?>">
                        <span class = "error" > * <?php echo validate_date(); ?> </span>

                    </div>
                    <div id = "pick_amount_people">
                        <label>
                            <?php echo quantity_people_string ?>
                        </label>
                        <input type="number" name="quantity_people"
                               value="<?php echo get_quantityPeople() ?>">
                        <span class = "error" > * <?php echo validate_quantity(); ?> </span>
                    </div>

                    <form action="/" id="search_food">
                        <input type="text" placeholder="search food.." onkeyup="getFoodList(this.value)">
                        <div id="results"></div>
                    </form>
                </div>
            </div>       
        </form>
        <div id = "catering_footer" >

            <?php
//footer
            include 'layout/footer.php';
            ?>
        </div>
    </body>
</html>
<?php


