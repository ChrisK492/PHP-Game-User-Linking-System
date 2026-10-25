<?php

require_once __DIR__ . "/../../static/Settings.php";
require_once __DIR__ . "/../../static/tools/phpmailer/PHPMailer.php";
require_once __DIR__ . "/../../static/tools/phpmailer/SMTP.php";
require_once __DIR__ . "/../../static/tools/phpmailer/Exception.php";


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


class EmailManager
{
    public static function sendEmail(
        string $aAdress,
        string $aSubject,
        string $aHTML
    ): bool {
        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->SMTPDebug = SMTP::DEBUG_OFF;                     //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = Settings::EMAIL_HOST;                    //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = Settings::EMAIL_USER;                   //SMTP username
            $mail->Password   = Settings::EMAIL_PASSWORD;                                //SMTP password
            $mail->SMTPSecure = Settings::EMAIL_AUTH_METHOD;             //Enable implicit TLS encryption
            $mail->Port       = Settings::EMAIL_PORT;                                     //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom(Settings::EMAIL_USER);

            $mail->addAddress($aAdress);     //Add a recipient


            // $mail->addAddress('ellen@example.com');               //Name is optional
            // $mail->addReplyTo('info@example.com', 'Information');
            // $mail->addCC('cc@example.com');
            // $mail->addBCC('bcc@example.com');

            // //Attachments
            // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
            // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = $aSubject;
            $mail->Body    = $aHTML;

            $mail->send();

            return true;

        } catch (Exception) {
            return false;
        }
    }
}
