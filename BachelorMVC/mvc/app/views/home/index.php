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
        /*echo "test";
        $_SESSION['displayed_view'] = 1;*/
        if(isset($user)){
            echo "hello " . $user;
        }
        
        
        ?>
        
    </head>
    <body>
        <h3><?php echo frontpage_label ?></h3>
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
            <tr><td></td></tr>

        </table>


    </body>
</html>
