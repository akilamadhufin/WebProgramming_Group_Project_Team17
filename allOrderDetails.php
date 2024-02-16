<?php
$title = "HOT POT Order Info";
include 'auth.php';
include 'admin_header.php';

include 'db.php';
?>

    <section id="allDeliveryInfo" style="padding-top: 20px; padding-bottom: 10px;" class="bg-light">
        <div class="container">
            <div class="col-12 intro-text">
                <h1 style="color:orange">Delivery Details:</h1>
            </div>
            <div class="col-12 intro-text">
                <?php
                    // Display the updated data here using updatedData
                    $sqlDelivery = "SELECT rg.id, dv.fname, dv.lname, dv.deliveryAddress, dv.phoneNum, dv.deliveryOrderId, dv.deliveryEmail, dv.deliveryDate, dv.deliveryTime, dv.mealName, dv.portionSize, dv.addMore, dv.deliveryMessage
                    FROM reginfo rg
                    JOIN deliveryData dv ON rg.email = dv.deliveryEmail";
                    
                    
                    $resultDelivery = $conn->query($sqlDelivery);
                    if ($resultDelivery !== false && $resultDelivery->num_rows > 0) {
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
                                    <td>{$rowDelivery['deliveryOrderId']}</td>
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
                    } else {
                        echo "User details not found.";
                    }
                
                
                ?>
            </div>
        </div>
    </section>

    <section id="allPickupInfo" style="padding-top: 20px; padding-bottom: 120px;" class="bg-light">
        <div class="container">
            <div class="col-12 intro-text">
                <h1 style="color:orange">Pickup Details:</h1>
            </div>
            <div class="col-12 intro-text">
                <?php
                    // Display the updated data here using updatedData
                    $sqlPickup = "SELECT rg.id, pk.fname, pk.lname, pk.phoneNum, pk.pickupOrderId, pk.pickupEmail, pk.pickupDate, pk.pickupTime, pk.mealName, pk.portionSize, pk.addMore, pk.pickupMessage
                    FROM reginfo rg
                    JOIN pickupData pk ON rg.email = pk.pickupEmail";
                    
                    
                    $resultPickup = $conn->query($sqlPickup);
                    if ($resultPickup !== false && $resultPickup->num_rows > 0) {
                        echo "<table class='table'>
                                <thead>
                                    <tr>
                                        <th>Order ID</th>
                                        <th>Customer ID</th>
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
                                    <td>{$rowPickup['pickupOrderId']}</td>
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
                        echo "User details not found.";
                    }
            
                ?>
            </div>
        </div>
    </section>
<?php

// Close the database connection
$conn->close();
include 'footer.php';
?>
