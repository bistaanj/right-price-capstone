<?php
require_once '../php/connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Data from the form
    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];

    // Sql
    $stmt = $connect->prepare("INSERT INTO tbl_wishlist_item (product_id, quantity) VALUES (?, ?)");
    $stmt->bind_param("id", $product_id, $quantity);

    if ($stmt->execute()) {
        echo "New wishlist add.";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $connect->close();
} else {
    echo "Not POST Method";
}
?>
