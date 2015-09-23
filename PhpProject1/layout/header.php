<?php
include 'language/switch_language.php';
?>
<!DOCTYPE html>
<html> 
    <head> 
        <title>Header</title> 
    </head> 
    <body> 

        <table border="0">
            <tr>

                <td><form method="POST" action="register_user.php">
                        <INPUT type="submit" value=<?php echo new_user_btn ?>>
                    </form></td>


                <td><form method="POST" action="welcome_user.php">
                        <?php echo username_label ?> <input type="text" name="username">
                        <input type="submit" value=<?php echo login_btn ?>>
                    </form></td>

                <td><form method="POST" action="index.php">
                        <input type="submit" value="test">
                    </form></td>

                <td>
                    <div id="language_links">
                        <a href="?lang=en"> english</a> | <a href="?lang=no"> norsk</a>
                    </div>
                </td>
            </tr>

        </table>


        <hr> 