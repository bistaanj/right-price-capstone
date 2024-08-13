<?php 
include '../includes/checkSession.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Right Price- Product Info</title>
    <link rel="icon" type="image/x-icon" href="../images/RightPriceLogo.ico">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../css/styles.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

</head>
<body>

<?php

if (isset($_SESSION['current_product'])) {
    $info = $_SESSION['current_product'];
    $data = $info[0];
}
?>
<?php 
 include '../includes/navigation.php'
?> 
<?php 
    if(isset($_GET["offer_status"])):
        if($_GET["offer_status"]=='value'):
?>
    <script> 
        window.addEventListener('load',function() {
        swal("Offer Declined!", "The buyer has set the reserve price.", "error");  
        })
    </script>
<?php
    elseif($_GET["offer_status"] == 'success') :
?>
    <script> 
        window.addEventListener('load',function() {
        swal("Offer Sent.", "Your offer has been sent. You will receive an email if your offer gets selected.", "success");  
        })
    </script>
<?php
    elseif ($_GET["offer_status"] == 'declined'):
        ?>
    <script> 
        window.addEventListener('load',function() {
        swal("Declined.", "You have already made an offer. Please wait for the result.", "warning");  
        })
    </script>
<?php
    elseif ($_GET["offer_status"] == 'error'):
        ?>
    <script> 
        window.addEventListener('load',function() {
        swal("Declined", "There was a problem sending your offer. Please try again later.", "error");  
        })
    </script>
<?php
    endif;
    endif;
?>
    <div class="row justify-content-center mt-2">
        <div class="col-md-11 ">
            <div class="container-fluid ">
                <!-- First Row Starts -->
                <div class="row">
                    <!-- Picture Side Starts -->
                    <div class="col-md-4 b pr-info-pic">
                        <div class="d-flex flex-column align-items-center" style="width:100%; height:100%;">
                            <!-- div for image -->
                            <div  style="width:80%; height:80%">
                                <img src="/images/<?php echo $data["product_image"]; ?>" style="width:100%; height:100%;" alt="">
                            </div>
                             <div class="row justify-content-center">
                            <span class="h1 mt-1">
                                <?php echo $data["product_name"]; ?>
                            </span>
                        </div>
                            <div>
                                <?php
                                if ($data['sale_type'] == 'Auction') {
                                    echo 'Reserve Price:';
                                } else {
                                    echo 'Price:';
                                }
                                ?>
                                $<?php echo $data["product_price"]; ?>/- per <?php echo $data["product_unit"]; ?>
                              
                            </div>

                        </div>
                        
                    </div>

                    <!-- Description Side Starts -->
                    <div class="col-md-6 offset-md-1">
                        <div class="row justify-content-center">
                            <span class="h2 mt-3">
                                <?php echo $data["product_short_description"]; ?>
                            </span>
                        </div>
                        <div class="row border-bottom border-danger border-2 mt-3 p-2">
                            <div class="col-md-4">
                                Seller : <strong>  <?php echo $data["fname"]; ?>  <?php echo $data["lname"]; ?> </strong>
                            </div>
                            <div class="col-md-4 d-flex ">
                                Type : <strong class='text-white bg-primary px-2 rounded ml-1'> <?php echo $data["sale_type"]; ?> </strong>
                                
                            </div>
                        </div>
                        <div class="row justify-content-center m-2">
                            <span class="font-weight-bold">
                                Description
                            </span>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <p class="text-justify">
                                        <?php echo $data["product_description"]; ?>
                                    </p>
                                </div>
                        </div>
                    </div>
                </div>
                <!-- First Row Ends -->
                 <!-- Second Row Starts -->
                <div class="row ">
                    <div class="col-md-4 text-center">
                        <div class="col mt-3">
                            <form action="../php/add_wishlist_item.php" method='POST'>
                            <input type="hidden" name="product_id" value='<?php  echo $data['product_id'] ?>' >
                            <button type='submit' class="btn-lg btn-primary rounded-pill border-0" style='width:170px;'> <span class="text-white">  Add to Wishlist  </span></button>
                            </form>
                        </div>

                        <?php
                        if ($data['sale_type'] == 'Sale') { ?>
                            <div class="col mt-3">
                                <a href="../php/placeOrder.php?id=<?php echo $data['product_id'];?>">
                                    <button type='submit' class="btn-lg btn-warning rounded-pill border-0" style='width:170px;'> <span class="text-white">  Place Order </span> </button>
                                </a>
                            
                        </div>
                            <?php                        }
                        ?>
                        
                        
                        <?php
                        if ($data['sale_type']=='Auction'){
                            echo '
                                <div class="col mt-3">
                                <!-- Button trigger modal -->
                                    <button type="button" class="btn-lg btn-primary rounded-pill border-0" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                     Send Offer <i class="bi bi-envelope float-right"></i>
                                    </button>
                                </div>'; 
                            } 
                                ?>
                                <!-- Modal -->
                                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h3 class="modal-title fs-5" id="exampleModalLabel">Send your offer</h1>
                                        </div>
                                        <p> Please place your offer. You offer will be sent anonymously.</p>
                                        <p> Please be advised that this will considered as final amount and will not be allowed to make corrections.</p>
                                        <form action="../php/sendOffer.php" method="POST">
                                        <div class="modal-body">
                                        <div class="input-group mb-3">
                                           <input type="number" step="0.01" name="user_offer" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                                            </div>                                            
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" name="send_offer" class="btn btn-primary">Send</button>
                                        </div>
                                        </div>
                                        </form>
                                    </div>
                                    </div>
                                
                            
                       

                        
                        
                    </div>
                </div>
             </div>
             </div>
    </div>
        </div>
    </div>
    <?php include '../includes/footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>