<?php
    require_once 'connection.php';
    $querry = "SELECT a.user_id, u.email FROM tbl_auction_offer a JOIN tbl_user u ON u.user_id = a.user_id WHERE a.product_id = ? ";
    $bind_statement = $connect->prepare($querry);
    $bind_statement->bind_param("i", $product_id);
    $bind_statement->execute();
    $result = $bind_statement->get_result();
    $users=[];
    while($row = $result->fetch_assoc()){        
        if($row['user_id']!= $highestBidder_id){
            $users[] = $row['email'];
        }
        }
    $querry = "SELECT p.product_name, u.fname as name, u.email FROM tbl_products p JOIN tbl_user u ON u.user_id = p.user_id WHERE p.product_id = ? ";
    $bind_statement = $connect->prepare($querry);
    $bind_statement->bind_param("i", $product_id);
    $bind_statement->execute();
    $result = $bind_statement->get_result();
    $row = $result->fetch_assoc();
    $owner_email = $row['email'];
    $owner_name = $row['name'];
// Code to send email verification
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    //Load Composer's autoloader
    require '../vendor/autoload.php';

    // this is for the losers
    function sendbidderMail($email, $productName)
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
        foreach ($email as $address) {
            $mail->addAddress($address);
        }
        

        $mail->isHTML(true);
        $mail->Subject = 'Bid Result';
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
                    <h2>Bid Status Update</h2>
                </div>

                <div class='card-body'>
                    <p class='card-text'>
                        <div>This is to inform you that the offer you made to the product</div>
                        <div class='product_name'> $productName </div> 
                        <div> was declined because someone placed a higher bid than yours.</div>
                    </div>
                    <div class='card-footer'>
                        <p>
                            Thank you for participating.
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
        $mail->Body = $email_content;
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
        $mail->send();

    }
    // this is for the bid winner
    function sendhighestBidder($owner_name,$owner_email, $productName, $highestBidder)
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
        $mail->addAddress($highestBidder);
        


        $mail->isHTML(true);
        $mail->Subject = 'Congratulations !! Your Bid Result';
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
                flex-direction:column;
                justify-content: center;
                width: 100%;
                margin-bottom: 20px;
                background-color: green;
                color:white;
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
                    <h2>Bid Status Update</h2>
                </div>

                <div class='card-body'>
                    <p class='card-text'>
                        <div>Congratulations!!</div>
                        <div> You have won the bid for the purchase of the product</div>
                        <div class='product_name'> $productName </div> 
                        <div>Please contact the Seller for futher purchsing process.</div>
                        <div>Seller Contact Details:</div>
                        <div>
                        <div> Name : $owner_name </div>
                        <div> Email : $owner_email</div>
                    </div>
                    <div class='card-footer'>
                        <p>
                            Thank you for participating.
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
    $mail->Body = $email_content;
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
    $mail->send();
    }
    // This is for the Seller
function sendOwner($owner_name, $owner_email, $productName, $highestBidder)
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
    $mail->addAddress($owner_email);



    $mail->isHTML(true);
    $mail->Subject = 'Auction Completion Information';
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
                flex-direction:column;
                justify-content: center;
                width: 100%;
                margin-bottom: 20px;
                background-color: green;
                color:white;
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
                    <h2>Bid Status Update</h2>
                </div>

                <div class='card-body'>
                    <p class='card-text'>
                        <div>Dear <strong> $owner_name </strong> </div>
                         <div>Your auction has been completed.</div>
                        <div> We have sent you the contact details for the highest bidder.
                         Please contact the buyer for further acquiring process.</div>
                         <div> Product Name : </div>
                        <div class='product_name'>  $productName </div> 
                        <div>Seller Contact Details:</div>
                        <div>
                        <div> Email : $highestBidder </div>
                        </div>
                    <div class='card-footer'>
                        <p>
                            Thank you for choosing us. We look forward to host another auction soon.
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
    $mail->Body = $email_content;
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
    $mail->send();
}

    sendhighestBidder($owner_name , $owner_email, $productName,$highestBidder);
    sendOwner($owner_name, $owner_email, $productName, $highestBidder);
    if(count($users) > 0){
        sendbidderMail($users, $productName);
    }
    
?>