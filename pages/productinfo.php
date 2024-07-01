<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Right Price Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>

<?php
session_start();
if (isset($_SESSION['current_product'])) {
    $info = $_SESSION['current_product'];
    $data = $info[0];
}

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

    
    <div class="row justify-content-center mt-2">
        <div class="col-md-11 ">
            <div class="container-fluid ">
                <!-- First Row Starts -->
                <div class="row">
                    <!-- Picture Side Starts -->
                    <div class="col-md-4 b pr-info-pic">
                        <div class="d-flex flex-column align-items-center" style="width:100%; height:100%;">
                            <!-- div for image -->
                            <div  style="width:80%; height:80%">
                                <img src="/images/<?php echo $data["product_image"]; ?>" style="width:100%; height:100%;" alt="">
                            </div>
                            <div class="text-center mt-2">
                            Price: $<?php echo $data["product_price"]; ?>/- per <?php echo $data["product_unit"]; ?>
                            </div>

                        </div>
                        
                    </div>

                    <!-- Description Side Starts -->
                    <div class="col-md-6 offset-md-1">
                        <div class="row justify-content-center">
                            <span class="h2">
                                <?php echo $data["product_name"]; ?>
                            </span>
                        </div>
                        <div class="row border-bottom border-danger border-2 mt-3 p-2">
                            <div class="col-md-4">
                                Seller
                            </div>
                            <div class="col-md-8">
                                Status : <button class="btn-sm btn-primary" style="padding: 2px 5px; font-size: 12px; width:fit-content;">
                                    <?php echo $data["product_status"]; ?>
                                </button>
                            </div>
                        </div>
                        <div class="row justify-content-center m-2">
                            <span class="font-weight-bold">
                                Description
                            </span>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <p class="text-justify">
                                        <?php echo $data["product_description"]; ?>
                                    </p>
                                </div>
                        </div>
                    </div>
                </div>
                <!-- First Row Ends -->
                 <!-- Second Row Starts -->
                <div class="row ">
                    <div class="col-md-4 text-center">
                        <div class="col mt-3">
                            <button class="btn-lg btn-primary rounded-pill border-0"> <span class="text-white">  Add to Wishlist <i class="bi bi-heart-fill float-right"></i> </span></button>
                        </div>
                        <div class="col mt-3">
                            <button class="btn-lg btn-primary rounded-pill border-0"> Request More Info  <i class="bi bi-info-square float-right"></i></button>
                        </div>
                        <div class="col mt-3">
                            <button class="btn-lg btn-primary rounded-pill border-0"> Send Offer <i class="bi bi-envelope float-right"></i></button>
                        </div>
                    </div>
                </div>
             </div>
             </div>
    </div>
        </div>
    </div>



    <!-- <footer class="footer mt-5">
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
    </footer> -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>