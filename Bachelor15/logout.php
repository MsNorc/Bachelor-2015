<?php

session_start();

if (isset($_SESSION)) {
    session_destroy();
}
?>

<!DOCTYPE html>
<html>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script>
        $(document).ready(function () {
            
            window.location.replace("index.php");
        });
    </script>
</html>