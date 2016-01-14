<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>home</title>
        
        <?php $app = new App();
        unset($_SESSION['JQUERY']);
        /*echo "test";
        $_SESSION['displayed_view'] = 1;
        echo $_SESSION['displayed_view'];*/
        ?>
        
    </head>
    <body>
        <table border="0">
            <tr>

                <td><form method="POST" action="catering">
                    
                        <input type="submit" value="<?php echo catering_label?>">
                    </form>
                </td>
                <td><form method="POST" action="index.php">
                        <input type="submit" value="<?php echo facility_label?>*">
                    </form>
                </td>
                <td><form method="POST" action="index.php">
                        <input type="submit" value="<?php echo sound_light_label?>*">
                    </form>
                </td>

            </tr>
            <tr><td>TODO*</td></tr>

        </table>


    </body>
</html>
