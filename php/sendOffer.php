<?php
session_start();
require_once 'connection.php';
try{
    if (isset($_POST['send_offer'])) {
        $user_id = $_SESSION['user_id'];
        $data = $_SESSION['current_product'];
        $product = $data[0];
        $product_id = $product['product_id'];
        $user_offer = floatval($_POST['user_offer']);
        $reserve_price = $product['product_price'];
        if ($user_offer < $reserve_price) {
            header("Location: ../pages/productinfo.php?offer_status=value");
        } else {

            try{
                $querry = "CALL check_buyer(?, ?, ?, @response_message)";
                $bind_statement = $connect->prepare($querry);
                $bind_statement->bind_param("iid", $user_id, $product_id,$user_offer);
                $bind_statement->execute();                
                $data = $connect->query("SELECT @response_message AS response ");
                $response = $data->fetch_assoc();
                $offer_status = $response['response'];
                header("Location: ../pages/productinfo.php?offer_status=" . urldecode($offer_status));}
            catch (Exception $e){
                echo $e;
            }
        }
    }
}catch (Exception $e) {
    echo $e;
}
?>