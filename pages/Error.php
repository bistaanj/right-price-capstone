<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error Page</title>
    <link rel="icon" type="image/x-icon" href="../images/RightPriceLogo.ico">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body class="d-flex flex-column min-vh-100">
    <?php include '../includes/navigation.php'; ?>
    <main class="container text-center mt-5 flex-grow-1">
        <div class="error-content">
            <img src="../images/error.png" alt="Error" class="error-image img-fluid">
            <p class="error-text">There was some error while processing your request. Please try again later or contact the Admin.</p>
            <div class="actions">
                <button onclick="location.href='dashboard.php'" class="btn btn-primary mr-3">See your dashboard</button>
                <i class="bi bi-question-lg error-icon"></i>
            </div>
        </div>
    </main>
    <?php include '../includes/footer.php'; ?>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
