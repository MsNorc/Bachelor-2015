<?php

function setDropdown() {
    if (isset($_GET['dropdown'])) {
        if ($_GET['dropdown'] == '1') {
            ?>

            <!DOCTYPE html>
            <html>
                <head>
                    <meta charset="UTF-8">
                    <title>dropdown</title>
                    
                </head>
                <body>
                    <table>
                        <tr>
                        
                            <input type="text" name="email">
                            <input type="submit" value=<?php echo search_btn ?>>
                        </form>
                    </tr>
                </table>
         

            <?php
        } else if ($_GET['dropdown'] == '2') {
            ?>

            
                    <table>
                        <tr>
                        <form method="POST" action="**search**">
                            <input type="text" name="email">
                            <input type="password" name="pw_user">
                            <input type="submit" value=<?php echo login_btn ?>>
                        </form>
                    </tr>
                </table>
            </body>
            </html>
            <?php
        }
    }
}

setDropdown();





