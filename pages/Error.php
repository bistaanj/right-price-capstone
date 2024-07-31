<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error Page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.9.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <?php include '../includes/navigation.php'; ?>
    <main>
    <div class="error-content">
            <img src="../images/error.png" alt="Error" class="error-image">
            <p class="error-text">There was some error while processing your request. Please try again later or contact the Admin.</p>
            <div class="actions">
                <button onclick="location.href='dashboard.php'" class="btn btn-primary">See your dashboard</button>
                <i class="bi bi-question-lg error-icon"></i>
            </div>
        </div>
    </main>
</body>
</html>
