<?php
require_once '../php/connection.php';
session_start();



if (strlen($_POST['productName_search']) > 0) {
    $name = $_POST['productName_search'];
    $user_id = $_SESSION['user_id'];

    $querry = "SELECT * from tbl_products where (product_name = ? or keyword like '%$name%') AND product_status != 'INACTIVE' AND user_id != ?  ";
    $bind_statement = $connect->prepare($querry);
    $bind_statement->bind_param("si", $name, $user_id );
    $bind_statement->execute();
    $result = $bind_statement->get_result();
    if (isset($_SESSION['product_info'])) {
        unset($_SESSION['product_info']);
    }
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $products_info[] = $row;
        }
    } else {
        echo "No results";
    }
    $_SESSION['product_info'] = $products_info;
    header('Location: ../pages/market.php');
    exit();



} elseif (strlen($_POST['productName_search']) < 1) {
    header('Location: ../php/marketProducts.php');
}

?>
