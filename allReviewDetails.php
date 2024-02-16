<?php
$title = "HOT POT Review Info";
include 'auth.php';
include 'admin_header.php';

include 'db.php';
       
?>

            <section id="myReviews" style="padding-top: 20px; padding-bottom: 120px;" class="bg-light">
                <div class="container">
                    <div class="row">
                        
                        <div class="row">
                            <div class="col-12 intro-text">
                                <h1 style="margin-bottom: 20px; color: orange;">Review Details</h1>
                                <div class="col-12 intro-text">
                                
                                </div>
                                <?php
                       
                                $sqlReview = "SELECT * 
                                              FROM customersinfo ci 
                                              JOIN reginfo rg ON rg.email = ci.email";
                                              

                                $resultReview = $conn->query($sqlReview);
                                if ($resultReview->num_rows > 0) {
                                    echo "<table class='table'>
                                            <thead>
                                                <tr>
                                                    <th>id</th>
                                                    <th>First Name</th>
                                                    <th>Last Name</th>
                                                    <th>email</th>
                                                    <th>Contact Number</th>
                                                    <th>Rating</th>
                                                    <th>Comments</th>
                                                </tr>
                                            </thead>
                                            <tbody>";
                                    while ($rowReview = $resultReview->fetch_assoc()) {
                                        echo "<tr>
                                                <td>{$rowReview['reviewId']}</td>
                                                <td>{$rowReview['fname']}</td>
                                                <td>{$rowReview['lname']}</td>
                                                <td>{$rowReview['email']}</td>
                                                <td>{$rowReview['phoneNum']}</td>
                                                <td>{$rowReview['addStar']}</td>
                                                <td>{$rowReview['additionalComment']}</td>
                                              </tr>";
                                    }
                                    echo "</tbody></table>";
                                
                                ?>
                            </div>
                        </div>

                        </div>
                    </div>
                </div>
            </section>
            <?php
         }else {
            echo "User details not found.";
        }

    
// Close the database connection
$conn->close();
include 'footer.php';
?>