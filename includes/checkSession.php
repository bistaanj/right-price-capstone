<?php
session_start();
if (!isset($_SESSION['session_id'])) {
    header("Location: ../pages/login.php?login_error=" . urldecode('Please login to get access.'));
}else{
    require_once '../php/connection.php';
    $session_id = $_SESSION['session_id'];
    $querry = "SELECT COUNT(*) as count from tbl_session where session_id = ?";
    $bind_statement = $connect->prepare($querry);
    $bind_statement->bind_param('s', $session_id);
    $bind_statement->execute();
    $result = $bind_statement->get_result();
    $row = $result->fetch_assoc();
    if ($row['count']!=1){
        session_destroy();
        header("Location: ../pages/login.php?login_error=" . urldecode('Session Timed Out.'));
    }
}

?>