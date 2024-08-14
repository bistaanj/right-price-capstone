<?php
require_once 'connection.php';
include '../includes/checkSession.php';


$user_id = $_SESSION['user_id'];
try {

   $querry = "SELECT p.*, a.total_offer
               FROM tbl_products p 
               LEFT JOIN tbl_auction_details a ON p.product_id = a.product_id 
               WHERE p.user_id = ? ";

   //  $querry = "SELECT * from tbl_products where user_id = ? ";
   $bind_statement = $connect->prepare($querry);
   $bind_statement->bind_param("i", $user_id);
   $result = $bind_statement->execute();
   $result = $bind_statement->get_result();
   while ($row = $result->fetch_assoc()) {
      $products[] = $row;
   }
   $_SESSION['user_products'] = $products;
   if (isset($_GET['status'])) {

      header('Location:../pages/userproducts.php?status=success');
   } else {
      header('Location:../pages/userproducts.php');
   }




} catch (Exception $e) {
   echo $e;

}





?>