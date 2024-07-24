<?php
require_once 'connection.php';

if (isset($_POST['product_id'])) {
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_category = $_POST['product_category'];
    $price = $_POST['price'];
    $unit = $_POST['unit'];
    $description = $_POST['description'];
    $sales_type = $_POST['sales_type'];

    // Initialize $product_image
    $product_image = null;
    
    // Check if an image file has been uploaded
    if (isset($_FILES['product_image']) && $_FILES['product_image']['error'] == 0) {
        $product_image = $_FILES['product_image']['name'];
        move_uploaded_file($_FILES['product_image']['tmp_name'], '../uploads/' . $product_image);
    }

    // Build the query based on whether an image is provided
    $query = "UPDATE tbl_products SET 
              product_name = ?, 
              product_category = ?, 
              product_price = ?, 
              product_unit = ?, 
              product_description = ?, 
              sale_type = ?";

    if ($product_image) {
        $query .= ", product_image = ?";
    }
    
    $query .= " WHERE product_id = ?";

    // Prepare the statement
    $stmt = $connect->prepare($query);

    // Bind parameters based on whether an image is provided
    if ($product_image) {
        $stmt->bind_param('ssissssi', $product_name, $product_category, $price, $unit, $description, $sales_type, $product_image, $product_id);
    } else {
        $stmt->bind_param('ssisssi', $product_name, $product_category, $price, $unit, $description, $sales_type, $product_id);
    }

    // Execute the statement
    if ($stmt->execute()) {
        // Redirect to userproducts.php with a success message
        header('Location: ../pages/userproducts.php?status=success');
        exit();
    } else {
        echo "Error updating record: " . $stmt->error;
    }
}
?>
