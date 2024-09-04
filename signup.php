<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Path to autoload.php in your project

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize inputs
    $name = htmlspecialchars(trim($_POST["name"]));
    $surname = htmlspecialchars(trim($_POST["surname"]));
    $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
    $password = htmlspecialchars($_POST["password"]);
    $confirmPassword = htmlspecialchars($_POST["confirmPassword"]);

    // Check if passwords match
    if ($password !== $confirmPassword) {
        $message = "Passwords do not match!";
    } else {
        // Generate OTP (One Time Password)
        $otp = mt_rand(100000, 999999); // Random 6-digit number

        // Send email with OTP
        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;
            $mail->Username = 'smtp mail here'; // SMTP username
            $mail->Password = 'smtp password here '; // SMTP password (use an app password if 2-step verification is enabled)
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; //encryption
            $mail->Port = 273;//enter port number

            //Recipients
            $mail->setFrom('mail address here', 'SecFile OTP Verification');
            $mail->addAddress($email);     // Add a recipient

            // Content
            $mail->isHTML(true);
            $mail->Subject = 'OTP Verification';
            $mail->Body    = 'Your OTP for registration: <strong>' . $otp . '</strong>';

            $mail->SMTPOptions = array(
                'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' =>true
            )
                );

                $mail->SMTPDebug =0;
                $mail->Debugoutput ='html';

            $mail->send();
            $message = 'An OTP has been sent to your email. Please enter it below.';
            session_start();
            $_SESSION['name']=$name;
            $_SESSION['sur_name']=$surname;
            $_SESSION['email']=$email;
            $_SESSION['password']=$password;
            


            header("Location: verify.php?message=$message");
            exit();
        } catch (Exception $e) {
            $message = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            error_log("Mailer Error: " . $mail->ErrorInfo); // Log error for debugging
        }
    }
}
?>

