<?php
include 'auth.php';
$title = "My Reviews";
include 'db.php';
include isset($_SESSION['authenticated']) && $_SESSION['authenticated'] === true ? 'regUserHeader.php' : 'header.php';

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

?>
            
            <section id="myReviews" style="padding-top: 20px; padding-bottom: 120px;" class="bg-light">
                <div class="container">
                    <div class="row">
                        <div class="col-12 intro-text">
                            <h1><?php echo "Welcome, $fname $lname"; ?></h1>
                        </div>
                        <div class="row">
                            <div class="col-12 intro-text">
                                <h1 style="margin-bottom: 20px; color: orange;">Your Review Details</h1>
                                <div class="col-12 intro-text">
                                    <div class="divider my-5"></div>
                                    <h5 style="color:red;">Click on Review Id to edit your reviews.</h5>
                                </div>
                                <?php
                                $userEmail = $_SESSION['email'];
                                $sqlReview = "SELECT * 
                                              FROM customersinfo ci 
                                              JOIN reginfo rg ON rg.email = ci.email 
                                              WHERE rg.email = '$userEmail'";

                                $resultReview = $conn->query($sqlReview);
                                if ($resultReview->num_rows > 0) {
                                    echo "<table class='table'>
                                            <thead>
                                                <tr>
                                                    <th>id</th>
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
                                                <td><a href='editReview.php?id=$rowReview[reviewId]' style='color:red;'>$rowReview[reviewId]</a></td>
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
                        <div class="row">
                            <div class="col-12 intro-text">
                                <h5 style="margin-bottom: 20px; color: red;">Click on below button delete your Reviews</h5>
                            </div>
                            <div class="col-12 intro-text">
                                <a href="deleteReview.php" type="submit" class="btn btn-brand" style="margin-top: 20px;" name="deleteReview">Delete</a>
                            </div>
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