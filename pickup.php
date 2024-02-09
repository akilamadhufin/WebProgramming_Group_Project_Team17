<?php
$title = "Pickup Order";
include_once 'header.php';
include 'db.php'; ?>

<section id="deliver" style="padding-top: 20px; padding-bottom: 120px;">
        <div class="container">
            <div class="row">
            <div class="col-12 intro-text">
              <h1>Book your Pickup</h1>
              <p>
Introducing HOT POT's convenient online order pickup service! Experience the ultimate fusion of flavor from the comfort of your home with our delectable hot pot creations. Simply browse our diverse menu, place your order online, and swing by our restaurant at your convenience to pick up your freshly prepared feast. Skip the wait and savor the tantalizing tastes of HOT POT, where exceptional cuisine meets seamless online ordering for a dining experience that's both delicious and efficient.</p>

            </div>
            </div>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="row justify-content-center" name="pickupInfor" method="post">
            <div class="col-lg-8">
              <div class="row g-3">
                <div class="form-group col-md-6">
                  <input type="text" class="form-control" placeholder="First Name" id="fname" name="fname" required>
                </div>
                <div class="form-group col-md-6">
                  <input type="text" class="form-control" placeholder="Last Name"  id="lname" name="lname" required>
                </div>
                <div class="form-group col-md-6">
                  <input type="text" class="form-control" placeholder="Email Address" id="pickupEmail" name="pickupEmail" required>
                </div>
                <div class="form-group col-md-6">
                  <input type="text" class="form-control" placeholder="Contact Number" id="phoneNum" name="phoneNum" required>
                </div>
                <div class="form-group col-md-6">
                  <input type="date" class="form-control" placeholder="Date" id="pickupDate" name="pickupDate" required>
                </div>
                <div class="form-group col-md-6">
                    <input type="time" class="form-control" id="pickupTime" name="pickupTime" placeholder="Select a time" required>
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
                  <textarea name="pickupMessage" id="pickupMessage" cols="30" rows="4" class="form-control" placeholder="Message"></textarea>
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
            $pickupEmail = $_POST['pickupEmail'];
            $phoneNum = $_POST['phoneNum'];
            $pickupDate = $_POST['pickupDate'];
            $pickupTime = $_POST['pickupTime'];
            $mealName = $_POST['mealName'];
            $portionSize = $_POST['portionSize'];
            $addMore = $_POST['addMore'];
            $pickupMessage = $_POST['pickupMessage'];
            include 'db.php';
        
            $sql = "insert into pickupData (fname,lname,pickupEmail,phoneNum,pickupDate,pickupTime,mealName,portionSize,addMore,pickupMessage) 
            values('$fname','$lname','$pickupEmail','$phoneNum','$pickupDate','$pickupTime','$mealName','$portionSize','$addMore','$pickupMessage')" ;
        
            if($conn->query($sql)===TRUE){
                echo "Your data was successfully recorded";
            }
            else{
                echo "Error in submitting: " .$sql. "<br>" . $conn->error;
            }
            }

            $sql = "SELECT * FROM pickupData";

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
                                <th>Contact Number</th>
                                <th>pickup Date</th>
                                <th>pickup Time</th>
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
                            <td><a href='updateOrder.php?id=$row[pickupOrderId]' style='color:red;'>$row[pickupOrderId]</a></td>
                            <td>{$row['fname']}</td>
                            <td>{$row['lname']}</td>
                            <td>{$row['pickupEmail']}</td>
                            <td>{$row['phoneNum']}</td>
                            <td>{$row['pickupDate']}</td>
                            <td>{$row['pickupTime']}</td>
                            <td>{$row['mealName']}</td>
                            <td>{$row['portionSize']}</td>
                            <td>{$row['addMore']}</td>
                            <td>{$row['pickupMessage']}</td>
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