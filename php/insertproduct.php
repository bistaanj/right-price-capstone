<?php
require_once '../php/connection.php';
include '../includes/checkSession.php';

try {
    session_start();
    $user_id = $_SESSION['user_id'];
    $saleType = $_POST["sales_type"];
    $name = $_POST["product_name"];
    $category = $_POST["product_category"];
    $price = $_POST["price"];
    $unit = $_POST["unit"];
    $short_description = $_POST["short_description"];
    $description = $_POST["description"];
    $addedDate = date("Y-m-d");
    $product_status = "Active";

    // Handle file upload
    $imageLink = null;
    if (isset($_FILES['product_image']) && $_FILES['product_image']['error'] == 0) {
        $imageLink = $_FILES['product_image']['name'];
        move_uploaded_file($_FILES['product_image']['tmp_name'], '../uploads/' . $imageLink);
    }

    // Prepare SQL query
    $query = "INSERT INTO tbl_products (user_id, product_name, product_unit, product_category, product_price, product_image, product_description, product_added, product_status, sale_type) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $connect->prepare($query);

    // Bind parameters
    $stmt->bind_param("issidssssss", $user_id, $name, $unit, $category, $price, $imageLink, $description, $short_description, $addedDate, $product_status, $saleType);

    // Execute the query
    if ($stmt->execute()) {
        header("Location: ../pages/userproducts.php?status=success");
        exit();
    } else {
        throw new Exception("Error executing query: " . $stmt->error);
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
    exit();
}
?>
