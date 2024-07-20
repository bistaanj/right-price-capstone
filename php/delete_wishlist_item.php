<?php

require_once '../php/connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $wishlist_item_id = $_POST['wishlist_item_id'];

    // delete wishlist_item
    $sql = "DELETE FROM tbl_wishlist_item WHERE wishlist_item_id = ?";
    $stmt = $connect->prepare($sql);
    $stmt->bind_param("i", $wishlist_item_id);

    if ($stmt->execute()) {
        echo "Item removed from wishlist.";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

// rediret to wishlist
header('Location: ../pages/wishlist.php');
exit();
?>
