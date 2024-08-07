<?php
require_once '../php/connection.php';
$req_product = $_GET['id'];
session_start();

try {
    $querry = "SELECT p.*, u.fname, u.lname from tbl_products p JOIN tbl_user u ON u.user_id = p.user_id where p.product_id = ?  ";
    $bind_statement = $connect->prepare($querry);
    $bind_statement->bind_param("i", $req_product);
    $bind_statement->execute();
    $result = $bind_statement->get_result();
    if ($result->num_rows == 1) {
        while ($row = $result->fetch_assoc()) {
            $current_product[] = $row;
        }
        if (isset($_SESSION['current_product'])) {
            unset($_SESSION['current_product']);
        }
        $_SESSION['current_product'] = $current_product;
        header('Location: ../pages/productinfo.php');


    }
} catch (Exception $e) {
    echo "404 Page not Found";
}



?>