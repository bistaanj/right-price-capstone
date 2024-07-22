<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Details</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
<header class="d-flex justify-content-between align-items-center p-3 bg-light">
    <div class="logo">
        <img src="../images/RightPriceLogo.jpeg" alt="Logo">
    </div>
    <nav>
        <ul class="nav">
            <li class="nav-item text-center">
                <a class="nav-link d-flex flex-column align-items-center" href="dashboard.php">
                    <i class="bi bi-speedometer2"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="nav-item text-center">
                <a class="nav-link d-flex flex-column align-items-center" href="wishlist.php">
                    <i class="bi bi-bag-check"></i>
                    <span>Wishlist</span>
                </a>
            </li>
            <li class="nav-item text-center">
                <a class="nav-link d-flex flex-column align-items-center" href="market.php">
                    <i class="bi bi-shop"></i>
                    <span>Market</span>
                </a>
            </li>
            <li class="nav-item text-center">
                <a class="nav-link d-flex flex-column align-items-center" href="blogs.php">
                    <i class="bi bi-pencil-square"></i>
                    <span>Blogs</span>
                </a>
            </li>
            <li class="nav-item text-center">
                <a class="nav-link d-flex flex-column align-items-center" href="../php/logout.php">
                    <i class="bi bi-box-arrow-right"></i>
                    <span>Logout</span>
                </a>
            </li>
        </ul>
    </nav>
</header>
<main class="container mt-4 flex-grow-1">
    <?php
    //get id blog
    $blog_id = $_GET['id'];

    //database 
    require_once '../php/connection.php';

    // sql
    $sql = "SELECT * FROM tbl_blog WHERE blog_id = $blog_id";
    $result = $connect->query($sql);

    
    if ($result === false) {
        echo "<p>Error en la consulta SQL: " . $connect->error . "</p>";
    } elseif ($result->num_rows > 0) {
        // show blog details
        while ($row = $result->fetch_assoc()) {
            echo "<h2>" . htmlspecialchars($row['blog_title']) . "</h2>";
            if (!empty($row['blog_picture'])) {
                // show the image
                $imagePath = "../uploads/" . htmlspecialchars($row['blog_picture']);
                echo "<img src=\"$imagePath\" alt=\"Blog Image\" class=\"img-fluid mb-3\">";
            }
            echo "<p>" . nl2br(htmlspecialchars($row['blog_contents'])) . "</p>";
            echo "<p><small>Author: " . htmlspecialchars($row['blog_author']) . " | Date: " . htmlspecialchars($row['blog_published_date']) . "</small></p>";
        }
    } else {
        echo "<p>Blog not found.</p>";
    }

    // close connection
    $connect->close();
    ?>
</main>
<footer class="footer mt-5">
    <div class="container d-flex justify-content-between align-items-center">
        <div class="footer-left">
            <img src="Images/RightPriceLogo.jpeg" alt="Logo" class="footer-logo">
            <h4>Right Price</h4>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
        </div>
        <div class="footer-right">
            <ul class="footer-links list-inline">
                <li class="list-inline-item"><a href="#">About</a></li>
                <li class="list-inline-item"><a href="#">Contact</a></li>
                <li class="list-inline-item"><a href="#">Careers</a></li>
            </ul>
        </div>
    </div>
</footer>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
