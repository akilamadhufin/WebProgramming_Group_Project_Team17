<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $title; ?></title>
    <link rel="icon" href="images/hotpot.jpg">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.1.0/fonts/remixicon.css" rel="stylesheet"/>
    <link rel="stylesheet" href="style2.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-white shadow py-0 sticky-top">
        <div class="container">
          <a class="navbar-brand" href="index.php">
            <img src="images/logonew2.png" alt="" width="60" height="60">
          </a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto">
            <li class="nav-item">
                <a class="nav-link active" href="index.php#heroslider" style="color: grey; font-size: 16px; line-height: 1.7;line-width:1.7; margin-right:4px">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" href="index.php#about" style="color: grey; font-size: 16px; line-height: 1.7;line-width:1.7; margin-right:4px">About</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" href="index.php#menu" style="color: grey; font-size: 16px;line-height: 1.7;line-width:1.7; margin-right:4px">Menu</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" href="index.php#services" style="color: grey; font-size: 16px; line-height: 1.7;line-width:1.7; margin-right:4px">Services</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" href="index.php#alumni" style="color: grey; font-size: 16px; line-height: 1.7;line-width:1.7; margin-right:4px">Alumni</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" href="index.php#reviews" style="color: grey; font-size: 16px; line-height: 1.7;line-width:1.7; margin-right:4px">Reviews</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" href="index.php#footer" style="color: grey; font-size: 16px; line-height: 1.7;line-width:1.7; margin-right:4px">Contact us</a>
              </li>
               
            </ul>
            <div class="d-flex" style="justify-content: flex-start;">
    <div class="nav-item dropdown">
        <button class="btn btn-brand position-relative me-3 nav-link dropdown-toggle" style="background-color: darkorange; border-radius: 0; padding: 10px 15px;" id="accountDropdown" data-bs-toggle="dropdown" aria-expanded="false">
            My Account
            <span class="position-absolute top-0 start-100 translate-middle p-2 bg-danger border border-light rounded-circle">
                <span class="visually-hidden">New Alerts</span>
            </span>
        </button>
        <ul class="dropdown-menu" aria-labelledby="accountDropdown">
            <li><a class="dropdown-item" href="myAccount.php" style="color: grey; font-size: 16px; line-height: 1.7;line-width:1.7; margin-right:4px">Account Settings</a></li>
            <li><a class="dropdown-item" href="myOrder.php" style="color: grey; font-size: 16px; line-height: 1.7;line-width:1.7; margin-right:4px">My Orders</a></li>
            <li><a class="dropdown-item" href="myReservations.php" style="color: grey; font-size: 16px; line-height: 1.7;line-width:1.7; margin-right:4px">Reservations</a></li>
            <li><a class="dropdown-item" href="myReview.php" style="color: grey; font-size: 16px; line-height: 1.7;line-width:1.7; margin-right:4px">Reviews</a></li>
            <li><a class="dropdown-item" href="loginform.php" style="color: grey; font-size: 16px; line-height: 1.7;line-width:1.7; margin-right:4px">Login to Another Account</a></li>
            <li><a class="dropdown-item" href="logout.php" style="color: grey; font-size: 16px; line-height: 1.7;line-width:1.7; margin-right:4px">Logout</a></li>
        </ul>
    </div>
    <?php
    $select_rows = mysqli_query($conn, "SELECT * FROM `cart`") or die('query failed');
    $row_count = mysqli_num_rows($select_rows);
    ?>
    <a style="background-color: darkorange; color: white; font-size: 16px; margin-left: 8px; border-radius: 0;  border: none; padding: 10px 15px;" href="cart.php" class="btn btn-primary position-relative me-3">cart <span><?php echo $row_count; ?></span></a>
    <div id="menu-btn" class="fas fa-bars"></div>
</div>





            </div>
        </div>
    </nav>