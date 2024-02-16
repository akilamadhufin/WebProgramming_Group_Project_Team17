<?php
include 'auth.php';
$title = "My Orders";
include 'db.php';

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

            include isset($_SESSION['authenticated']) && $_SESSION['authenticated'] === true ? 'regUserHeader.php' : 'header.php';
            ?>
            <section id="deliveryData" style="padding-top: 20px; padding-bottom: 20px;" class="bg-light">
                <div class="container">
                    <!-- Delivery Details -->
                    <div class="row">
                        <div class="col-12 intro-text">
                            <h1 style="margin-bottom: 20px; color: orange;">Your Current Delivery Details</h1>
                        </div>
                        <?php
                        $userEmail = $_SESSION['email'];
                        $sqlDelivery = "SELECT dv.*, rg.id
                                        FROM deliveryData dv 
                                        JOIN reginfo rg ON rg.email = dv.deliveryEmail 
                                        WHERE dv.deliveryEmail = '$userEmail'";
                        
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
                        }
                        ?>
                    </div>      
                </div>
            </section>
            <section id="deleteDelivery" style="padding-top: 1px; padding-bottom: 1px;">
                <div class="container">
                    <div class="row">
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="row justify-content-center" name="deleteDelivery" method="post">
                            <div class="col-lg-2">
                                <label for="orderId">Order Id to be deleted:</label>
                            </div>
                            <div class="col-lg-2">
                                <input type="text" class="form-control" id="orderIdtoDelete" name="orderIdtoDelete" required>
                                <p id="orderIdtoDeletError"></p>
                            </div>
                            <div class="col-12 intro-text">
                                <button type="submit" class="btn btn-brand" style="margin-top: 20px;" name="deleteDelivery">Delete</button>
                            </div>
                        </form>
                    </div>
                </div>
            </section>

            <?php
            if (isset($_POST['deleteDelivery'])) {
                $orderIdToDelete = isset($_POST['orderIdtoDelete']) ? $_POST['orderIdtoDelete'] : '';

                $sqlDelete = "DELETE FROM deliveryData WHERE deliveryEmail = '$userEmail' AND deliveryOrderId = '$orderIdToDelete'";
                if ($conn->query($sqlDelete) === TRUE) {
                    // Check if any rows were affected
                    if ($conn->affected_rows > 0) {
                        echo "<script>window.alert('Record deleted successfully');</script>";
                    } else {
                        echo "<script>window.alert('No records found with the provided Order ID');</script>";
                    }
                } else {
                    echo "<script>window.alert('Error deleting record. Check your order');</script>";
                }
            }
            ?>

            <section id="deliveryData" style="padding-top: 1px; padding-bottom: 20px;" class="bg-light">
                <div class="container">
                    <div class="row">
                        <div class="col-12 intro-text">
                            <h1 style="margin-bottom: 20px; color: orange;">Your Updated Delivery Details</h1>
                        </div>
                        <?php
                        $userEmail = $_SESSION['email'];
                        $sqlUpdatedDelivery = "SELECT dv.*, rg.id
                                            FROM deliveryData dv 
                                            JOIN reginfo rg ON rg.email = dv.deliveryEmail 
                                            WHERE deliveryEmail = '$userEmail'";
                        $resultUpdatedDelivery = $conn->query($sqlUpdatedDelivery);
                        
                        if ($resultUpdatedDelivery->num_rows > 0) {
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
                            while ($rowDelivery = $resultUpdatedDelivery->fetch_assoc()) {
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
                            echo "No updated delivery details found.";
                        }
                        ?>
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
