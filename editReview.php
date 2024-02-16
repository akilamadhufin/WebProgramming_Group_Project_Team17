<?php
include 'auth.php';
$title = "Edit Review";
include 'db.php';

include (isset($_SESSION['authenticated']) && $_SESSION['authenticated'] === true) ? 'regUserHeader.php' : 'header.php';
$updateSuccess = false;
$fname = $lname = $email = $phoneNum = $addStar =  $additionalComment = '';


if (isset($_GET['id']) || isset($_POST['updateReview'])) {

    if (isset($_GET['id'])) {
        $reviewId = $_GET['id'];
        $sqlReview = "SELECT * from customersinfo WHERE reviewId = '$reviewId'";
        $resultReview = $conn->query($sqlReview);
        
    // defining variables
        if ($resultReview !== false) {
            if ($resultReview->num_rows > 0) {
                $rowReview = $resultReview->fetch_assoc();              
                $reviewId = $rowReview['reviewId'];
                $fname = $rowReview['fname'];
                $lname = $rowReview['lname'];
                $email = $rowReview['email'];
                $phoneNum = $rowReview['phoneNum'];
                $addStar = $rowReview['addStar'];
                $additionalComment = $rowReview['additionalComment'];
            } else {
                echo "No rows found for review details.";
            }
        } else {
            echo "Query failed: " . $conn->error;
        }
    }
    
    if (isset($_POST['updateReview'])) {
        $reviewId = $_POST['reviewId'];
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $email = $_POST['email'];
        $phoneNum = $_POST['phoneNum'];
        $addStar = $_POST['addStar'];
        $additionalComment = $_POST['additionalComment'];

        // Perform database update here based on the form values
        $sqlUpdateReview = "UPDATE customersinfo SET
                            fname = '$fname',
                            lname = '$lname',
                            email = '$email',
                            phoneNum = '$phoneNum',
                            addStar = '$addStar',
                            additionalComment = '$additionalComment'
                            WHERE reviewId = '$reviewId'";

    if ($conn->query($sqlUpdateReview) === TRUE) {
        $updateSuccess = true; 
        
        $sqlUpdatedData = "SELECT * from customersinfo WHERE reviewId = '$reviewId'";
        $resultUpdatedData = $conn->query($sqlUpdatedData);

        if ($resultUpdatedData !== false && $resultUpdatedData->num_rows > 0) {
            $updatedData = $resultUpdatedData->fetch_assoc();
        } else {
            echo "Error fetching updated data: " . $conn->error;
        }
    } else {
        echo "<script>window.alert('Error in Update: " . $conn->error . "');</script>";
    }
    }
    }
?>

<section id="editReview" style="padding-top: 20px; padding-bottom: 120px;" class="bg-light">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h4 style="color:orange;">Edit Review Details</h4>
            </div>
        </div>
        <form action="editReview.php" method="post">
            <input type="hidden" name="reviewId" value="<?php echo $reviewId; ?>">

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
                <label for="addStar" class="col-sm-4 col-form-label" style="margin-bottom: 20px;">Ratings:</label>
                <div class="col-md-6">
                <select class="form-control" id="addStar" name="addStar" required>
                        <option value="" disabled selected>Select Rating</option>
                        <option value="☆☆☆☆☆">☆☆☆☆☆</option>
                        <option value="☆☆☆☆★">☆☆☆☆★</option>
                        <option value="☆☆☆★★">☆☆☆★★</option>
                        <option value="☆☆★★★">☆☆★★★</option>
                        <option value="☆★★★★">☆★★★★</option>
                        <option value="★★★★★">★★★★★</option>
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label for="additionalComment" class="col-sm-4 col-form-label" style="margin-bottom: 10px;">Comment:</label>
                <div class="col-md-6">
                    <input type="text" class="form-control" name="additionalComment" value="<?php echo $additionalComment; ?>" required>
                </div>
            </div>

           
            <div class="form-group row">
                <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-brand" name="updateReview">Update Review</button>
                </div>
            </div>
        </form>
        </section>

        <section id="updatedReview" style="padding-top: 20px; padding-bottom: 120px;" class="bg-light">
        
        <div class="col-12 intro-text">
        <h4 style="color:orange">Updated Review Details:</h4> </div>
        <div class="col-12 intro-text">
        <?php
         if ($updateSuccess && isset($updatedData)) {
           
            // Display the updated data here using updatedData
            
            $userEmail = $_SESSION['email'];
            $sqlReview = "SELECT rg.id, cs.fname, cs.lname, cs.email, cs.phoneNum, cs.reviewId, cs.addStar, cs.additionalComment
                FROM reginfo rg
                JOIN customersinfo cs ON rg.email = cs.email WHERE rg.email = '$userEmail' and reviewId = '$reviewId'";

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
    }
        ?>
    </div>
</div>

</section>
<?php
include 'footer.php';
?>
