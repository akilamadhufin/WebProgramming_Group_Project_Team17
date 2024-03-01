<?php
include 'auth.php';
$title = "HOT POT home";
include 'db.php';
include isset($_SESSION['authenticated']) && $_SESSION['authenticated'] === true ? 'regUserHeader.php' : 'header.php';
?>

<?php
if (isset($_SESSION['authenticated']) && $_SESSION['authenticated'] === true) {
    // If the user is authenticated, fetch user details from the database
    if (isset($_SESSION['email'])) {
        $userEmail = $_SESSION['email'];

        $sql = "SELECT id, fname, lname, email, phoneNum, city, citycode, user_type FROM reginfo WHERE email = '$userEmail'";
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
           
<section id="myAccount" style="padding-top: 20px; padding-bottom: 120px;" class="bg-light">
    <div class="container">
          <div class="row">
            <div class="col-12 intro-text">
            <h1><?php echo "Welcome, $fname $lname"; ?></h1>
              
            </div>
            <h4 style = "padding-top: 20px; padding-bottom: 30px;" class="myAccount text-center">You can review your account details.</h4>
          </div>
        </div>
          <div class="container">
                <div class="row">
                    <div class="col-8 intro-text">
                    <h1 style="margin-bottom: 20px; color: orange;">Your Account Details</h1>
                        <table class="table table-bordered table-hover table-sm">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Details</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-left">Customer ID</td>
                                    <td class="text-left"><?php echo $customerId; ?></td>
                                </tr>
                                <tr>
                                    <td class="text-left">First Name</td>
                                    <td class="text-left"><?php echo $fname; ?></td>
                                </tr>
                                <tr>
                                    <td class="text-left">Last Name</td>
                                    <td class="text-left"><?php echo $lname; ?></td>
                                </tr>
                                <tr>
                                    <td class="text-left">Email</td>
                                    <td class="text-left"><?php echo $userEmail; ?></td>
                                </tr>
                                <tr>
                                    <td class="text-left">Phone Number</td>
                                    <td class="text-left"><?php echo $phoneNum; ?></td>
                                </tr>
                                <tr>
                                    <td class="text-left">City</td>
                                    <td class="text-left"><?php echo $city; ?></td>
                                </tr>
                                <tr>
                                    <td class="text-left">Citycode</td>
                                    <td class="text-left"><?php echo $citycode; ?></td>
                                </tr>


                            </tbody>
                        </table>                       
                    </div>
                    <div class="col-4 intro-text">
                <div class="divider my-5"></div>
                <a href="editProfile.php" class="btn btn-brand" style="margin-top: 20px;">Edit Profile</a>
                <a href="deleteAccount.php" type="submit" class="btn btn-brand" style="margin-top: 20px;" name="delete">Delete Account</a>
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
        echo "Debug: User email not set."; // Debug statement
    }
} else {
    echo "Debug: User not authenticated."; // Debug statement
}

// Close the database connection
$conn->close();
include 'footer.php';
?>
