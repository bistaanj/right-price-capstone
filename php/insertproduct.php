<?php
require_once '../php/connection.php';


try {

    // if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (1 == 1) {

        // receiving data from form
        session_start();
        $user = $_SESSION['user_id'];
        $saleType = $_POST["sales_type"];
        $name = $_POST["product_name"];
        $pcategory = $_POST["product_category"];
        $price = $_POST["price"];
        $unit = $_POST["unit"];
        $imageLink = $_POST["product_image"];
        $description = $_POST["description"];
        $addedDate = date("Y-m-d");
        $product_status = "Active";

        // Test Values


        // Validations
        $errors = [];

        if (1 == 1) {
            // posting data to database
            $querry = "INSERT INTO tbl_products (user_id,product_name,  
            product_unit,
            product_category,
            product_price,
            product_image,
            product_description,
            product_added,
            product_status,
            sale_type) VALUES (?,?, ?, ?, ?,?,?,?,?,?)";
            $bind_statement = $connect->prepare($querry);
            $bind_statement->bind_param("issidsssss", $user, $name, $unit, $pcategory, $price, $imageLink, $description, $addedDate, $product_status, $saleType);
            $result = $bind_statement->execute();
            header("Location: ../php/dashboardsetup.php");
            //session_end
            
        } else {
            $register_error = urlencode(implode(' ', $errors));
            header("Location: ../pages/signup.php?register_error=" . $register_error . "&fname=" . urlencode($fname) . "&lname=" . urlencode($lname) . "&email=" . urlencode($email));
            exit();
        }

    }
    // The Trigger throws and error if the Email already exists so the error is managed here
} catch (Exception $e) {
    $register_error = "Email Already Exists.";
    // header("Location: signup.php?register_error=" . urlencode($register_error));
    exit();
}



?>