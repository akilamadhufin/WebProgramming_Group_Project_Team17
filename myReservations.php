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
                            <h1><?php echo "Welcome, $fname $lname"; ?></h1>
                        </div>
                        
                        <div class="col-12 intro-text">
                            <h1 style="margin-bottom: 20px; color: orange;">Your Current Reservations</h1>
                        </div>

                        <?php
                                    if (isset($_GET['removeReservation'])) {
                                        $remove_id = $_GET['removeReservation'];
                                        mysqli_query($conn, "DELETE FROM `reservation` WHERE reservationId = '$remove_id'");
                                    }
                                    ?>
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

                                ?>
                                <tr>
                                <td><?php echo $rowReservation['reservationId']; ?></td>
                                <td><?php echo $rowReservation['fname']; ?></td>
                                <td><?php echo $rowReservation['lname']; ?></td>
                                <td><?php echo $rowReservation['email']; ?></td>
                                <td><?php echo $rowReservation['phoneNum']; ?></td>
                                <td><?php echo $rowReservation['resDate']; ?></td>
                                <td><?php echo $rowReservation['resTime']; ?></td>
                                <td><?php echo $rowReservation['numOfPersons']; ?></td>
                                <td><?php echo $rowReservation['message']; ?></td>
                                <td><a href="editReservation.php?id=<?php echo $rowReservation['reservationId']; ?>" onclick="return confirm('Edit this Reservation?')" class="btn btn-brand" style="background-color: darkgreen;"> <i class="fas fa-trash"></i> Edit</a></td>
                                <td><a href="myReservations.php?removeReservation=<?php echo $rowReservation['reservationId']; ?>" onclick="return confirm('Cancel this Reservation?')" class="btn btn-brand" style="background-color: maroon;"> <i class="fas fa-trash"></i> Cancel</a></td>                           
                                </tr>

                            <?php
                            }
                            echo "</tbody></table>";
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
