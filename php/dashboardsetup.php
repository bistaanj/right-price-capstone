<?php
include_once "connection.php";
include '../includes/checkSession.php';

// Fetching the data from tbl_products
try{
    $user_id = $_SESSION['user_id']; 
    $sales_type = "Sale" ;  
    $product_status = 'ACTIVE';
    $querry = "SELECT COUNT(*) as count from tbl_products where user_id = ? and sale_type = ? and product_status = ?";
    $bind_statement = $connect->prepare($querry);
    $bind_statement -> bind_param('iss',$user_id,$sales_type,$product_status);
    $bind_statement->execute();
    $result = $bind_statement->get_result();
    $row = $result->fetch_assoc();
    $sales_count = $row['count'];

    $sales_type = "Auction";
    $querry = "SELECT COUNT(*) as count from tbl_products where user_id = ? and sale_type = ? and product_status = ?";
    $bind_statement = $connect->prepare($querry);
    $bind_statement->bind_param('iss', $user_id, $sales_type,$product_status);
    $bind_statement->execute();
    $result = $bind_statement->get_result();
    $row = $result->fetch_assoc();
    $auction_count = $row['count']; 
    $_SESSION['user_sale_count']=$sales_count;
    $_SESSION['user_auction_count']=$auction_count;
}
catch (Exception $e) {
    echo "Error: " . $e;
}

// fetching product from tbl_blog

try{
    $user_id = $_SESSION['user_id'];    
    $querry = "SELECT COUNT(*) as count from tbl_blog where blog_author= ?";
    $bind_statement = $connect->prepare($querry);
    $bind_statement -> bind_param('i',$user_id);
    $bind_statement->execute();
    $result = $bind_statement->get_result();
    $row = $result->fetch_assoc();
    $blog_count = $row['count'];
    // if(isset($_SESSION['user_blog_count']){
    //     unset($_SESSION['user_blog_count']);

    // })
    $_SESSION['user_blog_count']= $blog_count;
    header("Location: ../pages/dashboard.php");
}
catch (Exception $e){
    echo "Error: " . $e;
}

try {
    $user_id = $_SESSION['user_id'];
    $querry = "SELECT COUNT(*) as count from tbl_wishlist_item where user_id= ?";
    $bind_statement = $connect->prepare($querry);
    $bind_statement->bind_param('i', $user_id);
    $bind_statement->execute();
    $result = $bind_statement->get_result();
    $row = $result->fetch_assoc();
    $wishlist_count = $row['count'];
    
    $_SESSION['user_wishlist_count'] = $wishlist_count;
    header("Location: ../pages/dashboard.php");
} catch (Exception $e) {
    echo "Error: " . $e;
}
?>