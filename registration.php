<?php
$title = "Registration";
include 'header.php'; 
include 'db.php';
?>

<script>
    function validatefname() {
        const fname = document.getElementById("fname").value;
        const fnameError = document.getElementById("fnameError");

        if (!/^[a-zA-Z]+$/.test(fname)) {
            fnameError.innerHTML = "First Name should not include numbers";
            return false;
        } else {
            fnameError.innerHTML = "";
            return true;
        }
    }

    function validatelname() {
        const lname = document.getElementById("lname").value;
        const lnameError = document.getElementById("lnameError");

        if (!/^[a-zA-Z]+$/.test(lname)) {
            lnameError.innerHTML = "Last Name should not include numbers";
            return false;
        } else {
            lnameError.innerHTML = "";
            return true;
        }
    }

    function validateemail() {
        const email = document.getElementById("email").value;
        const emailError = document.getElementById("emailError");
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        if (!emailRegex.test(email)) {
            emailError.innerHTML = "Invalid email format";
            return false;
        } else {
            emailError.innerHTML = "";
            return true;
        }
    }

    function validatePhoneNum() {
        const phoneNum = document.getElementById("phoneNum").value;
        const phoneNumError = document.getElementById("phoneNumError");

        if (!/^\d+$/.test(phoneNum)) {
            phoneNumError.innerHTML = "Contact Number should only include digits";
            return false;
        } else {
            phoneNumError.innerHTML = "";
            return true;
        }
    }

    function validatePassword() {
        const password = document.getElementById("password").value;
        const confirmPassword = document.getElementById("confirm_password").value;
        const confirmPasswordError = document.getElementById("confirmPasswordError");
        const passwordError = document.getElementById("passwordError");

        // Validate password length
        if (password.length < 4 || password.length > 20) {
            passwordError.innerHTML = "Password should be between 4 and 20 characters";
            return false;
        } else {
            passwordError.innerHTML = "";
        }

        // Validate password match
        if (password !== confirmPassword) {
            confirmPasswordError.innerHTML = "Passwords do not match";
            return false;
        } else {
            confirmPasswordError.innerHTML = "";
            return true;
        }
    }
</script>

<section id="registration" style="padding-top: 20px; padding-bottom: 120px;">
    <div class="container">
        <div class="row">
            <div class="col-12 intro-text">
                <h1>Please Register</h1>
            </div>
        </div>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="row justify-content-center" name="registrationInfo" method="post">
            <div class="col-lg-8">
                <div class="row g-3">
                

                    <div class="form-group col-md-6">
                        <input type="text" class="form-control" placeholder="First Name" id="fname" name="fname" required oninput="validatefname()">
                        <p id="fnameError" class="text-danger"></p>
                    </div>

                    <div class="form-group col-md-6">
                        <input type="text" class="form-control" placeholder="Last Name" id="lname" name="lname" required oninput="validatelname()">
                        <p id="lnameError" class="text-danger"></p>
                    </div>

                    <div class="form-group col-md-6">
                        <input type="email" class="form-control" placeholder="Email" id="email" name="email" required oninput="validateemail()">
                        <p id="emailError" class="text-danger"></p>
                    </div>

                    <div class="form-group col-md-6">
                        <input type="text" class="form-control" placeholder="Contact Number" id="phoneNum" name="phoneNum" required oninput="validatePhoneNum()">
                        <p id="phoneNumError" class="text-danger"></p>
                    </div>

                    <div class="form-group col-md-6">
                        <input type="text" class="form-control" placeholder="city" id="city" name="city" required>
                    </div>

                    <div class="form-group col-md-6">
                        <input type="text" class="form-control" placeholder="citycode" id="citycode" name="citycode" required>
                    </div>

                    <div class="form-group col-md-6">
                        <input type="password" class="form-control" placeholder="Password" id="password" name="password" required minlength="4" maxlength="20" oninput="validatePassword()">
                        <p id="passwordError" class="text-danger"></p>
                    </div>

                    <div class="form-group col-md-6">
                        <input type="password" class="form-control" id="confirm_password" placeholder="Confirm Password" name="confirm_password" required minlength="4" maxlength="12" oninput="validatePassword()">
                        <p id="confirmPasswordError" class="text-danger"></p>
                    </div>

                    <div class="form-group col-md-6 mx-auto">
                        <select name="user_type" class="form-control" id="user_type" placeholder="Choose User type">
                            <option value="user">User</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>

                    <div class="form-group col-md-12 text-center" style="margin-top: 16px; margin-bottom: 16px;">
                        <button type="submit" class="btn btn-brand" name="register">Register</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>

<?php
if (isset($_POST['register'])) {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $city = $_POST['city'];
    $citycode = $_POST['citycode'];
    $phoneNum = $_POST['phoneNum'];
    $userType = $_POST['user_type'];
    $password = md5($_POST['password']);
}

$sql = "insert into reginfo (fname,lname,email,city,citycode,phoneNum,password,user_type) 
values('$fname','$lname','$email','$city','$citycode','$phoneNum','$password','$userType')" ;

if($conn->query($sql)===TRUE){
  
  echo '<script>alert("Your data was successfully recorded"); window.location.href = "loginform.php";</script>';
//   
exit();
  }

$conn->close();
include 'footer.php';
?>