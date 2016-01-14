<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>review you requests</title>

        <?php
        /*include 'layout/header.php';
        include 'layout/dropdown_layout.php';
        include 'controllers/request_controller.php';*/

        if (!isset($_SESSION)) {
            session_start();
        }
        $user = "";
        if (isset($_SESSION['user'])):
            $user = $_SESSION['user'];
            $user_id = $_SESSION['user_id'];
            
            //retrieve list of requests
            $list = get_request($user_id);
            
            //get current url to post in form 
            if (isset($_GET['url'])) {
            ( $url = explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL)));
        }
        endif;
        if ($user):
            ?>

            <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
            <script>
                $(document).ready(function () {
                    $(".select-request").click(function () {
                        
                        var array = [];
                        $(this).closest('tr').find('td').each(function () {
                            var textval = $(this).text(); // this will be the text of each <td>
                            array.push(textval);
                            //alert(textval);
                        });
                        $.post("overview", {picked_request: array, tempStop: true})
                                .done(function (data) {
                                    <?php $_SESSION['JQUERY'] = 1; ?>
                                    $("#requestPicked").html(data);
                                })

                                .always(function (data) {
                                    //alert("always");
                                    //alert(data);
                                });
                    });
                    $(".pick-provider").click(function () {
                        var arrayP = [];
                        $(this).closest('tr').find('td').each(function () {
                            var provider_name = $(this).text(); // this will be the text of each <td>
                            arrayP.push(provider_name);
                            //alert(arrayP);
                        });
                        $.post("overview", {provider_name: arrayP, tempStop: true})
                                .done(function (data) {
                                    <?php $_SESSION['JQUERY'] = 1; ?>
                                            
                                    $("#picked_provider").html(data);
                                })
                                .always(function (data) {
                                    //alert(data);
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
                <div id="request_left">
                    <table border="1">
                        <tr>
                            <th>#id</th>
                            <th>adress</th>
                            <th>zip</th>
                            <th>date</th>
                            <th>quantity</th>
                            <th>food type</th>
                            <th>amount</th>
                        </tr>
                        <?php for ($i = 0; $i < count($list); $i++) : ?>
                            <tr>
                                <?php for ($y = 0; $y < count($list[$i]); $y++) : ?>
                                    <td><?php echo $list[$i][$y]; ?></td>                                                
                                <?php endfor; ?>
                                <td><input type="submit" class="select-request" value="pick"></td>
                            </tr>
                        <?php endfor; ?>
                    </table>
                </div>
                <div id="request_right">
                    <?php
                    if (isset($_SESSION['request_picked'])):
                        $list = $_SESSION['request_picked'];
                        //print_r($list);
                        ?>
                        <table>
                            <tr>
                                <?php for ($i = 0; $i < count($list); $i++) : ?>
                                    <td><?php echo $list[$i] ?></td>
                                <?php endfor; ?>
                            </tr>
                        </table>
                        <table class="providers_scrollPick">
                            <?php
                            if (isset($_SESSION['providers'])):
                                $providers = $_SESSION['providers'];
                                for ($i = 0; $i < count($providers); $i++) :
                                    ?>
                                    <tr>
                                        <?php for ($y = 1; $y < count($providers[$i]); $y++) : ?>
                                            <td><?php echo $providers[$i][$y]; ?></td>
                                        <?php endfor; ?>
                                        <td><input type="button" class="pick-provider" value="pick"></td>
                                    </tr>
                                <?php endfor;
                                ?>
                            </table>

                            <?php
                        endif;
                        if (!isset($_SESSION['providers'])):
                            echo "no providers for your request so far..";
                        endif;
                    endif;
                    ?>
                    <div id="picked_provider">
                    </div>

                </div>
            </form>
        </body>
    </html>

    <?php
endif;
if (!$user):
    echo msg_login;
endif;
//get_requests($user_id);
?>
