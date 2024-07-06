<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

include 'components/add_cart.php';


?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>home</title>
<!-- swiper links -->
   <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />

   <!-- bootstrap links -->
   <link rel="stylesheet" href="css/bootstrap.min.css">
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
   
 

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>

<?php include 'components/user_header.php'; ?>

<div class="slider">
    <div class="list">
        <div class="item">
            <img src="./project images/dish-1.png" alt="">
        </div>

        <div class="item">
            <img src="./project images/dish-2.png" alt="">
        </div>

        <div class="item">
            <img src="./project images/dish-3.png" alt="">
        </div>

        <div class="item">
            <img src="./project images/dish-4.png" alt="">
        </div>

        <div class="item">
            <img src="./project images/pizza-1.png" alt="">
        </div>

        <div class="item">
            <img src="./project images/pizza-2.png" alt="">
        </div>

        <div class="item">
            <img src="./project images/pizza-3.png" alt="">
        </div>

        <div class="item">
            <img src="./project images/pizza-5.png" alt="">
        </div>
    </div>
    <div class="circle">
        If you're looking to create a simple but effective image slider on your website.
    </div>

    <div class="content">
        <!-- <div>menu</div>
        <div>Restaurant</div> -->
        <a href="menu.php" class="sld">see menus</a>
    </div>

    <div class="arrow">
        <button id="prev"><</button>
        <button id="next">></button>
    </div>
</div>


<!-- <section class="hero">

   <div class="swiper hero-slider">

      <div class="swiper-wrapper">

         <div class="swiper-slide slide">
            <div class="content">
               <span>order online</span>
               <h3>delicious pizza</h3>
               <a href="menu.php" class="btn">see menus</a>
            </div>
            <div class="image">
               <img src="images/home-img-1.png" alt="">
            </div>
         </div>

         <div class="swiper-slide slide">
            <div class="content">
               <span>order online</span>
               <h3>chezzy hamburger</h3>
               <a href="menu.php" class="btn">see menus</a>
            </div>
            <div class="image">
               <img src="images/home-img-2.png" alt="">
            </div>
         </div>

         <div class="swiper-slide slide">
            <div class="content">
               <span>order online</span>
               <h3>rosted chicken</h3>
               <a href="menu.php" class="btn">see menus</a>
            </div>
            <div class="image">
               <img src="images/home-img-3.png" alt="">
            </div>
         </div>

      </div>

      <div class="swiper-pagination"></div>

   </div>

</section> -->

<section class="category">

   <h1 class="title">food category</h1>

   <div class="box-container">

      <a href="category.php?category=fast food" class="box">
         <img src="images/cat-1.png" alt="">
         <h3>fast food</h3>
      </a>

      <a href="category.php?category=main dish" class="box">
         <img src="images/cat-2.png" alt="">
         <h3>main dishes</h3>
      </a>

      <a href="category.php?category=drinks" class="box">
         <img src="images/cat-3.png" alt="">
         <h3>drinks</h3>
      </a>

      <a href="category.php?category=desserts" class="box">
         <img src="images/cat-4.png" alt="">
         <h3>desserts</h3>
      </a>
   
  

   </div>

</section>




<section class="products">

   <h1 class="title">latest dishes</h1>

   <div class="box-container">

      <?php
         $select_products = $conn->prepare("SELECT * FROM `products` LIMIT 8 ");
         $select_products->execute();
         if($select_products->rowCount() > 0){
            while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){
      ?>
      <form action="" method="post" class="box">
         <input type="hidden" name="pid" value="<?= $fetch_products['id']; ?>">
         <input type="hidden" name="name" value="<?= $fetch_products['name']; ?>">
         <input type="hidden" name="price" value="<?= $fetch_products['price']; ?>">
         <input type="hidden" name="image" value="<?= $fetch_products['image']; ?>">
         <a href="quick_view.php?pid=<?= $fetch_products['id']; ?>" class="fas fa-eye"></a>
         <button type="submit" class="fas fa-shopping-cart" name="add_to_cart"></button>
         <img src="uploaded_img/<?= $fetch_products['image']; ?>" alt="">
         <a href="category.php?category=<?= $fetch_products['category']; ?>" class="cat"><?= $fetch_products['category']; ?></a>
         <div class="name"><?= $fetch_products['name']; ?></div>
         <div class="flex">
            <div class="price"><?= $fetch_products['price']; ?><span>DH</span></div>
            <input type="number" name="qty" class="qty" min="1" max="99" value="1" maxlength="2">
         </div>
      </form>
      <?php
            }
         }else{
            echo '<p class="empty">no products added yet!</p>';
         }
      ?>

   </div>

   <div class="more-btn">
      <a href="menu.php" class="btn">veiw all</a>
   </div>

</section>


















<?php include 'components/footer.php'; ?>

<?php
include 'components/btn_media.php';
?>


<!-- custom js file link  -->
<script src="js/script.js"></script>

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