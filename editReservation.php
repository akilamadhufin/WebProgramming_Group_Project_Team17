<?php
include 'auth.php';
$title = "Edit Reservation";
include 'db.php';

include (isset($_SESSION['authenticated']) && $_SESSION['authenticated'] === true) ? 'regUserHeader.php' : 'header.php';
$updateSuccess = false; 
$fname = $lname = $email = $phoneNum =  $phoneNum = $resTime = $numOfPersons = $message = $resDate = '';


if (isset($_GET['id']) || isset($_POST['updateReservation'])) {

    if (isset($_GET['id'])) {
        $reservationId = $_GET['id'];
        $sqlReservation = "SELECT * from reservation WHERE reservationId = '$reservationId'";
        $resultReservation = $conn->query($sqlReservation);
        
    // defining variables
        if ($resultReservation !== false) {
            if ($resultReservation->num_rows > 0) {
                $rowReservation = $resultReservation->fetch_assoc();              
                $reservationId = $rowReservation['reservationId'];
                $fname = $rowReservation['fname'];
                $lname = $rowReservation['lname'];
                $email = $rowReservation['email'];
                $phoneNum = $rowReservation['phoneNum'];
                $resDate = $rowReservation['resDate'];
                $resTime = $rowReservation['resTime'];
                $numOfPersons = $rowReservation['numOfPersons'];
                $message = $rowReservation['message'];
            } else {
                echo "No rows found for Reservation details.";
            }
        } else {
            echo "Query failed: " . $conn->error;
        }
    }
    
    if (isset($_POST['updateReservation'])) {
        $reservationId = $_POST['reservationId'];
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $email = $_POST['email'];
        $phoneNum = $_POST['phoneNum'];
        $resDate = $_POST['resDate'];
        $resTime = $_POST['resTime'];
        $numOfPersons = $_POST['numOfPersons'];
        $message = $_POST['message'];

        // Perform database update here based on the form values
        $sqlupdateReservation = "UPDATE reservation SET
                            fname = '$fname',
                            lname = '$lname',
                            email = '$email',
                            phoneNum = '$phoneNum',
                            resDate = '$resDate',
                            resTime = '$resTime',
                            numOfPersons = '$numOfPersons',
                            message = '$message'
                            WHERE reservationId = '$reservationId'";

    if ($conn->query($sqlupdateReservation) === TRUE) {
        $updateSuccess = true; 
        
        $sqlUpdatedData = "SELECT * from reservation WHERE reservationId = '$reservationId'";
        $resultUpdatedData = $conn->query($sqlUpdatedData);

        if ($resultUpdatedData !== false && $resultUpdatedData->num_rows > 0) {
            $updatedData = $resultUpdatedData->fetch_assoc();
        } else {
            echo "<script>window.alert('Error fetching updated data: " . $conn->error . "');</script>";
        }
    } else {
        echo "<script>window.alert('Error in Update: " . $conn->error . "');</script>";
    }
    }
    }
?>

<section id="editReservation" style="padding-top: 20px; padding-bottom: 120px;" class="bg-light">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h4 style="color:orange;">Edit Reservation Details</h4>
            </div>
        </div>
        <form action="editReservation.php" method="post">
            <input type="hidden" name="reservationId" value="<?php echo $reservationId; ?>">

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
                <label for="email" class="col-sm-4 col-form-label" style="margin-bottom: 10px;">email:</label>
                <div class="col-md-6">
                    <input type="email" class="form-control" name="email" value="<?php echo $email; ?>" required>
                </div>
            </div>

            <div class="form-group row">
                <label for="phoneNum" class="col-sm-4 col-form-label" style="margin-bottom: 10px;">Phone Number:</label>
                <div class="col-md-6">
                    <input type="text" class="form-control" name="phoneNum" value="<?php echo $phoneNum; ?>" required>
                </div>
            </div>

            <div class="form-group row">
                <label for="resDate" class="col-sm-4 col-form-label" style="margin-bottom: 10px;">Date:</label>
                <div class="col-md-6">
                    <input type="date" class="form-control" name="resDate" value="<?php echo $resDate; ?>" required>
                </div>
            </div>

            <div class="form-group row">
                <label for="resTime" class="col-sm-4 col-form-label" style="margin-bottom: 10px;">Time:</label>
                <div class="col-md-6">
                    <input type="time" class="form-control" name="resTime" value="<?php echo $resTime; ?>" required>
                </div>
            </div>

            <div class="form-group row">
                <label for="numOfPersons" class="col-sm-4 col-form-label" style="margin-bottom: 10px;">Num of Persons:</label>
                <div class="col-md-6">
                    <input type="text" class="form-control" name="numOfPersons" value="<?php echo $numOfPersons; ?>" required>
                </div>
            </div>
            
            <div class="form-group row">
                <label for="message" class="col-sm-4 col-form-label" style="margin-bottom: 10px;">Message:</label>
                <div class="col-md-6">
                    <input type="text" class="form-control" name="message" value="<?php echo $message; ?>" required>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-brand" name="updateReservation">Update Reservation</button>
                </div>
            </div>
        </form>
        </section>

        <section id="updatedReservation" style="padding-top: 20px; padding-bottom: 120px;" class="bg-light">
        
        <div class="col-12 intro-text">
        <h4 style="color:orange">Updated Reservation Details:</h4> </div>
        <div class="col-12 intro-text">
        <?php
         if ($updateSuccess && isset($updatedData)) {
           
            // Display the updated data here using updatedData
            
            $userEmail = $_SESSION['email'];
            $sqlReservation = "SELECT rg.id, rv.fname, rv.lname, rv.email, rv.phoneNum, rv.reservationId, rv.resDate, rv.resTime, rv.numOfPersons, rv.message
                FROM reginfo rg
                JOIN reservation rv ON rg.email = rv.email WHERE rg.email = '$userEmail' and reservationId = '$reservationId'";

                $resultReservation = $conn->query($sqlReservation);
                if ($resultReservation->num_rows > 0) {
                echo "<table class='table'>
                    <thead>
                                <tr>
                                <th>Reservation ID</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>email</th>
                                <th>Contact Number</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th># of Persons</th>
                                <th>Message</th>
                                 </tr>
                         </thead>
                        <tbody>";
                 while ($rowReservation = $resultReservation->fetch_assoc()) {
                                            echo "<tr>
                                            <td>{$rowReservation['reservationId']}</td>
                                            <td>{$rowReservation['fname']}</td>
                                            <td>{$rowReservation['lname']}</td>
                                            <td>{$rowReservation['email']}</td>
                                            <td>{$rowReservation['phoneNum']}</td>
                                            <td>{$rowReservation['resDate']}</td>
                                            <td>{$rowReservation['resTime']}</td>
                                            <td>{$rowReservation['numOfPersons']}</td>
                                            <td>{$rowReservation['message']}</td>
                                          
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
