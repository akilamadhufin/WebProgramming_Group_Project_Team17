<?php
$title = "Home Delivery";
include_once 'header.php'; 
include 'db.php'; ?>
<section id="deliver" style="padding-top: 20px; padding-bottom: 120px;">
        <div class="container">
            <div class="row">
            <div class="col-12 intro-text">
              <h1>Book your delivery</h1>
              <p>dulge in the ultimate dining experience with HOT POT's home delivery service. Enjoy the exquisite taste of fresh and hot meals from our kitchen to your doorstep, ensuring every bite is a flavorful delight. With our commitment to fast delivery, savor the convenience of receiving your favorite dishes promptly, bringing the essence of our restaurant directly to you.</p>

            </div>
            </div>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="row justify-content-center" name="deliveryInfor" method="post">
            <div class="col-lg-8">
              <div class="row g-3">
                <div class="form-group col-md-6">
                  <input type="text" class="form-control" placeholder="First Name" id="fname" name="fname" required>
                </div>
                <div class="form-group col-md-6">
                  <input type="text" class="form-control" placeholder="Last Name"  id="lname" name="lname" required>
                </div>
                <div class="form-group col-md-6">
                  <input type="text" class="form-control" placeholder="Email Address" id="deliveryEmail" name="deliveryEmail" required>
                </div>
                <div class="form-group col-md-6">
                  <input type="text" class="form-control" placeholder="Address" id="deliveryAddress" name="deliveryAddress" required>
                </div>
                <div class="form-group col-md-6">
                  <input type="text" class="form-control" placeholder="Contact Number" id="phoneNum" name="phoneNum" required>
                </div>
                <div class="form-group col-md-6">
                  <input type="date" class="form-control" placeholder="Date" id="deliveryDate" name="deliveryDate" required>
                </div>
                <div class="form-group col-md-6">
                    <input type="time" class="form-control" id="deliveryTime" name="deliveryTime" placeholder="Select a time" required>
                </div>

            </div>
            <div class="row" style="margin-top: 16px;">
                <div class="form-group col-md-4">
                <select class="form-control" id="mealName" name="mealName" required>
                    <option value="" disabled selected>Select your meal</option>
                    <option value="eggs_Benedict">Eggs Benedict</option>
                    <option value="buttermilk_Salads">Buttermilk Salads</option>
                    <option value="avocado_Toast">Avocado Toast</option>
                    <option value="crispy_Rice">Crispy Rice</option>
                    <option value="egg_White_Omelette">Egg White Omelette</option>
                    <option value="green_Detox_Smoothie">Green Detox Smoothie</option>
                    <option value="japanese_style_Bowl">Japanese-style Bowl</option>
                    <option value="Roasted_Beef">Roasted Beef</option>
                </select>
                </div>
                <div class="form-group col-md-4">
                <select class="form-control" id="portionSize" name="portionSize" required>
                    <option value="" disabled selected>Portion Size</option>
                    <option value="regular">Regular</option>
                    <option value="large">Large</option>
                </select>
                </div>
                <div class="form-group col-md-4">
                <select class="form-control" id="addMore" name="addMore" required>
                    <option value="" disabled selected>Add more item</option>
                    <option value="1_item">1</option>
                    <option value="2_items">2</option>
                    <option value="3_items">3</option>
                    <option value="4_items">4</option>
                    <option value="5_items">5</option>
                </select>
                </div>
                <div class="form-group col-md-12" style="margin-top: 16px;">
                  <textarea name="deliveryMessage" id="deliveryMessage" cols="30" rows="4" class="form-control" placeholder="Message"></textarea>
                </div>
                <div class="form-group col-md-12 text-center" style="margin-top: 16px;">
                <button type="submit" class="btn btn-brand" name="orderNow">Order Now</button>
                </div>
              </div>
            </div>
          </form>

          <?php

          if(isset($_POST['orderNow'])){
            $fname = $_POST['fname'];
            $lname = $_POST['lname'];
            $deliveryEmail = $_POST['deliveryEmail'];
            $deliveryAddress = $_POST['deliveryAddress'];
            $phoneNum = $_POST['phoneNum'];
            $deliveryDate = $_POST['deliveryDate'];
            $deliveryTime = $_POST['deliveryTime'];
            $mealName = $_POST['mealName'];
            $portionSize = $_POST['portionSize'];
            $addMore = $_POST['addMore'];
            $deliveryMessage = $_POST['deliveryMessage'];
            
        
            $sql = "insert into deliveryData (fname,lname,deliveryEmail,deliveryAddress,phoneNum,deliveryDate,deliveryTime,mealName,portionSize,addMore,deliveryMessage) 
            values('$fname','$lname','$deliveryEmail',' $deliveryAddress','$phoneNum','$deliveryDate','$deliveryTime','$mealName','$portionSize','$addMore','$deliveryMessage')" ;
        
            if($conn->query($sql)===TRUE){
                echo "Your data was successfully recorded";
            }
            else{
                echo "Error in submitting: " .$sql. "<br>" . $conn->error;
            }
            }

            $sql = "SELECT * FROM deliveryData";

            // Execute the SQL query and store the result
            $result = $conn->query($sql);

            // Check if there are any results
            if ($result->num_rows > 0) {
                echo "<table class='table'>
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>email</th>
                                <th>Address</th>
                                <th>Contact Number</th>
                                <th>Delivery Date</th>
                                <th>Delivery Time</th>
                                <th>Meal Ordered</th>
                                <th>Portion Size</th>
                                <th>Number of items</th>
                                <th>Message</th>
                            </tr>
                        </thead>
                        <tbody>";

                // Loop through the result set and display data in rows
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td><a href='updateOrder.php?id=$row[deliveryOrderId]' style='color:red;'>$row[deliveryOrderId]</a></td>
                            <td>{$row['fname']}</td>
                            <td>{$row['lname']}</td>
                            <td>{$row['deliveryEmail']}</td>
                            <td>{$row['deliveryAddress']}</td>
                            <td>{$row['phoneNum']}</td>
                            <td>{$row['deliveryDate']}</td>
                            <td>{$row['deliveryTime']}</td>
                            <td>{$row['mealName']}</td>
                            <td>{$row['portionSize']}</td>
                            <td>{$row['addMore']}</td>
                            <td>{$row['deliveryMessage']}</td>
                          </tr>";
                }
                echo "</tbody></table>";
            } else {
                // Display a message if no results are found
                echo "No results";
            }
            // close the connection when done
            $conn->close();   
          ?>

        </div>
      </section>

<?php include_once 'footer.php'; ?>