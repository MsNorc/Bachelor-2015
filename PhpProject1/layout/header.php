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
                <td><form method="POST" action="index.php">
                        <input type="submit" value="HOME">
                    </form></td>

                <td><form method="POST" action="registerUser.php">
                        <INPUT type="submit" value="<?php echo new_user_btn ?>">
                    </form></td>


                <td><form method="POST" action="?dropdown=2">
                        
                        <input type="submit" value="<?php echo login_btn ?>">
                    </form></td>

                <td><form method="POST" action="?dropdown=1">
                        <input type="submit" value="<?php echo search_btn ?>">

                    </form></td>

                <td>
                    <div id="language_links">
                        <a href="?lang=en"> english</a> | <a href="?lang=no"> norsk</a>
                    </div>
                </td>
                
                <td><form method="POST" action="admin_input.php">
                        <input type="submit" value="admin">

                    </form></td>
            </tr>

        </table>


        <hr> 