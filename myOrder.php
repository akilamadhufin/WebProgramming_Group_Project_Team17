<?php
include 'auth.php';
$title = "My Orders";
include 'db.php';
include isset($_SESSION['authenticated']) && $_SESSION['authenticated'] === true ? 'regUserHeader.php' : 'header.php';

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
                            <button class="nav-link active" id="pills-Deilvery-tab" data-bs-toggle="pill" data-bs-target="#pills-Deilvery" type="button" role="tab" aria-controls="pills-Deilvery" aria-selected="true">Delivery Details</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-Pickup-tab" data-bs-toggle="pill" data-bs-target="#pills-Pickup" type="button" role="tab" aria-controls="pills-Pickup" aria-selected="false">Pickup Details</button>
                        </li>
                    </ul>
                    <!-- Delivery Details -->
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-Deilvery" role="tabpanel" aria-labelledby="pills-Deilvery-tab" tabindex="0">
                            <div class="row">
                                
                            </div>
                            <div class="row">
                                <div class="col-12 intro-text">
                                    <h1 style="margin-bottom: 20px; color: orange;">Your Delivery Details</h1>
                                    <div class="col-12 intro-text">
                                    <div class="divider my-5"></div>
                                  <h5 style="color:red;">Click on Order Id to edit update your delivery details</h5>
                                    
                                </div>
                                    <?php
                                    $userEmail = $_SESSION['email'];
                                    $sqlDelivery = "SELECT dv.*, rg.id
                                                    FROM deliveryData dv 
                                                    JOIN reginfo rg ON rg.email = dv.deliveryEmail 
                                                    WHERE rg.email = '$userEmail'";

        
                                    $resultDelivery = $conn->query($sqlDelivery);
                                    if ($resultDelivery->num_rows > 0) {
                                        echo "<table class='table'>
                                                <thead>
                                                    <tr>
                                                        <th>Order ID</th>
                                                        <th>Customer ID</th>
                                                        <th>First Name</th>
                                                        <th>Last Name</th>
                                                        <th>email</th>
                                                        <th>Address</th>
                                                        <th>Contact Number</th>
                                                        <th>delivery Date</th>
                                                        <th>delivery Time</th>
                                                        <th>Meal Ordered</th>
                                                        <th>Portion Size</th>
                                                        <th>Number of items</th>
                                                        <th>Message</th>
                                                    </tr>
                                                </thead>
                                                <tbody>";
                                        while ($rowDelivery = $resultDelivery->fetch_assoc()) {
                                            echo "<tr>
                                                    <td><a href='editDelivery.php?id={$rowDelivery['deliveryOrderId']}' style='color:red;'>{$rowDelivery['deliveryOrderId']}</a></td>
                                                    <td>{$rowDelivery['id']}</td>
                                                    <td>{$rowDelivery['fname']}</td>
                                                    <td>{$rowDelivery['lname']}</td>
                                                    <td>{$rowDelivery['deliveryEmail']}</td>
                                                    <td>{$rowDelivery['deliveryAddress']}</td>
                                                    <td>{$rowDelivery['phoneNum']}</td>
                                                    <td>{$rowDelivery['deliveryDate']}</td>
                                                    <td>{$rowDelivery['deliveryTime']}</td>
                                                    <td>{$rowDelivery['mealName']}</td>
                                                    <td>{$rowDelivery['portionSize']}</td>
                                                    <td>{$rowDelivery['addMore']}</td>
                                                    <td>{$rowDelivery['deliveryMessage']}</td>
                                                </tr>";
                                        }
                                        echo "</tbody></table>";
                                    }
                                    ?>
                                </div>

                            
                            </div>
                            <div class="row">
                                <div class="col-12 intro-text">
                                    <h5 style="margin-bottom: 20px; color: red;">Click on below button delete your Orders</h>
                                </div>   
                                <div class="col-12 intro-text">
                                <a href="deleteDelivery.php" type="submit" class="btn btn-brand" style="margin-top: 20px;" name="deleteDelivery">Delete</a>
                            
                            </div>
                            </div>

                        </div>

                        <!-- Pickup Details -->
<div class="tab-pane fade" id="pills-Pickup" role="tabpanel" aria-labelledby="pills-Pickup-tab" tabindex="0">
    <div class="row">
       
    </div>
    <div class="row">
        <div class="col-12 intro-text">
            <h1 style="margin-bottom: 20px; color: orange;">Your Pickup Details</h1>
            <div class="col-12 intro-text">
            <div class="divider my-5"></div>
            <h5 style="color:red;">Click on Order Id to edit update your Pickup details</h5>
            
        </div>
            <?php
            $userEmail = $_SESSION['email'];
            $sqlPickup =    "SELECT pk.*, rg.id
                            FROM pickupData pk 
                            JOIN reginfo rg ON rg.email = pk.pickupEmail 
                            WHERE rg.email = '$userEmail'";

            $resultPickup = $conn->query($sqlPickup);

            if ($resultPickup !== false) {
                if ($resultPickup->num_rows > 0) {
                    echo "<table class='table'>
                            <thead>
                                <tr>
                                    <th>Order ID</th>
                                    <th>Customer_ID</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>email</th>
                                    <th>Contact Number</th>
                                    <th>Pickup Date</th>
                                    <th>Pickup Time</th>
                                    <th>Meal Ordered</th>
                                    <th>Portion Size</th>
                                    <th>Number of items</th>
                                    <th>Message</th>
                                </tr>
                            </thead>
                            <tbody>";
                    while ($rowPickup = $resultPickup->fetch_assoc()) {
                        echo "<tr>
                                <td><a href='editPickup.php?id={$rowPickup['pickupOrderId']}' style='color:red;'>{$rowPickup['pickupOrderId']}</a></td>
                                <td>{$rowPickup['id']}</td>
                                <td>{$rowPickup['fname']}</td>
                                <td>{$rowPickup['lname']}</td>
                                <td>{$rowPickup['pickupEmail']}</td>
                                <td>{$rowPickup['phoneNum']}</td>
                                <td>{$rowPickup['pickupDate']}</td>
                                <td>{$rowPickup['pickupTime']}</td>
                                <td>{$rowPickup['mealName']}</td>
                                <td>{$rowPickup['portionSize']}</td>
                                <td>{$rowPickup['addMore']}</td>
                                <td>{$rowPickup['pickupMessage']}</td>
                            </tr>";
                    }
                    echo "</tbody></table>";
                } else {
                    echo "No Pickup details found.";
                }
            } else {
                echo "Error executing the Pickup query: " . $conn->error;
            }
            ?>
        </div>
        <div class="row">
            <div class="col-12 intro-text">
            <h5 style="margin-bottom: 20px; color: red;">Click on below button delete your Orders</h>
            </div>  
        <div class="col-12 intro-text">
        <a href ="deletePickup.php" type="submit" class="btn btn-brand" style="margin-top: 20px;" name="delete">Delete</a>
        </div>
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
