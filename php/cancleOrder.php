<?php
include '../includes/checkSession.php';
try {
    $product_id = $_POST['product_id'];    
    $querry = "CALL cancleOrder(?,?, @process_status)";
    $bind_statement = $connect->prepare($querry);
    $bind_statement->bind_param("ii", $product_id, $_SESSION['user_id']);

    $bind_statement->execute();
    $bind_statement->close();

    // Fetch the output parameter
    $data = $connect->query("SELECT @process_status AS process_status ");
    $result = $data->fetch_assoc();
    if($result['process_status']=='CANCELED'){
        header('Location: ../pages/wishlist.php?requestAccepted=1');
    }elseif($result['process_status']=='DECLINED'){
        header('Location: ../pages/wishlist.php?requestDeclined=1');
    }else{
        header('Location: ../pages/error.php');
    }

    
} catch (Exception $e) {
    echo $e->getMessage();
}





?>