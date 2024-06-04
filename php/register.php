<?php
require_once '../php/connection.php';

function validationPassword($password){
    return preg_match('/^(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/', $password);
}


try {

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        // receiving data from form
        $fname = $_POST["fname"];
        $lname = $_POST["lname"];
        $email = $_POST["email"];
        $password = $_POST["password"];

        // Validations
        $errors = [];
        if (!validationPassword($password)) {
            $errors[] = "Password is not valid.";
        }

        if (empty($errors)) {
        // posting data to database
            $querry = "INSERT INTO tbl_user (fname, lname, email, password) VALUES (?, ?, ?, ?)";
            $bind_statement = $connect->prepare($querry);
            $bind_statement->bind_param("ssss", $fname, $lname, $email, $password);
            $result = $bind_statement->execute();
            header("Location: ../pages/login.php");
        } else {
            $register_error = urlencode(implode(' ', $errors));
            header("Location: ../pages/signup.php?register_error=" . $register_error . "&fname=" . urlencode($fname) . "&lname=" . urlencode($lname) . "&email=" . urlencode($email));
            exit();
        }

    }
    // The Trigger throws and error if the Email already exists so the error is managed here
} catch (Exception $e) {
    $register_error = "Email Already Exists.";
    header("Location: signup.php?register_error=" . urlencode($register_error));
    exit();
}
?>