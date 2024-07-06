<?php
include 'components/connect.php'; 

session_start();

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    $user_id = '';
}



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $name = $_POST["name"];
        $phone = $_POST["phone"];
      
        
        // Function to process checkbox arrays
        function processCheckbox($input) {
            if (isset($_POST[$input])) {
                $values = implode(',', $_POST[$input]);
                return $values;
            } else {
                return "default_value";
            }
        }

        // Process checkbox inputs
        $smbe = processCheckbox("smb");
        $basee = processCheckbox("base");
        $Ingredientss = processCheckbox("Ingredients");
        $supingree = processCheckbox("supingre");
        $saucee = processCheckbox("sauce");
        $topprosee = processCheckbox("topprose");
        $suptoppe = processCheckbox("suptopp");
        $toppreme = processCheckbox("topprem");

        

        $query = "INSERT INTO `ingredient_salad` (name, phone, smb_salad, base_salad, ingre_salad, supp_ingre_salad, sauce_salad, topp_rose_salad, supp_rose_salad, toop_prem_salad) VALUES (:name, :phone,  :smb_salad, :base_salad, :ingre_salad, :supp_ingre_salad, :sauce_salad, :topp_rose_salad , :supp_rose_salad , :toop_prem_salad)";

        $query_result = $conn->prepare($query);

        // Set PDO error mode to exceptions
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $pdoExec = $query_result->execute(array(":name" => $name, ":phone" => $phone,  ":smb_salad" => $smbe, ":base_salad" => $basee, ":ingre_salad" => $Ingredientss, ":supp_ingre_salad" => $supingree, ":sauce_salad" => $saucee, ":topp_rose_salad" => $topprosee, ":supp_rose_salad" => $suptoppe, ":toop_prem_salad" => $toppreme ));

        if ($pdoExec) {
            $_SESSION['status'] = "Data inserted successfully";
        }

    
 

    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
        exit();
    }
}
?>




<!DOCTYPE html>
<html lang="en">
<head> 
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Salade</title>
 
       <!-- font awesome cdn link  -->
       <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" /> <!-- bootstrap links -->
 <link rel="stylesheet" href="css/bootstrap.min.css">   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

   <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>



   <style>
    
    input[type="checkbox"] {
        -webkit-appearance: none; 
        -moz-appearance: none;
        appearance: none;
        width: 20px; 
        height: 20px;
        border: 1px solid #000; 
        border-radius: 3px; 
        margin-bottom: 3px;
    }

    
    input[type="checkbox"]:checked {
        background-color: #000; /
    }

    input[type="checkbox"] {
        vertical-align: middle; 
        margin-right: 5px; 
    }

    input[type="checkbox"] + span {
   
        font-weight: bold;
      
        vertical-align: middle; 
        font-size: 10px;
        font-family: cursive;
        
    }

 
</style>
</head>
<body>



<?php 
include 'components/user_header.php'; 
?>


    <div class="container">
        <div class="row justify-content-center ">
            <div class="col-lg-8">
       
                      <?php 
                    if(isset($_SESSION['status']))
                    {
                        ?>
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <strong>Hey!</strong> <?php echo $_SESSION['status']; ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php
                         unset($_SESSION['status']);
                    }
                ?>

                <div class="card m-5 cadr_cart_salad">
                    <div class="card-header cart_salad">
                        <h4>la cart de bar a salad</h4>
                    </div>
                    <div class="card-body">

<form class="" action="" method="POST" autocomplete="off">
<div class="form-group mb-3">
<table>
    <tr>
        <td><label for="name">Name:</label></td>
        <td><input type="text" id="name" name="name" required value="" style="margin-left: 40px; " class="border"></td>
    </tr>
    <tr>
        <td><label for="phone">Phone number:</label></td>
        <td><input type="text" id="phone" name="phone" required value="" style="margin-left: 40px;" class="border"></td>
    </tr>
  
