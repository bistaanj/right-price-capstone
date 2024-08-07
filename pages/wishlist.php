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
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <link rel="stylesheet" href="../css/styles.css">
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
            $sql = "SELECT wi.wishlist_item_id, wi.product_id, p.product_name, p.product_price, p.product_image, p.product_status
                    FROM tbl_wishlist_item wi
                    JOIN tbl_products p ON wi.product_id = p.product_id
                    WHERE wi.user_id = $user_id";
            $result = $connect->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    if ($row['product_status'] == 'Deleted') {
                        echo "<tr class='align-middle'>
                                <td><img src='../uploads/" . $row['product_image'] . "' alt='Product Image' class='product-image img-thumbnail'> " . $row['product_name'] . "</td>
                                <td>$" . number_format($row['product_price'], 2) . "</td>
                                <td class='text-center'>Product Not Available</td>
                              </tr>";
                    } else {
                        echo "<tr class='align-middle'>
                                <td><img src='../uploads/" . $row['product_image'] . "' alt='Product Image' class='product-image img-thumbnail'> " . $row['product_name'] . "</td>
                                <td>$" . number_format($row['product_price'], 2) . "</td>
                                <td class='d-flex flex-wrap justify-content-center align-items-center'>
                                    <form action='../php/delete_wishlist_item.php' method='post' style='display:inline;'>
                                        <input type='hidden' name='wishlist_item_id' value='" . $row['wishlist_item_id'] . "'>
                                        <button type='button' class='btn btn-primary btn-rounded btn-min-width-padding' onclick='confirmDelete(this.form)'>Delete Item</button>
                                    </form>
                                    <a style='color:white; text-decoration:none' href='../php/getProductinfo.php?id=" . $row['product_id'] . "'>
                                        <button type='button' class='btn btn-primary btn-rounded btn-min-width-padding'>View Product</button>
                                    </a>
                                    <button type='button' class='btn btn-primary btn-rounded btn-min-width-padding' data-bs-toggle='modal'
                                        data-bs-target='#orderModal'
                                        data-product-id='" . $row['product_id'] . "'>
                                        Place Order
                                    </button>
                                </td>
                              </tr>";
                    }
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

<div class="modal fade" id="orderModal" tabindex="-1" aria-labelledby="orderModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title fs-5" id="exampleModalLabel">Are you sure?</h3>
            </div>
            <div class="modal-body">
                <p class="p-2">Would you like to place an order?</p>
            </div>
            <div class="modal-footer d-flex flex-column">
                <form id='deleteForm' action="" method="POST">
                    <button type="button" class="btn btn-secondary m-2" data-bs-dismiss="modal">No</button>
                    <button type="submit" name="send_offer" class="btn btn-danger m-2">Yes, place order</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Script to send data to modal -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    function updateModalAction(event) {
        const button = event.relatedTarget; // Button that triggered the modal

        // Extract data from data-* attributes
        const productId = button.getAttribute('data-product-id');

        // Get the target modal ID
        const modalId = button.getAttribute('data-bs-target').substring(1); // Remove the '#' character

        // Find the modal and its form
        const modal = document.getElementById(modalId);
        const form = modal.querySelector('form');

        // Update the form action dynamically
        form.action = `../php/placeOrder.php?id=${productId}`;
    }

    // Add event listeners to all modals
    const modals = document.querySelectorAll('.modal');
    modals.forEach(modal => {
        modal.addEventListener('show.bs.modal', updateModalAction);
    });
});
</script>

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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>

</html>
