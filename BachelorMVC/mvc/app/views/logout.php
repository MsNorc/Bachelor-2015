<?php
//session_start();

if (isset($_SESSION)) {
    session_destroy();
}
?>

<!DOCTYPE html>
<html>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script>
        
            $(document).ready(function () {
                window.location = 'home';
                $("#logoutForm").submit();
            });

        
        //window.location.replace("index");
       
    </script>
    <body>
        <form method = "post" id="logoutForm" 
              action = "<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
            
        </form>
    </body>

</html>