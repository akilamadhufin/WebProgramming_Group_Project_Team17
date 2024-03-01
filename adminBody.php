<?php
session_start();
$title = "HOT POT home";
include 'auth.php';
include 'db.php';
// Initialize an empty array for messages
$message = array();

if (isset($_SESSION['authenticated']) && $_SESSION['authenticated'] === true) {
    include 'admin_header.php';


    if (isset($_SESSION['email'])) {
      $userEmail = $_SESSION['email'];

      $sql = "SELECT * FROM reginfo WHERE email = '$userEmail'";
      $result = $conn->query($sql);

      if ($result->num_rows > 0) {
          $row = $result->fetch_assoc();
          $customerId = $row['id'];
          $fname = $row['fname'];
          $lname = $row['lname'];
          $userEmail = $row['email'];
          $phoneNum = $row['phoneNum'];
          $city = $row['city'];
          $citycode = $row['citycode'];
          $user_type = $row['user_type'];
      }
    }
        
} else {
    include 'header.php';
}

if (isset($_POST['add_to_cart'])) {
    $product_name = $_POST['product_name'];
    $userEmail = isset($_SESSION['email']) ? $_SESSION['email'] : '';
    $product_price = $_POST['product_price'];
    $product_image = $_POST['product_image'];
    $product_quantity = 1;
    $product_category = $_POST['product_category'];

    $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name'");

    if (mysqli_num_rows($select_cart) > 0) {
        // Product is already in the cart, update the quantity
        $update_quantity = mysqli_query($conn, "UPDATE `cart` SET quantity = quantity + 1 WHERE name = '$product_name'");

        if ($update_quantity) {
            $message[] = 'Product quantity updated in cart';
        } else {
            $message[] = 'Error updating product quantity in cart';
        }
    } else {
        // Product is not in the cart, insert a new row
        $insert_product = mysqli_query($conn, "INSERT INTO `cart`(name, email, price, image, quantity) VALUES('$product_name','$userEmail', '$product_price', '$product_image', '$product_quantity')");

        if ($insert_product !== false) {
            $message[] = 'Product added to cart successfully';
        } else {
            $message[] = 'Error adding product to cart';
        }
    }
}

