<?php
require_once 'connection.php';
include '../includes/checkSession.php';



try {
    $req_product = $_GET['id'];
    $querry = "SELECT * from tbl_products where product_id = ?";
    $bind_statement = $connect->prepare($querry);
    $bind_statement->bind_param("i", $req_product);
    $bind_statement->execute();
    $result = $bind_statement->get_result();
    if ($result->num_rows == 1) {
        while ($row = $result->fetch_assoc()) {
            $checkout_product[] = $row;
        }
        if (isset($_SESSION['checkout_product'])) {
            unset($_SESSION['checkout_product']);
        }
        $_SESSION['checkout_product'] = $checkout_product;
        echo $_SESSION['checkout_product'][0]['product_name'];
        header('Location: ../pages/placeorder.php');


    }
} catch (Exception $e) {
    header('Location: ../pages/error.php');

}









?>