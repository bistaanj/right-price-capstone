<?php
include '../includes/checkSession.php';

if (isset($_SESSION['checkout_product'])) {
    $info = $_SESSION['checkout_product'];
    $data = $info[0];
} else {
    header('Location: error.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Place Order</title>
    <link rel="icon" type="image/x-icon" href="../images/RightPriceLogo.ico">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body class="d-flex flex-column min-vh-100">
    <?php include '../includes/navigation.php'; ?>
    <main class="container mt-5 flex-grow-1">
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
                                <p><strong>Product name:</strong> <?php echo htmlspecialchars($data['product_name']); ?></p>
                            </div>
                            <div class="col-lg-6">
                                <p><strong>Price:</strong> $<?php echo htmlspecialchars($data['product_price']); ?> per <?php echo htmlspecialchars($data['product_unit']); ?></p>
                            </div>
                        </div>
                        <form action="../php/sendOrder.php" method="POST">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputQuantity">Quantity</label>
                                    <input type="number" min="1" name="quantity" class="form-control" id="inputQuantity" placeholder="Quantity" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputAddressDetails"><strong>Address Details</strong></label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputAddress">Address</label>
                                <input type="text" class="form-control" name="address" id="inputAddress" placeholder="1234 Main St" required>
                            </div>
                            <div class="form-group">
                                <label for="inputAddress2">Address 2</label>
                                <input type="text" class="form-control" name="address_secondary" id="inputAddress2" placeholder="Apartment, studio, or floor">
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="inputCity">City</label>
                                    <input type="text" name="city" class="form-control" id="inputCity" required>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="inputState">State</label>
                                    <select id="inputState" class="form-control" name="state" required>
                                        <option value="AB">Alberta</option>
                                        <option value="BC">British Columbia</option>
                                        <option value="MB">Manitoba</option>
                                        <option value="NB">New Brunswick</option>
                                        <option value="NL">Newfoundland and Labrador</option>
                                        <option value="NS">Nova Scotia</option>
                                        <option value="ON">Ontario</option>
                                        <option value="PE">Prince Edward Island</option>
                                        <option value="QC">Quebec</option>
                                        <option value="SK">Saskatchewan</option>
                                        <option value="NT">Northwest Territories</option>
                                        <option value="NU">Nunavut</option>
                                        <option value="YT">Yukon</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="inputZip">Zip</label>
                                    <input type="text" name="zip" class="form-control" id="inputZip" required>
                                </div>
                                <!-- default Values -->
                                <div class="form-group col-md-2">
                                    <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($data['product_id']); ?>">
                                    <input type="hidden" name="seller_id" value="<?php echo htmlspecialchars($data['user_id']); ?>">
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputPhone">Contact number</label>
                                <input type="tel" name="phone" class="form-control" id="inputPhone" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" placeholder="123-456-7890" required>
                            </div>
                            <div class="form-row d-flex justify-content-center">
                                <div class="col-lg-6">
                                    <button type="submit" class="btn btn-primary w-100">Place Order</button>
                                </div>
                            </div>
                        </form>                        
                    </div>
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
