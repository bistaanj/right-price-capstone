<?php
session_start();
require_once '../php/connection.php';

if (isset($_POST['product_id'])) {
    $product_id = $_POST['product_id'];
    $quantity = 1; 
    $user_id = $_SESSION['user_id']; 
    $status = 'UNORDERED';

    // verify product in table
    $check_sql = "SELECT * FROM tbl_wishlist_item WHERE product_id = ? AND user_id = ?";
    $stmt_check = $connect->prepare($check_sql);
    $stmt_check->bind_param("ii", $product_id, $user_id);
    $stmt_check->execute();
    $result_check = $stmt_check->get_result();

    if ($result_check->num_rows > 0) {
        header("Location: ../pages/wishlist.php?error=Product already in wishlist");
    } else {
        $insert_sql = "INSERT INTO tbl_wishlist_item (product_id, quantity, user_id, product_status) VALUES (?, ?, ?,?)";
        $stmt_insert = $connect->prepare($insert_sql);
        $stmt_insert->bind_param("iiis", $product_id, $quantity, $user_id,$status);

        if ($stmt_insert->execute()) {
            header("Location: ../pages/wishlist.php?success=Product added to wishlist");
        } else {
            header("Location: ../pages/wishlist.php?error=Failed to add product to wishlist");
        }

        $stmt_insert->close();
    }

    $stmt_check->close();
    $connect->close();
} else {
    header("Location: ../pages/wishlist.php?error=No product selected");
}
?>
