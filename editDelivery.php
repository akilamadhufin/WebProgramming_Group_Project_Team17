<?php
include 'auth.php';
$title = "Edit Delivery";
include 'db.php';

include (isset($_SESSION['authenticated']) && $_SESSION['authenticated'] === true) ? 'regUserHeader.php' : 'header.php';
$updateSuccess = false;
$deliveryDate = $deliveryTime = $deliveryAddress = $mealName = $deliveryMessage = $additionalComment = '';

if (isset($_GET['id']) || isset($_POST['updateDelivery'])) {

    if (isset($_GET['id'])) {
        $deliveryOrderId = $_GET['id'];
        $sqlDelivery = "SELECT * from deliveryData WHERE deliveryOrderId = '$deliveryOrderId'";
        $resultDelivery = $conn->query($sqlDelivery);
        
    // defining variables
        if ($resultDelivery !== false) {
            if ($resultDelivery->num_rows > 0) {
                $rowDelivery = $resultDelivery->fetch_assoc();
                
                $deliveryOrderId = $rowDelivery['deliveryOrderId'];
                $fname = $rowDelivery['fname'];
                $lname = $rowDelivery['lname'];
                $deliveryAddress = $rowDelivery['deliveryAddress'];
                $deliveryEmail = $rowDelivery['deliveryEmail'];
                $phoneNum = $rowDelivery['phoneNum'];
                $deliveryDate = $rowDelivery['deliveryDate'];
                $deliveryTime = $rowDelivery['deliveryTime'];
                $mealName = $rowDelivery['mealName'];
                $deliveryMessage = $rowDelivery['deliveryMessage'];
                $portionSize = $rowDelivery['portionSize'];
                $addMore = $rowDelivery['addMore'];
            } else {
                echo "No rows found for delivery details.";
            }
        } else {
            echo "Query failed: " . $conn->error;
        }
    }
    
    

    if (isset($_POST['updateDelivery'])) {
        $deliveryOrderId = $_POST['deliveryOrderId'];
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $deliveryAddress = $_POST['deliveryAddress'];
        $phoneNum = $_POST['phoneNum'];
        $deliveryDate = $_POST['deliveryDate'];
        $deliveryTime = $_POST['deliveryTime'];
        $mealName = $_POST['mealName'];
        $deliveryMessage = $_POST['deliveryMessage'];
        $portionSize = $_POST['portionSize'];
        $addMore = $_POST['addMore'];

        // Perform database update here based on the form values
        $sqlUpdateDelivery = "UPDATE deliveryData SET
                            fname = '$fname',
                            lname = '$lname',
                            deliveryAddress = '$deliveryAddress',
                            phoneNum = '$phoneNum',
                            deliveryDate = '$deliveryDate',
                            deliveryTime = '$deliveryTime',
                            mealName = '$mealName',
                            deliveryMessage = '$deliveryMessage',
                            portionSize = '$portionSize',
                            addMore = '$addMore'
                            WHERE deliveryOrderId = '$deliveryOrderId'";

    if ($conn->query($sqlUpdateDelivery) === TRUE) {
        $updateSuccess = true; 
        
        $sqlUpdatedData = "SELECT * from deliveryData WHERE deliveryOrderId = '$deliveryOrderId'";
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

<section id="editDelivery" style="padding-top: 20px; padding-bottom: 120px;" class="bg-light">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h4 style="color:orange;">Edit Delivery Details</h4>
            </div>
        </div>
        <form action="editDelivery.php" method="post">
            <input type="hidden" name="deliveryOrderId" value="<?php echo $deliveryOrderId; ?>">

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
                <label for="deliveryAddress" class="col-sm-4 col-form-label" style="margin-bottom: 10px;">Delivery Address:</label>
                <div class="col-md-6">
                    <input type="text" class="form-control" name="deliveryAddress" value="<?php echo $deliveryAddress; ?>" required>
                </div>
            </div>

            <div class="form-group row">
                <label for="phoneNum" class="col-sm-4 col-form-label" style="margin-bottom: 10px;">Phone Number:</label>
                <div class="col-md-6">
                    <input type="text" class="form-control" name="phoneNum" value="<?php echo $phoneNum; ?>" required>
                </div>
            </div>

            <div class="form-group row">
                <label for="deliveryDate" class="col-sm-4 col-form-label" style="margin-bottom: 10px;">Delivery Date:</label>
                <div class="col-md-6">
                    <input type="date" class="form-control" name="deliveryDate" value="<?php echo $deliveryDate; ?>" required>
                </div>
            </div>

            <div class="form-group row">
                <label for="deliveryTime" class="col-sm-4 col-form-label" style="margin-bottom: 10px;">Delivery Time:</label>
                <div class="col-md-6">
                    <input type="time" class="form-control" name="deliveryTime" value="<?php echo $deliveryTime; ?>" required>
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
                <label for="deliveryMessage" class="col-sm-4 col-form-label" style="margin-bottom: 10px;">Delivery Message:</label>
                <div class="col-md-6">
                    <input type="text" class="form-control" name="deliveryMessage" value="<?php echo $deliveryMessage; ?>" required>
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
                    <button type="submit" class="btn btn-brand" name="updateDelivery">Update Delivery</button>
                </div>
            </div>
        </form>
        </section>

        <section id="updatedDelivery" style="padding-top: 20px; padding-bottom: 120px;" class="bg-light">
        
        <div class="col-12 intro-text">
        <h4 style="color:orange">Updated Delivery Details:</h4> </div>
        <div class="col-12 intro-text">
        <?php
         if ($updateSuccess && isset($updatedData)) {
           
            // Display the updated data here using updatedData
            
            $userEmail = $_SESSION['email'];
            $sqlDelivery = "SELECT rg.id, dv.fname, dv.lname, dv.deliveryAddress, dv.phoneNum, dv.deliveryOrderId, dv.deliveryEmail, dv.deliveryDate, dv.deliveryTime, dv.mealName, dv.portionSize, dv.addMore, dv.deliveryMessage
                FROM reginfo rg
                JOIN deliveryData dv ON rg.email = dv.deliveryEmail WHERE rg.email = '$userEmail' and deliveryOrderId = '$deliveryOrderId'";

                $resultDelivery = $conn->query($sqlDelivery);
                if ($resultDelivery->num_rows > 0) {
                echo "<table class='table'>
                    <thead>
                                                    <tr>
                                                        <th>Order ID</th>
                                                        <th>Customer_ID</th>
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
    }
        ?>
    </div>
</div>

</section>
<?php
include 'footer.php';
?>
