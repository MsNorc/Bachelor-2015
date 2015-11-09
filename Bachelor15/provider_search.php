

<html>
    <head>
        <meta charset="UTF-8">
        <title>provider jobs</title>

        <?php
        include '/layout/header.php';
        include '/provider_handling.php';
        include '/layout/dropdown_layout.php';


        if (!isset($_SESSION)) {
            session_start();
        }
        if (isset($_SESSION['user'])):
            $array = get_requestsForProvider(2);
            //echo count($array);
            ?>

            <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
            <script>
                $(document).ready(function () {
                    $(".pick-job").click(function () {
                        var array = [];
                        $(this).closest('tr').find('td').each(function () {
                            var textval = $(this).text(); // this will be the text of each <td>
                            array.push(textval);
                        });
                        $.post("provider_handling.php", {picked_job: array})
                                .always(function (data) {
                                });
                    });
                    $("#apply-job").click(function () {
                        $.post("provider_handling.php", {send_offer: true})
                                .done(function (data) {
                                    $("#resultOffered").html(data);
                                })
                                .always(function (data) {
                                    window.setTimeout(function () {
                                        location.reload()
                                    }, 3000);
                                });
                    });

                });

            </script>

        </head>
        <body>
            <link rel = "stylesheet" type = "text/css" href = "css/search_catering.css">
            <form method = "post" action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <div id="provider_wrapper_left">
                    <div>
                        <input type="number" placeholder="search radius km.." name="search radius">
                        <input type="submit" value="<?php echo search_btn ?>">
                    </div>

                    <div class="provider_jobHeader">
                        <table><tr>
                                <th>#id</th>
                                <th>date</th>
                                <th>adress</th>
                                <th>zip</th>    
                                <th>amount</th>
                                <th>food</th>
                                <th>food_amount</th>
                            </tr></table>
                    </div>
                    <div class="provider_jobBody">
                        <table class="testen">

                            <?php
                            for ($i = 0; $i < count($array); $i++) :
                                ?>
                                <tr>
                                    <?php for ($y = 0; $y < count($array[$i]); $y++) : ?>
                                        <td><?php echo $array[$i][$y]; ?></td>

                                    <?php endfor; ?>
                                    <td><input type="submit" class="pick-job" value="ok"></td>
                                </tr>
                            <?php endfor; ?>

                        </table>
                    </div>


                </div>
                <div id="provider_wrapper_right">
                    <table><tr>
                            <?php
                            if (isset($_SESSION['job_picked'])) :
                                $job_picked = $_SESSION['job_picked'];

                                for ($i = 0; $i < count($job_picked); $i++) :
                                    ?>
                                    <td><?php echo $job_picked[$i] ?></td>
                                <?php endfor; ?>
                                <td><input type="button" id="apply-job"  value="apply"></td>

                                <?php
                            //echo setJobOffer();
                            endif;
                            ?>
                        </tr></table>
                    <div id="resultOffered"></div>
                </div>
            </form>
        </body>     
    </html>

    <?php
endif;
if (!isset($_SESSION['user'])) {
    echo msg_login;
}
