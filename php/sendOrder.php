<?php
include '../includes/checkSession.php';
try{
    $quantity = $_POST['quantity'];
    $address = $_POST['address'];
    $address_secondary = $_POST['address_secondary'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $zip = $_POST['zip'];
    $phone = $_POST['phone'];
    $product_id = $_POST['product_id'];
    $buyer_id = $_SESSION['user_id'];
    $seller_id = $_POST['seller_id'];
    $order_status = 'ORDERED';
    

    $query = "INSERT INTO tbl_order (buyer_id, seller_id , address, address_secondary, city, state, zip, quantity, order_status, product_id, phone)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?)";
    $stmt = $connect->prepare($query);

    // Bind parameters
    $stmt->bind_param("iisssssisii", $buyer_id, $seller_id , $address, $address_secondary, $city, $state, $zip, $quantity, $order_status, $product_id, $phone);

    // Execute the query
    if ($stmt->execute()) {
        
        $querry = "UPDATE tbl_wishlist_item  SET product_status = ? WHERE product_id = ? AND user_id = ?";
        $bind_statement = $connect->prepare($querry);
        $bind_statement->bind_param("sii",$order_status, $product_id,$buyer_id);        
    } else {
        throw new Exception("Error executing query: " . $stmt->error);
    }

    // Change header location afterupdating the wishlist page
    if($bind_statement->execute()){
        header('Location:../pages/wishlist.php');
    }
}catch (Exception $e) {
    echo $e;
}


?>