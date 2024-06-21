<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sell a Product</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../css/styles.css">
    <script>
        function validateForm() {
            let price = document.getElementById("price").value;
            if (price <= 0) {
                alert("Price must be a positive number");
                return false;
            }
            return true;
        }

        function validateFile() {
            const allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i;
            const fileInput = document.getElementById('product_image');
            const filePath = fileInput.value;

            if (!allowedExtensions.exec(filePath)) {
                alert('Please upload a file with .jpeg/.jpg/.png extensions.');
                fileInput.value = '';
                return false;
            } else {
                if (fileInput.files[0].size > 5 * 1024 * 1024) {
                    alert('File size exceeds 5MB');
                    fileInput.value = '';
                    return false;
                }
            }
            return true;
        }
    </script>
    <style>
        <?php
        echo file_get_contents('../css/style.css');
        ?>
    </style>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/styles.css">
    
</head>
<body>
<header class="d-flex justify-content-between align-items-center p-3 bg-light">
        <div class="logo">
            <img src="Images/RightPriceLogo.jpeg" alt="Logo">
        </div>

        <nav>
            <ul class="nav">
                <li class="nav-item text-center d-flex flex-column align-items-center">
                    <a class="nav-link d-flex flex-column align-items-center link-dark " href="dashboard.php">
                        <i class="bi bi-speedometer2"></i>Dashboard</a>
                </li>
                <li class="nav-item text-center d-flex flex-column align-items-center">
                    <i class="bi bi-bag-check"></i>
                    <a class="nav-link" href="#">Wishlist</a>
                </li>
                <li class="nav-item text-center d-flex flex-column align-items-center">
                    <i class="bi bi-shop"></i>
                    <a class="nav-link" href="Market.html">Market</a>
                </li>
                <li class="nav-item text-center d-flex flex-column align-items-center">
                    <i class="bi bi-journal-check"></i>
                    <a class="nav-link" href="PostBlog.html">Blogs</a>
                </li>
                <li class="nav-item text-center d-flex flex-column align-items-center">
                    <i class="bi bi-box-arrow-right"></i>
                    <a class="nav-link" href="../php/logout.php">Logout</a>
                </li>
            </ul>
        </nav>
    </header>
    <div class="container">
        <h1>Sell a Product</h1>
        <form action="../php/insertproduct.php" method="post">
            <div class="form-group">
                <label for="sales_type">Sales Type</label>
                <input type="radio" id="sale" name="sales_type" value="sale" checked> Sale
                <input type="radio" id="auction" name="sales_type" value="auction"> Auction
            </div>
            <div class="form-group">
                <label for="product_name">Product Name</label>
                <input type="text" id="product_name" name="product_name" required>
            </div>
            <div class="form-group">
                <label for="product_category">Product Category</label>
                <select id="product_category" name="product_category" required>
                    <option value="" disabled selected>Please Select</option>
                    <option value = 5 >Live stock</option>
                    <option value = 1 >Seeds</option>
                    <option value = 3 >Farm Equiptment</option>
                    <option value = 4 >Pesticides</option>
                    <option value = 2 >Fertilizers</option>
                </select>
            </div>
            <div class="form-group">
                <label for="price">Price</label>
                <input type="number" id="price" name="price" required>
                <label for="unit">Per</label>
                <input type="text" id="unit" name="unit" required>
                
            </div>
            <div class="form-group">
                <label for="product_image">Product Image</label>
                <input type="file" id="product_image" name="product_image" required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea id="description" name="description" rows="4" required></textarea>
            </div>
            <div class="form-group">
                <button type="submit">Submit</button>
            </div>
        </form>
    </div>
</body>
</html>
