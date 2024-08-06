<?php
require_once '../php/connection.php';
include '../includes/checkSession.php';
try{
    $querry = "SELECT o.*, p.product_name, p.product_price, p.product_image, u.fname,u.email 
    FROM  
        tbl_order o
    JOIN 
        tbl_products p ON o.product_id = p.product_id
    JOIN 
        tbl_user u ON o.seller_id = u.user_id";
    $result = $connect->query($querry);
    if($result){       
        while ($row = $result->fetch_assoc()){
            $user_orders[] = $row;
        }
    }else{
        $user_orders = [];
    }  
    $_SESSION['user_orders'] = $user_orders;
    header('Location: ../pages/userOrder.php');


}catch (Exception $e){
    header('Location: ../pages/error.php');
}


?>