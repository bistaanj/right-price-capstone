<?php 

include '../includes/checkSession.php';
$name = $email = $amount = null;
if (isset($_GET['name'])) {
    $name = $_GET['name'];
    $product = $_GET['product'];
    $amount = $_GET['amount'];
   
}else{
    echo 'no data found';
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include '../includes/scripts.php'; ?>

    <title>Result</title>
</head>
<body>
    <?php include '../includes/navigation.php'; ?>
    <div class="container-fluid d-flex flex-column align-items-center justify-content-center mt-5">
        <div class="container d-flex justify-content-center ">
            <h2>Your auction process is complete</h2>
        </div>
        <div class="container d-flex flex-column justify-content-center align-items-center mt-2">
            <p> The highest amount offered to your product <span class="h3">  <?php echo htmlspecialchars($product); ?> </span> 
                    was  
                    <span class="h3"> $ <?php echo htmlspecialchars($amount); ?> </span> 
                    by  <span class="h3"> <?php echo htmlspecialchars($name) ;?> </span></p>

            <p> We have sent the contact details in your email for contacting purpose.</p>

            <p> <?php echo htmlspecialchars($name); ?>  has also been notified and your contact details has been provided.</p>
            <p> You might receive a mail soon. </p>
        </div>
        <div class="container d-flex flex-column justify-content-center align-items-center mt-2">
            <p>We look forward to hosting another auction soon.</p>
        </div>
    </div>
    <?php include '../includes/footer.php'; ?>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
   </body>

</html>


