<?php
class SendMail {
    function SendOTP($to_mail){
        $subject = 'Hi!';
        $body = "Hi,\n\nHow are you?";
        $mail_response = mail($to_mail, $subject, $body);
        if ($mail_response) {
            return $mail_response;
        } else {
            return $mail_response;
        }
    }
}
?>