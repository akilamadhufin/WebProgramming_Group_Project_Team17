<?php
include 'auth.php';
$title = "Delete My Account";
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
                        $sqlReview = "SELECT * from reginfo WHERE email = '$userEmail'";
                                        
                                        
                        
                        $resultReview = $conn->query($sqlReview);
                        
                        if ($resultReview->num_rows > 0) {
                            echo "<table class='table'>
                                    <thead>
                                        <tr>
                                        <th>ID</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>email</th>
                                        <th>Contact Number</th>
                                        <th>City</th>
                                        <th>City Code</th>
                                        <th>User type</th>
                                        </tr>
                                    </thead>
                                    <tbody>";
                            while ($rowReview = $resultReview->fetch_assoc()) {
                                echo "<tr>
                                <td>{$rowReview['id']}</td>
                                <td>{$rowReview['fname']}</td>
                                <td>{$rowReview['lname']}</td>
                                <td>{$rowReview['email']}</td>
                                <td>{$rowReview['phoneNum']}</td>
                                <td>{$rowReview['city']}</td>
                                <td>{$rowReview['citycode']}</td>
                                <td>{$rowReview['user_type']}</td>
                                </tr>";
                            }
                            echo "</tbody></table>";
                        }
                        ?>
                    </div>      
                </div>
            </section>
            <section id="deleteAccount" style="padding-top: 1px; padding-bottom: 1px;">
                <div class="container">
                    <div class="row">
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="row justify-content-center" name="deleteAccount" method="post">
                            <div class="col-lg-2">
                                <label for="id">Review Id to be deleted:</label>
                            </div>
                            <div class="col-lg-2">
                                <input type="text" class="form-control" id="idtoDelete" name="idtoDelete" required>
                                <p id="idtoDeletError"></p>
                            </div>
                            <div class="col-12 intro-text">
                                <button type="submit" class="btn btn-brand" style="margin-top: 20px;" name="deleteAccount">Delete</button>
                            </div>
                        </form>
                    </div>
                </div>
            </section>

            <?php
            if (isset($_POST['deleteAccount'])) {
                $idToDelete = isset($_POST['idtoDelete']) ? $_POST['idtoDelete'] : '';

                $sqlDelete = "DELETE FROM reginfo WHERE email = '$userEmail' AND id = '$idToDelete'";
                if ($conn->query($sqlDelete) === TRUE) {
                    // Check if any rows were affected
                    if ($conn->affected_rows > 0) {
                        echo "<script>window.alert('Record deleted successfully');</script>";
                        
                        header("Location: loginform.php");
                        exit();

                    } else {
                        echo "<script>window.alert('No records found with the provided ID');</script>";
                    }
                } else {
                    echo "<script>window.alert('Error deleting record. Check your ID');</script>";
                }
            }
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
