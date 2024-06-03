<?php
require_once '../php/connection.php';
try {

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        // receiving data from form
        $fname = $_POST["fname"];
        $lname = $_POST["lname"];
        $email = $_POST["email"];
        $password = $_POST["password"];

        // Validations


        // posting data to database

        $querry = "INSERT INTO tbl_user (fname, lname, email, password) VALUES (?, ?, ?, ?)";
        $bind_statement = $connect->prepare($querry);
        $bind_statement->bind_param("ssss", $fname, $lname, $email, $password);
        $result = $bind_statement->execute();
        header("Location: ../pages/login.php");

    }
    // The Trigger throws and error if the Email already exists so the error is managed here
} catch (Exception $e) {
    $register_error = "Email Already Exists.";
    header("Location: signup.php?register_error=" . urlencode($register_error));
    exit();
}
?>