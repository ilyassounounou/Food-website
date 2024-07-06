<?php
include '../components/connect.php';
session_start();

if(isset($_GET['delete'])){
    $delete_id = $_GET['delete'];
    $delete_reservation = $conn->prepare("DELETE FROM `reservations` WHERE id = ?");
    $delete_reservation->execute([$delete_id]);

    
    header('location:admin_reservations.php');
 }

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Admin_Reservation</title>
 <!-- font awesome cdn link  -->
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

<!-- custom css file link  -->
<link rel="stylesheet" href="../css/admin_style.css">
</head>
<body>
<?php include '../components/admin_header.php' ?>

<!-- placed orders section starts  -->

<section class="placed-orders">

   <h1 class="heading">Les Reservations</h1>

   <div class="box-container">


   <?php


try {
    $select_reservation = $conn->prepare("SELECT * FROM `reservations`");
    $select_reservation->execute();
    if ($select_reservation->rowCount() > 0) {
        while ($reservation = $select_reservation->fetch(PDO::FETCH_ASSOC)) {
?>
          <div class="box">
                <p> First name : <span><?= $reservation['first_name']; ?></span> </p>
                <p> Last name : <span><?= $reservation['last_name']; ?></span> </p>
                <p> Email : <span><?= $reservation['email']; ?></span> </p>
                <p> Phone: <span><?= $reservation['phone']; ?></span> </p>
                <p> Date : <span><?= $reservation['date']; ?></span> </p>
                <p> Time : <span><?= $reservation['time']; ?></span> </p>
                <p> Time Zone : <span><?= $reservation['time_zone']; ?></span> </p>
                <p> Nombre de Personne: <span><?= $reservation['num_guests']; ?></span> </p>
                <p> Commantaire: <span><?= $reservation['comments']; ?></span> </p>
                <!-- Add more details here as needed -->
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                    <input type="hidden" name="order_id" value="<?= $reservation['id']; ?>">
                    
                    <div class="flex-btn">
                        <!-- Add a button to submit updates -->
                        <a href="update_reservations.php?update=<?= $reservation['id']; ?>" class="option-btn">update</a>
                        <!-- Change the link to include PHP file name and reservation ID -->
                        <a href="admin_reservations.php?delete=<?= $reservation['id']; ?>" class="delete-btn" onclick="return confirm('Delete this order?');">Delete</a>
                    </div>
                </form>
            </div>
<?php
        }
    } else {
        echo '<p class="empty">No reservation placed yet!</p>';
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
</body>
</html>