</table>

    </div>

                        <hr>

                        
                         <div class="form-group  mb-3">
                         <div class="form-group mb-3">
                        <input type="checkbox" name="smb[]" value="Small"> Small : <b>1 Base + 5 Ingredients + 1 Topping rose + Sauces au choix</b>
                        <span class="prix_salad" style="border: 1px solid black; margin-left: 10px; padding: 3px;">35DH</span>
                         <br> 
                    </div>

 

                        <input type="checkbox" name="smb[]" value="Medium"> Medium : <b>2 Bases + 8 Ingredients + 2 Topping rose + Sauces au choix</b> 
                        <span class="prix_salad" style="border: 1px solid black; margin-left: 10px; padding: 3px;">45DH</span> <br>
                        <br>

                        <input type="checkbox" name="smb[]" value="Big"> Big : <b>3 Bases + Ingredients vert aux choix + 2 Toppings + 2 Toppings premium + sauces au choix</b> 
                        <span class="prix_salad" style="border: 1px solid black; margin-left: 10px; padding: 3px;">70DH</span> <br>
                        <br>
                         </div>
                         <hr>
                        <div class="form-group mb-3">
                            <label><b>Base:</b></label> <br>
                            <input type="checkbox" name="base[]" value="Salade vert" class=""><span>Salade vert</span> <br>
                            <input type="checkbox" name="base[]" value="Riz"><span>Riz </span> <br>
                            <input type="checkbox" name="base[]" value="pate Fusiii"><span>pate Fusiii </span> <br>
                            <input type="checkbox" name="base[]" value="pate penne"> <span>pate penne</span><br>
                            <input type="checkbox" name="base[]" value="Sans base"><span>Sans base </span><br>
                        </div>
                      
                            <hr>
                          


