<?php

include 'components/connect.php';

session_start();


if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
   header('location:home.php');
   exit; // Stop execution after redirect
}

$message = []; // Initialize message array



if(isset($_POST['delete'])){
 
       $delete_id = $_POST['delete'];
       $delete_cart_salad = $conn->prepare("DELETE FROM ingredient_salad WHERE id = ?");
       $delete_cart_salad->execute([$delete_id]);
   
}



if(isset($_POST['delete'])){
   if(isset($_POST['cart_id'])){
       $cart_id = $_POST['cart_id'];
       $delete_cart_item = $conn->prepare("DELETE FROM cart WHERE id = ?");
       $delete_cart_item->execute([$cart_id]);
     
   }}




if(isset($_POST['delete_all'])){

       $delete_cart_salad = $conn->prepare("DELETE FROM ingredient_salad ");
       $delete_cart_salad->execute();

   $delete_cart_item = $conn->prepare("DELETE FROM cart WHERE user_id = ?");
   $delete_cart_item->execute([$user_id]);
   // header('location:cart.php');
   $message[] = 'deleted all from cart!';
}








if(isset($_POST['update_qty'])){
   if(isset($_POST['cart_id'])){
   $cart_id = $_POST['cart_id'];
   $qty = $_POST['qty'];
   $qty = filter_var($qty, FILTER_SANITIZE_NUMBER_INT);
   $update_qty = $conn->prepare("UPDATE cart SET quantity = ? WHERE id = ?");
   $update_qty->execute([$qty, $cart_id]);
   $message[] = 'cart quantity updated';
}}




if(isset($_POST['update_qty'])){
    $cart_id = $_POST['update_qty']; // Assuming 'update_qty' contains the ID of the cart item
    $qty_key = 'qty_' . $cart_id;
    $qty = isset($_POST[$qty_key]) ? $_POST[$qty_key] : 1; // Get updated quantity
    $qty = filter_var($qty, FILTER_SANITIZE_NUMBER_INT); // Sanitize quantity

    $update_qty = $conn->prepare("UPDATE ingredient_salad SET quantity = ? WHERE id = ?");
    $update_qty->execute([$qty, $cart_id]);
    $message[] = 'Cart quantity updated';
}



$end_total = 0;

// Display messages (if any)


?>


<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>cart</title>

    <!-- bootstrap links -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<!-- header section starts  -->
<?php include 'components/user_header.php'; ?>
<!-- header section ends -->

<div class="heading">
   <h3>shopping cart</h3>
   <p><a href="home.php">home</a> <span> / cart</span></p>
</div>

<!-- shopping cart section starts  -->

<section class="products">

<h1 class="title">your cart</h1>

<div class="box-container">

<?php
   $grand_total_cart = 0;
   $select_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
   $select_cart->execute([$user_id]);
   if($select_cart->rowCount() > 0){
      while($fetch_cart = $select_cart->fetch(PDO::FETCH_ASSOC)){
?>
<form action="" method="post" class="box">
   <input type="hidden" name="cart_id" value="<?= $fetch_cart['id']; ?>">
   <a href="quick_view.php?pid=<?= $fetch_cart['pid']; ?>" class="fas fa-eye"></a>
   <button type="submit" class="fas fa-times" name="delete" onclick="return confirm('delete this item?');"></button>
   <img src="uploaded_img/<?= $fetch_cart['image']; ?>" alt="">
   <div class="name"><?= $fetch_cart['name']; ?></div>
   <div class="flex">
      <div class="price"><?= $fetch_cart['price']; ?><span>DH</span></div>
      <input type="number" name="qty" class="qty" min="1" max="99" value="<?= $fetch_cart['quantity']; ?>" maxlength="2">
      <button type="submit" class="fas fa-edit" name="update_qty"></button>
   </div>
   <div class="sub-total"> sub total : <span><?= $sub_total = ($fetch_cart['price'] * $fetch_cart['quantity']); ?>DH</span> </div>
</form>
<?php
        $end_total =  $grand_total_cart += $sub_total;
      }
   }else{
      // echo '<p class="empty">your cart is empty</p>';
   }
