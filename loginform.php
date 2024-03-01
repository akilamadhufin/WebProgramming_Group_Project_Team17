<?php
session_start();
ob_start();

$title = 'login';
include 'header.php';
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    $userType = $_POST['user_type'];

    $query = "SELECT * FROM reginfo WHERE email='$email' AND password='$password' AND user_type='$userType'";
    $result = $conn->query($query);

    if ($result->num_rows == 1) {
        $_SESSION['authenticated'] = true;
        $_SESSION['email'] = $email;
        $_SESSION['user_type'] = $userType;

        if ($userType == 'user') {
            header("Location: index.php");
        } elseif ($userType == 'admin') {
            header("Location: adminBody.php");
        } else {
            header("Location: index.php");
        }
        exit();
    } else {
        $error_message = "Invalid email or password";
    }
}

$conn->close();
?>



<section id="deliver" style="padding-top: 20px; padding-bottom: 120px;">
    <div class="container">
        <div class="row">
            <div class="col-12 intro-text">
                <h1>Please Login</h1>
            </div>
        </div>
        <!-- Login Form -->
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="row justify-content-center" name="loginInfo" method="post">
            <div class="col-lg-8">
                <div class="row g-3">
                <div class="form-group col-md-6">
                <select name="user_type" class="form-control" id="user_type" placeholder="choose User type">
                  <option value="user">user</option>
                  <option value="admin">admin</option>
                </select></div>
            
                    <div class="form-group col-md-6">
                        <input type="text" class="form-control" placeholder="email" id="email" name="email" required>
                    </div>
                    <div class="form-group col-md-6">
                        <input type="password" class="form-control" placeholder="Password" id="password" name="password" required>
                    </div>

                    <div class="form-group col-md-12 text-center" style="margin-top: 16px; margin-bottom: 16px;">
                        <button type="submit" class="btn btn-brand" name="login">Login</button>
                    </div>
                </div>
            </div>
        </form>

        <?php
        if (isset($error_message)) {
            echo '<p class="text-center text-danger">' . $error_message . '</p>';
        }
        ?>

        <p class="text-center"> If you don't have an account, kindly click on the below register button.</p>
        <div class="form-group col-md-12 text-center" style="margin-top: 16px; margin-bottom: 16px;">
            <a href="registration.php" class="btn btn-brand" style="margin-left: 15px; margin-top: 20px;">Register</a>
        </div>
    </div>
</section>

<?php
include 'footer.php';
?>
<?php ob_end_flush(); ?>
