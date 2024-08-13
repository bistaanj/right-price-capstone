<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Right Price-Order</title>
    <link rel="icon" type="image/x-icon" href="../images/RightPriceLogo.ico">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
<?php include "../includes/navigation.php"; ?>
<main>


<?php
session_start();
require_once '../php/connection.php';

// Get the user ID from the session
$user_id = $_SESSION['user_id'];
$products = $_SESSION['user_orders'];
?>

<div class="container mt-5">
    <h2 class="text-center">Your Orders</h2>
    <?php if (isset($_GET['status']) && $_GET['status'] == 'success') { ?>
            <script> 
            window.addEventListener('load',function() {
            swal("Product Updated!", "Your Product has been updated successfully", "success");  
            })
        </script>
    <?php } ?>
    <table class="table table-hover">
        <thead class="thead-dark">
            <tr>
                <th scope="col">Order#</th>
                <th scope="col">Product</th>
                <th scope="col">Price</th>
                <th scope="col">Buyer Name</th>
                <th scope="col">Contact Details</th>
                <th scope="col">Delivery Address</th>
                <th scope="col" class='text-center align-middle'>Actions</th>
            </tr>
        </thead>
        <tbody>            
                <?php
                 if (!empty($products)){
                foreach ($products as $index=> $data) {
                    ?>
                        <tr>
                            <th scope="row" class='text-center align-middle'><?php echo $data['order_id']; ?></th>
                            <td>
                                <div class="container d-flex justify-content-center">
                                    <img src="../images/<?php echo $data['product_image'] ?: 'RightPriceLogo.jpeg'; ?>" class="img-thumbnail" alt="Product Image">
                                </div>
                                <div class="container-fluid text-center">
                                    <?php echo $data['product_name']; ?>
                                </div>
                            </td>
                            <td class='text-center align-middle'><?php echo $data['product_price']; ?></td>
                            <td class='text-center align-middle'>
                                <div>
                                    <?php echo $data['fname']; ?>
                                    </div>
                            </td>
                            <td class='text-center align-middle'>
                                <div class="">
                                    <?php echo $data['email']; ?>
                                </div>
                                <div class="">
                                    <?php echo $data['phone']; ?>
                                </div>
                            </td>
                            <td class='text-center align-middle'>
                                <div class="">
                                    <?php echo $data['address_secondary']; ?> - <?php echo $data['address']; ?>,
                                </div>
                                <div class="">
                                    <?php echo $data['city']; ?>, <?php echo $data['state']; ?>
                                </div>
                                <div class="">
                                    <?php echo $data['zip']; ?>
                                </div>
                            </td>
                            <td class="align-middle">
                                <div class="d-flex flex-wrap justify-content-center align-items-center">
                                                                    <?php
                                if ($data['order_status'] == 'ORDERED') { ?>
                                        <div>
                                            <button class="btn btn-info btn-rounded btn-min-width-padding text-white"
                                            data-bs-toggle="modal"
                                            data-bs-target="#dispatchModal"
                                            data-order-id="<?php echo $data['order_id']; ?>" 
                                            data-product-id="<?php echo $data['product_id']; ?>" 
                                            data-buyer-id="<?php echo $data['buyer_id']; ?>" 
                                            data-transaction-type="DISPATCHED" >
                                            DISPATCH ORDER
                                        </button> 
                                        <button class="btn btn-danger btn-rounded btn-min-width-padding text-white"
                                            data-bs-toggle="modal"
                                            data-bs-target="#deleteModal"
                                            data-order-id="<?php echo $data['order_id']; ?>"
                                            data-product-id="<?php echo $data['product_id']; ?>" 
                                            data-buyer-id="<?php echo $data['buyer_id']; ?>" 
                                            data-transaction-type="DECLINED"  >
                                            Decline
                                        </button> 
                                        
                                         
                                        </div>
                                    <?php } ?>
                                    <?php
                                    if ($data['order_status'] == 'DECLINED') { ?>
                                        <div>
                                            <button class="btn btn-danger btn-rounded btn-min-width-padding text-white" disabled>                                            
                                            DECLINED
                                        </button> 
                                        </div>
                                    <?php } ?>
                                    <?php
                                        if ($data['order_status'] == 'DISPATCHED') { ?>
                                            <div>
                                                <button class="btn btn-danger btn-rounded btn-min-width-padding text-white" disabled>                                            
                                                DISPATCHED
                                            </button> 
                                            </div>
                                    <?php } ?>
                                    
                                </div>
                            </td>
                        </tr>
                    <?php
                } 
                ?>
                

                <?php
            }
            ?>
        </tbody>
    </table>
    <?php if (empty($products)) {
                echo "
                <div class='container'>
                    <h2 class='text-center'> You do not have any orders yet.</h2>
                </div>"; }
                ?>

    <!-- Modals -->
            <!-- try -->
             

    <!-- Modal for detail -->
    <div class="modal fade" id="dispatchModal" tabindex="-1" aria-labelledby="dispatchModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title fs-5" id="exampleModalLabel">Are you sure?</h3>
                </div>
                <div class="modal-body">
                    <p class="p-2">The buyer will be notified that the order has been dispatched. </p>
                </div>
                <div class="modal-footer d-flex flex-column">
                    <form id='deleteForm' action="" method="POST">
                        <button type="button" class="btn btn-secondary m-2" data-bs-dismiss="modal">No</button>
                        <button type="submit" name="process_order" class="btn btn-warning m-2">Yes, Order has been dispatched</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title fs-5" id="exampleModalLabel">Are you sure?</h3>
                </div>
                <div class="modal-body">
                    <p class="p-2"> The buyer will be notified that the order has been Declined. </p>
                </div>
                <div class="modal-footer d-flex flex-column">
                    <form id='deleteForm' action="" method="POST">
                        <button type="button" class="btn btn-secondary m-2" data-bs-dismiss="modal">No</button>
                        <button type="submit" name="process_order" class="btn btn-danger m-2">Yes, Decline</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

   


<!-- Script for modals -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    function updateModalAction(event) {
        const button = event.relatedTarget; // Button that triggered the modal

        // Extract data from data-* attributes
        const orderId = button.getAttribute('data-order-id');
        const transactionType = button.getAttribute('data-transaction-type');
        const productId = button.getAttribute('data-product-id');
        const buyerId = button.getAttribute('data-buyer-id');

        // Get the target modal ID
        const modalId = button.getAttribute('data-bs-target').substring(1); // Remove the '#' character

        // Find the modal and its form
        const modal = document.getElementById(modalId);
        const form = modal.querySelector('form');

        // Update the form action dynamically
        form.action = `../php/processorder.php?id=${orderId}&transaction=${transactionType}&buyer=${buyerId}&product=${productId}`;
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
