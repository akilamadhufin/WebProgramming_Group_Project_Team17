<?php
include 'auth.php';
$title = "Edit Pickup";
include 'db.php';

include (isset($_SESSION['authenticated']) && $_SESSION['authenticated'] === true) ? 'regUserHeader.php' : 'header.php';
$updateSuccess = false;
$PickupDate = $PickupTime = $PickupAddress = $mealName = $PickupMessage = $portionSize = $addMore = '';

if (isset($_GET['id']) || isset($_POST['updatePickup'])) {

    if (isset($_GET['id'])) {
        $pickupOrderId = $_GET['id'];
        $sqlPickup = "SELECT * from pickupData WHERE pickupOrderId = '$pickupOrderId'";
        $resultPickup = $conn->query($sqlPickup);
        
    // defining variables
        if ($resultPickup !== false) {
            if ($resultPickup->num_rows > 0) {
                $rowPickup = $resultPickup->fetch_assoc();
                $pickupOrderId = $rowPickup['pickupOrderId'];
                $fname = $rowPickup['fname'];
                $lname = $rowPickup['lname'];
                $pickupEmail = $rowPickup['pickupEmail'];
                $phoneNum = $rowPickup['phoneNum'];
                $pickupDate = $rowPickup['pickupDate'];
                $pickupTime = $rowPickup['pickupTime'];
                $mealName = $rowPickup['mealName'];
                $pickupMessage = $rowPickup['pickupMessage'];
                $portionSize = $rowPickup['portionSize'];
                $addMore = $rowPickup['addMore'];
            } else {
                echo "No rows found for pickup details.";
            }
        } else {
            echo "Query failed: " . $conn->error;
        }
    }
    
    if (isset($_POST['updatePickup'])) {
        $pickupOrderId = $_POST['pickupOrderId'];
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $phoneNum = $_POST['phoneNum'];
        $pickupDate = $_POST['pickupDate'];
        $pickupTime = $_POST['pickupTime'];
        $mealName = $_POST['mealName'];
        $pickupMessage = $_POST['pickupMessage'];
        $portionSize = $_POST['portionSize'];
        $addMore = $_POST['addMore'];

        // Perform database update here based on the form values
        $sqlUpdatePickup = "UPDATE pickupData SET
                            fname = '$fname',
                            lname = '$lname',
                            phoneNum = '$phoneNum',
                            pickupDate = '$pickupDate',
                            pickupTime = '$pickupTime',
                            mealName = '$mealName',
                            pickupMessage = '$pickupMessage',
                            portionSize = '$portionSize',
                            addMore = '$addMore'
                            WHERE pickupOrderId = '$pickupOrderId'";

    if ($conn->query($sqlUpdatePickup) === TRUE) {
        $updateSuccess = true; 
        
        $sqlUpdatedData = "SELECT * from pickupData WHERE pickupOrderId = '$pickupOrderId'";
        $resultUpdatedData = $conn->query($sqlUpdatedData);

        if ($resultUpdatedData !== false && $resultUpdatedData->num_rows > 0) {
            $updatedData = $resultUpdatedData->fetch_assoc();
        } else {
            echo "Error fetching updated data: " . $conn->error;
        }
    } else {
        echo "<script>window.alert('Error in Update: " . $conn->error . "');</script>";
    }
    }
    }
?>

<section id="editPickup" style="padding-top: 20px; padding-bottom: 120px;" class="bg-light">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h4 style="color:orange;">Edit Pickup Details</h4>
            </div>
        </div>
        <form action="editPickup.php" method="post">
            <input type="hidden" name="pickupOrderId" value="<?php echo $pickupOrderId; ?>">

            <div class="form-group row">
                <label for="fname" class="col-sm-4 col-form-label" style="margin-bottom: 10px;">First Name:</label>
                <div class="col-md-6">
                    <input type="text" class="form-control" name="fname" value="<?php echo $fname; ?>" required>
                </div>
            </div>

            <div class="form-group row">
                <label for="lname" class="col-sm-4 col-form-label" style="margin-bottom: 10px;">Last Name:</label>
                <div class="col-md-6">
                    <input type="text" class="form-control" name="lname" value="<?php echo $lname; ?>" required>
                </div>
            </div>

            <div class="form-group row">
                <label for="phoneNum" class="col-sm-4 col-form-label" style="margin-bottom: 10px;">Phone Number:</label>
                <div class="col-md-6">
                    <input type="text" class="form-control" name="phoneNum" value="<?php echo $phoneNum; ?>" required>
                </div>
            </div>

            <div class="form-group row">
                <label for="pickupDate" class="col-sm-4 col-form-label" style="margin-bottom: 10px;">Pickup Date:</label>
                <div class="col-md-6">
                    <input type="date" class="form-control" name="pickupDate" value="<?php echo $pickupDate; ?>" required>
                </div>
            </div>

            <div class="form-group row">
                <label for="pickupTime" class="col-sm-4 col-form-label" style="margin-bottom: 10px;">Pickup Time:</label>
                <div class="col-md-6">
                    <input type="time" class="form-control" name="pickupTime" value="<?php echo $pickupTime; ?>" required>
                </div>
            </div>

            <div class="form-group row">
                <label for="mealName" class="col-sm-4 col-form-label" style="margin-bottom: 10px;">Meal Name:</label>
                <div class="col-md-6">
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
            </div>

            <div class="form-group row">
                <label for="portionSize" class="col-sm-4 col-form-label" style="margin-bottom: 10px;">Portion Size:</label>
                <div class="col-md-6">
                    <select class="form-control" id="portionSize" name="portionSize" required>
                        <option value="" disabled selected>Select Portion Size</option>
                        <option value="regular">Regular</option>
                        <option value="large">Large</option>
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label for="pickupMessage" class="col-sm-4 col-form-label" style="margin-bottom: 10px;">Pickup Message:</label>
                <div class="col-md-6">
                    <input type="text" class="form-control" name="pickupMessage" value="<?php echo $pickupMessage; ?>" required>
                </div>
            </div>

            <div class="form-group row">
                <label for="addMore" class="col-sm-4 col-form-label" style="margin-bottom: 20px;">Add More:</label>
                <div class="col-md-6">
                    <select class="form-control" id="addMore" name="addMore" required>
                        <option value="" disabled selected>Add more item</option>
                        <option value="1_item">1</option>
                        <option value="2_items">2</option>
                        <option value="3_items">3</option>
                        <option value="4_items">4</option>
                        <option value="5_items">5</option>
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-brand" name="updatePickup">Update Pickup</button>
                </div>
            </div>
        </form>
        </section>

        <section id="updatedPickup" style="padding-top: 20px; padding-bottom: 120px;" class="bg-light">
        
        <div class="col-12 intro-text">
        <h4 style="color:orange">Updated Pickup Details:</h4> </div>
        <div class="col-12 intro-text">
        <?php
         if ($updateSuccess && isset($updatedData)) {
           
            // Display the updated data here using updatedData
            
            $userEmail = $_SESSION['email'];
            $sqlPickup = "SELECT rg.id, pk.fname, pk.lname, pk.phoneNum, pk.pickupOrderId, pk.pickupEmail, pk.pickupDate, pk.pickupTime, pk.mealName, pk.portionSize, pk.addMore, pk.pickupMessage
                FROM reginfo rg
                JOIN pickupData pk ON rg.email = pk.pickupEmail WHERE rg.email = '$userEmail' and pickupOrderId = '$pickupOrderId'";

                $resultPickup = $conn->query($sqlPickup);
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
            
        }                        
    }
        ?>
    </div>
</div>

</section>
<?php
include 'footer.php';
?>
