<?php
// connection
require_once '../php/connection.php';

// get the filters values.
$searchQuery = isset($_GET['search']) ? $_GET['search'] : '';
$saleType = isset($_GET['sale_type']) ? $_GET['sale_type'] : '';
$productType = isset($_GET['product_type']) ? $_GET['product_type'] : '';
$searchType = isset($_GET['search_type']) ? $_GET['search_type'] : '';

// SQL
$sql = "SELECT * FROM tbl_products WHERE 1 = 1";

// Filter by search
if (!empty($searchQuery)) {
    if ($searchType == 'User') {
        $sql .= " AND user_id IN (SELECT user_id FROM tbl_users WHERE user_name LIKE '%$searchQuery%')";
    } else if ($searchType == 'Product') {
        $sql .= " AND (product_name LIKE '%$searchQuery%' OR product_description LIKE '%$searchQuery%')";
    }
}

// Filtrer by type of sale
if (!empty($saleType)) {
    $sql .= " AND sale_type = '$saleType'";
}

// Filter by product type
if (!empty($productType)) {
    if ($productType == 'livestock') {
        $sql .= " AND product_category = 1"; 
    } else if ($productType == 'plant') {
        $sql .= " AND product_category = 2"; 
    } else if ($productType == 'seeds') {
        $sql .= " AND product_category = 3"; 
    }
}

// sql 
$result = $connect->query($sql);

// get and return values
if ($result->num_rows > 0) {
    $products = array();
    while($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
    echo json_encode($products);
} else {
    echo json_encode(array("message" => "No products found"));
}

// close connection
$connect->close();
?>
