<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
    header('location:admin_login.php');
    exit(); // Terminate script execution after redirection
}

if (isset($_POST['update'])) {

   $first_name = $_POST['first_name'];
   $first_name = filter_var($first_name, FILTER_SANITIZE_STRING);

   $last_name = $_POST['last_name'];
   $last_name = filter_var($last_name, FILTER_SANITIZE_STRING);
    
    $reservation_id = $_GET['update']; // Assuming you're passing reservation ID via GET

    $update_product = $conn->prepare("UPDATE `reservations` SET  first_name = ?, last_name = ? WHERE id = ?");
    $update_product->execute([ $first_name, $last_name ,$reservation_id]);


   //  $update_product = $conn->prepare("UPDATE `reservations` SET first_name = ?, last_name = ? WHERE id = ?");

    

    $message[] = 'Reservation updated!';
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Update Reservation</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/admin_style.css">

</head>
<body>

<?php include '../components/admin_header.php' ?>

<!-- update product section starts  -->

<section class="update-product">

   <h1 class="heading">Update Reservation</h1>

   <?php
      $update_id = $_GET['update'];
      $shows_reservation = $conn->prepare("SELECT * FROM `reservations` WHERE id = ?");
      $shows_reservation->execute([$update_id]);
      if($shows_reservation->rowCount() > 0){
         while($reservation = $shows_reservation->fetch(PDO::FETCH_ASSOC)){  
   ?>
   <form action="" method="POST" enctype="multipart/form-data">

     

      <span>Update first name</span>
      <input type="text" required placeholder="Enter first name" name="first_name" maxlength="100" class="box" value="<?= $reservation['first_name']; ?>">

      <span>Update last name</span>
      <input type="text" required placeholder="Enter last name" name="last_name" maxlength="100" class="box" value="<?= $reservation['last_name']; ?>">

      <span>Update Email</span>
      <input type="text" required placeholder="Enter Email" name="email" maxlength="100" class="box" value="<?= $reservation['email']; ?>">

      <span>Update Phone</span>
      <input type="text" required placeholder="Enter Phone" name="phone" maxlength="100" class="box" value="<?= $reservation['phone']; ?>">

      <span>Update Date</span>
      <input type="text" required placeholder="Enter Date" name="date" maxlength="100" class="box" value="<?= $reservation['date']; ?>">

      <span>Update Time</span>
      <input type="text" required placeholder="Enter Time" name="time" maxlength="100" class="box" value="<?= $reservation['time']; ?>">

      <span>Update Time Zone</span>
      <input type="text" required placeholder="Enter Time Zone" name="time_zone" maxlength="100" class="box" value="<?= $reservation['time_zone']; ?>">

      <span>Update Numero de personne</span>
      <input type="text" required placeholder="Enter Numero de Personne" name="Num_guests" maxlength="100" class="box" value="<?= $reservation['num_guests']; ?>">

      <span>Update Copmmente</span>
      <input type="text" required placeholder="Enter Your Commente" name="comments" maxlength="100" class="box" value="<?= $reservation['comments']; ?>">
 
     
      <div class="flex-btn">
         <input type="submit" value="Update" class="btn" name="update">
         <a href="admin_reservations.php" class="option-btn">Go back</a>
      </div>
   </form>
   <?php
         }
      } else {
         echo '<p class="empty">No reservation added yet!</p>';
      }
   ?>

</section>

<!-- update product section ends -->

<!-- custom js file link  -->
<script src="../js/admin_script.js"></script>

</body>
</html>
