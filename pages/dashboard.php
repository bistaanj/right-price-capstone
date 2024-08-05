<?php 
include '../includes/checkSession.php'
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Right Price Dashboard</title>
    <link rel="icon" type="image/png" href="images/RightPriceLogo.png">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <?php include "../includes/navigation.php" ?>    
    <main class="container-fluid mt-4">
        <div class="row">
            <div class="col-12 text-center overview-heading">
                <h2>Your Overview</h2>
            </div>
        </div>
        <div class="row mt-4">
            <aside class="col-md-3">
                <div class="sidebar p-3 rounded">
                    <div class="username mb-4 d-flex align-items-center">
                        <i class="bi bi-person-circle" style="margin-right: 10px;"></i>
                        <span style="color: yellow;"> 
                            <?php
                               
                               echo ($_SESSION['username']);
                               ?>
                               </span>
                    </div>
                    <ul class="nav flex-column">
                        <li class="nav-item mb-3 d-flex align-items-center">
                            <i class="bi bi-box"></i>
                            <a class="nav-link" href="sell_product.php">Sell a Product</a>
                        </li>
                        <li class="nav-item mb-3 d-flex align-items-center">
                            <i class="bi bi-box-seam"></i>
                            <a class="nav-link" href="../php/getUserproducts.php">Your Products</a>
                        </li>
                        <li class="nav-item mb-3 d-flex align-items-center">
                            <i class="bi bi-box-seam"></i>
                            <a class="nav-link" href="../php/getOrders.php">Your Orders</a>
                        </li>
                        <li class="nav-item mb-3 d-flex align-items-center">
                            <i class="bi bi-pencil-square"></i>
                            <a class="nav-link" href="postblog.php">Post a Blog</a>
                        </li>
                    </ul>
                </div>
            </aside>
            <section class="col-md-9">
                <div class="row text-center">
                    <div class="col-md-6 mb-3">
                        <div class="overview-box rounded p-4">
                            <h1>
                                <?php                                
                                echo $_SESSION['user_sale_count'];
                                ?>
                            </h1>
                            <p>Products on Sale</p>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="overview-box rounded p-4">
                            <h1>
                                <?php
                                echo $_SESSION['user_auction_count'];
                                ?>
                            </h1>
                            <p>Products on Auction</p>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="overview-box rounded p-4">
                            <h1>
                                <?php
                                echo $_SESSION['user_wishlist_count'];
                                ?>
                            </h1>
                            <p>Products on Wishlist</p>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="overview-box rounded p-4">
                            <h1>
                            <?php
                            echo $_SESSION['user_blog_count'];
                            ?>
                            </h1>
                            <p>Blogs Posted</p>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main>
    <?php include '../includes/footer.php' ?>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