?>

<?php

?>



<?php
$grand_total_salad = 0;



// Fetch and calculate totals
$select_query = $conn->prepare("SELECT * FROM ingredient_salad");
$select_query->execute();

if ($select_query->rowCount() > 0) {
    while ($select_salad = $select_query->fetch(PDO::FETCH_ASSOC)) {
        $total_items_ingre = 0; // Initialize total supplementary ingredients
        $total_items_rose = 0; // Initialize total rose salads

        // Calculate the total supplementary ingredients
        if (!empty($select_salad['supp_ingre_salad'])) {
            $total_items_ingre = count(explode(',', $select_salad['supp_ingre_salad']));
        }

        // Calculate the total rose salads
        if (!empty($select_salad['supp_rose_salad'])) {
            $total_items_rose = count(explode(',', $select_salad['supp_rose_salad']));
        }

        // Calculate adjusted price_per_unit based on the number of selected checkboxes
        $adjusted_price_per_unit = $select_salad['price_per_unit'] + ($total_items_ingre * 4) + ($total_items_rose * 7);

        // Calculate subtotal for each salad
        $sub_total = $adjusted_price_per_unit * $select_salad['quantity'];

        // Add subtotal to grand total
        $grand_total_salad += $sub_total;
      
      
?>

<?php
  $end_total = $grand_total_cart + $grand_total_salad;
?>

<form action="" method="post" class="box">
    <button type="submit" name="delete" value="<?= $select_salad['id']; ?>" class="fas fa-times" onclick="return confirm('delete this item?');"></button>
    <!-- <a href="quick_view.php?id=<?= $select_salad['id']; ?>" class="fas fa-eye"></a> -->

    <img src="images/cat-5.png" alt="">
    <p class="name">Type of salad: <span class='text'><?= $select_salad['smb_salad']; ?></span></p>

    <div class="flex">
        <div class="price"><?= $adjusted_price_per_unit ?><span>DH</span></div>

        <input type="number" name="qty_<?= $select_salad['id']; ?>" class="qty" min="1" max="99" value="<?= $select_salad['quantity']; ?>" maxlength="2">
        <button type="submit" class="fas fa-edit" name="update_qty" value="<?= $select_salad['id']; ?>"></button>   
    </div>

    <!-- Display the adjusted sub-total -->
    <div class="sub-total"> sub total : <span><?= $sub_total; ?>DH</span> </div>
</form>

<?php
    }
    //echo "Grand Total: $" . $end_total . " DH";
} else {
    //echo "No ingredients found.";
}
?>






</div>



<div class="cart-total">
   
   <p>cart total : <span><?= $end_total; ?>DH</span></p>
   <a href="checkout.php" class="btn <?= ($end_total > 1)?'':'disabled'; ?>">proceed to checkout</a>
</div>

<div class="more-btn">




 <form action="" method="post">
         <button type="submit" class="delete-btn <?= ($end_total > 1)?'':'disabled'; ?>" name="delete_all" onclick="return confirm('delete all from cart?');">delete all</button>
      </form> 


   <a href="menu.php" class="btn">continue shopping</a>
</div>

</section>


<!-- shopping cart section ends -->



<!-- footer section starts  -->
<?php include 'components/footer.php'; ?>
<!-- footer section ends -->



<!-- custom js file link  -->
<script src="js/script.js"></script>


<script>
// Retrieve the total price from localStorage
var totalPrice = localStorage.getItem('totalPrice');

// Display the total price
document.getElementById('displayTotal').innerText = totalPrice;
</script>
<?php
include 'components/btn_media.php';
?>









<script src="js/popper.min.js"></script>
    <script src="js/jquery-3.7.1.min.js"></script> 
    <script src="js/bootstrap.min.js"></script>

</body>
</html>