<?php
$title = "Complete your order";
@include 'db.php';

if(isset($_POST['order_btn'])){
   $name = $_POST['name'];
   $number = $_POST['number'];
   $email = $_POST['email'];
   $method = $_POST['method'];
   $flat = $_POST['flat'];
   $street = $_POST['street'];
   $city = $_POST['city'];
   $state = $_POST['state'];
   $country = $_POST['country'];
   $pin_code = $_POST['pin_code'];
   $date = $_POST['date'];
   $time = $_POST['time'];

   $cart_query = mysqli_query($conn, "SELECT * FROM `cart`");
   $price_total = 0;
   if(mysqli_num_rows($cart_query) > 0){
      while($product_item = mysqli_fetch_assoc($cart_query)){
         $product_name[] = $product_item['name'] .' ('. $product_item['quantity'] .') ';
         $product_price = ($product_item['price'] * $product_item['quantity']);
         $price_total += $product_price;
      };
   };
   $total_product = implode(', ',$product_name);
   $detail_query = mysqli_query($conn, "INSERT INTO `orders` (name, number, email, method, flat, street, city, state, country, pin_code,date,time, total_products, total_price) VALUES ('$name','$number','$email','$method','$flat','$street','$city','$state','$country','$pin_code','$date','$time','$total_product','$price_total')");
   
   if (!$detail_query) {
       die('Query failed: ' . mysqli_error($conn));
   }

   if($cart_query && $detail_query){
      // Clear the cart after the order is placed
      $clear_cart_query = mysqli_query($conn, "DELETE FROM `cart`");
      if (!$clear_cart_query) {
          die('Failed to clear cart: ' . mysqli_error($conn));
      }

      echo "
      <div class='order-message-container'>
      <div class='message-container'>
         <h3>thank you for shopping!</h3>
         <div class='order-detail'>
            <span>".$total_product."</span>
            <span class='total'> total : $".$price_total."/-  </span>
         </div>
         <div class='customer-details'>
            <p> your name : <span>".$name."</span> </p>
            <p> your number : <span>".$number."</span> </p>
            <p> your email : <span>".$email."</span> </p>
            <p> your address : <span>".$flat.", ".$street.", ".$city.", ".$state.", ".$country." - ".$pin_code."</span> </p>
            <p> your payment mode : <span>".$method."</span> </p>
            <p> your payment mode : <span>".$date."</span> </p>
            <p> your payment mode : <span>".$time."</span> </p>
            <p>(*pay when product is received*)</p>
         </div>
         <a href='index.php' class='btn btn-brand' style='border-radius: 0'>continue shopping</a>
         </div>
      </div>
      ";
   }
}
?>


<script>
    function validateEmail() {
        const email = document.getElementById("email").value;
        const emailError = document.getElementById("emailError");
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        if (!emailRegex.test(email)) {
            emailError.innerHTML = "Invalid email format";
            return false;
        } else {
            emailError.innerHTML = "&nbsp;"; // Add a non-breaking space to keep the space for the error message
            return true;
        }
    }

    function validatePhoneNum() {
        const phoneNum = document.getElementById("number").value;
        const phoneNumError = document.getElementById("phoneNumError");

        if (!/^\d+$/.test(phoneNum)) {
            phoneNumError.innerHTML = "Phone Number should only include digits";
            return false;
        } else {
            phoneNumError.innerHTML = "&nbsp;";
            return true;
        }
    }

    function validateName() {
        const name = document.getElementById("name").value;
        const nameError = document.getElementById("nameError");

        if (/\d/.test(name)) {
            nameError.innerHTML = "Name should not include numbers";
            return false;
        } else {
            nameError.innerHTML = "&nbsp;";
            return true;
        }
    }
</script>

<?php include 'userheader2.php'; ?>
<div class="container">
<section class="checkout-form">
   <h1 class="heading">complete your order</h1>
   <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
   <div class="display-order">
      <?php
         $select_cart = mysqli_query($conn, "SELECT * FROM `cart`");
         $total = 0;
         $grand_total = 0;
         if(mysqli_num_rows($select_cart) > 0){
            while($fetch_cart = mysqli_fetch_assoc($select_cart)){
            $total_price = ($fetch_cart['price'] * $fetch_cart['quantity']);
            $total += $total_price;
            $grand_total += $total_price;
      ?>
      <span style="font-size: 14px;"><?= $fetch_cart['name']; ?>(<?= $fetch_cart['quantity']; ?>)</span>
      <?php
         }
      }else{
         echo "<div class='display-order'><span style='font-size: 14px;'>your cart is empty!</span></div>";
      }
      ?>
      <span class="grand-total" style="font-size: 14px;"> grand total : $<?= $grand_total; ?>/- </span>
   </div>
      <div class="flex">
         <div class="inputBox">
            <span style="font-size: 14px;">your name</span>
            <input type="text" placeholder="enter your name" id= "name" name="name" required style="font-size: 14px;" oninput="validateName()">
            <p id="nameError" class="text-danger"></p>
         </div>
         <div class="inputBox">
            <span style="font-size: 14px;">your number</span>
            <input type="text" placeholder="enter your number" id="number" name="number" required style="font-size: 14px;" oninput="validatePhoneNum()">
            <p id="phoneNumError" class="text-danger"></p>
         </div>
         <div class="inputBox">
            <span style="font-size: 14px;">your email</span>
            <input type="email" placeholder="enter your email" id= "email" name="email" required style="font-size: 14px;" oninput="validateEmail()">
            <p id="emailError" class="text-danger"></p>
         </div>
         <div class="inputBox">
            <span style="font-size: 14px;">payment method</span>
            <select name="method" style="font-size: 14px;">
               <option value="delivery" selected>devlivery</option>
               <option value="pickup">pickup</option>
            </select>
         </div>
         <div class="inputBox">
            <span style="font-size: 14px;">address line 1</span>
            <input type="text" placeholder="building no." name="flat" required style="font-size: 14px;">
         </div>
         <div class="inputBox">
            <span style="font-size: 14px;">address line 2</span>
            <input type="text" placeholder="street name" name="street" required style="font-size: 14px;">
         </div>
         <div class="inputBox">
            <span style="font-size: 14px;">city</span>
            <input type="text" placeholder="eg. Tampere" name="city" required style="font-size: 14px;">
         </div>
         <div class="inputBox">
            <span style="font-size: 14px;">state</span>
            <input type="text" placeholder="eg. Pirakanmaa" name="state" required style="font-size: 14px;">
         </div>
         <div class="inputBox">
            <span style="font-size: 14px;">country</span>
            <input type="text" placeholder="eg. Finland" name="country" required style="font-size: 14px;">
         </div>
         <div class="inputBox">
            <span style="font-size: 14px;">pin code</span>
            <input type="text" placeholder="eg. 33710" name="pin_code" required style="font-size: 14px;">
         </div>
         <div class="inputBox">
            <span style="font-size: 14px;">Date</span>
            <input type="date"  name="date" required style="font-size: 14px;">
         </div>
         <div class="inputBox">
            <span style="font-size: 14px;">Time</span>
            <input type="time" name="time" required style="font-size: 14px;">
         </div>

      </div>
      <button class="btn btn-brand text-center" type="submit" name="order_btn" style="width: 500px; padding: 10px; display: block; margin: 0 auto; background-color: darkorange; font-size: 14px;">order now</button>

   </form>

  

</section>

</div>

<!-- custom js file link  -->
<script src="js/script.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>