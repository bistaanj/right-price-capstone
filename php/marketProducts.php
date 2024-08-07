<?php
require_once '../php/connection.php';
include '../includes/checkSession.php';


try {
    $user_id = $_SESSION['user_id'];
    $status = 'INACTIVE';
    if (isset($_SESSION['product_info'])) {
        unset($_SESSION['product_info']);
    }
    $querry = "SELECT * from tbl_products WHERE product_status != ? AND user_id != ? ORDER By RAND() LIMIT 8";
    $bind_statement = $connect->prepare($querry);
    $bind_statement->bind_param('si', $status , $user_id);
    $bind_statement->execute();
    $result = $bind_statement->get_result();

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
