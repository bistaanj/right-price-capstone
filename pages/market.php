<?php include '../includes/checkSession.php' ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Right Price Market</title>
    <link rel="icon" type="image/x-icon" href="../images/RightPriceLogo.ico">
    <?php include '../includes/scripts.php' ?>
</head>

<body>
    <!-- Php to get data from the session -->
    <?php
    $product_info = isset($_SESSION['product_info']) ? $_SESSION['product_info'] : [];
    ?>

    <?php include "../includes/navigation.php" ?>    

    <main class="container-xl mt-4 flex-grow-1">
    <div class="search-bar d-flex flex-row mb-4">
            <form action="../php/searchProducts.php" method="POST" class="d-flex flex-row align-items-center w-100">
                <input type="text" class="form-control rounded-pill" placeholder="Search" name="productName_search">
                <button type="submit" name="productSearch" class="button-search">
                    <i class="bi bi-search search-icon"></i> 
                </button>
            </form>
        </div>
        <div class="row">
            <div class="product-container">
                <div class="product-grid">

                <!-- Product Card Starts here -->

                <?php
                if (count($product_info) > 0):
                    foreach ($product_info as $data):
                        // Check if the product status is not "Deleted"
                        if ($data['product_status'] !== 'Deleted'):
                            ?>                
                            <div class="product-card">
                                <div class="product-image">
                                    <img src="../images/<?php echo $data['product_image']?>" alt="">
                                </div>
                                <div class="product-info">
                                    <h3><?php echo htmlspecialchars($data['product_name']); ?></h3>
                                    <p><?php echo htmlspecialchars($data['product_price']); ?> / <?php echo htmlspecialchars($data['product_unit']); ?></p>
                                    <a href="../php/getProductinfo.php?id=<?php echo htmlspecialchars($data['product_id']); ?>">
                                        <button class="btn btn-primary btn-rounded">View Product</button>
                                    </a>
                                    <form action="../php/add_wishlist_item.php" method="POST" style="display:inline;">
                                        <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($data['product_id']); ?>">
                                        <button type="submit" class="btn btn-secondary btn-rounded">Add to Wishlist</button>
                                    </form>
                                </div>
                            </div>
                            <?php
                        else:
                            ?>                
                            <div class="product-card">
                                <div class="product-image">
                                    <img src="https://via.placeholder.com/150" alt="Product Image">
                                </div>
                                <div class="product-info">
                                    <h3><?php echo htmlspecialchars($data['product_name']); ?></h3>
                                    <p><?php echo htmlspecialchars($data['product_price']); ?> / <?php echo htmlspecialchars($data['product_unit']); ?></p>
                                    <a href="../php/getProductinfo.php?id=<?php echo htmlspecialchars($data['product_id']); ?>">
                                        <button class="btn btn-primary btn-rounded">View Product</button>
                                    </a>
                                    <p class="text-danger">Product Not Available</p>
                                </div>
                            </div>
                            <?php
                        endif;
                    endforeach;
                endif;
                ?>
               
                </div>
            </div>
        
         <?php
         if (count($product_info) < 1):
             ?>
                        <div class="h2 text-center d-flex align-self-center justify-self-center"> 
                            <p class='align-items-center'> Sorry, no Product found. </p>
                        </div>
                        <?php
         endif;
         ?>
            </div>
        
    </main>
    
    <script>
        function searchFunction() {
            const query = document.querySelector('.search-bar input').value;
            window.location.href = `https://www.google.com/search?q=${query}`;
        }
    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <?php include '../includes/footer.php'; ?>
</body>

</html>
