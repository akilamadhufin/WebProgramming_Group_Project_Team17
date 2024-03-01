<?php
include 'auth.php';
$title = "All Orders";
include 'db.php';
include isset($_SESSION['authenticated']) && $_SESSION['authenticated'] === true ? 'admin_header.php' : 'header.php';

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
            <section id="myOrder" style="padding-top: 20px; padding-bottom: 120px;" class="bg-light">
                <div class="container">
                    <div class="row">
                    <div class="col-12 intro-text">
                            <h1><?php echo "Welcome, $fname $lname"; ?></h1>
                        </div>
                    </div>
                </div>
                    <div class="tab-content" id="pills-tabContent">
                            <div class="row"></div>
                            <div class="row">
                                <div class="col-12 intro-text">
                                    <h1 style="margin-bottom: 20px; color: orange;">All User Details</h1>
                                    <?php
                                    if (isset($_GET['removeUser'])) {
                                        $remove_id = $_GET['removeUser'];
                                        mysqli_query($conn, "DELETE FROM `reginfo` WHERE id = '$remove_id'");
                                        
                                    }

                                    if (isset($_POST['update_update_btn'])) {

                                        $update_fname = $_POST['update_fname'];
                                        $update_fnameId = $_POST['update_fname_id'];

                                        $update_lname = $_POST['update_lname'];
                                        $update_lnameId = $_POST['update_lname_id'];

                                        $update_phoneNum = $_POST['update_phoneNum'];
                                        $update_phoneNumId = $_POST['update_phoneNum_id'];

                                        $update_email = $_POST['update_email'];
                                        $update_emailId = $_POST['update_email_id'];

                                        $update_city = $_POST['update_city'];
                                        $update_cityId = $_POST['update_city_id'];
                                      
                                        $update_password = $_POST['update_password'];
                                        $update_passwordId = $_POST['update_password_id'];

                                        $update_citycode = $_POST['update_citycode'];
                                        $update_citycodeId = $_POST['update_citycode_id'];


                         
                                        $update_fname_query = mysqli_query($conn, "UPDATE `reginfo` SET fname = '$update_fname' WHERE id = '$update_fnameId'");
                                        $update_lname_query = mysqli_query($conn, "UPDATE `reginfo` SET lname = '$update_lname' WHERE id = '$update_lnameId'");
                                        $update_email_query = mysqli_query($conn, "UPDATE `reginfo` SET email = '$update_email' WHERE id = '$update_emailId'");
                                        $update_phoneNum_query = mysqli_query($conn, "UPDATE `reginfo` SET phoneNum = '$update_phoneNum' WHERE id = '$update_phoneNumId'");
                                        $update_city_query = mysqli_query($conn, "UPDATE `reginfo` SET city = '$update_city' WHERE id = '$update_cityId'");                                 
                                        $update_password_query = mysqli_query($conn, "UPDATE `reginfo` SET password = '$update_password' WHERE id = '$update_passwordId'");
                                        $update_citycode_query = mysqli_query($conn, "UPDATE `reginfo` SET citycode = '$update_citycode' WHERE id = '$update_citycodeId'");

                                    }       
                                    if (isset($_GET['delete_all'])) {
                                        mysqli_query($conn, "DELETE FROM `reginfo`");
                                     
                                    }        
                                    
                        ?>
                                
                                    <div class="container" style="text-align: center;">
                                        <table class="table" style="width: 80%; text-align: center; margin: 0 auto; font-size: 13px;">
                                            <thead style="background-color: darkorange; color: white; padding: 1.5rem; font-size: 16px; margin-bottom: 10px; border: 1px solid #ddd;">
                                                <th style="border: 1px solid #ddd">ID</th>                                            
                                                <th style="border: 1px solid #ddd">First Name</th>
                                                <th style="border: 1px solid #ddd">Last Name</th>
                                                <th style="border: 1px solid #ddd">Email</th>
                                                <th style="border: 1px solid #ddd">Phone Num</th>       
                                                <th style="border: 1px solid #ddd">City</th>
                                                <th style="border: 1px solid #ddd">citycode</th>
                                                <th style="border: 1px solid #ddd">user_type</th>
                                                <th style="border: 1px solid #ddd">password</th>
                                                <th></th>
                                                <th></th>
                                            </thead>
                                            <tbody style="border: 1px solid #ddd;">
                                                <?php
                                                $user_query = mysqli_query($conn, "SELECT * FROM `reginfo`");
                                              
                                                if (mysqli_num_rows($user_query) > 0) {
                                                    while ($user = mysqli_fetch_assoc($user_query)) {
                                                        ?>
                                                        <tr><form action="" method="post">
                                                            <td style="border: 1px solid #ddd";><?php echo $user['id']; ?></td>

                                                          

                                                            <td style="border: 1px solid #ddd;"> <input type="hidden" name="update_fname_id" value="<?php echo $user['id']; ?>">
                                                            <input type="text" name="update_fname" style="width: 4rem;" min="1" value="<?php echo $user['fname']; ?>">
                                                            </td>


                                                            <td style="border: 1px solid #ddd"> <input type="hidden" name="update_lname_id" value="<?php echo $user['id']; ?>">
                                                            <input type="text" name="update_lname" style="width: 4rem;" min="1" value="<?php echo $user['lname']; ?>">
                                                            </td>

                                                            <td style="border: 1px solid #ddd"> <input type="hidden" name="update_email_id" value="<?php echo $user['id']; ?>">
                                                            <input type="email" name="update_email" style="width: 4rem;" min="1" value="<?php echo $user['email']; ?>">
                                                            </td>

                                                            <td style="border: 1px solid #ddd"> <input type="hidden" name="update_phoneNum_id" value="<?php echo $user['id']; ?>">
                                                            <input type="text" name="update_phoneNum" style="width: 4rem;" min="1" value="<?php echo $user['phoneNum']; ?>">
                                                            </td>

                                                            <td style="border: 1px solid #ddd"> <input type="hidden" name="update_city_id" value="<?php echo $user['id']; ?>">
                                                            <input type="text" name="update_city" style="width: 4rem;" min="1" value="<?php echo $user['city']; ?>">
                                                            </td>

                                                            <td style="border: 1px solid #ddd"> <input type="hidden" name="update_citycode_id" value="<?php echo $user['id']; ?>">
                                                            <input type="text" name="update_citycode" style="width: 4rem;" min="1" value="<?php echo $user['citycode']; ?>">
                                                            </td>
                                                        
                                                            <td style="border: 1px solid #ddd";><?php echo $user['user_type']; ?></td>

                                                            <td style="border: 1px solid #ddd"> <input type="hidden" name="update_password_id" value="<?php echo $user['id']; ?>">
                                                            <input type="password" name="update_password" style="width: 4rem;" min="1" value="<?php echo $user['password']; ?>">
                                                            </td>

                                                            <td style="border: 1px solid #ddd"><input type="submit" value="update" name="update_update_btn" class="btn btn-brand" style="background-color: darkgreen; font-size: 12px;"> <i class="fas fa-trash"></i></td>                                                         
                                                            <td style="border: 1px solid #ddd"><a href="allUserInfo.php?removeUser=<?php echo $user['id']; ?>" onclick="return confirm('Delete this Account?')" class="btn btn-brand" style="background-color: maroon;font-size: 12px;"> <i class="fas fa-trash"></i> Delete</a></td>
                                                        </tr></form>
                                                <?php

                                               
                                                        };
                                                        };
                                                        ?>
                                                        <tr>                                           
                                                        
                                                        <td colspan="14"><a href="allUserInfo.php?delete_all" onclick="return confirm('Are you sure you want to delete all?');" class="btn btn-brand" style="background-color: red; color: white; font-size: 14px;"> <i class="fas fa-trash"></i> Delete All </a></td>
                                                        </tr>
                                                        
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
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
