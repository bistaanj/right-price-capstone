<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Right Price Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
<?php include "../includes/navigation.php"; ?>

<?php 
session_start();
require_once '../php/connection.php';

// Get the user ID from the session
$user_id = $_SESSION['user_id'];
$products = $_SESSION['user_products'];
?>

<div class="container mt-5">
    <h2 class="text-center">Your Products</h2>
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
                <th scope="col">ID</th>
                <th scope="col">Product</th>
                <th scope="col">Price</th>
                <th scope="col">Type</th>
                <th scope="col">Status</th>
                <th scope="col" class='text-center align-middle'>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($products)) {
                foreach ($products as $data) {
            ?>
                <tr>
                    <th scope="row" class='text-center align-middle'><?php echo $data['product_id']; ?></th>
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
                            <?php echo $data['sale_type']; ?>
                            <br>
                            <?php 
                             if ($data['sale_type']=='Auction'){
                                echo isset($data['total_offer']) && $data['total_offer']>0 ? $data['total_offer'] . "  bidder" : "No bidder";
                                // echo "(".$data['total_offer']." Offer Received )";
                            }  ?> 
                        </div>
                    </td>
                    <td class='text-center align-middle'>
                        <?php echo $data['product_status']; ?>
                    </td>
                    <td class="align-middle">
                        <div class="d-flex flex-wrap justify-content-center align-items-center">
                            <div>
                                <a href="sell_product.php?id=<?php echo $data['product_id']; ?>" class="btn btn-warning btn-rounded btn-min-width-padding">Edit</a>
                            </div>
                            <?php if ($data['sale_type'] == 'Sale') { ?>
                                <div>
                                    <button class="btn btn-primary btn-rounded btn-min-width-padding"
                                        data-bs-toggle="modal"
                                        data-bs-target="#deactiveModal"
                                        data-product-id="<?php echo $data['product_id']; ?>"
                                        data-transaction="deactivate">
                                        Change Status
                                    </button>
                                </div>
                            <?php } ?>
                            <?php if ($data['sale_type'] == 'Auction') { ?>
                                <div>
                                    <button class="btn btn-success btn-rounded btn-min-width-padding">Complete Auction</button>
                                </div>
                            <?php } ?>
                            <div>
                                <button class="btn btn-danger btn-rounded btn-min-width-padding"
                                    data-bs-toggle="modal"
                                    data-bs-target="#deleteModal"
                                    data-product-id="<?php echo $data['product_id']; ?>"
                                    data-transaction="delete">
                                    Delete
                                </button>
                            </div>
                        </div>
                    </td>
                </tr>
            <?php
                }
            }
            ?>
        </tbody>
    </table>

    <!-- Modals -->
    <!-- Modal for delete -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title fs-5" id="exampleModalLabel">Are you sure?</h3>
                </div>
                <div class="modal-body">
                    <p class="p-2">You cannot revert the changes once you delete. You can instead change status to make it hidden.</p>
                </div>
                <div class="modal-footer d-flex flex-column">
                    <form id='deleteForm' action="" method="POST">
                        <button type="button" class="btn btn-secondary m-2" data-bs-dismiss="modal">No</button>
                        <button type="submit" name="send_offer" class="btn btn-danger m-2">Yes, delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Deactivate -->
    <div class="modal fade" id="deactiveModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title fs-5" id="exampleModalLabel">Are you sure?</h3>
                </div>
                <div class="modal-body">
                    <p class="p-2">Your product visibility will change in the market.</p>
                </div>
                <div class="modal-footer d-flex flex-column">
                    <form id='deactiveForm' action="" method="POST">
                        <button type="button" class="btn btn-secondary m-2" data-bs-dismiss="modal">No</button>
                        <button type="submit" name="send_offer" class="btn btn-danger m-2">Yes, change</button>
                    </form>
                </div>
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
        const productId = button.getAttribute('data-product-id');
        const transactionType = button.getAttribute('data-transaction');

        // Get the target modal ID
        const modalId = button.getAttribute('data-bs-target').substring(1); // Remove the '#' character

        // Find the modal and its form
        const modal = document.getElementById(modalId);
        const form = modal.querySelector('form');

        // Update the form action dynamically
        form.action = `../php/userProductApi.php?id=${productId}&transaction=${transactionType}`;
    }

    // Add event listeners to all modals
    const modals = document.querySelectorAll('.modal');
    modals.forEach(modal => {
        modal.addEventListener('show.bs.modal', updateModalAction);
    });
});
</script>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>
