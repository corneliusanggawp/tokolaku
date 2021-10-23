<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../public/vendor/PHPMailer/src/Exception.php';
require '../public/vendor/PHPMailer/src/OAuth.php';
require '../public/vendor/PHPMailer/src/PHPMailer.php';
require '../public/vendor/PHPMailer/src/POP3.php';
require '../public/vendor/PHPMailer/src/SMTP.php';


class Mailer {

    public static function sendMail($menu, $username, $email, $verifCode)
    {
        // Instantiation and passing `true` enables exceptions
        $mail = new PHPMailer(true);
 
        //Server settings
        // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                  // Enable verbose debug output
        $mail->isSMTP();                                           // Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                      // Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                  // Enable SMTP authentication
        $mail->Username   = 'khongcuann@gmail.com';                // SMTP username
        $mail->Password   = 'lucubanget9';                         // SMTP password
        // $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;     // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
        $mail->Port       = 587;                                   // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
 
        //Recipients
        $mail->setFrom('khongcuann@gmail.com');
        $mail->addAddress($email, $username);     // Add a recipient
 
        $mail->addReplyTo('khongcuann@gmail.com');
        // $mail->addCC('cc@example.com');
        // $mail->addBCC('bcc@example.com');
 
        // Attachments
        // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
        // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
 
        // Content
        $mail->isHTML(true); // Set email format to HTML
        $mail->Subject = 'Vertifikasi Akun TokoLaku';
        $mail->Body    = '<p>Halo ' . $username . ', terimakasih sudah mendaftar di TokoLaku.</p> <p>Klik <a href="'. BASEURL .'/'. $menu .'/authVerification/'. $username .'/' . $verifCode . '">disini</a> untuk melakukan vertifikasi </p> ';
 
        if ($mail->send()) {
            echo 'Email Terkirim';
        } else {
            echo "Email tidak terkirim. Mailer Error: {$mail->ErrorInfo}";
        }

    }

}