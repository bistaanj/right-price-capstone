<?php
require_once 'connection.php';
require_once '../includes/checkSession.php';
try{
    $transaction_type = $_GET['transaction'];
    $product_id = $_GET['id'];
    // To delete product
    if($transaction_type=="delete"){
        $querry = "DELETE from tbl_products where product_id = ?";
        $bind_statement = $connect->prepare($querry);
        $bind_statement->bind_param("i", $product_id);
        $bind_statement->execute();
        
        // To deactivate product
    }elseif ($transaction_type=="deactivate") {
        $querry = "UPDATE tbl_products  SET product_status = CASE 
            WHEN product_status = 'INACTIVE' THEN 'ACTIVE' 
            ELSE 'INACTIVE' 
            END 
            where product_id = ?";
        $bind_statement = $connect->prepare($querry);
        $bind_statement->bind_param("i", $product_id);
        $bind_statement->execute();
        
    }
    elseif($transaction_type=="completeAuction"){
        $querry = "CALL getWinnerBidder(?, @highestBidder, @highestBidder_name, @highestBidder_email, @productName, @closureStatus, @highestAmount);";
        $bind_statement = $connect->prepare($querry);
        $bind_statement->bind_param("i", $product_id);
        $bind_statement->execute();
        $data = $connect->query("SELECT @highestBidder AS highestBidder, 
                                        @highestBidder_name AS highestBidder_name, 
                                        @highestBidder_email AS highestBidder_email,
                                        @productname AS productname, 
                                        @closureStatus AS closure_status, 
                                        @highestAmount AS highestAmount " );
        if($data){
            $result = $data->fetch_assoc();
            
            $closure_status = $result['closure_status'];
            if ($closure_status== 'success' ){
                $productName =$result['productname'];
                $highestBidder =$result['highestBidder_email'];
                $highestBidder_name =$result['highestBidder_name'];
                $highestBidder_id =$result['highestBidder'];
                $winning_amount =$result['highestAmount'];
                include '../php/bidCompletionMail.php';
                $link = 'name='.$highestBidder_name . '&product=' . $productName . '&amount=' . $winning_amount;
                header('Location: ../pages/auction_closure.php?'. urldecode($link));    
                exit();         
            }elseif($closure_status== 'void'){
                header('Location: ../pages/auction_void.php?') ;
                exit();
            }
    }
}
        
        
    header("Location:../php/getUserProducts.php");

}catch (Exception $e){
    echo $e;

}

?>


