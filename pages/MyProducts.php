<!-- This is a template -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Products</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <div class="d-flex flex-column min-vh-100">
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
                        <a class="nav-link d-flex flex-column align-items-center" href="../php/marketProducts.php">
                            <i class="bi bi-shop"></i>
                            <span>Market</span>
                        </a>
                    </li>
                    <li class="nav-item text-center">
                        <a class="nav-link d-flex flex-column align-items-center" href="blogs.html">
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
            <div class="row">
                <div class="col text-center">
                    <h2>Your Products</h2>
                </div>
            </div>

            <!-- Code Starts here -->
            <div class="row mt-4">
                <div class="col-md-3 text-center">
                    <div class="product-image">
                        <img src="../images/placeholder.png" alt="Product Image">
                    </div>
                </div>
                <div class="col-md-3 text-center">
                    <h5>Name</h5>
                    <p>Product name</p>
                </div>
                <div class="col-md-3 text-center">
                    <h5>Added on</h5>
                    <p>Date</p>
                </div>
            </div>
        </main>
        <footer class="footer mt-5">
            <div class="container d-flex justify-content-between align-items-center">
                <div class="footer-left">
                    <img src="../images/RightPriceLogo.jpeg" alt="Logo" class="footer-logo">
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
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
