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

            include isset($_SESSION['authenticated']) && $_SESSION['authenticated'] === true ? 'admin_header.php' : 'header.php';
            ?>
            <section id="reservationData" style="padding-top: 20px; padding-bottom: 20px;" class="bg-light">
                <div class="container">
                    
                <div class="row">
                        <div class="col-12 intro-text">
                            <h1><?php echo "Welcome, $fname $lname"; ?></h1>
                        </div>
                        
                        <div class="col-12 intro-text">
                            <h1 style="margin-bottom: 20px; color: orange;">All Current Reservations</h1>
                        </div>

                        <?php
                                    if (isset($_GET['removeReservation'])) {
                                        $remove_id = $_GET['removeReservation'];
                                        mysqli_query($conn, "DELETE FROM `reservation` WHERE reservationId = '$remove_id'");
                                    }

                                    if (isset($_POST['update_update_btn'])) {
                                        $update_fname = $_POST['update_fname'];
                                        $update_fnameId = $_POST['update_fname_id'];

                                        $update_lname = $_POST['update_lname'];
                                        $update_lnameId = $_POST['update_lname_id'];

                                        $update_phoneNum = $_POST['update_phoneNum'];
                                        $update_phoneNumId = $_POST['update_phoneNum_id'];

                                        $update_resDate = $_POST['update_resDate'];
                                        $update_resDateId = $_POST['update_resDate_id'];

                                        $update_resTime = $_POST['update_resTime'];
                                        $update_resTimeId = $_POST['update_resTime_id'];

                                        $update_numOfPersons = $_POST['update_numOfPersons'];
                                        $update_numOfPersonsId = $_POST['update_numOfPersons_id'];

                                        $update_message = $_POST['update_message'];
                                        $update_messageId = $_POST['update_message_id'];

                                        $update_fname_query = mysqli_query($conn, "UPDATE `reservation` SET fname = '$update_fname' WHERE reservationId = '$update_fnameId'");                                     
                                        $update_lname_query = mysqli_query($conn, "UPDATE `reservation` SET lname = '$update_lname' WHERE reservationId = '$update_lnameId'");
                                        $update_phoneNum_query = mysqli_query($conn, "UPDATE `reservation` SET phoneNum = '$update_phoneNum' WHERE reservationId = '$update_phoneNumId'");
                                        $update_resTime_query = mysqli_query($conn, "UPDATE `reservation` SET resTime = '$update_resTime' WHERE reservationId = '$update_resTimeId'");
                                        $update_resDate_query = mysqli_query($conn, "UPDATE `reservation` SET resDate = '$update_resDate' WHERE reservationId = '$update_resDateId'");
                                        $update_numOfPersons_query = mysqli_query($conn, "UPDATE `reservation` SET numOfPersons = '$update_numOfPersons' WHERE reservationId = '$update_numOfPersonsId'");
                                        $update_message_query = mysqli_query($conn, "UPDATE `reservation` SET message = '$update_message' WHERE reservationId = '$update_messageId'");
                                       

                                    }               
                                    if (isset($_GET['delete_all'])) {
                                        mysqli_query($conn, "DELETE FROM `reservation`");
                                        //  header('location:cart.php');
                                    }
                                    ?>
                                        <div class="container" style="text-align: center;">
                                        <table class="table" style="width: 80%; text-align: center; margin: 0 auto; font-size: 13px;">
                                            <thead style="background-color: darkorange; color: white; padding: 1.5rem; font-size: 16px; margin-bottom: 10px; border: 1px solid #ddd;">
                                                <th style="border: 1px solid #ddd">Reservation ID</th>
                                                <th style="border: 1px solid #ddd">First Name</th>
                                                <th style="border: 1px solid #ddd">Last Name</th>
                                                <th style="border: 1px solid #ddd">Email</th>
                                                <th style="border: 1px solid #ddd">Contact Number</th>                                  
                                                <th style="border: 1px solid #ddd">Date</th>
                                                <th style="border: 1px solid #ddd">Time</th>
                                                <th style="border: 1px solid #ddd"># of Persons</th>
                                                <th style="border: 1px solid #ddd">Message</th>
                                                <th></th>
                                                <th></th>
                                            </thead>
                                            <tbody style="border: 1px solid #ddd;">
                                                <?php
                                                $reservation_query = mysqli_query($conn, "SELECT * FROM `reservation`");
                                    
                                                if (mysqli_num_rows($reservation_query) > 0) {
                                                    while ($reservation = mysqli_fetch_assoc($reservation_query)) {
                                                        ?>
                                                        <tr><form action="" method="post">
                                                            <td style="border: 1px solid #ddd";><?php echo $reservation['reservationId']; ?></td>

                                                            <td style="border: 1px solid #ddd;"> <input type="hidden" name="update_fname_id" value="<?php echo $reservation['reservationId']; ?>">
                                                            <input type="text" name="update_fname" style="width: 4rem;" min="1" value="<?php echo $reservation['fname']; ?>">
                                                            </td>                                                           

                                                            <td style="border: 1px solid #ddd"> <input type="hidden" name="update_lname_id" value="<?php echo $reservation['reservationId']; ?>">
                                                            <input type="text" name="update_lname" style="width: 4rem;" min="1" value="<?php echo $reservation['lname']; ?>">
                                                            </td>

                                                            <td style="border: 1px solid #ddd"><?php echo $reservation['email']; ?></td>

                                                            <td style="border: 1px solid #ddd"> <input type="hidden" name="update_phoneNum_id" value="<?php echo $reservation['reservationId']; ?>">
                                                            <input type="text" name="update_phoneNum" style="width: 4rem;" min="1" value="<?php echo $reservation['phoneNum']; ?>">
                                                            </td>
                                                                                                                   
                                                            <td style="border: 1px solid #ddd">
                                                            <input type="hidden" name="update_resDate_id" value="<?php echo $reservation['reservationId']; ?>">
                                                            <input type="date" name="update_resDate" style="width: 4rem;" min="1" value="<?php echo $reservation['resDate']; ?>">
                                                            </td>
                                                             
                                                            <td style="border: 1px solid #ddd">
                                                            <input type="hidden" name="update_resTime_id" value="<?php echo $reservation['reservationId']; ?>">
                                                            <input type="time" name="update_resTime" style="width: 4rem;" min="1" value="<?php echo $reservation['resTime']; ?>">                                                          
                                                            </td>

                                                            <td style="border: 1px solid #ddd"> <input type="hidden" name="update_numOfPersons_id" value="<?php echo $reservation['reservationId']; ?>">
                                                            <input type="number" name="update_numOfPersons" style="width: 4rem;" min="1" value="<?php echo $reservation['numOfPersons']; ?>">
                                                            </td>

                                                            <td style="border: 1px solid #ddd"> <input type="hidden" name="update_message_id" value="<?php echo $reservation['reservationId']; ?>">
                                                            <input type="text" name="update_message" style="width: 4rem;" min="1" value="<?php echo $reservation['message']; ?>">
                                                            </td>

                                                            <td style="border: 1px solid #ddd"><input type="submit" value="update" name="update_update_btn" class="btn btn-brand" style="background-color: darkgreen; font-size: 12px;"> <i class="fas fa-trash"></i></td>                                                         
                                                            <td style="border: 1px solid #ddd"><a href="allReservations.php?removeReservation=<?php echo $reservation['reservationId']; ?>" onclick="return confirm('Cancel this reservation?')" class="btn btn-brand" style="background-color: maroon;font-size: 12px;"> <i class="fas fa-trash"></i> Cancel</a></td>
                                                            </form>

                                                            
                                            </tr>
                                        <?php
                                        }
                                    }
                                    ?>
                                    <tr>                                           
                                        <td colspan="14"><a href="allReservations.php?delete_all" onclick="return confirm('Are you sure you want to delete all?');" class="btn btn-brand" style="background-color: red; color: white; font-size: 14px;"> <i class="fas fa-trash"></i> Delete All </a></td>
                                    </tr>
                                </tbody>
                            </table>
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
