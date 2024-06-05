<?php
require_once '../php/connection.php';
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // Query to delete session in the database
    $querry = "DELETE from tbl_session where session_id = ? ";
    $bind_statement = $connect->prepare("$querry");
    $bind_statement->bind_param("s", $_GET["session_id"]);
    $result = $bind_statement->execute();
    if ($result) {
        session_start();
        session_unset();
        session_destroy();
        header("Location: ../pages/login.php");
        exit();
    } else {
        header("Location: ../pages/login.php");
    }
}
?>