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
                                    <h1 style="margin-bottom: 20px; color: orange;">Your Delivery Details</h1>
                                    <?php
                                    if (isset($_GET['removeDelivery'])) {
                                        $remove_id = $_GET['removeDelivery'];
                                        mysqli_query($conn, "DELETE FROM `orders` WHERE id = '$remove_id'");
                                    }
                                    ?>
                                    <div class="container">
                                        <table class="table" style="width: 100%; text-align: center;">
                                            <thead style="background-color: darkorange; color: white; padding: 1.5rem; font-size: 16px; margin-bottom: 10px;">
                                                <th>Order ID</th>
                                                <th>Products</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Address</th>
                                                <th>Date</th>
                                                <th>Time</th>
                                                <th>Total Price</th>
                                                <th></th>
                                                <th></th>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $delivery_orders_query = mysqli_query($conn, "SELECT * FROM `orders` WHERE method = 'delivery' and email = '$userEmail'");
                                                if (mysqli_num_rows($delivery_orders_query) > 0) {
                                                    while ($order = mysqli_fetch_assoc($delivery_orders_query)) {
                                                        ?>
                                                        <tr>
                                                            <td><?php echo $order['id']; ?></td>
                                                            <td><?php echo $order['total_products']; ?></td>
                                                            <td><?php echo $order['name']; ?></td>
                                                            <td><?php echo $order['email']; ?></td>
                                                            <td><?php echo $order['flat'] . ', ' . $order['street'] . ', ' . $order['city'] . ', ' . $order['state'] . ', ' . $order['country'] . ' - ' . $order['pin_code']; ?></td>
                                                            <td><?php echo $order['date']; ?></td>
                                                            <td><?php echo $order['time']; ?></td>
                                                            <td>$<?php echo number_format($order['total_price'], 2); ?>/-</td>
                                                            <td><td><a href="editDelivery.php?id=<?php echo $order['id']; ?>" onclick="return confirm('Edit this Order?')" class="btn btn-brand" style="background-color: darkgreen;"> <i class="fas fa-trash"></i> Edit</a></td></td>
                                                            <td><a href="myOrder.php?removeDelivery=<?php echo $order['id']; ?>" onclick="return confirm('Cancel this Order?')" class="btn btn-brand" style="background-color: maroon;"> <i class="fas fa-trash"></i> Cancel</a></td>
                                                        </tr>
                                                <?php
                                                    }
                                                } else {
                                                    echo "<tr><td colspan='7'>No delivery orders available.</td></tr>";
                                                }
                                                ?>
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
                                    <h1 style="margin-bottom: 20px; color: orange;">Your Pickup Details</h1>
                                    <?php
                                    if (isset($_GET['removePickup'])) {
                                        $remove_id = $_GET['removePickup'];
                                        mysqli_query($conn, "DELETE FROM `orders` WHERE id = '$remove_id'");
                                    }
                                    ?>
                                    <div class="container">
                                        <table class="table" style="width: 100%; text-align: center;">
                                            <thead style="background-color: darkorange; color: white; padding: 1.5rem; font-size: 16px; margin-bottom: 10px;">
                                                <th>Order ID</th>
                                                <th>Products</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Address</th>
                                                <th>Date</th>
                                                <th>Time</th>
                                                <th>Total Price</th>
                                                <th></th>
                                                <th></th>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $pickup_orders_query = mysqli_query($conn, "SELECT * FROM `orders` WHERE method = 'pickup' and email = '$userEmail'");
                                                if (mysqli_num_rows($pickup_orders_query) > 0) {
                                                    while ($order = mysqli_fetch_assoc($pickup_orders_query)) {
                                                        ?>
                                                        <tr>
                                                            <td><?php echo $order['id']; ?></td>
                                                            <td><?php echo $order['total_products']; ?></td>
                                                            <td><?php echo $order['name']; ?></td>
                                                            <td><?php echo $order['email']; ?></td>
                                                            <td><?php echo $order['flat'] . ', ' . $order['street'] . ', ' . $order['city'] . ', ' . $order['state'] . ', ' . $order['country'] . ' - ' . $order['pin_code']; ?></td>
                                                            <td><?php echo $order['date']; ?></td>
                                                            <td><?php echo $order['time']; ?></td>
                                                            <td>$<?php echo number_format($order['total_price'], 2); ?>/-</td>
                                                            <td><a href="editPickup.php?id=<?php echo $order['id']; ?>" onclick="return confirm('Edit this Order?')" class="btn btn-brand" style="background-color: darkgreen;"> <i class="fas fa-trash"></i> Edit</a></td>
                                                            <td><a href="myOrder.php?removePickup=<?php echo $order['id']; ?>" onclick="return confirm('Cancel this Order?')" class="btn btn-brand" style="background-color: maroon;"> <i class="fas fa-trash"></i> Cancel</a></td>
                                                        </tr>
                                                <?php
                                                    }
                                                } else {
                                                    echo "<tr><td colspan='7'>No pickup orders available.</td></tr>";
                                                }
                                                ?>
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
