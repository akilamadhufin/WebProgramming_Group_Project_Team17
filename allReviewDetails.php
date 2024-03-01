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

            include isset($_SESSION['authenticated']) && $_SESSION['authenticated'] === true ? 'admin_header.php' : 'header.php';
            ?>
            <section id="reviewData" style="padding-top: 20px; padding-bottom: 20px;" class="bg-light">
                <div class="container">
                    
                <div class="row">
                        <div class="col-12 intro-text">
                            <h1><?php echo "Welcome, $fname $lname"; ?></h1>
                        </div>
                        
                        <div class="col-12 intro-text">
                            <h1 style="margin-bottom: 20px; color: orange;">All Current Reviews</h1>
                        </div>

                        <?php
                                    if (isset($_GET['removeReview'])) {
                                        $remove_id = $_GET['removeReview'];
                                        mysqli_query($conn, "DELETE FROM `customersinfo` WHERE reviewId = '$remove_id'");
                                    }

                                    if (isset($_POST['update_update_btn'])) {
                                        $update_fname = $_POST['update_fname'];
                                        $update_fnameId = $_POST['update_fname_id'];

                                        $update_lname = $_POST['update_lname'];
                                        $update_lnameId = $_POST['update_lname_id'];

                                        $update_phoneNum = $_POST['update_phoneNum'];
                                        $update_phoneNumId = $_POST['update_phoneNum_id'];

                                        $update_addStar = $_POST['update_addStar'];
                                        $update_addStarId = $_POST['update_addStar_id'];

                                        $updateadditionalComment = $_POST['updateadditionalComment'];
                                        $updateadditionalCommentId = $_POST['updateadditionalComment_id'];

                                        $update_fname_query = mysqli_query($conn, "UPDATE `customersinfo` SET fname = '$update_fname' WHERE reviewId = '$update_fnameId'");                                     
                                        $update_lname_query = mysqli_query($conn, "UPDATE `customersinfo` SET lname = '$update_lname' WHERE reviewId = '$update_lnameId'");
                                        $update_phoneNum_query = mysqli_query($conn, "UPDATE `customersinfo` SET phoneNum = '$update_phoneNum' WHERE reviewId = '$update_phoneNumId'");
                                        $update_addStar_query = mysqli_query($conn, "UPDATE `customersinfo` SET addStar = '$update_addStar' WHERE reviewId = '$update_addStarId'");
                                        $updateadditionalComment_query = mysqli_query($conn, "UPDATE `customersinfo` SET additionalComment = '$updateadditionalComment' WHERE reviewId = '$updateadditionalCommentId'");
                                       

                                    }               
                                    if (isset($_GET['delete_all'])) {
                                        mysqli_query($conn, "DELETE FROM `customersinfo`");
                                        //  header('location:cart.php');
                                    }
                                    ?>
                                        <div class="container" style="text-align: center;">
                                        <table class="table" style="width: 80%; text-align: center; margin: 0 auto; font-size: 13px;">
                                            <thead style="background-color: darkorange; color: white; padding: 1.5rem; font-size: 16px; margin-bottom: 10px; border: 1px solid #ddd;">
                                                <th style="border: 1px solid #ddd">Review ID</th>
                                                <th style="border: 1px solid #ddd">First Name</th>
                                                <th style="border: 1px solid #ddd">Last Name</th>
                                                <th style="border: 1px solid #ddd">Email</th>
                                                <th style="border: 1px solid #ddd">Contact Number</th>                                  
                                                <th style="border: 1px solid #ddd">Rating</th>
                                                <th style="border: 1px solid #ddd">Comments</th>                                            
                                                <th></th>
                                                <th></th>
                                            </thead>
                                            <tbody style="border: 1px solid #ddd;">
                                                <?php
                                                $review_query = mysqli_query($conn, "SELECT * FROM `customersinfo`");
                                    
                                                if (mysqli_num_rows($review_query) > 0) {
                                                    while ($review = mysqli_fetch_assoc($review_query)) {
                                                        ?>
                                                        <tr><form action="" method="post">
                                                            <td style="border: 1px solid #ddd";><?php echo $review['reviewId']; ?></td>

                                                            <td style="border: 1px solid #ddd;"> <input type="hidden" name="update_fname_id" value="<?php echo $review['reviewId']; ?>">
                                                            <input type="text" name="update_fname" style="width: 4rem;" min="1" value="<?php echo $review['fname']; ?>">
                                                            </td>                                                           

                                                            <td style="border: 1px solid #ddd"> <input type="hidden" name="update_lname_id" value="<?php echo $review['reviewId']; ?>">
                                                            <input type="text" name="update_lname" style="width: 4rem;" min="1" value="<?php echo $review['lname']; ?>">
                                                            </td>

                                                            <td style="border: 1px solid #ddd"><?php echo $review['email']; ?></td>

                                                            <td style="border: 1px solid #ddd"> <input type="hidden" name="update_phoneNum_id" value="<?php echo $review['reviewId']; ?>">
                                                            <input type="text" name="update_phoneNum" style="width: 4rem;" min="1" value="<?php echo $review['phoneNum']; ?>">
                                                            </td>
                                                                                                                   
                                                            <td style="border: 1px solid #ddd">
                                                            <input type="hidden" name="update_addStar_id" value="<?php echo $review['reviewId']; ?>">
                                                            <input type="date" name="update_addStar" style="width: 4rem;" min="1" value="<?php echo $review['addStar']; ?>">
                                                            </td>
                                                                                                         
                                                            <td style="border: 1px solid #ddd"> <input type="hidden" name="updateadditionalComment_id" value="<?php echo $review['reviewId']; ?>">
                                                            <input type="text" name="updateadditionalComment" style="width: 4rem;" min="1" value="<?php echo $review['additionalComment']; ?>">
                                                            </td>

                                                            <td style="border: 1px solid #ddd"><input type="submit" value="update" name="update_update_btn" class="btn btn-brand" style="background-color: darkgreen; font-size: 12px;"> <i class="fas fa-trash"></i></td>                                                         
                                                            <td style="border: 1px solid #ddd"><a href="allReviewDetails.php?removeReview=<?php echo $review['reviewId']; ?>" onclick="return confirm('Cancel this review?')" class="btn btn-brand" style="background-color: maroon;font-size: 12px;"> <i class="fas fa-trash"></i> Cancel</a></td>
                                                            </form>

                                                           
                                            </tr>
                                        <?php
                                        }
                                    }
                                    ?>
                                    <tr>                                           
                                    <td colspan="14"><a href="allReviewDetails.php?delete_all" onclick="return confirm('Are you sure you want to delete all?');" class="btn btn-brand" style="background-color: red; color: white; font-size: 14px;"> <i class="fas fa-trash"></i> Delete All </a></td>
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
