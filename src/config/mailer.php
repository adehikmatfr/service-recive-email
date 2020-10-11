<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function mailSend($email, $message)
{
    $mail = new PHPMailer(true);

    try {

        $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
        $mail->isSMTP();                                            // Send using SMTP
        $mail->Host       = $_ENV["MAIL_HOST"];                    // Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
        $mail->Username   = $_ENV["MAIL_UERNAME"];                     // SMTP username
        $mail->Password   = $_ENV["MAIL_PASSWORD"];                               // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
        $mail->Port       = $_ENV["MAIL_PORT"];                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

        //Recipients
        $mail->setFrom($_ENV["MAIL_UERNAME"], 'ade');
        $mail->addAddress($email);     // Add a recipient            // Name is optional
        $mail->addReplyTo($_ENV["MAIL_REPLAY"], 'Ade Hikmat fr');

        // Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = 'Send Email Test Queue';
        $mail->Body    = $message;

        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
