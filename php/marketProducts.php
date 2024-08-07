<?php
require_once '../php/connection.php';

try {
    session_start();
    
    // Clear product_info session variable
    if (isset($_SESSION['product_info'])) {
        unset($_SESSION['product_info']);
    }

    // Prepare the query using a prepared statement
    $query = "SELECT * FROM tbl_products WHERE product_status != ? ORDER BY RAND() LIMIT 8";
    $stmt = $connect->prepare($query);
    $status = 'INACTIVE';
    $stmt->bind_param('s', $status);
    $stmt->execute();
    $result = $stmt->get_result();

    // Fetch products
    $products_info = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $products_info[] = $row;
        }
    }

    // Store product information in session
    $_SESSION['product_info'] = $products_info;

    // Redirect to market page
    header('Location: ../pages/market.php');
    exit();

} catch (Exception $e) {
    // Handle exception and display sanitized error message
    echo "Error: " . htmlspecialchars($e->getMessage());
}
?>
