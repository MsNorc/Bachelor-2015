<?php
 //function setDropdown() {
  if (isset($_SESSION['dropdown'])) :
  if ($_SESSION['dropdown'] == '1') :
 
//include 'header.php';
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>dropdown</title>
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script>
            $(document).ready(function () {

            $("#login").click(function () {
            //alert("clicked");
                    var email = $("#email").val();
                    var password = $("#password").val();
//alert ("clicked");

                    $.post("layout/loginTest.php", {email1: email, password1: password})
                            .done(function (data) {
                            $("#resultLogin").html(data);
                    
                            
                    //alert(data);
                            })
                            .error(function(data){
                            //location = location['admin_input.php'];
                            })

                            .always(function (data) {
                            window.setTimeout(function(){location.reload()},2000);
                            });
                    });
            });
        </script>
    </head>
    <body>
        <link rel = "stylesheet" type = "text/css" href = "css/search_catering.css">
        <div class="container">
            <div class="main_login">
                <form action="/.." method="POST">
                <label><?php echo email_label ?></label>
                <input type="text" name="demail" id="email">
                <label><?php echo pw_label ?></label>
                <input type="password" name="password" id="password">
                <input type="button" name="login" id="login" value="Login">
                <div><a href="forgotPassword.php">forgot pw?</a></div>
                <div id="resultLogin"></div>
                </form>
            </div>
        </div>
    </body>
</html>
<?php
endif;
endif;
 //}
//echo "no dropdown";
//setDropdown();

?>