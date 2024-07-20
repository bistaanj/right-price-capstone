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

<div class="container mt-5">
    <h2 class="text-center">WISHLIST</h2>
    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>PRODUCT</th>
                <th>PRICE</th>
                <th>ACTION</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // connection
            require_once '../php/connection.php';

            // get data 
            $sql = "SELECT wi.wishlist_item_id, p.product_name, p.product_price, p.product_image
                    FROM tbl_wishlist_item wi
                    JOIN tbl_products p ON wi.product_id = p.product_id";
            $result = $connect->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td><img src='" . $row['product_image'] . "' alt='Product Image' class='product-image'> " . $row['product_name'] . "</td>
                            <td>$" . number_format($row['product_price'], 2) . "</td>
                            <td>
                                <form action='../php/delete_wishlist_item.php' method='post' style='display:inline;'>
                                    <input type='hidden' name='wishlist_item_id' value='" . $row['wishlist_item_id'] . "'>
                                    <button type='submit' class='btn btn-dark'>🗑️</button>
                                </form>
                            </td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='3' class='text-center'>No items in wishlist</td></tr>";
            }

            // Close connection
            $connect->close();
            ?>
        </tbody>
    </table>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
