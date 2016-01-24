<?php
if (!isset($_SESSION)) {
    session_start();
}


?>
<!DOCTYPE html>
<html> 
    <head> 
        <meta charset="UTF-8">
        <title>Catering</title> 

        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script>
            $(document).ready(function () {
                $("#home_btn").click(function () {
                    //alert("success..");
                    window.location = 'home';
                });
                $("#overview").click(function () {
                    //alert("success..");
                    window.location = 'overview';
                });

            });

        </script>


    </head> 
    <body> 
        <link rel = "stylesheet" type = "text/css" href = "css/dummy_layout.css">
        <div id="main_header">
            <table border="0">
                <tr>
                    <td><form method = "post" action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">

                            <input type="submit" id="home_btn" value="<?php echo home_btn ?>">
                        </form></td>

                    <?php if (!isset($_SESSION['user'])): ?>
                        <td><form method="POST" action="register">
                                <INPUT type="submit" value="<?php echo new_user_btn ?>">
                            </form>
                        </td>

                        <td><form method="POST" action="login">
                                <input type="submit" onkeyup="<?php //check_dropdown()   ?>" value="<?php echo login_btn; ?>">
                            </form>
                        </td>
                    <?php endif; ?>

                    <!-- <td>
                        <select name="form" onchange="location = this.options[this.selectedIndex].value;">
                            <option style="display:none;"><?php //echo more_btn   ?></option>
                            <option id="overview_btn" value="overview"><?php //echo view_request_btn   ?></option>
                    <?php /*
                      if (isset($_SESSION['user_type']) &&
                      $_SESSION['user_type'] == "provider"):
                      ?>
                      <option value="provider"><?php //echo search_jobs_btn ?></option>

                      <?php //endif; */ ?>
                        </select> 
                    </td> -->
                    <td>
                        <form method="POST" action="overview">
                            <input type="submit" id="overview" value="<?php echo view_request_btn ?>">
                        </form>
                    </td>
                    <?php
                    if (isset($_SESSION['user_type']) &&
                            $_SESSION['user_type'] == "provider"):
                        ?>
                        <td>
                            <form method="POST" action="provider">
                                <input type="submit" value="<?php echo search_jobs_btn; ?>">
                            </form>
                        </td>
                    <?php endif; ?>
                    <td><form method="POST" action="?dropdown=1">
                            <input type="submit" value="<?php echo search_btn; ?>*">

                        </form></td>

                    <td>
                        <div id="language_links">
                            <a href="?lang=en"> english</a> | <a href="?lang=no"> norsk</a>
                        </div>
                    </td>

                    <td><form method="POST" action="admin">
                            <input type="submit" value="<?php echo admin_btn; ?>">
<?php //show_admin();      ?>
                        </form></td>
                    <td>
                        <?php if (isset($_SESSION['user'])): ?>
                            <div id="logged_in"><?php echo loggedInAs . $_SESSION['user'] ?></div>
                            <?php /* if (isset($_SESSION['user_type'])) : ?>
                              <div><?php echo $_SESSION['user_type'] ?></div>
                              <?php endif; */ ?>


                        </td>
                        <td><form method="POST" action="register/provider">
                                <input type="submit" value="<?php echo upgrade_button;
                                unset($_SESSION['JQUERY']);?>">
                            </form></td>
                        <td><form method="POST" action="home/logout">
                                <input type="submit" value="<?php echo logout_button ?>">

                            </form></td>
                        <td>
<?php endif; ?>

                </tr>

            </table>


            <hr> 
        </div>