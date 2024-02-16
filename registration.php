<?php
$title = "registration";
include 'header.php'; 
include 'db.php';?>
<section id="deliver" style="padding-top: 20px; padding-bottom: 120px;">
        <div class="container">
            <div class="row">
            <div class="col-12 intro-text">
              <h1>Please Register</h1>
            </div>
            </div>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="row justify-content-center" name="regstrationInfo" method="post">
            <div class="col-lg-8">
              <div class="row g-3">
              <div class="form-group col-md-6">
                  <input type="text" class="form-control" placeholder="First Name" id="fname" name="fname" required>
                </div>
                <div class="form-group col-md-6">
                  <input type="text" class="form-control" placeholder="Last Name"  id="lname" name="lname" required>
                </div>
                <div class="form-group col-md-6">
                  <input type="email" class="form-control" placeholder="email" id="email" name="email" required>
                </div>
                <div class="form-group col-md-6">
                  <input type="text" class="form-control" placeholder="city" id="city" name="city" required>
                </div>
                <div class="form-group col-md-6">
                  <input type="text" class="form-control" placeholder="citycode" id="citycode" name="citycode" required>
                </div>
                <div class="form-group col-md-6">
                  <input type="text" class="form-control" placeholder="Contact Number" id="phoneNum" name="phoneNum" required>
                </div>
                <div class="form-group col-md-6">
                  <input type="password" class="form-control" placeholder="Password"  id="password" name="password" required minlength="4" maxlength="20">
                </div>
                <div class="form-group col-md-6">
                <input type="password" class="form-control" id="confirm_password" placeholder="Confirm Password" name="confirmpassword" required minlength="4" maxlength="12">
                </div>
                <div class="form-group col-md-6 mx-auto " >
                <select name="user_type" class="form-control" id="user_type" placeholder="choose User type">
                  <option value="user">user</option>
                  <option value="admin">admin</option>
                </select></div>
                <div class="form-group col-md-12 text-center" style="margin-top: 16px; margin-bottom: 16px; ">
                <button type="submit" class="btn btn-brand" name="register">Register</button>
                </div>
              </div>
            </div>
            <script>
function validatePassword() {
    const password = document.getElementById("password").value;
    const confirmPassword = document.getElementById("confirm_password").value;
    const passwordError = document.getElementById("passwordError");

    if (password !== confirmPassword) {
        passwordError.innerHTML = "Passwords do not match";
        return false;
    } else {
        passwordError.innerHTML = "";
        return true;
    }
}

document.getElementById("confirm_password").addEventListener("input", validatePassword);
</script>
          </form>
</section>

<?php

          if(isset($_POST['register'])){
            $fname = $_POST['fname'];
            $lname = $_POST['lname'];
            $email = $_POST['email'];
            $city = $_POST['city'];
            $citycode = $_POST['citycode'];
            $phoneNum = $_POST['phoneNum'];
            $password = md5($_POST['password']);
            $userType = md5($_POST['user_type']);
            
            $sql = "insert into reginfo (fname,lname,email,city,citycode,phoneNum,password,user_type) 
            values('$fname','$lname','$email','$city','$citycode','$phoneNum','$password','$userType')" ;
        
            if($conn->query($sql)===TRUE){
              
              echo '<script>alert("Your data was successfully recorded"); window.location.href = "loginform.php";</script>';
              
            exit();
              }
            }
            else{
              echo '<script>alert("Error in submitting: ' . $conn->error . '");</script>';
            }
            
      
            $conn->close();   
    
?>

<?php include 'footer.php'; ?>