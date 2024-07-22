<?php
require_once 'connection.php';
try{
    $transaction_type = $_GET['transaction'];
    $product_id = $_GET['id'];

    if($transaction_type=="delete"){
        $querry = "DELETE from tbl_products where product_id = ?";
        $bind_statement = $connect->prepare($querry);
        $bind_statement->bind_param("i", $product_id);        
    }elseif ($transaction_type=="deactivate") {
        $querry = "UPDATE tbl_products  SET product_status = CASE 
            WHEN product_status = 'INACTIVE' THEN 'ACTIVE' 
            ELSE 'INACTIVE' 
            END 
            where product_id = ?";
        $bind_statement = $connect->prepare($querry);
        $bind_statement->bind_param("i", $product_id);
        
    }
    $bind_statement->execute();
    header("Location:../php/getUserProducts.php");

}catch (Exception $e){
    echo $e;

}

?>