<div class="container">
  <div class="row">
    <div class="col-md-3">
  <h3>Ingredients</h3>
     <input type="checkbox" name="Ingredients[]" value="Tomate fraiches"><span>Tomate fraiches</span> <br>
       <input type="checkbox" name="Ingredients[]" value="Tomate cerise"><span>Tomate cerisespan </span><br>
         <input type="checkbox" name="Ingredients[]" value="Concombre"> <span>Concombre</span> <br>
           <input type="checkbox" name="Ingredients[]" value=" Chou blanc / rouge"><span>Chou blanc / rouge</span> <br>
             <input type="checkbox" name="Ingredients[]" value="Tomate confites"><span>Tomate confites</span> <br>
               <input type="checkbox" name="Ingredients[]" value="Oignon frais"><span>Oignon frais</span> <br>
                 <input type="checkbox" name="Ingredients[]" value="Oignon caramelise"><span>Oignon caramelise</span> <br>
                 <input type="checkbox" name="Ingredients[]" value="Bettrave"><span>Bettrave</span> <br>
                  <input type="checkbox" name="Ingredients[]" value="Brocoli"><span>Brocoli</span> <br>
                   <input type="checkbox" name="Ingredients[]" value="Persil"><span>Persil</span> <br>
                    <input type="checkbox" name="Ingredients[]" value="Radis"><span>Radis</span> <br>
                      <input type="checkbox" name="Ingredients[]" value="Courgette grillee"><span>Courgette grillee</span> <br>
                        <input type="checkbox" name="Ingredients[]" value="Aubergine grillee"><span>Aubergine grillee</span> <br>
                          <input type="checkbox" name="Ingredients[]" value="Poivron frais"><span>Poivron frais</span> <br>
                            <input type="checkbox" name="Ingredients[]" value="La roquette"><span>La roquette</span> <br>
                              <input type="checkbox" name="Ingredients[]" value="Olives noir"><span>Olives noir</span> <br>
                                <input type="checkbox" name="Ingredients[]" value="Olives vert"><span>Olives vert</span> <br>
         <hr>                          
    </div>
 
    <div class="col-md-3">
     <h4>supplement</h4><b>4DH</b><br>
      <input type="checkbox" name="supingre[]" value="Dinde fume"><span>Dinde fume</span><br>
      <input type="checkbox" name="supingre[]" value="Cornichons"><span>Cornichons</span><br>
      <input type="checkbox" name="supingre[]" value="capres"><span>capres</span><br>
      <input type="checkbox" name="supingre[]" value="Raisin sec"><span>Raisin sec</span><br>
      <input type="checkbox" name="supingre[]" value="Pomme de terre"><span>Pomme de terre</span><br>
      <input type="checkbox" name="supingre[]" value="Patate douce"><span>Patate douce</span><br>
      <input type="checkbox" name="supingre[]" value="Carotte rape"><span>Carotte rape</span><br>
      <input type="checkbox" name="supingre[]" value="Haricot vert"><span>Haricot vert</span><br>
      <input type="checkbox" name="supingre[]" value="Haricot rouge"><span>Haricot rouge</span><br>
      <input type="checkbox" name="supingre[]" value="Poire"><span>Poire</span><br>
      <input type="checkbox" name="supingre[]" value="Oeuf dur"><span>Oeuf dur</span><br>
      <input type="checkbox" name="supingre[]" value="Oeuf de caille"><span>Oeuf de caille</span><br>
      <input type="checkbox" name="supingre[]" value="Croutons a l'ail"><span>Croutons a l'ail</span><br>
      <input type="checkbox" name="supingre[]" value="Mais"><span>Mais</span><br>
      <input type="checkbox" name="supingre[]" value="Lentille"><span>Lentille</span><br>
      <input type="checkbox" name="supingre[]" value="Pois chiche"><span>Pois chiche</span><br>
      <input type="checkbox" name="supingre[]" value="Datte"><span>Datte</span><br>
      <input type="checkbox" name="supingre[]" value="Noix"><span>Noix</span><br>
    </div>


    <div class="col-md-3">
        <br><br>
      <input type="checkbox" name="supingre[]" value="Figue"><span>Figue</span><br>
      <input type="checkbox" name="supingre[]" value="Pamplimousse"><span>Pamplimousse</span><br>
      <input type="checkbox" name="supingre[]" value="Fraise"><span>Fraise</span><br>
      <input type="checkbox" name="supingre[]" value="Kaki"><span>Kaki</span><br>
      <input type="checkbox" name="supingre[]" value="Melon"><span>Melon</span><br>
      <input type="checkbox" name="supingre[]" value="Orange"><span>Orange</span><br>
      <input type="checkbox" name="supingre[]" value="Kiwi"><span>Kiwi</span><br>
      <input type="checkbox" name="supingre[]" value="Pomme"><span>Pomme</span><br>
        <input type="checkbox" name="supingre[]" value="Banane"><span>Banane</span><br>
      <input type="checkbox" name="supingre[]" value="Quinoa"><span>Quinoa</span><br>
      <input type="checkbox" name="supingre[]" value="Amande"><span>Amande</span><br>
      <input type="checkbox" name="supingre[]" value="Abricot sec"><span>Abricot sec</span><br>
      <input type="checkbox" name="supingre[]" value="Champignon Frais"><span>Champignon Frais</span><br>
      <input type="checkbox" name="supingre[]" value="Graine de chia"><span>Graine de chia</span><br>
      <input type="checkbox" name="supingre[]" value="Graine de lin"><span>Graine de lin</span><br>
      <input type="checkbox" name="supingre[]" value="Graine de sesame"><span>Graine de sesame</span><br>
       <input type="checkbox" name="supingre[]" value="Greaine de courge"><span>Greaine de courge</span><br>

    <hr>
    </div>


    <div class="col-md-3">
    <h3>Sauce</h3>
       <input type="checkbox" name="sauce[]" value="Sauce cesar"><span>Sauce cesar</span><br>
         <input type="checkbox" name="sauce[]" value="Sauce cocktail"><span>Sauce cocktail</span><br>
           <input type="checkbox" name="sauce[]" value="Sauce pesto"><span>Sauce pesto</span><br>
             <input type="checkbox" name="sauce[]" value="Mayonnaise"><span>Mayonnaise</span><br>
             <input type="checkbox" name="sauce[]" value="Moutard et miel"><span>Moutard et miel</span><br>
         <input type="checkbox" name="sauce[]" value="Vinaigrette moutarde"><span>Vinaigrette moutarde</span><br>
           <input type="checkbox" name="sauce[]" value="Vinaigrette au Balsamique"><span>Vinaigrette au Balsamique</span><br>
           <input type="checkbox" name="sauce[]" value="Vinaigrette au ciboulette"><span>Vinaigrette au ciboulette</span><br>
             <input type="checkbox" name="sauce[]" value="Hulle d'olive + citron"><span>Hulle d'olive + citron</span><br>
             <input type="checkbox" name="sauce[]" value="Yaourt concombre ciboulette"><span>Yaourt concombre ciboulette</span><br>
         <input type="checkbox" name="sauce[]" value="Huile d'argane"><span>Huile d'argane</span><br>
           <input type="checkbox" name="sauce[]" value="Sans sauce"><span>Sans sauce</span><br>
             <input type="checkbox" name="sauce[]" value="Sauce separer"><span>Sauce separer</span><br>
