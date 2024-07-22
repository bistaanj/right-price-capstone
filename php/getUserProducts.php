<?php
require_once 'connection.php';
session_start();

$user_id = $_SESSION['user_id'];
 try{
    $querry = "SELECT * from tbl_products where user_id = ? ";
    $bind_statement = $connect->prepare($querry);
    $bind_statement->bind_param("i",$user_id);
    $result = $bind_statement->execute();
    $result = $bind_statement->get_result();
    while ($row = $result->fetch_assoc()) {
            $products[] = $row;
        }
    $_SESSION['user_products'] = $products;
    header('Location:../pages/userproducts.php');


 }catch (Exception $e) {
    echo $e;

 }





?>