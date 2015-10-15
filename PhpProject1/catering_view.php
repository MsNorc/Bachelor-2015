
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>catering</title>

        <?php
        include 'layout/header.php';
        include './catering_populate_view.php';
        ?>

    </head>
    <body>

        <link rel="stylesheet" type="text/css" href="css/search_catering.css">
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="catering_wrapper">
                <div id="catering_left_display">
                    <div>
                        <input type="checkbox" id="checkbox_city_trd" value="trd">
                        <label for="checkbox_city_trd"><?php echo city_trd ?></label>
                    </div>

                    <div>

                        <a><?php
                            if (check_validation()) {
                                save_input();
                                header('Location: submit_catering.php');
                            }
                            cancel_picked();

                            $display_array = show_picked();

                            for ($i = 0; $i < count($display_array); $i++) {
                                $display_array[$i];
                                ?>
                                <a href="?cancelled=<?php echo $display_array[$i]; ?>"
                                   > <input type="button" value="X">

                                </a>
                                <?php echo $display_array[$i] ?>
                                <input type="number">
                                <?php
                                echo "<br>";
                            }
                            //  }
                            ?></a>

                        <?php
                        //script testing
                        ?>


                    </div>

                    
                    
                    <div>
                        <input type="submit" value="<?php echo send_btn ?>">
                    </div>
                </div>
                <div id="catering_right_display">
                    <div id="adress_event">
                        <label>
                            <?php echo adress_event_string ?>
                        </label>

                        <input type="text" name="adress_event" 
                               value="<?php echo get_adress(); ?>">
                        <span class="error">* <?php echo validate_adress(); ?>
                        </span>


                    </div>
                    <div id="zip_event">
                        <label>
                            <?php echo zip_event_string ?>
                        </label>
                        <input type="number" name="zip_code" 
                               value="<?php echo get_zip(); ?>">
                        <span class="error">* <?php echo validate_zip(); ?></span>

                    </div>

                    <div id="pick_date">
                        <label>
                            <?php echo select_date_string ?>
                        </label> 
                        <input type="date" name="date_picked" 
                               value="<?php echo get_date(); ?>">
                        <span class="error">* <?php echo validate_date(); ?></span>

                    </div>
                    <div id="pick_amount_people">
                        <label>
                            <?php echo quantity_people_string ?>
                        </label>
                        <input type="number" name="quantity_people" 
                               value="<?php echo get_quantityPeople(); ?>">
                        <span class="error">* <?php echo validate_quantity(); ?></span>
                    </div>

                    <div id="container">
                        <input type="text" onkeyup="getFood(this.value)"/><br>
                        
                        <div> id="result"></div>
                    </div>

                    <div>
                        <ul class="catering_list_options">
                            <?php
                            $show_dishes = check_dishes();


                            for ($i = 0; $i < count($show_dishes); $i++) {
                                ?>

                                <li>
                                    <a href="?show_picked=<?php echo $show_dishes[$i] ?>">
                                        <?php echo $show_dishes[$i]; ?></a>
                                </li>

                                <?php
                            }
                            ?>

                        </ul>
                    </div>
                </div>
            </div>       
        </form>
        <div id="catering_footer">
            <?php
//footer
            include 'layout/footer.php';
            ?>
        </div>
    </body>
</html>
