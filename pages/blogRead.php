<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Details</title>
    <link rel="icon" type="image/x-icon" href="../images/RightPriceLogo.ico">
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
    //$sql = "SELECT * FROM tbl_blog WHERE blog_id = $blog_id";
    $sql = "SELECT b.*, CONCAT(u.fname, ' ', u.lname) AS author_name 
    FROM tbl_blog b
    JOIN tbl_user u ON b.blog_author = u.user_id
    WHERE b.blog_id = $blog_id";
    $result = $connect->query($sql);

    if ($result === false) {
        echo "<div class='alert alert-danger'>Error en la consulta SQL: " . $connect->error . "</div>";
    } elseif ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<div class='card mb-4'>";
            echo "<div class='text-center'>";
            echo "<h2 class='card-title'>" . htmlspecialchars($row['blog_title']) . "</h2>";
            echo "<p class='text-muted'>By " . htmlspecialchars($row['author_name']) . " on " . htmlspecialchars($row['blog_published_date']) . "</p>";
            echo "</div>";
            if (!empty($row['blog_picture'])) {
                $imagePath = "../uploads/" . htmlspecialchars($row['blog_picture']);
                echo "<img src=\"$imagePath\" alt=\"Blog Image\" class=\"card-img-top w-50 mx-auto d-block\">";
            }
            echo "<div class='card-body'>";
            echo "<p class='card-text'>" . nl2br(htmlspecialchars($row['blog_contents'])) . "</p>";
            echo "</div>";
            echo "</div>";
        }
    } else {
        echo "<div class='alert alert-info'>Blog not found.</div>";
    }

    // close connection
    $connect->close();
    ?>
    
</main>
<?php include '../includes/footer.php'; ?>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
