<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Place Order</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.9.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <?php include '../includes/navigation.php'; ?>
    <main class="container mt-5">
        <div class="row">
            <div class="col-lg-2 text-center">
                <img src="../images/RightPriceLogo.jpeg" alt="Right Price Logo" class="img-fluid rounded-circle product-image">
            </div>
            <div class="col-lg-10">
                <h1 class="text-center mb-4">Place Order</h1>
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-lg-6">
                                <p><strong>Product name:</strong> Product name</p>
                            </div>
                            <div class="col-lg-6">
                                <p><strong>Price:</strong> $12,345.00</p>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <p id="description" class="form-control-plaintext">This is the product description. It is static text that cannot be edited.</p>
                        </div>
                        <div class="row mb-3">
                            <div class="col-lg-6">
                                <label for="quantity" class="form-label">Quantity</label>
                                <p id="quantity" class="form-control-plaintext">1</p>
                            </div>
                            <div class="col-lg-6 d-flex align-items-end">
                                <button class="btn btn-primary w-100">Place Order</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
</html>
