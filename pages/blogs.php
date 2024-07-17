<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Right Price Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css">
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
        <div class="search-bar d-flex justify-content-center mb-4">
            <input type="text" class="form-control rounded-pill" placeholder="Search" style="max-width: 600px;">
            <img src="Images/Search.png" alt="Search Icon" class="search-icon ml-2" onclick="searchFunction()">
        </div>
        <div class="row">
            <div class="col-md-3 mb-4">
                <div class="blog-card p-3 rounded">
                    <p>Lorem ipsum dolor sit amet, consectetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt
                        ut labore et dolore magna aliquyam erat, sed diam voluptua.</p>
                    <a href="#">.....Read More</a>
                    <hr>
                    <p class="author-date">
                        <span>Author</span><br>
                        <span>Date</span>
                    </p>
                </div>
                <h5 class="text-center mt-2">Blog Title</h5>
            </div>
            <div class="col-md-3 mb-4">
                <div class="blog-card p-3 rounded">
                    <p>Lorem ipsum dolor sit amet, consectetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt
                        ut labore et dolore magna aliquyam erat, sed diam voluptua.</p>
                    <a href="#">.....Read More</a>
                    <hr>
                    <p class="author-date">
                        <span>Author</span><br>
                        <span>Date</span>
                    </p>
                </div>
                <h5 class="text-center mt-2">Blog Title</h5>
            </div>
            <div class="col-md-3 mb-4">
                <div class="blog-card p-3 rounded">
                    <p>Lorem ipsum dolor sit amet, consectetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt
                        ut labore et dolore magna aliquyam erat, sed diam voluptua.</p>
                    <a href="#">.....Read More</a>
                    <hr>
                    <p class="author-date">
                        <span>Author</span><br>
                        <span>Date</span>
                    </p>
                </div>
                <h5 class="text-center mt-2">Blog Title</h5>
            </div>
            <div class="col-md-3 mb-4">
                <div class="blog-card p-3 rounded">
                    <p>Lorem ipsum dolor sit amet, consectetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt
                        ut labore et dolore magna aliquyam erat, sed diam voluptua.</p>
                    <a href="#">.....Read More</a>
                    <hr>
                    <p class="author-date">
                        <span>Author</span><br>
                        <span>Date</span>
                    </p>
                </div>
                <h5 class="text-center mt-2">Blog Title</h5>
            </div>
        </div>
    </main>
    <footer class="footer mt-5">
        <div class="container d-flex justify-content-between align-items-center">
            <div class="footer-left">
                <img src="Images/RightPriceLogo.jpeg" alt="Logo" class="footer-logo">
                <h4>Right Price</h4>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore
                    et dolore magna aliqua.</p>
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