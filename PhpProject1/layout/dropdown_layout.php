<?php

function setDropdown() {
    if (isset($_GET['dropdown'])) {
        if ($_GET['dropdown'] == '1') {
            ?>

            <!DOCTYPE html>
            <html>
                <body>
                    <table>
                        <tr>
                        <form method="POST" action="**search**">
                            <input type="text" name="email">
                            <input type="submit" value=<?php echo search_btn ?>>
                        </form>
                    </tr>
                </table>
            </body>
            </html>

            <?php
        } else if ($_GET['dropdown'] == '2') {
            ?>

            <!DOCTYPE html>
            <html>
                <body>
                    <table>
                        <tr>
                        <form method="POST" action="**search**">
                            <input type="text" name="email">
                            <input type="text" name="password">
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





