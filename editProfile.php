<?php
ob_start();
session_start();
include 'auth.php';
$title = "HOT POT home";
include 'db.php';

if (isset($_SESSION['authenticated']) && $_SESSION['authenticated'] === true) {
    include_once 'regUserHeader.php';
} else {
    include_once 'header.php';
}

$userEmail = $_SESSION['email'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $newEmail = $_POST['newEmail'];
    $newPassword = $_POST['newPassword'];
    $newFname = $_POST['newFname'];
    $newLname = $_POST['newLname'];
    $newcity = $_POST['newcity'];
    $newcitycode = $_POST['newcitycode'];
    $newPhoneNum = $_POST['newPhoneNum'];

    $updateQuery = "UPDATE reginfo SET email = '$newEmail', password = '$newPassword', fname = '$newFname', lname = '$newLname', city = '$newcity', citycode = '$newcitycode', phoneNum = '$newPhoneNum' WHERE email = '$userEmail'";
    $updateResult = $conn->query($updateQuery);
    if ($updateResult) {
        header("Location: myAccount.php");
        exit();
    } else {
        $error_message = "Error updating profile. Please try again.";
    }
}
// getting details for displaying the current information
$sql = "SELECT fname, lname, email, city, citycode, user_type, phoneNum FROM reginfo WHERE email = '$userEmail'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $currentFname = $row['fname'];
    $currentLname = $row['lname'];
    $currentEmail = $row['email'];
    $currentcity = $row['city'];
    $currentcitycode = $row['citycode'];
    $currentPhoneNum = $row['phoneNum'];


} else {
    echo "User details not found.";
    exit();
}
$conn->close();
?>

<section id="editProfile" style="padding-top: 20px; padding-bottom: 120px;">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h2>Your Current Profile Information</h2>
                <table class="table table-bordered">
                    <tr>
                        <th>Email:</th>
                        <td><?php echo $currentEmail; ?></td>
                    </tr>
                    <tr>
                        <th>First Name:</th>
                        <td><?php echo $currentFname; ?></td>
                    </tr>
                    <tr>
                        <th>Last Name:</th>
                        <td><?php echo $currentLname; ?></td>
                    </tr>
                    <tr>
                        <th>City:</th>
                        <td><?php echo $currentcity; ?></td>
                    </tr>
                    <tr>
                        <th>City Code:</th>
                        <td><?php echo $currentcitycode; ?></td>
                    </tr>
                    <tr>
                        <th>Phone Number:</th>
                        <td><?php echo $currentPhoneNum; ?></td>
                    </tr>
                </table>
            </div>
            <div class="col-md-6">
                <h2>Edit Your Profile</h2>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="form-group">
                        <label for="newEmail">New Email:</label>
                        <input type="email" class="form-control" id="newEmail" name="newEmail" required>
                    </div>
                    <div class="form-group">
                        <label for="newPassword">New Password:</label>
                        <input type="password" class="form-control" id="newPassword" name="newPassword" required>
                    </div>
                    <div class="form-group">
                        <label for="newFname">New First Name:</label>
                        <input type="text" class="form-control" id="newFname" name="newFname" required>
                    </div>
                    <div class="form-group">
                        <label for="newLname">New Last Name:</label>
                        <input type="text" class="form-control" id="newLname" name="newLname" required>
                    </div>
                    <div class="form-group">
                        <label for="newcity">New City:</label>
                        <input type="text" class="form-control" id="newcity" name="newcity" required>
                    </div>
                    <div class="form-group">
                        <label for="newcitycode">New city code:</label>
                        <input type="text" class="form-control" id="newcitycode" name="newcitycode" required>
                    </div>
                    <div class="form-group">
                        <label for="newPhoneNum">New Phone Number:</label>
                        <input type="tel" class="form-control" id="newPhoneNum" name="newPhoneNum" required>
                    </div>
                    <div class="divider my-3"></div>
                    <button type="submit" style="padding-top: 20px;" class="btn btn-brand" name="updateProfile">Update Profile</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<?php include 'footer.php'; 
ob_end_flush();
?>
