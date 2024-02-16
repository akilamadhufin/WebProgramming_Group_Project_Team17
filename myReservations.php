<?php
include 'auth.php';
$title = "Delete My Reservations";
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
            <section id="reservationData" style="padding-top: 20px; padding-bottom: 20px;" class="bg-light">
                <div class="container">
                    
                    <div class="row">
                        <div class="col-12 intro-text">
                            <h1 style="margin-bottom: 20px; color: orange;">Your Current Reservations</h1>
                        </div>
                        <?php
                        $userEmail = $_SESSION['email'];
                        $sqlReservation = "SELECT rv.*, rg.id
                                        FROM reservation rv 
                                        JOIN reginfo rg ON rg.email = rv.email 
                                        WHERE rv.email = '$userEmail'";
                        
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
                                <td>$rowReservation[reservationId]</td>
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
                        ?>
                    </div>      
                </div>
            </section>
            <section id="deleteReservation" style="padding-top: 1px; padding-bottom: 1px;">
                <div class="container">
                    <div class="row">
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="row justify-content-center" name="deleteReservation" method="post">
                            <div class="col-lg-2">
                                <label for="reservationId">Reservation Id to be deleted:</label>
                            </div>
                            <div class="col-lg-2">
                                <input type="text" class="form-control" id="reservationIdtoDelete" name="reservationIdtoDelete" required>
                                <p id="reservationIdtoDeletError"></p>
                            </div>
                            <div class="col-12 intro-text">
                                <button type="submit" class="btn btn-brand" style="margin-top: 20px;" name="deleteReservation">Delete</button>
                            </div>
                        </form>
                    </div>
                </div>
            </section>

            <?php
            if (isset($_POST['deleteReservation'])) {
                $reservationIdToDelete = isset($_POST['reservationIdtoDelete']) ? $_POST['reservationIdtoDelete'] : '';

                $sqlDelete = "DELETE FROM reservation WHERE email = '$userEmail' AND reservationId = '$reservationIdToDelete'";
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

            <section id="deleteReservation" style="padding-top: 1px; padding-bottom: 20px;" class="bg-light">
                <div class="container">
                    <div class="row">
                        <div class="col-12 intro-text">
                            <h1 style="margin-bottom: 20px; color: orange;">Your Updated Reservation Details</h1>
                        </div>
                        <?php
                        $userEmail = $_SESSION['email'];
                        $sqlUpdatedReservation = "SELECT rv.*, rg.id
                                            FROM reservation rv 
                                            JOIN reginfo rg ON rg.email = rv.email 
                                            WHERE rv.email = '$userEmail'";
                        $resultUpdatedReservation = $conn->query($sqlUpdatedReservation);
                        
                        if ($resultUpdatedReservation->num_rows > 0) {
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
                            while ($rowReservation = $resultUpdatedReservation->fetch_assoc()) {
                                echo "<tr>
                                <td>$rowReservation[reservationId]</td>
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
                        } else {
                            echo "No updated Reservation details found.";
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
