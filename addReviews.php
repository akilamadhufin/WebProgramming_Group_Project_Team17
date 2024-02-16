<?php
include 'auth.php';
$title = "HOT POT  Delivery";
include 'db.php';
include ($_SESSION['authenticated'] && $_SESSION['authenticated'] === true) ? 'regUserHeader.php' : 'header.php';
?>

<section id="deliver" style="padding-top: 20px; padding-bottom: 20px;">
        <div class="container">
            <div class="row">
            <div class="col-12 intro-text">
              <h1>Please Enter your Review below</h1>
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
                  <input type="text" class="form-control" placeholder="Contact Number" id="phoneNum" name="phoneNum" required>
                </div>
                <div class="form-group col-md-4">
                <div class="quote-icon"><i class="ri-double-quotes-l"></i></div>
                    <select class="form-control" id="addStar" name="addStar" required>
                        <option value="" disabled selected>Select Rating</option>
                        <option value="☆☆☆☆☆">☆☆☆☆☆</option>
                        <option value="☆☆☆☆★">☆☆☆☆★</option>
                        <option value="☆☆☆★★">☆☆☆★★</option>
                        <option value="☆☆★★★">☆☆★★★</option>
                        <option value="☆★★★★">☆★★★★</option>
                        <option value="★★★★★">★★★★★</option>
                    </select>
                    </div>
                </select>
                </div>
                <div class="form-group col-md-12" style="margin-top: 16px;">
                  <textarea name="additionalComment" id="additionalComment" cols="30" rows="4" class="form-control" placeholder="Additional Comments"></textarea>
                </div>
                <div class="form-group col-md-12 text-center" style="margin-top: 20px; margin-bottom: 1px; ">
                <button type="submit" class="btn btn-brand" id="addReview" name="addReview">Submit Review</button>
                <a href="myReview.php" type="submit" class="btn btn-brand" id="displayReviews" name="displayReviews"> View My Review</a>
                </div>
              </div>
            </div>
          </form>
</section>

<?php

          if(isset($_POST['addReview'])){
            $fname = $_POST['fname'];
            $lname = $_POST['lname'];
            $email = $_POST['email'];
            $phoneNum = $_POST['phoneNum'];
            $addStar = $_POST['addStar'];
            $additionalComment = $_POST['additionalComment'];
            
            $submitreviewsql = "insert into customersinfo (fname,lname,email,phoneNum,addStar,additionalComment) 
            values('$fname','$lname','$email','$phoneNum','$addStar','$additionalComment')" ;
        
            if($conn->query($submitreviewsql)===TRUE){
                echo "<script>window.alert('Your data was successfully recorded');</script>";
            }
            else{
                echo "<script>window.alert('Error in submitting');</script>";
            }
            
            } 
            // close the connection when done
            $conn->close();   
    
?>

<?php include 'footer.php'; ?>