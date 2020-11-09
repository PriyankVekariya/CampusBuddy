<?php
require_once "Mail/send_mail.php";
$mail = $_POST["temp_email"];
echo $mail;
$send_mail = new SendMail();
$result = $send_mail->SendOTP($mail);
if($result){
    // setcookie("UserMail", (string)$mail, time() + (86400 * 30), "/");
} else {
    echo $result;
    echo "Something went wrong";
}
?>