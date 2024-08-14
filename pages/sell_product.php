<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sell a Product</title>
    <link rel="icon" type="image/x-icon" href="../images/RightPriceLogo.ico">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

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

            if (filePath && !allowedExtensions.exec(filePath)) {
                alert('Please upload a file with .jpeg/.jpg/.png extensions.');
                fileInput.value = '';
                return false;
            } else {
                if (filePath && fileInput.files[0].size > 5 * 1024 * 1024) {
                    alert('File size exceeds 5MB');
                    fileInput.value = '';
                    return false;
                }
            }
            return true;
        }
    </script>
</head>
<body>
    <?php include '../includes/navigation.php'; ?>

    <main class="container mt-5">
        <h1><?php echo isset($_GET['id']) ? 'Edit Product' : 'Sell a Product'; ?></h1>
        
        <?php
        require_once '../php/connection.php';
        $product = null;
        if (isset($_GET['id'])) {
            $product_id = $_GET['id'];
            $query = "SELECT * FROM tbl_products WHERE product_id = ?";
            $stmt = $connect->prepare($query);
            $stmt->bind_param("i", $product_id);
            $stmt->execute();
            $result = $stmt->get_result();
            $product = $result->fetch_assoc();
        }
        ?>
        
        <form action="<?php echo isset($product) ? '../php/updateproduct.php' : '../php/insertproduct.php'; ?>" method="post" enctype="multipart/form-data" onsubmit="return validateForm() && validateFile()">
            <?php if (isset($product)) { ?>
                    <input type="hidden" name="product_id" value="<?php echo $product['product_id']; ?>">
            <?php } ?>
            <div class="form-group radio-group">
                <label for="sales_type">Sales Type</label>
                <div class="radio-options">
                    <div>
                        <input type="radio" id="sale" name="sales_type" value="Sale" <?php echo isset($product) && $product['sale_type'] == 'Sale' ? 'checked' : ''; ?>>
                        <label for="sale">Sale</label>
                    </div>
                    <div>
                        <input type="radio" id="auction" name="sales_type" value="Auction" <?php echo isset($product) && $product['sale_type'] == 'Auction' ? 'checked' : ''; ?>>
                        <label for="auction">Auction</label>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="product_name">Product Name</label>
                <input type="text" id="product_name" name="product_name" class="form-control" required value="<?php echo isset($product) ? $product['product_name'] : ''; ?>">
            </div>
            <div class="form-group">
                <label for="product_category">Product Category</label>
                <select id="product_category" name="product_category" class="form-control" required>
                    <option value="" disabled <?php echo !isset($product) ? 'selected' : ''; ?>>Please Select</option>
                    <option value="5" <?php echo isset($product) && $product['product_category'] == '5' ? 'selected' : ''; ?>>Live stock</option>
                    <option value="1" <?php echo isset($product) && $product['product_category'] == '1' ? 'selected' : ''; ?>>Seeds</option>
                    <option value="3" <?php echo isset($product) && $product['product_category'] == '3' ? 'selected' : ''; ?>>Farm Equipment</option>
                    <option value="4" <?php echo isset($product) && $product['product_category'] == '4' ? 'selected' : ''; ?>>Pesticides</option>
                    <option value="2" <?php echo isset($product) && $product['product_category'] == '2' ? 'selected' : ''; ?>>Fertilizers</option>
                </select>
            </div>
            
                <div class="form-group ">
                    <label for="price">Price</label>
                    <input type="number" id="price" name="price" class="form-control" required value="<?php echo isset($product) ? $product['product_price'] : ''; ?>">
                </div>
                <div class="form-group ">
                    <label for="unit">Per</label>
                    <input type="text" id="unit" name="unit" class="form-control" required value="<?php echo isset($product) ? $product['product_unit'] : ''; ?>">
                </div>
            
            <div class="form-group">
                <label for="product_image">Product Image</label>
                <?php if (isset($product) && !empty($product['product_image'])) { ?>
                        <div>
                            <img src="../uploads/<?php echo $product['product_image']; ?>" alt="Product Image" width="150">
                        </div>
                        <label for="product_image">Change Image (optional)</label>
                <?php } ?>
                <input type="file" id="product_image" name="product_image" class="form-control" <?php echo !isset($product) ? 'required' : ''; ?>>
            </div>
            <div class="form-group">
                <label for="short_description">Short Description</label>
                <textarea id="short_description" name="short_description" class="form-control" rows="2" required><?php echo isset($product) ? $product['product_short_description'] : ''; ?></textarea>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea id="description" name="description" class="form-control" rows="4" required><?php echo isset($product) ? $product['product_description'] : ''; ?></textarea>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary"> <i class="fa-solid fa-circle-check"></i> Post Product</button>
            </div>
        </form>
    </main>

    <?php include '../includes/footer.php'; ?>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
