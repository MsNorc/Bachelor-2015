<?php

//mailsender.company@gmail.com
//catering1234

require('PHPMailer-master/PHPMailerAutoload.php');

function sendRecoveryMail($recipient, $encryptedEmail) {

    $name = "Automated recovery mail";
    $mail = new PHPMailer();
    $mail->CharSet = 'UTF-8';

    $body = 'Hello, <br/> <br/>Click the link to reset the password for ' . $recipient . ' '
            . '<br><br>Click here to reset your password '
            . 'http://localhost/Bachelor15/resetPassword.php?encrypt=' . $encryptedEmail . '&action=reset '
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

function sendEmailVerification() {
    
}

function sendEmail_pickedProvider($recipient) {
    $name = "Automated mail";
    $mail = new PHPMailer();
    $mail->CharSet = 'UTF-8';

    $body = 'Hello, <br/> <br/>You have been chosen to cater';
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
    $mail->Subject = 'You have been chosen for the job';
    $mail->MsgHTML($body);

    $mail->AddAddress($recipient, $recipient);
    $mail->send();
}

//sendRecoveryMail("msnorc@gmail.com");
?>