?>



      <div id="heroslider" class="carousel slide">
        <div class="carousel-inner">
          <div class="carousel-item text-center  bg-cover vh-100 active slide-1">
            <div class="container h-100 d-flex align-items-center justify-content-center">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <h6 class="text-white">Welcome to HOT POT</h6>
                        <h1 class="display-1 fw-bold text-white">Grilled & Spicy Flavored</h1>
                        <a href="#menu" class="btn btn-brand">Check Menu</a>
                    </div>
                </div>
            </div>

           
          </div>
          <div class="carousel-item text-center  bg-cover vh-100 slide-2">
            <div class="container h-100 d-flex align-items-center justify-content-center">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <h6 class="text-white">Welcome to HOT POT</h6>
                        <h1 class="display-1 fw-bold text-white">Fresh & Tasty Food</h1>
                        <a href="#menu" class="btn btn-brand">Check Menu</a>
                    </div>
                </div>
            </div>
          </div>
          <div class="carousel-item text-center  bg-cover vh-100 slide-3">
            <div class="container h-100 d-flex align-items-center justify-content-center">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <h6 class="text-white" >Welcome to HOT POT</h6>
                        <h1 class="display-1 fw-bold text-white">Healthy & Tasty</h1>
                        <a href="#menu" class="btn btn-brand">Check Menu</a>
                    </div>
                </div>
            </div>
          </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#heroslider" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#heroslider" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>
      <section id="about">
        <div class="container">
          <div class="row gy-4 align-items-center">
            <div class="col-lg-5">
              <img src="images/about.jpeg" alt="">
            </div>
            <div class="col-lg-5">
              <h1>About Us</h1>
              <div class="divider my-4"></div>
              <p>About us - A culinary journey that transcends boundaries and brings the heartwarming tradition of hot pot dining to the vibrant city of Tampere, Finland. Nestled in the heart of this charming town, Hot Pot is not just a restaurant; it's a celebration of flavors, a gathering place for food enthusiasts, and a cultural haven for those seeking a unique and immersive dining experience.
              </p>
              <p>At Hot Pot, we believe that food has the power to connect people and create lasting memories. Our journey began with a passion for bringing the diverse and delectable world of hot pot to the people of Tampere. Inspired by the rich tapestry of global cuisine, we set out to create a haven where traditional hot pot meets innovative culinary concepts.</p>
              <p>Explore Our Menu - Step into Hot Pot and embark on a culinary adventure like no other. Our menu boasts a vast range of fresh, high-quality ingredients sourced locally and internationally. From succulent meats and fresh seafood to crisp vegetables and homemade broths, each element is carefully curated to ensure a symphony of flavors that tantalize your taste buds.</p>
              <a href="#menu" class="btn btn-brand">Check Menu</a>
            </div>
          </div>
        </div>

      </section>
      <?php
              $select_rows = mysqli_query($conn, "SELECT * FROM `cart`") or die('query failed');
              $row_count = mysqli_num_rows($select_rows);
              ?>
      

        
      <section id="menu" class="bg-light">
   <div class="container">
      <div class="row">
         <div class="col-12 intro-text">
            <h1>Our Menu</h1>
         </div>
         <p class="menuDescription text-center">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Ipsum earum et enim quia architecto assumenda</p>
      </div>
   </div>

   <div class="container">
      <ul class="nav nav-pills mb-4 justify-content-center" id="pills-tab" role="tablist">
      
         <li class="nav-item" role="presentation">
            <button class="nav-link active" id="pills-breakfast-tab" data-bs-toggle="pill" data-bs-target="#pills-breakfast" type="button" role="tab" aria-controls="pills-breakfast" aria-selected="false">Breakfast</button>
         </li>
         <li class="nav-item" role="presentation">
            <button class="nav-link" id="pills-lunch-tab" data-bs-toggle="pill" data-bs-target="#pills-lunch" type="button" role="tab" aria-controls="pills-lunch" aria-selected="false">Lunch</button>
         </li>
         <li class="nav-item" role="presentation">
            <button class="nav-link" id="pills-dinner-tab" data-bs-toggle="pill" data-bs-target="#pills-dinner" type="button" role="tab" aria-controls="pills-dinner" aria-selected="false">Dinner</button>
         </li>
      </ul>
      <div> 
      <div class="tab-content" id="pills-tabContent">
<!-- Content for Breakfast -->

<div class="tab-pane fade show active" id="pills-breakfast" role="tabpanel" aria-labelledby="pills-breakfast-tab" tabindex="0">
    <?php
    $select_breakfast = mysqli_query($conn, "SELECT * FROM `products` WHERE category='breakfast'");
    if (mysqli_num_rows($select_breakfast) > 0) {
        echo '<div class="row gy-4">';
        while ($breakfast = mysqli_fetch_assoc($select_breakfast)) {
    ?>
            <div class="col-lg-3 col-sm-6">
                <form action="" method="post">
                    <!-- Dynamic content for Breakfast -->
                    <div class="menu-item bg-white shadow-on-hover text-center" style="background-color: #021f08; margin-bottom: 1px;">
                        <img src="uploaded_img/<?php echo $breakfast['image']; ?>" alt="">
                        <div class="menu-item-content p-4">
                        <div class="mb-2" style="color: gold; font-size: 1.5em;">
                              <?php echo "<td>{$breakfast['rating']}</td>"; ?>
                           </div>
                           <h5 class="mt-1 mb-2"><?php echo $breakfast['name']; ?></h5>
                           <p class="small"><?php echo $breakfast['description']; ?> </p>
                           <p class="mt-2 mb-1 small" style="color: red";>$<?php echo $breakfast['price']; ?>/-</p>
                            <input type="hidden" name="product_name" value="<?php echo $breakfast['name']; ?>">
                            <input type="hidden" name="product_price" value="<?php echo $breakfast['price']; ?>">
                            <input type="hidden" name="product_image" value="<?php echo $breakfast['image']; ?>">
                            <input type="hidden" name="product_category" value="<?php echo $breakfast['category']; ?>">
                            <input type="hidden" name="product_rating" value="<?php echo $breakfast['rating']; ?>">
                            <input type="hidden" name="product_description" value="<?php echo $breakfast['description']; ?>">
                            <input type="submit" class="btn btn-primary" style="background-color: #021f08; margin-top: 1px;" value="add to cart" name="add_to_cart">
                        </div>
                    </div>
                </form>
            </div>
    <?php
        }
        echo '</div>';
    }
    ?>
