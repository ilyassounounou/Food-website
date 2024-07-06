<?php
$message = []; // Initialize an array to store messages

if(isset($_POST['add_to_cart'])){

   if($user_id == ''){
      header('location:login.php');
   }else{

      $pid = $_POST['pid'];
      $pid = filter_var($pid, FILTER_SANITIZE_STRING);
      $name = $_POST['name'];
      $name = filter_var($name, FILTER_SANITIZE_STRING);
      $price = $_POST['price'];
      $price = filter_var($price, FILTER_SANITIZE_STRING);
      $image = $_POST['image'];
      $image = filter_var($image, FILTER_SANITIZE_STRING);
      $qty = $_POST['qty'];
      $qty = filter_var($qty, FILTER_SANITIZE_STRING);

      $check_cart_numbers = $conn->prepare("SELECT * FROM `cart` WHERE name = ? AND user_id = ?");
      $check_cart_numbers->execute([$name, $user_id]);

      if($check_cart_numbers->rowCount() > 0){
         $message[] = 'Already added to cart!';
      }else{
         $insert_cart = $conn->prepare("INSERT INTO `cart`(user_id, pid, name, price, quantity, image) VALUES(?,?,?,?,?,?)");
         $insert_cart->execute([$user_id, $pid, $name, $price, $qty, $image]);
         $message[] = 'Added to cart!';
      }
   }
}

if(isset($_POST['submit'])){

    if(isset($_POST['id'])){
        $id = $_POST['id']; // Retrieve id from post data
    }else{
        header('location:login.php');
        exit; 
    }

    if(isset($_POST['name'], $_POST['phone'], $_POST['qty'])){

        $name = $_POST['name'];
        $name = filter_var($name, FILTER_SANITIZE_STRING);
        
        $phone = $_POST['phone'];
        $phone = filter_var($phone, FILTER_SANITIZE_STRING);

        $qty = $_POST['qty'];
        $qty = filter_var($qty, FILTER_SANITIZE_STRING);

        $check_cart_numbers = $conn->prepare("SELECT * FROM `ingredient_salad` WHERE name = ? ");
        $check_cart_numbers->execute([$name]);

        if($check_cart_numbers->rowCount() > 0){
            $message[] = 'Item already added to cart!';
        }else{
            $insert_cart = $conn->prepare("INSERT INTO `ingredient_salad`(id, name, phone, quantity) VALUES(?, ?, ?, ?)");
            $insert_cart->execute([$id, $name, $phone, $qty]);
            $message[] = 'Item added to cart!';
        }
    }else{
        $message[] = 'All required fields are not provided!';
    }
}

// Output any messages

?>
