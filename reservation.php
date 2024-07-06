<?php
include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};


try {
    if (isset($_POST["reserver"])) {
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $date = $_POST['date'];
        $time = $_POST['time'];
        $time_zone = $_POST['time_zone'];
        $num_guests = $_POST['num_guests'];
        $comments = $_POST['comments'];
  

        // Validate if phone, date, time, time_zone, and num_guests are numeric values
        if (!is_numeric($phone) || !is_numeric($time_zone) || !is_numeric($num_guests)) {
            // Handle the error, e.g., display a message or redirect to an error page
            echo "<script>alert('Phone, Time Zone, and Number of Guests must be numeric values')</script>";
        } else {
            // Insert reservation into the database using prepared statements
            $sql = "INSERT INTO reservations (first_name, last_name, email, phone, date, time, time_zone, num_guests, comments) 
                    VALUES (:first_name, :last_name, :email, :phone, :date, :time, :time_zone, :num_guests, :comments)";

            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':first_name', $first_name);
            $stmt->bindParam(':last_name', $last_name);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':phone', $phone);
            $stmt->bindParam(':date', $date);
            $stmt->bindParam(':time', $time);
            $stmt->bindParam(':time_zone', $time_zone);
            $stmt->bindParam(':num_guests', $num_guests);
            $stmt->bindParam(':comments', $comments);

            $stmt->execute();

            // Close the database connection
            $conn = null;

          
       

            // Redirect or display success message
            //  header("Location: success.php"); // Uncomment this line if you want to redirect the user to a success page.
            $message[] = 'Data inserted successfully';
        }
    
    }
}    catch (PDOException $e) {
    echo 'Error: ' . $e->getMessage();
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant Reservation</title>
       <!-- bootstrap links -->
   <link rel="stylesheet" href="css/bootstrap.min.css">
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
   

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">
</head>

<body>


    <!-- header section starts  -->

    <!-- header section ends -->




    <div class="heading">
        <h3>our menu</h3>
        <p><a href="home.php">home</a> <span> / Reservation</span></p>
    </div>
    <section class="reservation">
        <div class="rows">
                    <form action="" method="post" >
                <h3>Reservation</h3>
                <input type="text" name="first_name" class="boxe" placeholder="First Name" required><br>
                <input type="text" name="last_name" class="boxe" placeholder="Last Name" required><br>
                <input type="email" name="email" required placeholder="enter your email" class="boxe" maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')">
                <input type="text" name="phone" class="boxe" placeholder="Phone" required><br>
                <input type="date" name="date" class="boxe" placeholder="Date" required><br>
                <input type="time" name="time" class="boxe" placeholder="Time" required><br>
                <input type="text" name="time_zone" class="boxe" placeholder="Time Zone" required><br>
                <input type="text" name="num_guests" class="boxe" placeholder="Number of Guests" required><br>
                <textarea name="comments" placeholder="enter your message" maxlength="500" cols="30" rows="10" class="boxe" required></textarea><br>
                <input type="submit" name="reserver" value="Reserve" class="btn">
                </form>
        </div>
    </section>

    <section class="reserver">
        <div class="client">

       
    <div class="row">
        <h3>Reserver par Email</h3>
        <i class="fa-solid fa-envelope"><p>Friends_eaterycoffeehouse@gmail.com</p></i>
        
    
        <h3>Reserver par Telephone</h3>
        <i class="fa-solid fa-phone"><p>+212 528 220 988</p></i>
    </div>
     </div>
    </section>
    

</body>



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
</html>