</div>

      <!-- Content for Lunch -->
<div class="tab-pane fade" id="pills-lunch" role="tabpanel" aria-labelledby="pills-lunch-tab" tabindex="0">
    <?php
    $select_lunch = mysqli_query($conn, "SELECT * FROM `products` WHERE category='lunch'");
    if (mysqli_num_rows($select_lunch) > 0) {
        echo '<div class="row gy-4">';
        while ($lunch = mysqli_fetch_assoc($select_lunch)) {
    ?>
            <div class="col-lg-3 col-sm-6">
                <form action="" method="post">
                    <!-- Dynamic content for Lunch -->
                    <div class="menu-item bg-white shadow-on-hover text-center" style="background-color: #021f08; margin-bottom: 1px;">
                        <img src="uploaded_img/<?php echo $lunch['image']; ?>" alt="">
                        <div class="menu-item-content p-4">
                       
                           <div class="mb-2" style="color: gold; font-size: 1.5em;">
                              <?php echo "<td>{$lunch['rating']}</td>"; ?>
                           </div>
                           <h5 class="mt-1 mb-2"><?php echo $lunch['name']; ?></h5>
                           <p class="small"><?php echo $lunch['description']; ?> </p>
                           <p class="mt-2 mb-1 small" style="color: red";>$<?php echo $lunch['price']; ?>/-</p>
                            <input type="hidden" name="product_name" value="<?php echo $lunch['name']; ?>">
                            <input type="hidden" name="product_price" value="<?php echo $lunch['price']; ?>">
                            <input type="hidden" name="product_image" value="<?php echo $lunch['image']; ?>">
                            <input type="hidden" name="product_category" value="<?php echo $lunch['category']; ?>">
                            <input type="hidden" name="product_rating" value="<?php echo $lunch['rating']; ?>">
                            <input type="hidden" name="product_description" value="<?php echo $lunch['description']; ?>">
                            <input type="submit" class="btn btn-primary" style="background-color: #021f08; margin-top: 1px;" value="add to cart" name="add_to_cart">
                        </div>
                    </div>
                </form>
            </div>
    <?php
        }
        echo '</div>';
    }
    ?>
</div>

<!-- Content for Dinner -->
<div class="tab-pane fade" id="pills-dinner" role="tabpanel" aria-labelledby="pills-dinner-tab" tabindex="0">
    <?php
    $select_dinner = mysqli_query($conn, "SELECT * FROM `products` WHERE category='dinner'");
    if (mysqli_num_rows($select_dinner) > 0) {
        echo '<div class="row gy-4">';
        while ($dinner = mysqli_fetch_assoc($select_dinner)) {
    ?>
            <div class="col-lg-3 col-sm-6">
                <form action="" method="post">
                    <!-- Dynamic content for Dinner -->
                    <div class="menu-item bg-white shadow-on-hover text-center" style="background-color: #021f08; margin-bottom: 1px;">
                        <img src="uploaded_img/<?php echo $dinner['image']; ?>" alt="">
                        <div class="menu-item-content p-4">
                        <div class="mb-2" style="color: gold; font-size: 1.5em;">
                              <?php echo "<td>{$dinner['rating']}</td>"; ?>
                           </div>
                           <h5 class="mt-1 mb-2"><?php echo $dinner['name']; ?></h5>
                           <p class="small"><?php echo $dinner['description']; ?> </p>
                           <p class="mt-2 mb-1 small" style="color: red";>$<?php echo $dinner['price']; ?>/-</p>
                            <input type="hidden" name="product_name" value="<?php echo $dinner['name']; ?>">
                            <input type="hidden" name="product_price" value="<?php echo $dinner['price']; ?>">
                            <input type="hidden" name="product_image" value="<?php echo $dinner['image']; ?>">
                            <input type="hidden" name="product_category" value="<?php echo $dinner['category']; ?>">
                            <input type="hidden" name="product_rating" value="<?php echo $dinner['rating']; ?>">
                            <input type="hidden" name="product_description" value="<?php echo $dinner['description']; ?>">
                            <input type="submit" class="btn btn-primary" style="background-color: #021f08; margin-top: 1px;" value="add to cart" name="add_to_cart">
                        </div>
                    </div>
                </form>
            </div>
    <?php
        }
        echo '</div>';
    }
    ?>
