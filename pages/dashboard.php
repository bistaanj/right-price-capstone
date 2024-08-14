<?php 
include '../includes/checkSession.php'
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Right Price Dashboard</title>
    <link rel="icon" type="image/x-icon" href="../images/RightPriceLogo.ico">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
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
                    <div class="d-flex flex-column align-items-center text-center" style="height: 120px">   
                        <div>
                            <i class="fa fa-user-large fa-4x" aria-hidden="true"></i>                      
                        </div>                   
                        <div class="h2 mt-1">
                            <?php
                            echo ($_SESSION['username']);
                            ?>                       
                            </div>   
                    </div>
                    
                       
                    <ul class="nav flex-column">
                        
                        <li class="nav-item mb-3 d-flex align-items-center">
                            <i class="fa-solid fa-dolly"></i>
                            <a class="nav-link" href="sell_product.php">Sell a Product</a>
                        </li>
                        <li class="nav-item mb-3 d-flex align-items-center">
                            <i class="fa-solid fa-warehouse"></i>
                            <a class="nav-link" href="../php/getUserproducts.php">Your Products</a>
                        </li>
                        <li class="nav-item mb-3 d-flex align-items-center">
                            <i class="fa-solid fa-truck"></i>
                            <a class="nav-link" href="../php/getOrders.php">Your Orders</a>
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
