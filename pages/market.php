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
    <?php include '../includes/navigation.php'; ?>  
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
    <?php include '../includes/footer.php'; ?>  
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>