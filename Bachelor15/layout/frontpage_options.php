

<!DOCTYPE html>
<html> 
    <head> 
        <meta charset="UTF-8">
        <title>Header</title> 
    </head> 
    <body> <h2><?php echo frontpage_label; ?></h2><p>

        <table border="0">
            <tr>

                <td><form method="POST" action="catering_view.php">
                        <input type="submit" value="<?php echo catering_label?>">
                    </form>
                </td>
                <td><form method="POST" action="index.php">
                        <input type="submit" value="<?php echo facility_label?>">
                    </form>
                </td>
                <td><form method="POST" action="index.php">
                        <input type="submit" value="<?php echo sound_light_label?>">
                    </form>
                </td>

            </tr>

        </table>


        

