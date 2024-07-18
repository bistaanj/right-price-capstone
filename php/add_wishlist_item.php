<?php
session_start();
require_once '../php/connection.php';

if (isset($_POST['product_id'])) {
    $product_id = $_POST['product_id'];
    $quantity = 1; 

    // Insert
    $sql = "INSERT INTO tbl_wishlist_item (product_id, quantity) VALUES (?, ?)";
    $stmt = $connect->prepare($sql);
    $stmt->bind_param("ii", $product_id, $quantity);

    if ($stmt->execute()) {
        header("Location: ../pages/wishlist.php?success=Product added to wishlist");
    } else {
        header("Location: ../pages/wishlist.php?error=Failed to add product to wishlist");
    }

    $stmt->close();
    $connect->close();
} else {
    header("Location: ../pages/wishlist.php?error=No product selected");
}
?>