</div>
  </div>
</section>

      <section id="services" class="bg-cover">
        <div class="container">
          <div class="row">
            <div class="col-12 intro-text">
              <h1 class="text-white">Why to Choose Us</h1>
              <p class="text-white text-center">Hot Pot embraces the spirit of Tampere while celebrating the diversity of global cuisine. Our fusion of local and international flavors creates a harmonious blend that caters to the diverse palates of our guests.</p>
            </div>
            
          </div>
          <div class="row gy-4">
            <div class="col-lg-3 col-sm-6">
              <div class="feature p-4 text-center">
                <div class="feature-icon">
                  <i class="ri-wifi-fill"></i>
                </div>
                <h4 class="text-white mt-4 mb-2">Free wifi</h4>
                <p class="text-white">Lorem ipsum dolor sit amet consectetur adipisicing elit. Nobis magni veritatis accusantium. Excepturi, ipsum quos? Omnis laboriosam iste possimus beatae, odio ratione repudiandae quae, eaque repellendus modi unde reprehenderit praesentium?</p>
              </div>

            </div>
            <div class="col-lg-3 col-sm-6">
              <div class="feature p-4 text-center">
                <div class="feature-icon">
                  <i class="ri-timer-2-fill"></i>
                </div>
                <h4 class="text-white mt-4 mb-2">Fast Dilivery</h4>
                <p class="text-white">Lorem ipsum dolor sit amet consectetur adipisicing elit. Nobis magni veritatis accusantium. Excepturi, ipsum quos? Omnis laboriosam iste possimus beatae, odio ratione repudiandae quae, eaque repellendus modi unde reprehenderit praesentium?</p>
              </div>

            </div>
            <div class="col-lg-3 col-sm-6">
              <div class="feature p-4 text-center">
                <div class="feature-icon">
                  <i class="ri-user-heart-fill"></i>
                </div>
                <h4 class="text-white mt-4 mb-2">Friendly Staff</h4>
                <p class="text-white">Lorem ipsum dolor sit amet consectetur adipisicing elit. Nobis magni veritatis accusantium. Excepturi, ipsum quos? Omnis laboriosam iste possimus beatae, odio ratione repudiandae quae, eaque repellendus modi unde reprehenderit praesentium?</p>
              </div>

            </div>
            <div class="col-lg-3 col-sm-6">
              <div class="feature p-4 text-center">
                <div class="feature-icon">
                  <i class="ri-star-fill"></i>
                </div>
                <h4 class="text-white mt-4 mb-2">Highly Rated</h4>
                <p class="text-white">Lorem ipsum dolor sit amet consectetur adipisicing elit. Nobis magni veritatis accusantium. Excepturi, ipsum quos? Omnis laboriosam iste possimus beatae, odio ratione repudiandae quae, eaque repellendus modi unde reprehenderit praesentium?</p>
              </div>

            </div>
          </div>
        </div>
      </section>

      <section id="alumni">
        <div class="container">
          <div class="row ">
            <div class="col-12 intro-text">
              <h1>Our Staff</h1>
              <p class="p1 text-center">Our hot pot experience is not just about the food; it's about the journey. Engage with your friends and family as you gather around the simmering pot, sharing stories, laughter, and the joy of creating your own customized culinary masterpiece. Whether you're a hot pot aficionado or a first-time adventurer, our knowledgeable staff is here to guide you through the process, ensuring an unforgettable dining experience.</p>
            </div>
            
          </div>
          <div class="row gy-4">
            <div class="col-lg-3 col-sm-6">
              <div class="team-member px-4 py-5 border shadow-on-hover text-center">
                <img src="images/chef3.webp" alt="">
                <div class="team-member-content">
                  <h4 class="mb-0 mt-4">Randunu Akila</h4>
                  <p class="mb-0">Main Chef</p>
                </div>
              </div>

            </div>
            <div class="col-lg-3 col-sm-6">
              <div class="team-member px-4 py-5 border shadow-on-hover text-center">
                <img src="images/chef2.jpg" alt="">
                <div class="team-member-content">
                  <h4 class="mb-0 mt-4">Gimhani Kaushalya</h4>
                  <p class="mb-0">Main Chef</p>
                </div>
              </div>

            </div>
            <div class="col-lg-3 col-sm-6">
              <div class="team-member px-4 py-5 border shadow-on-hover text-center">
                <img src="images/chef3.webp" alt="">
                <div class="team-member-content">
                  <h4 class="mb-0 mt-4">Wasantha Ranasighe</h4>
                  <p class="mb-0">Main Chef</p>
                </div>
              </div>

            </div>
            <div class="col-lg-3 col-sm-6">
              <div class="team-member px-4 py-5 border shadow-on-hover text-center">
                <img src="images/chef2.jpg" alt="">
                <div class="team-member-content">
                  <h4 class="mb-0 mt-4">Thilini Gamage</h4>
                  <p class="mb-0">Main Chef</p>
                </div>
              </div>
            </div>
          </div>
        </div>

      </section >
      <section id="reviews" class="bg-cover">
        <div class="container">
          <div class="row">
            <div class="col-12 intro-text">
              <h1 class="text-white">Our Client Saying</h1>
              <p class="text-white text-center">Hot Pot is a restaurant where every meal is a celebration, and every bite tells a story. Immerse yourself in the warmth of our hospitality, the richness of our flavors, and the joy of shared moments.</p>
            </div>
           
          </div>
          <div id="reviewSlider" class="carousel slide">
            <div class="carousel-indicators">
              <button type="button" data-bs-target="#reviewSlider" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
              <button type="button" data-bs-target="#reviewSlider" data-bs-slide-to="1" aria-label="Slide 2"></button>
              <button type="button" data-bs-target="#reviewSlider" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
              <div class="carousel-item active">
                <div class="row justify-content-center">
                  <div class="col-lg-8">
                    <div class="review bg-white p-5 text-center">
                      <div class="quote-icon"><i class="ri-double-quotes-l"></i></div>
                      <p class="mb-0 ">Hot Pot is a restaurant where every meal is a celebration, and every bite tells a story. Immerse yourself in the warmth of our hospitality, the richness of our flavors, and the joy of shared moments.</p>
                      <div class="person mt-4">
                        <img src="images/customer1.jpg" alt="">
                        <h4 class="mb-0 mt-2">Akila</h4>
                        <span class="stars">
                          <i class="ri-star-fill"></i>
                          <i class="ri-star-fill"></i>
                          <i class="ri-star-fill"></i>
                          <i class="ri-star-half-fill"></i>
                          </span>
                      </div>
                    </div>

                  </div>

                </div>
              </div>
              <div class="carousel-item">
                <div class="row justify-content-center">
                  <div class="col-lg-8">
                    <div class="review bg-white p-5 text-center">
                      <div class="quote-icon"><i class="ri-double-quotes-l"></i></div>
                      <p class="mb-0">Hot Pot is a restaurant where every meal is a celebration, and every bite tells a story. Immerse yourself in the warmth of our hospitality, the richness of our flavors, and the joy of shared moments.</p>
                      <div class="person mt-4">
                        <img src="images/customer2.jpg" alt="">
                        <h4 class="mb-0 mt-2">Wasantha</h4>
                        <span class="stars">
                          <i class="ri-star-fill"></i>
                          <i class="ri-star-fill"></i>
                          <i class="ri-star-fill"></i>
                          <i class="ri-star-half-fill"></i>
                          </span>
                      </div>
                    </div>

                  </div>

                </div>
              </div>
              <div class="carousel-item">
                <div class="row justify-content-center">
                  <div class="col-lg-8">
                    <div class="review bg-white p-5 text-center">
                      <div class="quote-icon"><i class="ri-double-quotes-l"></i></div>
                      <p class="mb-0">Hot Pot is a restaurant where every meal is a celebration, and every bite tells a story. Immerse yourself in the warmth of our hospitality, the richness of our flavors, and the joy of shared moments.</p>
                      <div class="person mt-4">
                        <img src="images/customer3.jpg" alt="">
                        <h4 class="mb-0 mt-2">Gimhani</h4>
                        <span class="stars">
                          <i class="ri-star-fill"></i>
                          <i class="ri-star-fill"></i>
                          <i class="ri-star-fill"></i>
                          <i class="ri-star-half-fill"></i>
                          </span>
                      </div>
                    </div>

                  </div>

                </div>
              </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#reviewSlider" data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#reviewSlider" data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
            </button>
        </div>
        <div style="margin-top:10px;" class="form-group col-md-12 text-center">
        <a href="addReviews.php" class="btn btn-brand">Add Reviews</a>
        </div>

      </section>

      <section id="reservation">
        <div class="container">
          <div class="row">
            <div class="col-12 intro-text">
              <h1>Book Your Table</h1>
              <p>We invite you to be a part of our culinary journey as we redefine the dining experience in Tampere, one hot pot at a time.</p>

            </div>
          </div>
          <?php if (isset($_SESSION['authenticated']) && $_SESSION['authenticated'] === true) : ?>
          <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="row justify-content-center" name="addReservation" id="addReservation" method="post">
            <div class="col-lg-8">
              <div class="row g-3">
                <div class="form-group col-md-6">
                  <input type="text" class="form-control" placeholder="First Name" id="fname" name="fname" required>
                </div>
                <div class="form-group col-md-6">
                  <input type="text" class="form-control" placeholder="Last Name" id="lname" name="lname" required>
                </div>
                <div class="form-group col-md-6">
                  <input type="email" class="form-control" placeholder="Email Address" id="email" name="email" required>
                </div>
                <div class="form-group col-md-6">
                  <input type="text" class="form-control" placeholder="Contact Number" id="phoneNum" name="phoneNum" required>
                </div>
                <div class="form-group col-md-6">
                  <input type="date" class="form-control" placeholder="Date" id="resDate" name="resDate" required>
                </div>
                <div class="form-group col-md-6">
                  <input type="Time" class="form-control" placeholder="Time" id="resTime" name="resTime" required> 
                </div>
                <div class="form-group col-md-6">
                  <input type="text" class="form-control" placeholder="Number of Persons" id="numOfPersons" name="numOfPersons" required>
                </div>
                <div class="form-group col-md-12">
                  <textarea cols="30" rows="4" class="form-control" placeholder="Message" id="message" name="message"></textarea>
                </div>
                <div class="form-group col-md-12 text-center">
                  <button class="btn btn-brand" name="addReservation" id="addReservation">Book Now</button>
                </div>
              </div>
            </div>
          </form>
        
        </div>
        <?php else : ?>
          <div class="col-12 intro-text">
                    <p style="color:red;">Please log in to make a reservation. <a class="btn btn-brand" name="login" id="login"href="loginform.php">Log in</a></p>
        </div>
          <?php endif; ?>

        <?php

  
          if(isset($_POST['addReservation'])){
            $fname = $_POST['fname'];
            $lname = $_POST['lname'];
            $email = $_POST['email'];
            $phoneNum = $_POST['phoneNum'];
            $resDate = $_POST['resDate'];
            $resTime = $_POST['resTime'];
            $numOfPersons = $_POST['numOfPersons'];
            $message = $_POST['message'];
            
            $submitreservationsql = "insert into reservation (fname,lname,email,phoneNum,resDate,resTime,numOfPersons,message) 
            values('$fname','$lname','$email','$phoneNum','$resDate','$resTime','$numOfPersons','$message')" ;
        
            if($conn->query($submitreservationsql)===TRUE){
                echo "<script>window.alert('Your data was successfully recorded');</script>";
            }
            else{
              echo "<script>window.alert('Error in submitting: " . $conn->error . "');</script>";
            }
            
            } 
            // close the connection when done
            $conn->close();   
    
