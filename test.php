<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Path to autoload.php in your project

// Generate OTP (One Time Password)
$otp = mt_rand(100000, 999999); // Random 6-digit number

// Send email with OTP
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
    $mail->addAddress("devkumar@cyberswipe.in");     // Add a recipient

    // Content
    $mail->isHTML(true);
    $mail->Subject = 'OTP Verification';
    $mail->Body    = 'Your OTP for registration: <strong>' . $otp . '</strong><br><br>'
                   . 'Do not share this OTP with any untrusted person. It is sensitive for you.<br><br>'
                   . '<p1>Make it in your mind only</p1>';

    $mail->send();
    echo 'Email has been sent with OTP.';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>
