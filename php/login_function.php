<?php
require_once '../php/connection.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Logic for getting value from database 

    $email = $_POST['email'];
    $password = $_POST['password'];

    // Database Query

    $querry = "CALL check_user_credentials(?, ?, @session_id, @user_id, @username)";
    $bind_statement = $connect->prepare($querry);
    $bind_statement->bind_param("ss", $email, $password);

    $bind_statement->execute();
    $bind_statement->close();


    $data = $connect->query("SELECT @session_id AS session_id, @user_id AS user_id, @username AS username");
    $result = $data->fetch_assoc();

    /* Storing the data into session after successful login  */
    if ($result['session_id']) {
        session_start();
        $_SESSION['session_id'] = $result['session_id'];
        $_SESSION['user_id'] = $result['user_id'];
        $_SESSION['username'] = $result['username'];
        header("Location: ../pages/welcome.php");
    } else {
        $login_error = "Invalid credentials.";
        header("Location: ../pages/login.php?login_error=" . urldecode($login_error));
    }

}

?>