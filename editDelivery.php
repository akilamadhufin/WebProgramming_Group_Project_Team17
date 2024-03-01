<?php
include 'auth.php';
$title = "Edit Delivery";
include 'db.php';

include (isset($_SESSION['authenticated']) && $_SESSION['authenticated'] === true) ? 'regUserHeader.php' : 'header.php';
$updateSuccess = false;
$date = $time = $deliveryAddress = $city = $pin_code = $additionalComment = '';
$id = '';

if (isset($_GET['id']) || isset($_POST['updateDelivery'])) {

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $sqlDelivery = "SELECT * from orders WHERE id = '$id'";
        $resultDelivery = $conn->query($sqlDelivery);
        
    // defining variables
        if ($resultDelivery !== false) {
            if ($resultDelivery->num_rows > 0) {
                $rowDelivery = $resultDelivery->fetch_assoc();
                $name = $rowDelivery['name'];
                $number = $rowDelivery['number'];
                $email = $rowDelivery['email'];
                $method = $rowDelivery['method'];
                $flat = $rowDelivery['flat'];
                $street = $rowDelivery['street'];
                $city = $rowDelivery['city'];
                $state = $rowDelivery['state'];
                $country = $rowDelivery['country'];
                $pin_code = $rowDelivery['pin_code'];
                $date = $rowDelivery['date'];
                $time = $rowDelivery['time'];
            } else {
                echo "No rows found for delivery details.";
            }
        } else {
            echo "Query failed: " . $conn->error;
        }
    }
    
    
    if (isset($_POST['updateDelivery'])) {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $number = $_POST['number'];
        $email = $_POST['email'];
        $method = $_POST['method'];
        $flat = $_POST['flat'];
        $street = $_POST['street'];
        $city = $_POST['city'];
        $state = $_POST['state'];
        $country = $_POST['country'];
        $pin_code = $_POST['pin_code'];
        $date = $_POST['date'];
        $time = $_POST['time'];
    
        // Perform database update here based on the form values
        $sqlUpdateDelivery = "UPDATE orders SET
                            name = '$name',
                            email = '$email',
                            method = '$method',
                            number = '$number',
                            country = '$country',
                            street = '$street',
                            date = '$date',
                            time = '$time',
                            city = '$city',
                            pin_code = '$pin_code',
                            flat = '$flat',
                            state = '$state'
                            WHERE id = '$id'";

    if ($conn->query($sqlUpdateDelivery) === TRUE) {
        if ($conn->affected_rows > 0) {
            $updateSuccess = true;
    
            // Fetch the updated data directly from the form values
            $updatedData = [
                'name' => $name,
                'email' => $email,
                'method' => $method,
                'number' => $number,
                'country' => $country,
                'street' => $street,
                'date' => $date,
                'time' => $time,
                'city' => $city,
                'pin_code' => $pin_code,
                'flat' => $flat,
                'state' => $state,
            ];
    
        } 
    } else {
        echo "Error in Update: " . $conn->error;

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
            <input type="hidden" name="id" value="<?php echo $id; ?>">

            <div class="form-group row">
                <label for="name" class="col-sm-4 col-form-label" style="margin-bottom: 10px;">Name:</label>
                <div class="col-md-6">
                    <input type="text" class="form-control" name="name" value="<?php echo $name; ?>" required>
                </div>
            </div>

            <div class="form-group row">
                <label for="email" class="col-sm-4 col-form-label" style="margin-bottom: 10px;">Email:</label>
                <div class="col-md-6">
                    <input type="text" class="form-control" name="email" value="<?php echo $email; ?>" required>
                </div>
            </div>

            <div class="form-group row">
                <label for="number" class="col-sm-4 col-form-label" style="margin-bottom: 10px;">Number:</label>
                <div class="col-md-6">
                    <input type="text" class="form-control" name="number" value="<?php echo $number; ?>" required>
                </div>
            </div>

            <div class="form-group row">
                <label for="method" class="col-sm-4 col-form-label" style="margin-bottom: 10px;">Payment Method:</label>
                <div class="col-md-6">
              <!--      <input type="text" class="form-control" name="method" value="<?php echo $method; ?>" required> -->

                    <select name="method" class="form-control" id="method" placeholder="<?php echo $method; ?>">
                  <option value="delivery">delivery</option>
                  <option value="pickup">pickup</option>
                </select>
                </div>
            </div>

            <div class="form-group row">
                <label for="flat" class="col-sm-4 col-form-label" style="margin-bottom: 10px;">Address Line 1:</label>
                <div class="col-md-6">
                    <input type="text" class="form-control" name="flat" value="<?php echo $flat; ?>" required>
                </div>
            </div>

            <div class="form-group row">
                <label for="street" class="col-sm-4 col-form-label" style="margin-bottom: 10px;">Address Line 2:</label>
                <div class="col-md-6">
                    <input type="text" class="form-control" name="street" value="<?php echo $street; ?>" required>
                </div>
            </div>

            <div class="form-group row">
                <label for="city" class="col-sm-4 col-form-label" style="margin-bottom: 10px;">City:</label>
                <div class="col-md-6">
                    <input type="text" class="form-control" name="city" value="<?php echo $city; ?>" required>
                </div>
            </div>
            
            <div class="form-group row">
                <label for="state" class="col-sm-4 col-form-label" style="margin-bottom: 10px;">State:</label>
                <div class="col-md-6">
                    <input type="text" class="form-control" name="state" value="<?php echo $state; ?>" required>
                </div>
            </div>

            <div class="form-group row">
                <label for="country" class="col-sm-4 col-form-label" style="margin-bottom: 10px;">Country:</label>
                <div class="col-md-6">
                    <input type="text" class="form-control" name="country" value="<?php echo $country; ?>" required>
                </div>
            </div>

            <div class="form-group row">
                <label for="pin_code" class="col-sm-4 col-form-label" style="margin-bottom: 10px;">pin_code:</label>
                <div class="col-md-6">
                    <input type="text" class="form-control" name="pin_code" value="<?php echo $pin_code; ?>" required>
                </div>
            </div>

            <div class="form-group row">
                <label for="date" class="col-sm-4 col-form-label" style="margin-bottom: 10px;">Date:</label>
                <div class="col-md-6">
                    <input type="date" class="form-control" name="date" value="<?php echo $date; ?>" required>
                </div>
            </div>

            <div class="form-group row">
                <label for="time" class="col-sm-4 col-form-label" style="margin-bottom: 10px;">Time:</label>
                <div class="col-md-6">
                    <input type="time" class="form-control" name="time" value="<?php echo $time; ?>" required>
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

            $email = $_SESSION['email'];
            $sqlDelivery = "SELECT * FROM orders WHERE email = '$email' AND id = '$id'";

            $resultDelivery = $conn->query($sqlDelivery);
            if ($resultDelivery->num_rows > 0) {
                echo "<table class='table'>
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Products</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Address</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Total Price</th>
                            </tr>
                        </thead>
                        <tbody>";

                while ($rowDelivery = $resultDelivery->fetch_assoc()) {
                    echo "<tr>
                            <td>{$rowDelivery['id']}</td>
                            <td>{$rowDelivery['total_products']}</td>
                            <td>{$rowDelivery['name']}</td>
                            <td>{$rowDelivery['email']}</td>
                            <td>{$rowDelivery['flat']}, {$rowDelivery['street']}, {$rowDelivery['city']}, {$rowDelivery['state']}, {$rowDelivery['country']} - {$rowDelivery['pin_code']}</td>
                            <td>{$rowDelivery['date']}</td>
                            <td>{$rowDelivery['time']}</td>
                            <td>$" . number_format($rowDelivery['total_price'], 2) . "/-</td>
                          </tr>";
                }

                echo "</tbody></table>";
            }
            else {
                echo  "<script>window.alert('No Update: " . $conn->error . "');</script>";
               
            }
        }
        ?>
    </div>
</div>

</section>
<?php
include 'footer.php';
?>
