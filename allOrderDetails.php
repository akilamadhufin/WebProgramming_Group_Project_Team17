<?php
include 'auth.php';
$title = "All Orders";
include 'db.php';
include isset($_SESSION['authenticated']) && $_SESSION['authenticated'] === true ? 'admin_header.php' : 'header.php';

if (isset($_SESSION['authenticated']) && $_SESSION['authenticated'] === true) {
    // If the user is authenticated, getting user details from the db
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

            ?>
            <section id="myOrder" style="padding-top: 20px; padding-bottom: 120px;" class="bg-light">
                <div class="container">
                    <div class="row">
                    <div class="col-12 intro-text">
                            <h1><?php echo "Welcome, $fname $lname"; ?></h1>
                        </div>
                        <h4 style="padding-top: 20px; padding-bottom: 30px;" class="text-center">You can review your Order details.</h4>
                    </div>
                </div>
                <div class="container">
                    <ul class="nav nav-pills mb-4 justify-content-center" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="pills-Delivery-tab" data-bs-toggle="pill" data-bs-target="#pills-Delivery" type="button" role="tab" aria-controls="pills-Delivery" aria-selected="true">Delivery Details</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-Pickup-tab" data-bs-toggle="pill" data-bs-target="#pills-Pickup" type="button" role="tab" aria-controls="pills-Pickup" aria-selected="false">Pickup Details</button>
                        </li>
                    </ul>
                    <!-- Delivery Details -->
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-Delivery" role="tabpanel" aria-labelledby="pills-Delivery-tab" tabindex="0">
                            <div class="row"></div>
                            <div class="row">
                                <div class="col-12 intro-text">
                                    <h1 style="margin-bottom: 20px; color: orange;">All Delivery Details</h1>
                                    <?php
                                    if (isset($_GET['removeDelivery'])) {
                                        $remove_id = $_GET['removeDelivery'];
                                        mysqli_query($conn, "DELETE FROM `orders` WHERE id = '$remove_id'");
                                        
                                    }

                                    if (isset($_POST['update_update_btn'])) {
                                        $update_time = $_POST['update_time'];
                                        $update_timeId = $_POST['update_time_id'];

                                        $update_date = $_POST['update_date'];
                                        $update_dateId = $_POST['update_date_id'];

                                        $update_name = $_POST['update_name'];
                                        $update_nameId = $_POST['update_name_id'];

                                        $update_flat = $_POST['update_flat'];
                                        $update_flatId = $_POST['update_flat_id'];

                                        $update_street = $_POST['update_street'];
                                        $update_streetId = $_POST['update_street_id'];

                                        $update_city = $_POST['update_city'];
                                        $update_cityId = $_POST['update_city_id'];

                                        $update_state = $_POST['update_state'];
                                        $update_stateId = $_POST['update_state_id'];

                                        $update_country = $_POST['update_country'];
                                        $update_countryId = $_POST['update_country_id'];

                                        $update_pin_code = $_POST['update_pin_code'];
                                        $update_pin_codeId = $_POST['update_pin_code_id'];


                                        $update_time_query = mysqli_query($conn, "UPDATE `orders` SET time = '$update_time' WHERE id = '$update_timeId'");
                                        $update_date_query = mysqli_query($conn, "UPDATE `orders` SET date = '$update_date' WHERE id = '$update_dateId'");
                                        $update_name_query = mysqli_query($conn, "UPDATE `orders` SET name = '$update_name' WHERE id = '$update_nameId'");
                                        $update_flat_query = mysqli_query($conn, "UPDATE `orders` SET flat = '$update_flat' WHERE id = '$update_flatId'");
                                        $update_street_query = mysqli_query($conn, "UPDATE `orders` SET street = '$update_street' WHERE id = '$update_streetId'");
                                        $update_city_query = mysqli_query($conn, "UPDATE `orders` SET city = '$update_city' WHERE id = '$update_cityId'");
                                        $update_state_query = mysqli_query($conn, "UPDATE `orders` SET state = '$update_state' WHERE id = '$update_stateId'");
                                        $update_country_query = mysqli_query($conn, "UPDATE `orders` SET country = '$update_country' WHERE id = '$update_countryId'");
                                        $update_pin_code_query = mysqli_query($conn, "UPDATE `orders` SET pin_code = '$update_pin_code' WHERE id = '$update_pin_codeId'");

                                    }               
                                    if (isset($_GET['delete_all'])) {
                                        mysqli_query($conn, "DELETE FROM `orders`");
                                        //  header('location:cart.php');
                                    }
                        ?>
                                
                                    <div class="container" style="text-align: center;">
                                        <table class="table" style="width: 80%; text-align: center; margin: 0 auto; font-size: 13px;">
                                            <thead style="background-color: darkorange; color: white; padding: 1.5rem; font-size: 16px; margin-bottom: 10px; border: 1px solid #ddd;">
                                                <th style="border: 1px solid #ddd">Order ID</th>
                                                <th style="border: 1px solid #ddd">Products</th>
                                                <th style="border: 1px solid #ddd">Name</th>
                                                <th style="border: 1px solid #ddd">Email</th>
                                                <th style="border: 1px solid #ddd">Flat</th>
                                                <th style="border: 1px solid #ddd">Street</th>
                                                <th style="border: 1px solid #ddd">City</th>
                                                <th style="border: 1px solid #ddd">State</th>
                                                <th style="border: 1px solid #ddd">Country</th>
                                                <th style="border: 1px solid #ddd">Pin_code</th>
                                                <th style="border: 1px solid #ddd">Date</th>
                                                <th style="border: 1px solid #ddd">Time</th>
                                                <th style="border: 1px solid #ddd">Total Price</th>
                                                <th></th>
                                                <th></th>
                                            </thead>
                                            <tbody style="border: 1px solid #ddd;">
                                                <?php
                                                $delivery_orders_query = mysqli_query($conn, "SELECT * FROM `orders` WHERE method = 'delivery'");
                                                $grand_total = 0;
                                                if (mysqli_num_rows($delivery_orders_query) > 0) {
                                                    while ($order = mysqli_fetch_assoc($delivery_orders_query)) {
                                                        ?>
                                                        <tr><form action="" method="post">
                                                            <td style="border: 1px solid #ddd";><?php echo $order['id']; ?></td>

                                                            <td style="border: 1px solid #ddd";><?php echo $order['total_products']; ?></td>

                                                            <td style="border: 1px solid #ddd;"> <input type="hidden" name="update_name_id" value="<?php echo $order['id']; ?>">
                                                            <input type="name" name="update_name" style="width: 4rem;" min="1" value="<?php echo $order['name']; ?>">
                                                            </td>

                                                            <td style="border: 1px solid #ddd"><?php echo $order['email']; ?></td>

                                                            <td style="border: 1px solid #ddd"> <input type="hidden" name="update_flat_id" value="<?php echo $order['id']; ?>">
                                                            <input type="flat" name="update_flat" style="width: 4rem;" min="1" value="<?php echo $order['flat']; ?>">
                                                            </td>

                                                            <td style="border: 1px solid #ddd"> <input type="hidden" name="update_street_id" value="<?php echo $order['id']; ?>">
                                                            <input type="street" name="update_street" style="width: 4rem;" min="1" value="<?php echo $order['street']; ?>">
                                                            </td>

                                                            <td style="border: 1px solid #ddd"> <input type="hidden" name="update_city_id" value="<?php echo $order['id']; ?>">
                                                            <input type="city" name="update_city" style="width: 4rem;" min="1" value="<?php echo $order['city']; ?>">
                                                            </td>

                                                            <td style="border: 1px solid #ddd"> <input type="hidden" name="update_state_id" value="<?php echo $order['id']; ?>">
                                                            <input type="state" name="update_state" style="width: 4rem;" min="1" value="<?php echo $order['state']; ?>">
                                                            </td>

                                                            <td style="border: 1px solid #ddd"> <input type="hidden" name="update_country_id" value="<?php echo $order['id']; ?>">
                                                            <input type="country" name="update_country" style="width: 4rem;" min="1" value="<?php echo $order['country']; ?>">
                                                            </td>

                                                            <td style="border: 1px solid #ddd"> <input type="hidden" name="update_pin_code_id" value="<?php echo $order['id']; ?>">
                                                            <input type="pin_code" name="update_pin_code" style="width: 4rem;" min="1" value="<?php echo $order['pin_code']; ?>">
                                                            </td>
                                                             
                                                            <td style="border: 1px solid #ddd">
                                                            <input type="hidden" name="update_date_id" value="<?php echo $order['id']; ?>">
                                                            <input type="date" name="update_date" style="width: 4rem;" min="1" value="<?php echo $order['date']; ?>">
                                                            </td>
                                                             
                                                            <td style="border: 1px solid #ddd">
                                                            <input type="hidden" name="update_time_id" value="<?php echo $order['id']; ?>">
                                                            <input type="time" name="update_time" style="width: 4rem;" min="1" value="<?php echo $order['time']; ?>">                                                          
                                                            </td>

                                                            <td style="border: 1px solid #ddd">$<?php echo number_format($order['total_price'], 2); ?>/-</td>

                                                            <td style="border: 1px solid #ddd"><input type="submit" value="update" name="update_update_btn" class="btn btn-brand" style="background-color: darkgreen; font-size: 12px;"> <i class="fas fa-trash"></i></td>                                                         
                                                            <td style="border: 1px solid #ddd"><a href="allOrderDetails.php.php?removeDelivery=<?php echo $order['id']; ?>" onclick="return confirm('Cancel this Order?')" class="btn btn-brand" style="background-color: maroon;font-size: 12px;"> <i class="fas fa-trash"></i> Cancel</a></td>
                                                        </tr></form>
                                                <?php

                                                        $grand_total += $order['total_price'];
                                                        };
                                                        };
                                                        ?>
                                                        <tr>                                           
                                                        <td colspan="12" style="font-size:16px; margin-top:8px;">grand total</td>
                                                        <td style="font-size:16px; margin-top:8px;">$<?php echo number_format($grand_total, 2, '.', ''); ?>/-</td>
                                                        <td colspan="14"><a href="allOrderDetails.php?delete_all" onclick="return confirm('Are you sure you want to delete all?');" class="btn btn-brand" style="background-color: red; color: white; font-size: 14px;"> <i class="fas fa-trash"></i> Delete All </a></td>
                                                        </tr>
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Pickup Details -->
                        <div class="tab-pane fade" id="pills-Pickup" role="tabpanel" aria-labelledby="pills-Pickup-tab" tabindex="0">
                            <div class="row"></div>
                            <div class="row">
                                <div class="col-12 intro-text">
                                    <h1 style="margin-bottom: 20px; color: orange;">All Pickup Details</h1>
                                    <?php
                                    if (isset($_GET['removePickup'])) {
                                        $remove_id = $_GET['removePickup'];
                                        mysqli_query($conn, "DELETE FROM `orders` WHERE id = '$remove_id'");
                                    }
                                    
                                    if (isset($_POST['update_update_btn'])) {
                                        $update_time = $_POST['update_time'];
                                        $update_timeId = $_POST['update_time_id'];

                                        $update_date = $_POST['update_date'];
                                        $update_dateId = $_POST['update_date_id'];

                                        $update_name = $_POST['update_name'];
                                        $update_nameId = $_POST['update_name_id'];

                                        $update_flat = $_POST['update_flat'];
                                        $update_flatId = $_POST['update_flat_id'];

                                        $update_street = $_POST['update_street'];
                                        $update_streetId = $_POST['update_street_id'];

                                        $update_city = $_POST['update_city'];
                                        $update_cityId = $_POST['update_city_id'];

                                        $update_state = $_POST['update_state'];
                                        $update_stateId = $_POST['update_state_id'];

                                        $update_country = $_POST['update_country'];
                                        $update_countryId = $_POST['update_country_id'];

                                        $update_pin_code = $_POST['update_pin_code'];
                                        $update_pin_codeId = $_POST['update_pin_code_id'];


                                        $update_time_query = mysqli_query($conn, "UPDATE `orders` SET time = '$update_time' WHERE id = '$update_timeId'");
                                        $update_date_query = mysqli_query($conn, "UPDATE `orders` SET date = '$update_date' WHERE id = '$update_dateId'");
                                        $update_name_query = mysqli_query($conn, "UPDATE `orders` SET name = '$update_name' WHERE id = '$update_nameId'");
                                        $update_flat_query = mysqli_query($conn, "UPDATE `orders` SET flat = '$update_flat' WHERE id = '$update_flatId'");
                                        $update_street_query = mysqli_query($conn, "UPDATE `orders` SET street = '$update_street' WHERE id = '$update_streetId'");
                                        $update_city_query = mysqli_query($conn, "UPDATE `orders` SET city = '$update_city' WHERE id = '$update_cityId'");
                                        $update_state_query = mysqli_query($conn, "UPDATE `orders` SET state = '$update_state' WHERE id = '$update_stateId'");
                                        $update_country_query = mysqli_query($conn, "UPDATE `orders` SET country = '$update_country' WHERE id = '$update_countryId'");
                                        $update_pin_code_query = mysqli_query($conn, "UPDATE `orders` SET pin_code = '$update_pin_code' WHERE id = '$update_pin_codeId'");

                                    }               
                                    if (isset($_GET['delete_all'])) {
                                        mysqli_query($conn, "DELETE FROM `orders`");
                                        //  header('location:cart.php');
                                    }
                        ?>
                                
                                <div class="container" style="text-align: center;">
                                        <table class="table" style="width: 80%; text-align: center; margin: 0 auto; font-size: 13px;">
                                            <thead style="background-color: darkorange; color: white; padding: 1.5rem; font-size: 16px; margin-bottom: 10px; border: 1px solid #ddd;">
                                                <th style="border: 1px solid #ddd">Order ID</th>
                                                <th style="border: 1px solid #ddd">Products</th>
                                                <th style="border: 1px solid #ddd">Name</th>
                                                <th style="border: 1px solid #ddd">Email</th>
                                                <th style="border: 1px solid #ddd">Flat</th>
                                                <th style="border: 1px solid #ddd">Street</th>
                                                <th style="border: 1px solid #ddd">City</th>
                                                <th style="border: 1px solid #ddd">State</th>
                                                <th style="border: 1px solid #ddd">Country</th>
                                                <th style="border: 1px solid #ddd">Pin_code</th>
                                                <th style="border: 1px solid #ddd">Date</th>
                                                <th style="border: 1px solid #ddd">Time</th>
                                                <th style="border: 1px solid #ddd">Total Price</th>
                                                <th></th>
                                                <th></th>
                                            </thead>
                                            <tbody style="border: 1px solid #ddd;">
                                                <?php
                                                $pickup_orders_query = mysqli_query($conn, "SELECT * FROM `orders` WHERE method = 'pickup'");
                                                $grand_total = 0;
                                                if (mysqli_num_rows($pickup_orders_query) > 0) {
                                                    while ($order = mysqli_fetch_assoc($pickup_orders_query)) {
                                                        ?>
                                                        <tr><form action="" method="post">
                                                            <td style="border: 1px solid #ddd";><?php echo $order['id']; ?></td>

                                                            <td style="border: 1px solid #ddd";><?php echo $order['total_products']; ?></td>

                                                            <td style="border: 1px solid #ddd;"> <input type="hidden" name="update_name_id" value="<?php echo $order['id']; ?>">
                                                            <input type="name" name="update_name" style="width: 4rem;" min="1" value="<?php echo $order['name']; ?>">
                                                            </td>

                                                            <td style="border: 1px solid #ddd"><?php echo $order['email']; ?></td>

                                                            <td style="border: 1px solid #ddd"> <input type="hidden" name="update_flat_id" value="<?php echo $order['id']; ?>">
                                                            <input type="flat" name="update_flat" style="width: 4rem;" min="1" value="<?php echo $order['flat']; ?>">
                                                            </td>

                                                            <td style="border: 1px solid #ddd"> <input type="hidden" name="update_street_id" value="<?php echo $order['id']; ?>">
                                                            <input type="street" name="update_street" style="width: 4rem;" min="1" value="<?php echo $order['street']; ?>">
                                                            </td>

                                                            <td style="border: 1px solid #ddd"> <input type="hidden" name="update_city_id" value="<?php echo $order['id']; ?>">
                                                            <input type="city" name="update_city" style="width: 4rem;" min="1" value="<?php echo $order['city']; ?>">
                                                            </td>

                                                            <td style="border: 1px solid #ddd"> <input type="hidden" name="update_state_id" value="<?php echo $order['id']; ?>">
                                                            <input type="state" name="update_state" style="width: 4rem;" min="1" value="<?php echo $order['state']; ?>">
                                                            </td>

                                                            <td style="border: 1px solid #ddd"> <input type="hidden" name="update_country_id" value="<?php echo $order['id']; ?>">
                                                            <input type="country" name="update_country" style="width: 4rem;" min="1" value="<?php echo $order['country']; ?>">
                                                            </td>

                                                            <td style="border: 1px solid #ddd"> <input type="hidden" name="update_pin_code_id" value="<?php echo $order['id']; ?>">
                                                            <input type="pin_code" name="update_pin_code" style="width: 4rem;" min="1" value="<?php echo $order['pin_code']; ?>">
                                                            </td>
                                                             
                                                            <td style="border: 1px solid #ddd">
                                                            <input type="hidden" name="update_date_id" value="<?php echo $order['id']; ?>">
                                                            <input type="date" name="update_date" style="width: 4rem;" min="1" value="<?php echo $order['date']; ?>">
                                                            </td>
                                                             
                                                            <td style="border: 1px solid #ddd">
                                                            <input type="hidden" name="update_time_id" value="<?php echo $order['id']; ?>">
                                                            <input type="time" name="update_time" style="width: 4rem;" min="1" value="<?php echo $order['time']; ?>">                                                          
                                                            </td>

                                                            <td style="border: 1px solid #ddd">$<?php echo number_format($order['total_price'], 2); ?>/-</td>

                                                            <td style="border: 1px solid #ddd"><input type="submit" value="update" name="update_update_btn" class="btn btn-brand" style="background-color: darkgreen; font-size: 12px;"> <i class="fas fa-trash"></i></td>                                                         
                                                            <td style="border: 1px solid #ddd"><a href="allOrderDetails.php.php?removepickup=<?php echo $order['id']; ?>" onclick="return confirm('Cancel this Order?')" class="btn btn-brand" style="background-color: maroon;font-size: 12px;"> <i class="fas fa-trash"></i> Cancel</a></td>
                                                        </tr></form>
                                                <?php

                                                        $grand_total += $order['total_price'];
                                                        };
                                                        };
                                                        ?>
                                                        <tr>                                           
                                                        <td colspan="12" style="font-size:16px; margin-top:8px;">grand total</td>
                                                        <td style="font-size:16px; margin-top:8px;">$<?php echo number_format($grand_total, 2, '.', ''); ?>/-</td>
                                                        <td colspan="14"><a href="allOrderDetails.php?delete_all" onclick="return confirm('Are you sure you want to delete all?');" class="btn btn-brand" style="background-color: red; color: white; font-size: 14px;"> <i class="fas fa-trash"></i> Delete All </a></td>
                                                        </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

<?php
        } else {
            echo "User details not found.";
        }
    } else {
        echo "User email not set.";
    }
} else {
    echo "User not authenticated.";
}
// Close the database connection
$conn->close();
include 'footer.php';
?>
