<?php

include 'components/connect.php';

session_start();

if (!isset($_SESSION['user_id'])) {
    header('location:home.php');
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch user profile data
$fetch_profile_query = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
$fetch_profile_query->execute([$user_id]);
$fetch_profile = $fetch_profile_query->fetch(PDO::FETCH_ASSOC);

if (!$fetch_profile) {
    header('location:home.php');
    exit();
}

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $name = filter_var($name, FILTER_SANITIZE_STRING);
    $number = $_POST['number'];
    $number = filter_var($number, FILTER_SANITIZE_STRING);
    $email = $_POST['email'];
    $email = filter_var($email, FILTER_SANITIZE_STRING);
    $method = $_POST['method'];
    $method = filter_var($method, FILTER_SANITIZE_STRING);
    $address = $_POST['address'];
    $address = filter_var($address, FILTER_SANITIZE_STRING);
    $total_products = $_POST['total_products'];
    $total_price = $_POST['total_price'];
    $remarque = filter_var($_POST['remarque'], FILTER_SANITIZE_STRING);

    // Vérification du panier
    $check_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
    $check_cart->execute([$user_id]);

    // Vérification des ingrédients de salade
    $check_salad = $conn->prepare("SELECT * FROM ingredient_salad");
    $check_salad->execute();

    // Vérification du contenu du panier ou des ingrédients de salade
    if ($check_cart->rowCount() > 0 || $check_salad->rowCount() > 0) {
        if (empty($address)) {
            $message[] = 'Please add your address!';
        } else {
            // Insertion de la commande dans la table 'orders'
            $insert_order = $conn->prepare("INSERT INTO `orders` (user_id, name, number, email, method, address, total_products, total_price, remarque) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $insert_order->execute([$user_id, $name, $number, $email, $method, $address, $total_products, $total_price, $remarque]);

            // Suppression des éléments du panier
            $delete_cart = $conn->prepare("DELETE FROM `cart` WHERE user_id = ?");
            $delete_cart->execute([$user_id]);

            $message[] = 'Order placed successfully!';
            echo "<script>document.addEventListener('DOMContentLoaded', function() { updateCartCount(0); });</script>";
        }
    } else {
        $message[] = 'Your cart is empty';
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Checkout</title>
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
   <h3>Checkout</h3>
   <p><a href="home.php">Home</a> <span> / Checkout</span></p>
</div>

<section class="checkout">

   <h1 class="title">Order Summary</h1>

<form action="" method="post">

   <div class="cart-items">
      <h3>Cart Items</h3>

      <?php
$grand_total = 0; // Initialize grand total variable only once
$cart_items = []; // Initialize cart items array

// Retrieve salad ingredients
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
        $grand_total += $sub_total;

        // Add item details to cart items array
        $cart_items[] = $select_salad['smb_salad'] . ' (' . $adjusted_price_per_unit . ' x ' . $select_salad['quantity'] . ') - ' . $sub_total;
        ?>
        <p><span class="name"><?= htmlspecialchars($select_salad['smb_salad']); ?></span><span class="price"><?= $adjusted_price_per_unit ?> x <?= $select_salad['quantity']; ?> DH</span></p>
        <?php
    }
}

// Retrieve items from cart
$select_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
$select_cart->execute([$user_id]);

if ($select_cart->rowCount() > 0) {
    while ($fetch_cart = $select_cart->fetch(PDO::FETCH_ASSOC)) {
        $cart_items[] = $fetch_cart['name'].' ('.$fetch_cart['price'].' x '.$fetch_cart['quantity'].') - '.($fetch_cart['price'] * $fetch_cart['quantity']);
        $grand_total += ($fetch_cart['price'] * $fetch_cart['quantity']);
        ?>
        <p><span class="name"><?= htmlspecialchars($fetch_cart['name']); ?></span><span class="price"><?= $fetch_cart['price']; ?> x <?= $fetch_cart['quantity']; ?> DH</span></p>
        <?php
    }
}

// Concatenate all cart items into a single string
$total_products = implode(', ', $cart_items);
?>

<p><?= htmlspecialchars($total_products); ?></p>

<p class="grand-total"><span class="name">Grand Total :</span><span class="price">$<?= $grand_total; ?></span></p>

      <a href="cart.php" class="btn">View Cart</a>
   </div>

   <input type="hidden" name="total_products" value="<?= htmlspecialchars($total_products); ?>">
   <input type="hidden" name="total_price" value="<?= htmlspecialchars($grand_total); ?>">
   <input type="hidden" name="name" value="<?= htmlspecialchars($fetch_profile['name']); ?>">
   <input type="hidden" name="number" value="<?= htmlspecialchars($fetch_profile['number']); ?>">
   <input type="hidden" name="email" value="<?= htmlspecialchars($fetch_profile['email']); ?>">
   <input type="hidden" name="address" value="<?= htmlspecialchars($fetch_profile['address']); ?>">

   <div class="user-info">
      <h3>Your Info</h3>
      <p><i class="fas fa-user"></i><span><?= htmlspecialchars($fetch_profile['name']); ?></span></p>
      <p><i class="fas fa-phone"></i><span><?= htmlspecialchars($fetch_profile['number']); ?></span></p>
      <p><i class="fas fa-envelope"></i><span><?= htmlspecialchars($fetch_profile['email']); ?></span></p>
      <a href="update_profile.php" class="btn">Update Info</a>
      <h3>Delivery Address</h3>
      <p><i class="fas fa-map-marker-alt"></i><span><?php if($fetch_profile['address'] == ''){echo 'Please enter your address';}else{echo htmlspecialchars($fetch_profile['address']);} ?></span></p>
      <a href="update_address.php" class="btn">Update Address</a>
      <select name="method" class="box" required>
         <option value="" disabled selected>Select payment method --</option>
         <option value="cash on delivery">Cash on Delivery</option>
         <option value="credit card">Credit Card</option>
         <option value="stripe">Stripe</option>
         <option value="paypal">Paypal</option>
      </select>
      <textarea name="remarque" id="remarque" placeholder="Enter your message" maxlength="500" cols="30" rows="10" class="box" required></textarea><br>
      <input type="submit" value="place order" class="btn <?php if($fetch_profile['address'] == ''){echo 'disabled';} ?>" style="width:100%; background:var(--red); color:var(--white);" name="submit">
   </div>

</form>
   
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


function updateCartCount(count) {
    const cartCountElement = document.querySelector('.cart-count'); // Update this selector as per your HTML structure
    if (cartCountElement) {
        cartCountElement.textContent = count;
    }
}

</script>

<script src="js/popper.min.js"></script>
<script src="js/jquery-3.7.1.min.js"></script> 
<script src="js/bootstrap.min.js"></script>
</body>
</html>
