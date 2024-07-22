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
<?php include "../includes/navigation.php" ?>    
<?php 
session_start();
$product = $_SESSION['user_products'];
?>
<div class="container mt-5">
    <h2 class="text-center">Your Products</h2>
    <table class="table table-hover">
  <thead class="thead-dark">
    <tr>
      <th scope="col">id</th>
      <th scope="col">Product</th>
      <th scope="col">Price</th>
      <th scope="col">Type</th>
      <th scope="col">Status</th>
      <th scope="col" class='text-center align-middle'>Actions</th>
    </tr>
  </thead>
  <tbody>
    <tr>
        <?php 
        if(!empty($product)){
            foreach($product as $data){
               
        ?>

            
      <th scope="row" class='text-center align-middle' > <?php echo $data['product_id'];?>  </th>
      <td>
        <div class="container d-flex justify-content-center">
            <img src="../images/RightPriceLogo.jpeg" class="img-thumbnail" alt="Logo">
        </div>
        <div class="container-fluid text-center">
           <?php echo $data['product_name']; ?>
        </div>

      </td>
      <td class='text-center align-middle'><?php echo $data['product_price']; ?></td>
      <td class='text-center align-middle'>
        <div>
            <?php echo $data['sale_type']; ?>
        </div>
        </td>
      <td class='text-center align-middle'>
        <?php echo $data['product_status']; ?>
      </td>
      <td class="align-middle">
        <div class = " d-flex flex-wrap justify-content-center align-items-center" >
            <div>
                <button class="btn btn-warning btn-rounded btn-min-width-padding">Edit</button>
            </div>
            <?php
            if($data['sale_type']=='Sale'){
                echo'
                <div>
                    <button class="btn btn-primary btn-rounded btn-min-width-padding">Change Status</button>
                </div>
                <div>
                    <button class="btn btn-success btn-rounded btn-min-width-padding">Sold-out</button>
                </div>
                ';
            }             
            ?>
            <?php
            if($data['sale_type']=='Auction'){
                echo'
                <div>
                    <button class="btn btn-success btn-rounded btn-min-width-padding">Complete Auction</button>
                </div>
                ';
            }    
            ?>         
            <div>
               <button class="btn btn-danger btn-rounded btn-min-width-padding">Delete</button>
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


</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
