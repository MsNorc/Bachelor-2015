<?php
if (!isset($_SESSION)) {
    session_start();
}
//$filePath = "/home/stud/chrnordh/public_html/Bachelor15";//server
$filePath = "C:\wamp\www\Bachelor15";
include 'language/switch_language.php';

function check_dropdown() {
//$php_errormsg = "what";
//$_SESSION['dropdown'] = 1;
    if (isset($_SESSION['dropdown'], $_GET['dropdown'])) {
        $session_drop = $_SESSION['dropdown'];
        $get_drop = $_GET['dropdown'];
        /* if (($session_drop == 1) && ($get_drop == 2)) {
          $_SESSION['dropdown'] = 0;
          } */ if (($session_drop == 0) && ($get_drop == 2)) {
            $_SESSION['dropdown'] = 1;
        } else {
            $_SESSION['dropdown'] = 0;
        }
    } else {
        $_SESSION['dropdown'] = 0;
    }
}
?>
<!DOCTYPE html>
<html> 
    <head> 
        <meta charset="UTF-8">
        <title>Header</title> 


    </head> 
    <body> 
        <link rel = "stylesheet" type = "text/css" href = "css/search_catering.css">
        <div id="main_header">
            <table border="0">
                <tr>
                    <td><form method="POST" action="index.php">
                            <input type="submit" value="HOME">
                        </form></td>

                    <?php if (!isset($_SESSION['user'])): ?>
                        <td><form method="POST" action="register_user_input.php">
                                <INPUT type="submit" value="<?php echo new_user_btn ?>">
                            </form>
                        </td>

                        <td><form method="POST" action="?dropdown=2">
                                <input type="submit" onkeyup="<?php check_dropdown() ?>" value="<?php echo login_btn ?>">
                            </form>
                        </td>
                    <?php endif; ?>

                    <td>
                        <select name="form" onchange="location = this.options[this.selectedIndex].value;">
                            <option style="display:none;">more</option>
                            <option value="request_view.php">view requests</option>
                            <?php if (isset($_SESSION['user_type']) && 
                                    $_SESSION['user_type'] == "provider"): ?>
                                <option value="provider_view.php">apply jobs</option>
                            <?php endif; ?>
                        </select>
                    </td>

                    <td><form method="POST" action="?dropdown=1">
                            <input type="submit" value="<?php echo search_btn ?>*">

                        </form></td>

                    <td>
                        <div id="language_links">
                            <a href="?lang=en"> english</a> | <a href="?lang=no"> norsk</a>
                        </div>
                    </td>

                    <td><form method="POST" action="admin_view.php">
                            <input type="submit" value="admin">
                            <?php //show_admin();  ?>
                        </form></td>
                    <td>
                        <?php if (isset($_SESSION['user'])): ?>
                            <div id="logged_in">logged in as: <?php echo$_SESSION['user'] ?></div>
                            <?php if (isset($_SESSION['user_type'])) : ?>
                                <div><?php echo $_SESSION['user_type'] ?></div>
                            <?php endif; ?>


                        </td>
                        <td><form method="POST" action="register_provider_input.php">
                                <input type="submit" value="<?php echo upgrade_button ?>">
                            </form></td>
                        <td><form method="POST" action="logout.php">
                                <input type="submit" value="<?php echo logout_button ?>">

                            </form></td>
                        <td>
                        <?php endif; ?>

                </tr>

            </table>


            <hr> 
        </div>