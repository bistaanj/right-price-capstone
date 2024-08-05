<?php
require_once 'connection.php';
include '../includes/checkSession.php';
// Code to send email verification
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require '../vendor/autoload.php';

try {
    $product_id = $_GET['product'];
    $buyer_id = $_GET['buyer'];
    $order_id = $_GET['id'];
    $transaction_type = $_GET['transaction'];

    $querry = "CALL updateOrderStatus(?,?,?,?)";
    $bind_statement = $connect->prepare($querry);
    $bind_statement->bind_param("iiis", $order_id, $buyer_id, $product_id, $transaction_type);
    

    if ($bind_statement->execute()) {
        $secondary_query = "SELECT u.email, p.product_name FROM tbl_user u JOIN tbl_products p ON p.product_id = ? WHERE u.user_id = ?";
        $bind_statement = $connect->prepare($secondary_query);
        $bind_statement->bind_param("ii", $product_id, $buyer_id);
        $bind_statement->execute();
        $result = $bind_statement->get_result();
        $row = $result->fetch_assoc();


        header('Location: ../php/getOrders.php');

        function sendOrderMail($email, $productName, $emailtype)
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
            $mail->addAddress($email);
            $mail->isHTML(true);
            if ($emailtype == "DECLINED") {
            $mail->Subject = 'Order Declined';
                $email_content = "
                    <!DOCTYPE html>
                        <html lang='en'>
                            <head>
                                <meta charset='UTF-8'>
                                <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                                <style>
                                    .container {
                                        margin-top: 50px;
                                        max-width: 600px;
                                        padding: 15px;
                                        margin-left: auto;
                                        margin-right: auto;
                                        display: flex;
                                        width: 30vw;
                                    }
                                    .card {
                                        padding: 20px;
                                        border: 1px solid #dee2e6;
                                        border-radius: 5px;
                                        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
                                    }
                                    .card-title {
                                        font-size: 1.25rem;
                                        display: flex;
                                        justify-content: center;
                                        width: 100%;
                                        margin-bottom: 20px;
                                        background-color: red;
                                        text-align: center;
                                    }
                                    .card-text {
                                        font-size: 1rem;
                                        margin-bottom: 15px;
                                        display: flex;
                                        flex-direction: column;
                                        justify-content: center;
                                        line-height: 5vh;
                                        text-align: center;
                                    }
                                    .card-footer{
                                        margin-top: 60px;
                                    }
                                    .product_name{
                                        font-size: 1.5rem;
                                        justify-content: center;
                                        font-weight: bold;
                                    }
                                </style>
                                <title>Email Notification</title>
                            </head>
                            <body>    
                                <div class='container'>
                                    <div class='card'>
                                        <div class='card-title'>
                                            <h2>Order Declined</h2>
                                        </div>

                                        <div class='card-body'>
                                            <p class='card-text'>
                                                <div>This is to inform you that your order for the product</div>
                                                <div class='product_name'> $productName </div> 
                                                <div> was declined by the seller. </div>
                                            </div>
                                            <div class='card-footer'>
                                                <p>
                                                    We apologize for the inconvenience.
                                                </p>
                                                <p>
                                                    <strong>Right Price Team</strong>
                                                </p>

                                            </div>

                                            </p>
                                    </div>
                                </div>
                            </body>
                    </html>";
            } else {
            $mail->Subject = 'Order Dispatched';
                $email_content = "
                    <!DOCTYPE html>
                        <html lang='en'>
                            <head>
                                <meta charset='UTF-8'>
                                <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                                <style>
                                    .container {
                                        margin-top: 50px;
                                        max-width: 600px;
                                        padding: 15px;
                                        margin-left: auto;
                                        margin-right: auto;
                                        display: flex;
                                        width: 30vw;
                                    }
                                    .card {
                                        padding: 20px;
                                        border: 1px solid #dee2e6;
                                        border-radius: 5px;
                                        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
                                    }
                                    .card-title {
                                        font-size: 1.25rem;
                                        display: flex;
                                        justify-content: center;
                                        width: 100%;
                                        margin-bottom: 20px;
                                        background-color: green;
                                        text-align: center;
                                    }
                                    .card-text {
                                        font-size: 1rem;
                                        margin-bottom: 15px;
                                        display: flex;
                                        flex-direction: column;
                                        justify-content: center;
                                        line-height: 5vh;
                                        text-align: center;
                                    }
                                    .card-footer{
                                        margin-top: 60px;
                                    }
                                    .product_name{
                                        font-size: 1.5rem;
                                        justify-content: center;
                                        font-weight: bold;
                                    }
                                </style>
                                <title>Email Notification</title>
                            </head>
                            <body>    
                                <div class='container'>
                                    <div class='card'>
                                        <div class='card-title'>
                                            <h2>Order Dispatched</h2>
                                        </div>
                                        <div class='card-body'>
                                            <p class='card-text'>
                                                <div>This is to inform you that your order for the product</div>
                                                <div class='product_name'> $productName </div> 
                                                <div> has been dispatched by the seller.You might receive further details
                                                about the shipping information from the seller.</div>
                                            </div>
                                            <div class='card-footer'>
                                                <p>
                                                    Thank you for using our platform
                                                </p>
                                                <p>
                                                    <strong>Right Price Team</strong>
                                                </p>

                                            </div>

                                            </p>
                                    </div>
                                </div>
                            </body>
                    </html>";

            }
            $mail->Body = $email_content;
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
            $mail->send();

        }
        sendOrderMail($row['email'], $row['product_name'], $transaction_type);
        header('Location: ../php/getOrders.php');
    } else {
        header('Location: ../pages/error.php');
    }

} catch (Exception $e) {
    header('Location:../pages/error.php?catchingException');
}



?>