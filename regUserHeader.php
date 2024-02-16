<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $title; ?></title>
    <link rel="icon" href="images/hotpot.jpg">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.1.0/fonts/remixicon.css" rel="stylesheet"/>
    <link rel="stylesheet" href="styles.css">
</head>
  <body>
    <nav class="navbar navbar-expand-lg bg-white shadow py-0 sticky-top">
        <div class="container">
          <a class="navbar-brand" href="#">
            <img src="images/logonew2.png" alt="" width="100" height="60">
          </a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto">

              <li class="nav-item">
                <a class="nav-link active"  href="index.php#heroslider">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active"  href="index.php#about">About</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active"  href="index.php#menu">Menu</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active"  href="index.php#services">Services</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active"  href="index.php#alumni">Alumni</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active"  href="index.php#reviews">Reviews</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active"  href="index.php#footer">Contact us</a>
              </li>
             
            </ul>
            <div class="d-flex" style="justify-content: flex-end;">
                    <div class="nav-item dropdown">
                        <button class="btn btn-brand position-relative me-3 nav-link dropdown-toggle" id="accountDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            My Account
                            <span class="position-absolute top-0 start-100 translate-middle p-2 bg-danger border border-light rounded-circle">
                                <span class="visually-hidden">New Alerts</span>
                            </span>
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="accountDropdown">
                            <li><a class="dropdown-item" href="myAccount.php">Account Settings</a></li>
                            <li><a class="dropdown-item" href="myOrder.php">My Orders</a></li>
                            <li><a class="dropdown-item" href="myReservations.php">Reservations</a></li>
                            <li><a class="dropdown-item" href="myReview.php">Reviews</a></li>
                            <li><a class="dropdown-item" href="loginform.php">Login to Another Account</a></li>
                            <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                        </ul>
                    </div>
                    <a href="onlineOrder.php" class="btn btn-brand ms-auto">Order Online</a>
                </div>
            </div>
        </div>
    </nav>