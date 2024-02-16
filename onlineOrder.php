<?php
include 'auth.php';

$title = "HOT POT home";
include 'db.php';

include isset($_SESSION['authenticated']) && $_SESSION['authenticated'] === true ? 'regUserHeader.php' : 'header.php';

?>


<<section id="orderOnline" style="padding-top: 20px; padding-bottom: 120px;">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="intro-text">
                    <h1 style="margin-bottom: 20px;">Dear Customer</h1>
                    <div class="divider my-4"></div>
                    <p>Welcome to HOT POT, where the flavors of Asia come alive at your fingertips! With our convenient online order service, you can savor the tantalizing taste of our signature hot pots from the comfort of your home. Choose from an array of mouthwatering options and customize your order with our easy-to-use platform.</p>
                    <p>Whether you prefer the convenience of home delivery or a quick pickup, HOT POT ensures a delightful dining experience with every order. Elevate your dining experience with our online ordering service, bringing the essence of our restaurant directly to your doorstep. Enjoy the perfect blend of convenience and delectable flavors with HOT POT's online order service.</p>
                    <a href="deliver.php" class="btn btn-brand" style="margin-top: 20px;">Deliver</a>
                    <a href="pickup.php" class="btn btn-brand" style="margin-left: 15px; margin-top: 20px;">Pickup</a>
                </div>
            </div>
            <div style="color: grey;" class="col-md-4 d-flex align-items-center justify-content-center">
             <div class="divider my-5 text-center">
            <h4>Review your orders here</h4>
            <a href="myOrder.php" class="btn btn-brand" style="margin-top: 20px;">Go to My Orders</a>
    </div>
</div>
        </div>
    </div>
</section>


<?php include_once 'footer.php'; ?>