<hr>
    </div>
  </div>
</div>


    <div class="container">
  <div class="row">
    <div class="col-md-3">
        <h3>Topping rose</h3>
        <input type="checkbox" name="topprose[]" value="Poulet grille"><span>Poulet grille</span><br>
        <input type="checkbox" name="topprose[]" value="Anchoix"><span>Anchoix</span><br>
         <input type="checkbox" name="topprose[]" value="Avocat"><span>Avocat</span><br>
        <input type="checkbox" name="topprose[]" value="Artichaut"><span>Artichaut</span><br>
         <input type="checkbox" name="topprose[]" value="Ananas frais"><span>Ananas frais</span><br>
        <input type="checkbox" name="topprose[]" value="Mangue"><span>Mangue</span><br>
         <input type="checkbox" name="topprose[]" value="Poivrron marine"><span>Poivrron marine</span><br>
        <input type="checkbox" name="topprose[]" value="Ricotta"><span>Ricotta</span><br>
        <hr>
    </div>  


    <div class="col-md-3">
         <h4>supplement</h4><b>7DH</b><br>
           <input type="checkbox" name="suptopp[]" value="Thon"><span>Thon</span><br>
         <input type="checkbox" name="suptopp[]" value="Fromage Edam"><span>Fromage Edam</span><br>
        <input type="checkbox" name="suptopp[]" value="Mozzarella Boi"><span>Mozzarella Boi</span><br>
        <input type="checkbox" name="suptopp[]" value="Jambon de boeuf"><span>Jambon de boeuf</span><br>
        <input type="checkbox" name="suptopp[]" value="Surimi"><span>Surimi</span><br>
        <input type="checkbox" name="suptopp[]" value="Coeur de palmier"><span>Coeur de palmier</span><br>
         <input type="checkbox" name="suptopp[]" value="Feta"><span>Feta</span><br>
         
<hr>
    </div>  

        <div class="col-md-3">
        <h3>Topping Premium</h3>
        <input type="checkbox" name="topprem[]" value="Crevette"><span>Crevette</span><br>
        <input type="checkbox" name="topprem[]" value="Calamar"><span>Calamar</span><br>
         <input type="checkbox" name="topprem[]" value="Saumon frais"><span>Saumon frais 18DH</span><br>
        <input type="checkbox" name="topprem[]" value="Parmesan"><span>Parmesan</span><br>
         <input type="checkbox" name="topprem[]" value="Fromage bleu"><span>Fromage bleu</span><br>
        <input type="checkbox" name="topprem[]" value="Fromage maasdam"><span>Fromage maasdam</span><br>
        <hr>
    </div> 
</div>  
</div>



<label for="total" style="font-size: 20px;">Total Price:</label>
<input type="text" name="total" id="total" readonly style="font-size: 20px;">


</div>
                </div>
            </div>
        </div>
    </div>

    <div class="salade_ice  mb-3">
     <button type="submit"  class="btn" name="submit">Submit</button>
     
    </div> 
               
    </form>
      

                        
 
                        
          




<!-- footer section starts  -->
<?php include 'components/footer.php'; ?>
<!-- footer section ends -->

<?php
include 'components/btn_media.php';
?>








<!-- custom js file link  -->
<script src="js/script.js"></script>


<?php
 include 'components/select_check.php';
 ?>

<script src="js/popper.min.js"></script>
    <script src="js/jquery-3.7.1.min.js"></script> 
    <script src="js/bootstrap.min.js"></script>
 
</body>
</html>