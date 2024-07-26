<?php include '../includes/checkSession.php' ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Right Price Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../css/styles.css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        function confirmDelete(form) {
            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this item!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    form.submit();
                } else {
                    swal("Your item is safe!");
                }
            });
        }
    </script>
</head>

<body>
<?php include "../includes/navigation.php" ?>    
<div class="container mt-5">

<?php
    if (isset($_GET['success'])) {
        ?>
        <script> 
        window.addEventListener('load',function() {
            swal("Success", "Product added to wishlist", "success");  
        })
        </script>
        <?php
    } elseif (isset($_GET['error'])) {
    ?>
        <script> 
        window.addEventListener('load',function() {
            swal("Declined", "Product already in wishlist", "error");  
        })
        </script>
    <?php
    }
    ?>

    <h2 class="text-center">WISHLIST</h2>
    <table class="table mt-3">
        <thead>
            <tr>
                <th>PRODUCT</th>
                <th>PRICE</th>
                <th class="text-center">ACTION</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // connection
            require_once '../php/connection.php'; 

            
            $user_id = $_SESSION['user_id']; // get session id

            // get data 
            $sql = "SELECT wi.wishlist_item_id, wi.product_id, p.product_name, p.product_price, p.product_image
                    FROM tbl_wishlist_item wi
                    JOIN tbl_products p ON wi.product_id = p.product_id
                    WHERE wi.user_id = $user_id";
            $result = $connect->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td><img src='../uploads/" . $row['product_image'] . "' alt='Product Image' class='product-image img-thumbnail'> " . $row['product_name'] . "</td>
                            <td>$" . number_format($row['product_price'], 2) . "</td>
                            <td>
                                <form action='../php/delete_wishlist_item.php' method='post' style='display:inline;'>
                                    <input type='hidden' name='wishlist_item_id' value='" . $row['wishlist_item_id'] . "'>
                                    <button type='button' class='btn btn-primary btn-sm' onclick='confirmDelete(this.form)'>Delete Item 🗑️</button>
                                    
                                    <button type='button' class='btn btn-primary mt-2'>
                                    <a style='color:white; text-decoration:none' href='../php/getProductinfo.php?id=" . $row['product_id'] . "'>
                                        View Product
                                    </a>
                                    </button>
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
<footer class="footer mt-5">
    <div class="container d-flex justify-content-between align-items-center">
        <div class="footer-left">
            <img src="Images/RightPriceLogo.jpeg" alt="Logo" class="footer-logo">
            <h4>Right Price</h4>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore
                et dolore magna aliqua.</p>
        </div>
        <div class="footer-right">
            <ul class="footer-links list-inline">
                <li class="list-inline-item"><a href="#">About</a></li>
                <li class="list-inline-item"><a href="#">Contact</a></li>
                <li class="list-inline-item"><a href="#">Careers</a></li>
            </ul>
        </div>
    </div>
</footer>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
