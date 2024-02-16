<?php
include 'auth.php';
$title = "Delete My Reviews";
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
            <section id="reviewData" style="padding-top: 20px; padding-bottom: 20px;" class="bg-light">
                <div class="container">
                    
                    <div class="row">
                        <div class="col-12 intro-text">
                            <h1 style="margin-bottom: 20px; color: orange;">Your Current Reviews</h1>
                        </div>
                        <?php
                        $userEmail = $_SESSION['email'];
                        $sqlReview = "SELECT cs.*, rg.id
                                        FROM customersinfo cs 
                                        JOIN reginfo rg ON rg.email = cs.email 
                                        WHERE cs.email = '$userEmail'";
                        
                        $resultReview = $conn->query($sqlReview);
                        
                        if ($resultReview->num_rows > 0) {
                            echo "<table class='table'>
                                    <thead>
                                        <tr>
                                        <th>Review ID</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>email</th>
                                        <th>Contact Number</th>
                                        <th>Rating</th>
                                        <th>Comments</th>
                                        </tr>
                                    </thead>
                                    <tbody>";
                            while ($rowReview = $resultReview->fetch_assoc()) {
                                echo "<tr>
                                <td>{$rowReview['reviewId']}</td>
                                <td>{$rowReview['fname']}</td>
                                <td>{$rowReview['lname']}</td>
                                <td>{$rowReview['email']}</td>
                                <td>{$rowReview['phoneNum']}</td>
                                <td>{$rowReview['addStar']}</td>
                                <td>{$rowReview['additionalComment']}</td>
                                </tr>";
                            }
                            echo "</tbody></table>";
                        }
                        ?>
                    </div>      
                </div>
            </section>
            <section id="deleteReview" style="padding-top: 1px; padding-bottom: 1px;">
                <div class="container">
                    <div class="row">
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="row justify-content-center" name="deleteReview" method="post">
                            <div class="col-lg-2">
                                <label for="reviewId">Review Id to be deleted:</label>
                            </div>
                            <div class="col-lg-2">
                                <input type="text" class="form-control" id="reviewIdtoDelete" name="reviewIdtoDelete" required>
                                <p id="reviewIdtoDeletError"></p>
                            </div>
                            <div class="col-12 intro-text">
                                <button type="submit" class="btn btn-brand" style="margin-top: 20px;" name="deleteReview">Delete</button>
                            </div>
                        </form>
                    </div>
                </div>
            </section>

            <?php
            if (isset($_POST['deleteReview'])) {
                $reviewIdToDelete = isset($_POST['reviewIdtoDelete']) ? $_POST['reviewIdtoDelete'] : '';

                $sqlDelete = "DELETE FROM customersinfo WHERE email = '$userEmail' AND reviewId = '$reviewIdToDelete'";
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

            <section id="deleteReview" style="padding-top: 1px; padding-bottom: 20px;" class="bg-light">
                <div class="container">
                    <div class="row">
                        <div class="col-12 intro-text">
                            <h1 style="margin-bottom: 20px; color: orange;">Your Updated Review Details</h1>
                        </div>
                        <?php
                        $userEmail = $_SESSION['email'];
                        $sqlUpdatedReview = "SELECT cs.*, rg.id
                                            FROM customersinfo cs 
                                            JOIN reginfo rg ON rg.email = cs.email 
                                            WHERE cs.email = '$userEmail'";
                        $resultUpdatedReview = $conn->query($sqlUpdatedReview);
                        
                        if ($resultUpdatedReview->num_rows > 0) {
                            echo "<table class='table'>
                                    <thead>
                                        <tr>
                                        <th>Review ID</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>email</th>
                                        <th>Contact Number</th>
                                        <th>Rating</th>
                                        <th>Comments</th>
                                        </tr>
                                    </thead>
                                    <tbody>";
                            while ($rowReview = $resultUpdatedReview->fetch_assoc()) {
                                echo "<tr>
                                <td>{$rowReview['reviewId']}</td>
                                <td>{$rowReview['fname']}</td>
                                <td>{$rowReview['lname']}</td>
                                <td>{$rowReview['email']}</td>
                                <td>{$rowReview['phoneNum']}</td>
                                <td>{$rowReview['addStar']}</td>
                                <td>{$rowReview['additionalComment']}</td>
                                    </tr>";
                            }
                            echo "</tbody></table>";
                        } else {
                            echo "No updated review details found.";
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
