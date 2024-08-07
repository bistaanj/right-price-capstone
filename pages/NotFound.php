<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 Page Not Found</title>
    <link rel="icon" type="image/x-icon" href="../images/RightPriceLogo.ico">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.9.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <?php include '../includes/navigation.php'; ?>
    <main class="container text-center mt-5">
        <div class="row align-items-center">
            <div class="col-lg-6 text-start">
                <h1 class="display-1">404</h1>
                <p class="lead">The page you are requesting for was not found.</p>
                <div class="d-flex justify-content-start align-items-center mt-4">
                    <button onclick="location.href='dashboard.php'" class="btn btn-primary me-3">See your dashboard</button>
                    <i class="bi bi-question-lg error-icon"></i>
                </div>
            </div>
            <div class="col-lg-6 text-end">
                <img src="../images/stickman-searching-vnJL6OD-600.jpg" alt="Figure with Magnifying Glass" class="img-fluid">
            </div>
        </div>
    </main>
    <?php include '../includes/footer.php'; ?>
</body>
</html>
