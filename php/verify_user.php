<?php
require_once "../php/connection.php";
$verification_code = $_GET['code'];

// Query to set verified = 1 in the database

$querry = "UPDATE tbl_user SET verified = 1 WHERE verification_code = ?";
$bind_statement = $connect->prepare($querry);
$bind_statement->bind_param("s", $verification_code);
$result = $bind_statement->execute();
if ($result) {
    header("Location: ../pages/login.php");
}

?>