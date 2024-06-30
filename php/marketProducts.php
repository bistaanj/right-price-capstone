<?php

require_once '../php/connection.php';

try {
    session_start();
    $querry = 'SELECT * from tbl_products';
    $result = $connect->query($querry);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $products_info[] = $row;
        }
    }

    header('Location: ../pages/market.php');
    $_SESSION['product_info'] = $products_info;
    exit();



} catch (Exception $e) {
    echo "Error: " . $e;
}
?>