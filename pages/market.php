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
    <!-- Php to get data from the session -->
    <?php
    session_start();
    $product_info = isset($_SESSION['product_info']) ? $_SESSION['product_info'] : [];

    ?>


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
    <main class="container-xl mt-4 flex-grow-1">
        <div class="search-bar d-flex flex-row mb-4">
            <form action="../php/searchProducts.php" method="POST" class="d-flex flex-row align-items-center">
                <input type="text" class="form-control rounded-pill" placeholder="Search" style="max-width: 600px;" name="productName_search">
                <button type="submit" name="productSearch" class="button-search ml-2"></button>
            </form>
        </div>
        <div class="row">
        <div class="product-container">
            <div class="product-grid">

            <!-- Product Card Starts here -->

                    <?php
                    if (count($product_info) > 0):
                        foreach ($product_info as $data):
                            ?>                
                                        <div class="product-card">
                                            <div class="product-image">
                                                <img src="https://via.placeholder.com/150" alt="Product Image">
                                            </div>
                                            <div class="product-info">
                                                <h3> <?php echo $data['product_name']; ?> </h3>
                                                <p> <?php echo $data['product_price']; ?>  /  <?php echo $data['product_unit']; ?> </p>
                                                    <a href="../php/getProductinfo.php?id=<?php echo $data['product_id']; ?> ">
                                                <button class="btn btn-primary btn-rounded">View Product</button></a>
                                                <button class="btn btn-secondary btn-rounded">Add to Wishlist</button>
                                            </div>
                                        </div>

                                                        <?php
                        endforeach;
                    endif;
                    ?>
            
            
                </div>
            </div>
        </div>
    </main>
    <footer class="footer">
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
    <script>
        function searchFunction() {
            const query = document.querySelector('.search-bar input').value;
            window.location.href = `https://www.google.com/search?q=${query}`;
        }
    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>