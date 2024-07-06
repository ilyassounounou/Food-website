<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
   header('location:home.php');
};

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>orders</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
 <!-- bootstrap links -->
 <link rel="stylesheet" href="css/bootstrap.min.css">   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<!-- header section starts  -->
<?php include 'components/user_header.php'; ?>
<!-- header section ends -->

<div class="heading">
   <h3>orders</h3>
   <p><a href="html.php">home</a> <span> / orders</span></p>
</div>





<section class="orders">
    <h1 class="title">Your Orders</h1>
    <div class="box-container">
    <?php
    if($user_id == ''){
        echo '<p class="empty">Please login to see your orders</p>';
    } else {
        $orders_empty = true;

        // Selecting orders from the 'orders' table
        $select_orders = $conn->prepare("SELECT * FROM `orders` WHERE user_id = ?");
        $select_orders->execute([$user_id]);

        // Selecting ingredients from the 'ingredient_salad' table
        $select_salads = $conn->prepare("SELECT * FROM `ingredient_salad`");
        $select_salads->execute();

        // Displaying orders
        if ($select_orders->rowCount() > 0) {
            while ($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)) {
                $orders_empty = false;
                ?>
                <div class="box">
                    <p>Placed On: <span><?= $fetch_orders['placed_on']; ?></span></p>
                    <p>Name: <span><?= $fetch_orders['name']; ?></span></p>
                    <p>Email: <span><?= $fetch_orders['email']; ?></span></p>
                    <p>Number: <span><?= $fetch_orders['number']; ?></span></p>
                    <p>Address: <span><?= $fetch_orders['address']; ?></span></p>
                    <p>Payment Method: <span><?= $fetch_orders['method']; ?></span></p>
                    <p>Your Orders: <span><?= $fetch_orders['total_products']; ?></span></p>
                    <p>Total Price: <span><?= $fetch_orders['total_price']; ?> DH</span></p>
                    <p>Payment Status: <span style="color:<?php if($fetch_orders['payment_status'] == 'pending'){ echo 'red'; }else{ echo 'green'; }; ?>"><?= $fetch_orders['payment_status']; ?></span></p>
                    <p>Remarque: <span><?= $fetch_orders['remarque']; ?></span></p>
                </div>
                <?php
            }
        }

        // Displaying ingredients
        if ($select_salads->rowCount() > 0) {
            while ($fetch_salads = $select_salads->fetch(PDO::FETCH_ASSOC)) {
                $orders_empty = false;
                ?>
                <div class="box">
                  
                    <p>Name: <span><?= $fetch_salads['name']; ?></span></p>
                    <p>Phone: <span><?= $fetch_salads['phone']; ?></span></p>
                    <p>Type of Salad: <span class='text'><?= $fetch_salads['smb_salad']; ?></span></p>
                    <p>Base de Salad: <span class='text'><?= $fetch_salads['base_salad']; ?></span></p>
                    <p>Ingredients: <span class='text'><?= $fetch_salads['ingre_salad']; ?></span></p>
                    <p>Supplement 4DH: <span class='text'><?= $fetch_salads['supp_ingre_salad']; ?></span></p>
                    <p>Sauce: <span class='text'><?= $fetch_salads['sauce_salad']; ?></span></p>
                    <p>Topping Rose: <span class='text'><?= $fetch_salads['topp_rose_salad']; ?></span></p>
                    <p>Supplement 7DH: <span class='text'><?= $fetch_salads['supp_rose_salad']; ?></span></p>
                    <p>Topping Premieum: <span class='text'><?= $fetch_salads['toop_prem_salad']; ?></span></p>
                </div>
                <?php
            }
        }

        // Displaying the "No orders placed yet!" message if both tables are empty
        if ($orders_empty) {
            echo '<p class="empty">No orders placed yet!</p>';
        }
    }
    ?>
    </div>
</section>








<!-- footer section starts  -->
<?php include 'components/footer.php'; ?>
<!-- footer section ends -->






<!-- custom js file link  -->
<script src="js/script.js"></script>

<?php
include 'components/btn_media.php';
?>




<script>


   document.addEventListener("DOMContentLoaded", function() {
   const closeBtn = document.querySelector(".btn_media");

   closeBtn.addEventListener("click", () => {
       closeBtn.classList.toggle("open");
   });
});

</script>


<script src="js/popper.min.js"></script>
    <script src="js/jquery-3.7.1.min.js"></script> 
    <script src="js/bootstrap.min.js"></script>
</body>
</html>




