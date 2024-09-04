<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Path to autoload.php in your project

// Send email with message
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;
    $mail->Username = 'secfile101@gmail.com'; // SMTP username (your Gmail address)
    $mail->Password = 'zzih ydjd wsly hwzs'; // SMTP password (your Gmail password or App Password)
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    //Recipients
    $mail->setFrom('secfile101@gmail.com', 'hello sir');
    $mail->addAddress("shekharnitish93041@gmail.com");     // Add a recipient

    // Content
    $mail->isHTML(true);
    $mail->Subject = 'Important Message for you';
    $mail->Body    = 'bsdk nitish nitish kumar kkrh btech cse DATA SCIENCE .<br><br>'
    
                   . '<p1>Make it in your mind only</p1>';

    $mail->send();
    echo 'Email has been sent with your message.';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>
