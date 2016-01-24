

<html>
    <head>
        <meta charset="UTF-8">
        <title>provider jobs</title>

        <?php
        /* include 'layout/header.php';
          include 'controllers/provider_controller.php';
          include 'layout/dropdown_layout.php'; */

        if (isset($_GET['url'])) {
            ( $url = explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL)));
        }

        if (!isset($_SESSION)) {
            session_start();
        }
        if (isset($_SESSION['user'])):
            $provider_id = $_SESSION['user_id'];
            $provider_zip = getZipUser($provider_id);
            $radius = setRange();
            $free_jobs = get_requestsForProvider($provider_id, $provider_zip, $radius);
            //print_r($free_jobs);
            $applied_jobs = get_providerAppliedJobs($provider_id);
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
                        $.post("provider", {picked_job: array})
                                .always(function (data) {
                                });
                    });
                    $("#apply-job").click(function () {
                        var price = document.getElementById("priceOffer").value;
                       
                        //alert(price);
                        $.post("provider", {send_offer: true, priceOffer: price, tempSave: true})
                                .done(function (data) {
    <?php $_SESSION['JQUERY'] = 1; ?>
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
            <form method = "post" action = "<?php echo htmlspecialchars($url[0]); ?>">
                <div id="provider_wrapper_left">
                    <div>
                        <input type="number" placeholder="search radius km.." name="search_radius">
                        <input type="submit" value="<?php echo search_btn ?>">
                        <label> Zip: <?php echo $provider_zip ?></label>
                        <label>Radius : <?php echo $radius ?>km</label>
                    </div>

                    <div class="provider_jobHeader">
                        <table><tr>
                                <th>#id</th>
                                <th><?php echo adress_label ?></th>
                                <th><?php echo zipCode_label ?></th>
                                <th><?php echo date_label ?></th>
                                <th><?php echo people_label ?></th>
                                <th><?php echo food_label ?></th>
                                <th><?php echo food_amount_label ?></th>
                            </tr></table>
                    </div>
                    <div class="provider_jobBody">
                        <table class="testen">

                            <?php
                            for ($i = 0; $i < count($free_jobs); $i++) :
                                ?>
                                <tr>
                                    <?php for ($y = 0; $y < count($free_jobs[$i]); $y++) : ?>
                                        <td><?php echo $free_jobs[$i][$y]; ?></td>

                                    <?php endfor; ?>
                                    <td><input type="submit" class="pick-job" 
                                               value="<?php echo pick_btn ?>"></td>
                                </tr>
                            <?php endfor;
                            ?>

                        </table>
                    </div>
                    <hr>
                    <div>
                        <h4><?php echo applied_noAnswer ?></h4>
                        <table>
                            <?php
                            for ($i = 0; $i < count($applied_jobs); $i++) :
                                ?>
                                <tr>
                                    <?php for ($y = 0; $y < count($applied_jobs[$i]); $y++) : ?>
                                        <td><?php echo $applied_jobs[$i][$y]; ?></td>

                                    <?php endfor; ?>
                                </tr>
                            <?php endfor;
                            ?>

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
                            </tr>
                            <tr><td><?php echo price_offer ?></td>
                                <td><input type="number" id="priceOffer"
                                           placeholder="120"></td>
                                <td>NOK</td>
                            </tr>
                            <td><input type="button" id="apply-job"  value="<?php echo send_btn ?>"></td>

        <?php
    //echo setJobOffer();
    endif;
    ?>
                    </table>
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
