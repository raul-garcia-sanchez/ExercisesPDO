<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Send Email</title>
</head>
<body>

<h1>Send Email</h1>

<form method="post">
    <label for="to">Email to:</label><br>
    <input type="text" id="to" name="emailTo" placeholder="Write an email"><br><br>
    <label for="subject">Subject:</label><br>
    <input type="text" id="subject" name="emailSUbject" placeholder="Write a subject"><br><br>
    <label for="content">Content:</label><br>
    <input type="text" id="content" name="emailContent" placeholder="Write a content"><br><br>
    <input type="submit" name="submitButton" value="Send email">
</form>

<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'vendor/phpmailer/phpmailer/src/Exception.php';
require 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
require 'vendor/phpmailer/phpmailer/src/SMTP.php';
if(isset($_POST['submitButton'])){
    $mail = new PHPMailer;
$mail->isSMTP();
$mail->Mailer = "smtp";
$mail->SMTPDebug  = 1;  
$mail->SMTPAuth   = TRUE;
$mail->SMTPSecure = "tls";
$mail->Port       = 587;
$mail->Host       = "smtp.gmail.com";
$mail->Username   = "rgarciasanchez.cf@iesesteveterradas.cat";
$mail->Password   = "*****************";
$mail->IsHTML(true);
$mail->AddAddress($_POST['emailTo']);
$mail->SetFrom("rgarciasanchez.cf@iesesteveterradas.cat", "Raul Garcia");
$mail->Subject  = $_POST['emailSUbject'];
$mail->Body     = $_POST['emailContent'];
if(!$mail->send()) {
  echo '<p>Message was not sent.</p>';
} else {
  echo '<p>Message has been sent.</p>';
}
}

?>
    
</body>
</html>