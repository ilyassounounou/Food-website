<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>about</title>
 <!-- bootstrap links -->
 <link rel="stylesheet" href="css/bootstrap.min.css">   

 <!-- swiper links -->
 <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<!-- bax n3yto l navbar -->
<?php include 'components/user_header.php'; ?>
<!-- header section ends -->

<div class="heading">
   <h3>about us</h3>
   <p><a href="home.php">home</a> <span> / about</span></p>
</div>

<!-- about section starts  -->

<section class="about">

   <div class="row">

      <div class="image">
         <img src="images/about-img.svg" alt="">
      </div>

      <div class="content">
         <h3>why choose us?</h3>
         <p>
Chez "Friends", chaque aspect de votre expérience culinaire est soigneusement orchestré pour vous offrir bien plus qu'un simple repas. Dès que vous franchissez nos portes, vous entrez dans un univers où la convivialité est reine. Notre cuisine est une véritable déclaration d'amitié, avec des plats préparés avec amour et une attention méticuleuse aux détails. Vous découvrirez une palette de saveurs alléchantes, allant des classiques réconfortants aux créations audacieuses, toujours concoctées avec des ingrédients de qualité. Dans notre atmosphère chaleureuse et accueillante, chaque convive est traité comme un ami cher, avec un service attentif et amical qui fait toute la différence. Chez "Friends", nous célébrons la diversité culinaire en proposant une variété de plats adaptés à tous les goûts et préférences alimentaires, y compris des options végétariennes et végétaliennes savoureuses. Et avec des critiques élogieuses et des recommandations enthousiastes, vous pouvez être sûr que votre visite chez "Friends" sera une expérience mémorable à partager avec vos proches.</p>
         <a href="menu.php" class="btn">our menu</a>
      </div>

   </div>

</section>

<!-- about section ends -->

<!-- steps section starts  -->

<section class="steps">

   <h1 class="title">simple steps</h1>

   <div class="box-container">

      <div class="box">
         <img src="images/step-1.png" alt="">
         <h3>choose order</h3>
         <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Nesciunt, dolorem.</p>
      </div>

      <div class="box">
         <img src="images/step-2.png" alt="">
         <h3>fast delivery</h3>
         <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Nesciunt, dolorem.</p>
      </div>

      <div class="box">
         <img src="images/step-3.png" alt="">
         <h3>enjoy food</h3>
         <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Nesciunt, dolorem.</p>
      </div>

   </div>

</section>

<!-- steps section ends -->

<!-- reviews section starts  -->

<section class="reviews">

   <h1 class="title">customer's reivews</h1>

   <div class="swiper reviews-slider">

      <div class="swiper-wrapper">

         <div class="swiper-slide slide">
            <img src="images/pic-1.png" alt="">
            <p>"Je suis un habitué chez Friends et je ne suis jamais déçu. Leur constance dans la qualité de la cuisine et du service est remarquable. Que ce soit pour un déjeuner rapide ou un dîner plus élaboré, Friends est toujours une valeur sûre. Bravo à toute l'équipe !"</p>
            <div class="stars">
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star-half-alt"></i>
            </div>
            <h3>Nicolas </h3>
         </div>

         <div class="swiper-slide slide">
            <img src="images/pic-2.png" alt="">
            <p>  "Une expérience gastronomique inoubliable ! La cuisine chez Friends est tout simplement divine. Chaque plat est un véritable chef-d'œuvre de saveurs et de fraîcheur. L'ambiance décontractée et conviviale ajoute une touche spéciale à cette expérience culinaire. J'ai hâte d'y retourner !"</p>
            <div class="stars">
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star-half-alt"></i>
            </div>
            <h3>Sophie</h3>
         </div>

         <div class="swiper-slide slide">
            <img src="images/pic-3.png" alt="">
            <p>"Le service chez Friends est impeccable. Le personnel est attentif, sympathique et toujours prêt à répondre à nos besoins. C'est rafraîchissant de voir une équipe aussi dévouée à offrir une expérience exceptionnelle à ses clients. Je recommande vivement !"</p>
            <div class="stars">
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star-half-alt"></i>
            </div>
            <h3>Marc </h3>
         </div>

         <div class="swiper-slide slide">
            <img src="images/pic-4.png" alt="">
            <p>"En tant que végétalienne, j'apprécie énormément la variété d'options disponibles chez Friends. Leur menu végétalien est créatif et délicieux. C'est agréable de pouvoir savourer un repas aussi délicieux sans compromettre mes valeurs. Merci, Friends !"</p>
            <div class="stars">
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star-half-alt"></i>
            </div>
            <h3>Emma </h3>
         </div>

         <div class="swiper-slide slide">
            <img src="images/pic-5.png" alt="">
            <p>"Friends est devenu mon restaurant préféré en ville. La qualité de la nourriture est toujours au rendez-vous, et l'ambiance est juste parfaite pour une soirée entre amis ou un dîner en amoureux. Je recommande le plat de pâtes au pesto - c'est un vrai délice !".</p>
            <div class="stars">
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star-half-alt"></i>
            </div>
            <h3>Thomas</h3>
         </div>

         <div class="swiper-slide slide">
            <img src="images/pic-6.png" alt="">
            <p> "J'ai fêté mon anniversaire chez Friends et je n'aurais pas pu rêver mieux ! Le personnel a tout fait pour rendre cette soirée spéciale encore plus mémorable. La nourriture était délicieuse, l'ambiance était animée et festive. Merci pour cette expérience inoubliable !"</p>
            <div class="stars">
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star-half-alt"></i>
            </div>
            <h3>Jorjina</h3>
         </div>

      </div>

      <div class="swiper-pagination"></div>

   </div>

</section>

<!-- reviews section ends -->



















<!-- footer section starts  -->
<?php include 'components/footer.php'; ?>
<!-- footer section ends -->=






<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>

<!-- custom js file link  -->
<script src="js/script.js"></script>

<script>

var swiper = new Swiper(".reviews-slider", {
   loop:true,
   grabCursor: true,
   spaceBetween: 20,
   pagination: {
      el: ".swiper-pagination",
      clickable:true,
   },
   breakpoints: {
      0: {
      slidesPerView: 1,
      },
      700: {
      slidesPerView: 2,
      },
      1024: {
      slidesPerView: 3,
      },
   },
});

</script>


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