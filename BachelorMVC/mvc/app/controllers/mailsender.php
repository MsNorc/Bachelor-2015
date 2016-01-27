<?php

//mailsender.company@gmail.com
//catering1234

require('PHPMailer-master/PHPMailerAutoload.php');

function sendRecoveryMail($recipient, $encryptedEmail) {
    
    $link = "http://stud.iie.ntnu.no/~chrnordh/BachelorMVC/mvc/public/";

    $name = "Automated recovery mail";
    $mail = new PHPMailer();
    $mail->CharSet = 'UTF-8';

    $body = 'Hello, <br/> <br/>Click the link to reset the password for ' . $recipient . ' '
            . '<br><br>Click here to reset your password '
            . $link . 'password/forgot?encrypt=' . $encryptedEmail . '&action=reset '
            . '<br/> <br/>--<br>';
//http://stud.aitel.hist.no/~chrnordh/Bachelor15/resetPassword.php?encrypt='.$encryptedEmail.'&action=reset '
    $mail->IsSMTP();
    $mail->Host = 'smtp.gmail.com';

    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;
    $mail->SMTPDebug = 0;
    $mail->SMTPAuth = true;

    $mail->Username = 'mailsender.company@gmail.com';
    $mail->Password = 'catering1234';

    $mail->SetFrom('mailsender.company@gmail.com', $name);
    $mail->AddReplyTo('mailsender.company@gmail.com', 'no-reply');
    $mail->Subject = 'Password recovery';
    $mail->MsgHTML($body);

    $mail->AddAddress($recipient, $recipient);
    $mail->send();
}

/*function sendEmailVerification() {
    
}*/

function sendEmail_pickedProvider($information) {
    
    $recipient = $information[0][1];
    $adress = $information[0][2];
    $zip = $information[0][3];
    $date = $information[0][4];
    $total_people = $information[0][5];
    $user_email = $information[0][6];
    $user_phone = $information[0][7];
    $amount_food = $information[0][8];
    $food = $information[0][9];
    $price_offer = $information[0][10];

    
    $name = "Automated mail";
    $mail = new PHPMailer();
    $mail->CharSet = 'UTF-8';

    $body = 'Hei, <br/> <br/>Du har blitt valgt til å levere for et arrangement!' .
            '<h3>Informasjon som følger..</h3>'.
            '<br><label>Adresse:</label>'.$adress . 
            '<br><label>Postnummer:</label>' . $zip . 
            '<br><label>Dato:</label>' . $date .
            '<br><label>Totalt gjester:</label>' . $total_people.
            '<br><label>Mat/Antall:</label>' .$food . " " . $amount_food.
            '<br><br><label>Ditt prisanbud:</label>'.$price_offer.
            '<br><br><h4>Kontakt informasjon:</h4>'.
            '<br><label>E-post:</label>' . $user_email.
            '<br><label>Telefon:</label>'. $user_phone;

    $mail->IsSMTP();
    $mail->Host = 'smtp.gmail.com';

    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;
    $mail->SMTPDebug = 0;
    $mail->SMTPAuth = true;

    $mail->Username = 'mailsender.company@gmail.com';
    $mail->Password = 'catering1234';

    $mail->SetFrom('mailsender.company@gmail.com', $name);
    $mail->AddReplyTo('mailsender.company@gmail.com', 'no-reply');
    $mail->Subject = 'Arrangement, du har blitt valgt til å servere';
    $mail->MsgHTML($body);

    $mail->AddAddress($recipient, $recipient);
    $mail->send();
}

//sendRecoveryMail("msnorc@gmail.com");
?>
