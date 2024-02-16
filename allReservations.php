<?php
$title = "HOT POT Reservation Info";
include 'auth.php';
include 'admin_header.php';

include 'db.php';
?>
            <section id="allReservation" style="padding-top: 20px; padding-bottom: 120px;" class="bg-light">
                <div class="container">    
                        <div class="row">
                            <div class="col-12 intro-text">
                                <h1 style="margin-bottom: 20px; color: orange;">Reservation Details</h1>
                                <div class="col-12 intro-text">
                                <?php
                               
                                $sqlReservation = "SELECT * 
                                              FROM reservation ri 
                                              JOIN reginfo rg ON rg.email = ri.email ";
                                             

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
                                                <td>{$rowReservation['reservationId']}</a></td>
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
                </div>
            </section>
            <?php
// Close the database connection
$conn->close();
include 'footer.php';
?>