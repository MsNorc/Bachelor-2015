<?php
include '/layout/header.php';
?>

<!DOCTYPE html>
<html>
    <head>
    <div id="catering_header">
        <h1>
            search for catering
        </h1>
    </div>

</head>
<body>
    <link rel="stylesheet" type="text/css" href="css/search_catering.css">
    <div class="catering_wrapper">
        <div id="catering_left_display">
            <div>
                <input type="checkbox" id="checkbox_city_trd" value="trd">
                <label for="checkbox_city_trd"><?php echo city_trd ?></label>
            </div>
            <div>
                
            </div>
            <div>
                <input type="button" value="<?php echo send_btn ?>">
            </div>
        </div>
        <div id="catering_right_display">
            <div id="adress_event">
                <input type="text" name="adress_event">
                <label>
                    <?php echo adress_event_string ?>
                </label>

            </div>
            <div id="zip_event">
                <input type="number">
                <label>
                    <?php echo zip_event_string ?>
                </label>
            </div>

            <div id="pick_date">
                <input type="date" name="date_picked">
                <label>
                    <?php echo select_date_string ?>
                </label> 

            </div>
            <div id="pick_amount_people">
                <input type="number" name="quantity_people" min="1" max="200">
                <label>
                    <?php echo quantity_people_string ?>
                </label>
            </div

            <div>
                <ul id="_catering_list">
                    <?php
                    for ($index = 0; $index < 4; $index++) {
                        ?>
                        <li>
                            <a value="number"href="#"><?php echo $index ?></a>
                        </li>
                        <?php
                    }
                    ?>


                </ul>

            </div>
        </div>
    </div>
    <div id="catering_footer">
        <?php
        include 'layout/footer.php';
        ?>
    </div>
</body>
</html>
