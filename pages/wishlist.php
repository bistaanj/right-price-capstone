<?php include '../includes/checkSession.php' ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Right Price Dashboard</title>
    <link rel="icon" type="image/x-icon" href="../images/RightPriceLogo.ico">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../css/styles.css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <link rel="stylesheet" href="../css/styles.css">
    <script>
        function confirmRemove(form) {
            swal({
                title: "Are you sure?",
                text: "This product will be removed from your wishlist.",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    form.submit();
                } else {
                    swal("Item not removed!");
                }
            });
        }
    </script>
    <script>
        function confirmCancle(form) {
            swal({
                title: "Are you sure?",
                text: "Your order has already been processed. You might be liable for cancellation fee.",
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
<main class ='d-flex justify-content-center align-items-start'>
<div class="mt-5 w-75 ">

<?php
if (isset($_GET['success'])) {
    echo '<script>window.addEventListener("load", function() { swal("Success", "Product added to wishlist", "success"); })</script>';
} elseif (isset($_GET['error'])) {
    echo '<script>window.addEventListener("load", function() { swal("Declined", "Product already in wishlist", "error"); })</script>';
} elseif (isset($_GET['requestAccepted'])) {
    echo '<script>window.addEventListener("load", function() { swal("Order Canceled", "Your order has been canceled. You can still order the product from ", "success"); })</script>';
} elseif (isset($_GET['requestDeclined'])) {
    echo '<script>window.addEventListener("load", function() { swal("Declined", "Your Order has already been dispatched. You cannot cancel the order now.", "error"); })</script>';
}
?>

    <div class="mt-5 ">
    <h2 class="text-center">WISHLIST</h2>
    <table class="table table-striped  mt-3">
        <thead class="thead-dark">
            <tr>
                <th class='text-center' style="width: 20%;">PRODUCT</th>
                <th class='text-center' style="width: 20%;">PRICE</th>
                <th class='text-center' style="width: 50%;">ACTION</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // connection
            require_once '../php/connection.php';

            $user_id = $_SESSION['user_id']; // get session id
            
            // get data 
            $sql = "SELECT wi.wishlist_item_id, wi.product_id, 
            wi.product_status, 
            p.product_name, p.product_price, p.product_unit, p.product_image, p.sale_type, p.product_status as product_presence
                    FROM tbl_wishlist_item wi
                    JOIN tbl_products p ON wi.product_id = p.product_id
                    WHERE wi.user_id = $user_id";
            $result = $connect->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    if ($row['product_status'] == 'UNORDERED' && $row['sale_type'] == 'Sale' && $row['product_presence'] != 'Deleted' ) {
                        echo "<tr>
                            <td class='align-middle'>
                                <div class='d-flex align-items-center'>
                                    <img src='../images/" . $row['product_image'] . "' alt='Product Image' class='img-thumbnail' style='width: 100px; height: auto; margin-right: 10px;'> 
                                    <div>
                                        <h5 class='mb-0'>" . $row['product_name'] . "</h5>
                                    </div>
                                </div>
                            </td>
                            <td class='align-middle text-center'>
                                <div> 
                                    <h5 class='mb-0'>$" . number_format($row['product_price'], 2) . "</h5>
                                    <small>per " . $row['product_unit'] . "</small>
                                </div>
                            </td>
                            <td class='align-middle'>
                                <div class='d-flex text-center flex-wrap justify-content-around align-items-center'>
                                    <div>
                                        <form action='../php/delete_wishlist_item.php' method='post' class='mb-2'>
                                            <input type='hidden' name='wishlist_item_id' value='" . $row['wishlist_item_id'] . "'>
                                            <button type='button' class='btn btn-danger btn-sm d-flex align-items-center justify-content-center' onclick='confirmRemove(this.form)'>
                                                <i class='bi bi-trash-fill p-3'></i>
                                            </button>
                                        </form>
                                    </div>
                                    <div>
                                        <a href='../php/getProductinfo.php?id=".$row['product_id']."'> 
                                            <button class='btn btn-primary' style='width:120px;'>
                                                View Product
                                            </button>
                                        </a>
                                    </div>
                                    <div>
                                    <a href='../php/placeOrder.php?id=" . $row['product_id'] . "' > 
                                    <button class='btn btn-primary' style='width:120px;'>
                                    Place Order
                                    </button>
                                    </a>
                                    </div>
                                </div>
                            </td>
                          </tr>";
                    } elseif ($row['product_status'] == 'ORDERED' && $row['sale_type'] == 'Sale' && $row['product_presence'] != 'Deleted') {
                        echo "<tr>
                            <td class='align-middle'>
                                <div class='d-flex align-items-center'>
                                    <img src='../images/" . $row['product_image'] . "' alt='Product Image' class='img-thumbnail' style='width: 100px; height: auto; margin-right: 10px;'> 
                                    <div>
                                        <h5 class='mb-0'>" . $row['product_name'] . "</h5>
                                    </div>
                                </div>
                            </td>
                            <td class='align-middle text-center'>
                                <div> 
                                    <h5 class='mb-0'>$" . number_format($row['product_price'], 2) . "</h5>
                                    <small>per " . $row['product_unit'] . "</small>
                                </div>
                            </td>
                            <td class='align-middle'>
                                <div class='d-flex flex-wrap justify-content-around align-items-center'>
                                <div>
                                    <form action='../php/cancleOrder.php' method='POST' class='mb-2'>
                                        <input type='hidden' name='product_id' value='" . $row['product_id'] . "'>
                                        <button type='button' class='btn btn-danger btn-sm d-flex align-items-center justify-content-center' onclick='confirmCancle(this.form)'>
                                                <i class='bi bi-x-circle p-3'></i>
                                            </button>
                                    </form> 
                                </div>
                                <div>
                                    <a href='../php/getProductinfo.php?id=" . $row['product_id'] . "'>
                                    <button class='btn btn-primary' style='width:120px;'>
                                        View Product 
                                    </button>
                                    </a>
                                </div>
                                <div>
                                    <button class='btn btn-info' style='width:125px;' disabled>
                                        Order Placed 
                                    </button>
                                </div>
                                </div>
                            </td>
                        </tr>";
                    } elseif ($row['sale_type'] == 'Auction' && $row['product_presence'] != 'Deleted') {
                        echo "<tr>
                            <td class='align-middle'>
                                <div class='d-flex align-items-center'>
                                    <img src='../images/" . $row['product_image'] . "' alt='Product Image' class='img-thumbnail' style='width: 100px; height: auto; margin-right: 10px;'> 
                                    <div>
                                        <h5 class='mb-0'>" . $row['product_name'] . "</h5>
                                    </div>
                                </div>
                            </td>
                            <td class='align-middle text-center'>
                                <div> 
                                    <h5 class='mb-0'>$" . number_format($row['product_price'], 2) . "</h5>
                                    <small>per " . $row['product_unit'] . "</small>
                                </div>
                            </td>
                            <td class='text-center '>
                                <div class='d-flex flex-wrap justify-content-center align-items-center'>
                                    <div>
                                        <form action='../php/delete_wishlist_item.php' method='post' class='mb-2'>
                                            <input type='hidden' name='wishlist_item_id' value='" . $row['wishlist_item_id'] . "'>
                                            <button type='button' class='btn btn-danger d-flex align-items-center justify-content-center' onclick='confirmDelete(this.form)'>
                                                <i class='bi bi-trash-fill p-3'></i>
                                            </button>
                                            
                                        </form>
                                    </div>                                    
                                    <div class='ml-2'>
                                        <a href='../php/getProductinfo.php?id=" . $row['product_id'] . "'>
                                            <button class='btn btn-primary ' style='width:120px;'>
                                                View Product 
                                            </button>
                                        </a>
                                    </div>
                                </div>
                            </td>
                          </tr>";
                    } elseif ($row['product_presence'] == 'Deleted') {
                        echo "<tr class='align-middle'>
                                <td class='align-middle'>
                                <div class='d-flex align-items-center'>
                                    <img src='../images/" . $row['product_image'] . "' alt='Product Image' class='img-thumbnail' style='width: 100px; height: auto; margin-right: 10px;'> 
                                    <div>
                                        <h5 class='mb-0'>" . $row['product_name'] . "</h5>
                                    </div>
                                </div>
                            </td>
                            <td class='align-middle text-center'>
                                <div> 
                                    <h6> Was </h6>
                                    <h5 class='mb-0'>$" . number_format($row['product_price'], 2) . "</h5>
                                    <small>per " . $row['product_unit'] . "</small>
                                </div>
                            </td>
                                <td class='text-center'>Product is removed by the seller</td>
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


<!-- Script to send data to modal -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    function updateModalAction(event) {
        const button = event.relatedTarget; // Button that triggered the modal

        // Extract data from data-* attributes
        const productId = button.getAttribute('data-product-id');

        // Get the target modal ID
        const modalId = button.getAttribute('data-bs-target').substring(1);
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

</main>
<?php include '../includes/footer.php'; ?>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>
