<?php
//function setDropdown() {
//if (isset($_SESSION['dropdown'])) :
//   if ($_SESSION['dropdown'] == '1') :
//include 'header.php';
?>

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

                    $.post("login", {email1: email, password1: password, tempSave: true})
                            .done(function (data) {
<?php $_SESSION['login'] = 1; ?>
                                $("#resultLogin").html(data);


                                //alert(data);
                            })
                            .error(function (data) {
                                alert(data);
                                //location = location['admin_input.php'];
                            })

                            .always(function (data) {
                                var result = $.trim(data);
                                if (result.toString() === 'success..') {
                                    //alert("ja");
                                    window.location = 'index';
                                    //window.location.reload();
                                }

                                //window.setTimeout(function(){location.reload()},2000);
                            });
                });
            });
        </script>
    </head>
    <body>
        <link rel = "stylesheet" type = "text/css" href = "css/dummy_layout.css">
        <form method = "post" id="loginForm" 
              action = "<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
            <div class="container">
                <div class="main_login">
                    <form action="/.." method="POST">
                        <label><?php echo email_label ?></label>
                        <input type="text" name="demail" id="email">
                        <label><?php echo pw_label ?></label>
                        <input type="password" name="password" id="password">
                        <input type="button" name="login" id="login" value="<?php echo login_btn ?>">
                        <div><a href="password"><?php echo forgotPw_btn ?></a></div>
                        <div id="resultLogin"></div>
                    </form>
                </div>
            </div>
        </form>
    </body>
</html>
<?php
//endif;
//endif;
//}
//echo "no dropdown";
//setDropdown();
?>