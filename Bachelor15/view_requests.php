<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>review you requests</title>

        <?php
        include 'layout/header.php';
        include 'db/mysqli_connect.php';

        if (!isset($_SESSION)) {
            session_start();
        }

        $user = $_SESSION['user'];
        $user_id = $_SESSION['user_id'];

        $list = get_requestDB($user_id);

        ?>
    </head>

    <body>
        <div>
            <table border="1">
                <tr>
                    <th>adress</th>
                    <th>zip</th>
                    <th>date</th>
                    <th>quantity</th>
                    <th>food type</th>
                    <th>amount</th>
                </tr>
                <?php for ($i = 0; $i < count($list); $i++) : ?>
                    <tr>
                        <td>
                            <?php /*if(!($i > 0 && $list[$i][0] != $list[$i-1][0])):*/
                            echo $list[$i][0]; ?>
                        </td>
                        <td>
                            <?php echo $list[$i][1] ?>
                        </td>
                        <td>
                            <?php echo $list[$i][2] ?>
                        </td>
                        <td>
                            <?php echo $list[$i][3]; 
                            /*endif;*/ ?>

                        </td>
                        <td>
                            <?php echo $list[$i][4] ?>
                        </td>
                        <td>
                            <?php echo $list[$i][5] ?>
                        </td>
                    </tr>
                <?php endfor; ?>
            </table>
        </div>
    </body>
</html>

<?php
//get_requests($user_id);
?>
