<?php
include 'auth.php';
$title = "My Reviews";
include 'db.php';

include (isset($_SESSION['authenticated']) && $_SESSION['authenticated'] === true) ? 'regUserHeader.php' : 'header.php';

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

                                <?php
                                if (isset($_GET['removeReview'])) {
                                    $remove_id = $_GET['removeReview'];
                                    mysqli_query($conn, "DELETE FROM `customersinfo` WHERE reviewId = '$remove_id'");
                                }
                                ?>
                                <?php
                                $userEmail = $_SESSION['email'];
                                $sqlReview = "SELECT * 
                                              FROM customersinfo ci 
                                              JOIN reginfo rg ON rg.email = ci.email 
                                              WHERE rg.email = '$userEmail'";

                                $resultReview = $conn->query($sqlReview);
                              
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
                                                    <th></th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>";
                                               
                                            if ($resultReview->num_rows > 0) {
                                                    while ($rowReview = mysqli_fetch_assoc($resultReview)) {
                                                        ?>
                                                        <tr>
                                                            <td><?php echo $rowReview['reviewId']; ?></td>
                                                            <td><?php echo $rowReview['fname']; ?></td>
                                                            <td><?php echo $rowReview['lname']; ?></td>
                                                            <td><?php echo $rowReview['email']; ?></td>                                          
                                                            <td><?php echo $rowReview['phoneNum']; ?></td>
                                                            <td><?php echo $rowReview['addStar']; ?></td>
                                                            <td><?php echo $rowReview['additionalComment']; ?></td>
                                                            <td><a href="editReview.php?id=<?php echo $rowReview['reviewId']; ?>" onclick="return confirm('Edit this review?')" class="btn btn-brand" style="background-color: darkgreen;"> <i class="fas fa-trash"></i> Edit</a></td>
                                                            <td><a href="myReview.php?removeReview=<?php echo $rowReview['reviewId']; ?>" onclick="return confirm('Cancel this review?')" class="btn btn-brand" style="background-color: maroon;"> <i class="fas fa-trash"></i> Cancel</a></td>

                                                        </tr>
                                                <?php
                                                    }
                                                } else {
                                                    echo "<tr><td colspan='7'>No reviews available.</td></tr>";
                                                }
                                                ?>
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
