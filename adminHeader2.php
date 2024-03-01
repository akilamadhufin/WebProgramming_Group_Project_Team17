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
                <a class="nav-link active"  href="allUserInfo.php" style="color: grey; font-size: 16px; line-height: 1.7;line-width:1.7; margin-right:4px">Customer Management</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active"  href="allOrderDetails.php" style="color: grey; font-size: 16px; line-height: 1.7;line-width:1.7; margin-right:4px">Order Management</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active"  href="allReservations.php" style="color: grey; font-size: 16px; line-height: 1.7;line-width:1.7; margin-right:4px">Reservation Managment</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active"  href="allReviewDetails.php" style="color: grey; font-size: 16px; line-height: 1.7;line-width:1.7; margin-right:4px">Reviews</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active"  href="employee.php" style="color: grey; font-size: 16px; line-height: 1.7;line-width:1.7; margin-right:4px">Staff Managment</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active"  href="adminAddProducts.php" style="color: grey; font-size: 16px; line-height: 1.7;line-width:1.7; margin-right:4px">Add Products</a>
              </li>
              
              
            </ul>
            <div class="d-flex" style="justify-content: flex-start;">
                    <div class="nav-item dropdown">
                    <button class="btn btn-brand position-relative me-3 nav-link dropdown-toggle" style="background-color: darkorange; border-radius: 0; padding: 10px 15px;" id="accountDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            Admin Account
                            <span class="position-absolute top-0 start-100 translate-middle p-2 bg-danger border border-light rounded-circle">
                                <span class="visually-hidden">New Alerts</span>
                            </span>
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="accountDropdown">
                         
                            <li><a class="dropdown-item" href="loginform.php" style="color: grey; font-size: 16px; line-height: 1.7;line-width:1.7; margin-right:4px">Login to Another Account</a></li>
                            <li><a class="dropdown-item" href="logout.php" style="color: grey; font-size: 16px; line-height: 1.7;line-width:1.7; margin-right:4px">Logout</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </nav>