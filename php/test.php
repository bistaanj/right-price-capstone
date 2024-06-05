<?php

// Code to send email verification
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require '../vendor/autoload.php';

$email = "bistaanj@gmail.com"; // Example email, change as needed
$verification_code = "your_verification_code"; // Replace with your actual verification code

verify_user($email, $verification_code);

function verify_user($email, $verification_code)
{
    $mail = new PHPMailer(true);
    try {
        //Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Replace with your SMTP server
        $mail->SMTPAuth = true; // Enable SMTP authentication
        $mail->Username = 'getrightprice4u@gmail.com'; // Replace with your SMTP username
        $mail->Password = 'wurneobhhepytxrp'; // Replace with your SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption
        $mail->Port = 587; // TCP port to connect to

        //Recipients
        $mail->setFrom('bistaanj@gmail.com', 'Mailer');
        $mail->addAddress($email); // Add a recipient

        // Content
        $mail->isHTML(true); // Set email format to HTML
        $mail->Subject = 'Email Verification';
        $email_content = "
            Verify your email 
            <br/>
            <br/>
            <a href='http://localhost:3000/pages/login.php/verify_user.php?code=$verification_code'>Click me</a>
        ";
        $mail->Body = $email_content;
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();
        echo 'Verification email has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>
