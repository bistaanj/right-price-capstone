<?php
require_once '../php/connection.php';

function validationPassword($password)
{
    return preg_match('/^(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/', $password);
}

// Code to send email verification
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require '../vendor/autoload.php';


// Function to send verification email to the user
function verify_user($email, $verification_code)
{
    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'getrightprice4u@gmail.com'; //This is the google if for our project
    $mail->Password = 'wurneobhhepytxrp'; // This is the app password to grant acces to our email verification
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    $mail->setFrom('getrightprice4u@gmail.com', 'Right Price ');
    $mail->addAddress($_POST["email"]);

    $mail->isHTML(true);
    $mail->Subject = 'Email Verification';
    $email_content = "
            <b> We are happy to have you onboard. Please verify your email with the link below. 
            <br/>
            <br/>
            <button> <a href='http://localhost:3000/php/verify_user.php?code=$verification_code'>Verify</a> </button>
        ";
    $mail->Body = $email_content;
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();

}

try {

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        // receiving data from form
        $fname = $_POST["fname"];
        $lname = $_POST["lname"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $verification_code = md5(rand() . time());
        $verified_status = 0;

        // Validations
        $errors = [];
        if (!validationPassword($password)) {
            $errors[] = "Password is not valid.";
        }

        if (empty($errors)) {
            // posting data to database
            $querry = "INSERT INTO tbl_user (fname, lname, email, password, verification_code,verified) VALUES (?, ?, ?, ?,?,?)";
            $bind_statement = $connect->prepare($querry);
            $bind_statement->bind_param("sssssi", $fname, $lname, $email, $password, $verification_code, $verified_status);
            $result = $bind_statement->execute();

            verify_user($email, $verification_code);

            header("Location: ../pages/login.php");
        } else {
            $register_error = urlencode(implode(' ', $errors));
            header("Location: ../pages/signup.php?register_error=" . $register_error . "&fname=" . urlencode($fname) . "&lname=" . urlencode($lname) . "&email=" . urlencode($email));
            exit();
        }

    }
    // The Trigger throws and error if the Email already exists so the error is managed here
} catch (Exception $e) {
    $register_error = "Email Already Exists.";
    header("Location: signup.php?register_error=" . urlencode($register_error));
    exit();
}
?>