?>

      </section>
      <div class="row g-0">
        <div class="col-lg-3 col-sm-6">
          <div class="insta-img">
            <img src="images/breakfast.jpg" alt="">
            <a href="#" class="insta-btn">
              <i class="ri-instagram-fill"></i>
            </a>
          </div>
        </div> 
        <div class="col-lg-3 col-sm-6">
          <div class="insta-img">
            <img src="images/insta2.jpg" alt="">
            <a href="#" class="insta-btn">
              <i class="ri-instagram-fill"></i>
            </a>
          </div>
        </div>
        <div class="col-lg-3 col-sm-6">
          <div class="insta-img">
            <img src="images/insta3.jpg" alt="">
            <a href="#" class="insta-btn">
              <i class="ri-instagram-fill"></i>
            </a>
          </div>
        </div>
        <div class="col-lg-3 col-sm-6">
          <div class="insta-img">
            <img src="images/insta4.jpg" alt="">
            <a href="#" class="insta-btn">
              <i class="ri-instagram-fill"></i>
            </a>
          </div>
        </div>
      </div>
      <section id="ytchannel">
        <div class="container">
          <div class="row">
            <div class="col-12 intro-text">
              <h1>Our Channel</h1>
              <p>Dive into the heart and soul of Hot Pot dining as we explore the artistry behind this beloved culinary tradition. From selecting the perfect broth to crafting a personalized masterpiece at your table.</p>
              <div><p>Subscribe to our channel</p>
                <span class="ytchannel">
                  <a href="https://www.youtube.com/@tastyrecipes" target="_blank">
                  <i class="ri-youtube-fill" style="font-size: 28px; margin-right: 10px; color: red;"></i></a>
                  <i class="ri-notification-3-fill" style="font-size: 28px;"></i>
                  </span>  
                </div>
            </div>
            </div>

          <div class="row g-3">
            <div class="col-sm-6">
              <div class="ytchannel d-flex shadow-on-hover">
                <iframe src="https://www.youtube.com/embed/x2AZJ6QK1K4"></iframe>
                <div class="ytchannel-post-content p-4">
                  <p>posted: 25 Dec,2023</p>
                  <h4><a href="https://www.youtube.com/embed/x2AZJ6QK1K4">Cheese recipes the entire family will love!</a></h4>
                  <p>Welcome to the official YouTube channel for all your Tasty recipe needs. Join us as we dig into loads of fun and drool-worthy dishes.</p>
                  
                </div>
              </div>
            </div>

            <div class="col-sm-6">
              <div class="ytchannel d-flex shadow-on-hover">
                <iframe src="https://www.youtube.com/embed/KL352kWHEr0"></iframe>
                <div class="ytchannel-content p-4">
                  <p>posted: 18 Dec,2023</p>
                  <h4><a href="https://www.youtube.com/embed/KL352kWHEr0">Try These Japanese Dishes At Home</a></h4>
                  <p>Join us as we dig into loads of fun and drool-worthy dishes. From easy make-ahead meals to dinner party showstoppers.</p>
                  

                </div>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="ytchannel d-flex shadow-on-hover">
                <iframe src="https://www.youtube.com/embed/v5Oa-NbG_Ho"></iframe>
                <div class="ytchannel-content p-4">
                  <p>posted: 21 Jan,2024</p>
                  <h4><a href="https://www.youtube.com/embed/v5Oa-NbG_Ho">6 Korean-Inspired Recipes to Try At Home</a></h4>
                  <p>From easy make-ahead meals to dinner party showstoppers, grab your apron and let's get cooking! Craving seconds? Subscribe!</p>
                  

                </div>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="ytchannel d-flex shadow-on-hover">
                <iframe src="https://www.youtube.com/embed/AN39KCqsD_8"></iframe>
                <div class="ytchannel-content p-4">
                  <p>posted: 25 Nov,2023</p>
                  <h4><a href="https://www.youtube.com/embed/AN39KCqsD_8">6 One-Pan Chicken Recipes For Beginners</a></h4>
                  <p>Grab your apron and let's get cooking! Craving seconds? Subscribe!Join us as we dig into loads of fun and drool-worthy dishes.</p>

                </div>
              </div>
            </div>
          </div>

        </div>
      </section>
      <script src="js/script.js"></script>
      <?php include 'footer.php' ?>