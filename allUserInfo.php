<?php
$title = "HOT POT user Info";
include 'auth.php';
include 'admin_header.php';

include 'db.php';
?>


           <section id="userDetails" style="padding-top: 20px; padding-bottom: 120px;" class="bg-light">
                <div class="container">
                    <div class="row">
                        <div class="col-12 intro-text">
                        <h1 style="color:orange">Customer Details:</h1>
                        </div>
                                <?php
                                $sqlUserInfo = "SELECT * 
                                              FROM 
                                              reginfo";

                                $resultUserInfo = $conn->query($sqlUserInfo);
                                if ($resultUserInfo->num_rows > 0) {
                                    echo "<table class='table'>
                                            <thead>
                                                <tr>
                                                    <th>id</th>
                                                    <th>First Name</th>
                                                    <th>Last Name</th>
                                                    <th>email</th>
                                                    <th>Contact Number</th>
                                                    <th>City</th>
                                                    <th>City Code</th>
                                                    <th>User Type</th>
                                                </tr>
                                            </thead>
                                            <tbody>";
                                    while ($rowUserInfo = $resultUserInfo->fetch_assoc()) {
                                        echo "<tr>
                                                <td>$rowUserInfo[id]</a></td>
                                                <td>{$rowUserInfo['fname']}</td>
                                                <td>{$rowUserInfo['lname']}</td>
                                                <td>{$rowUserInfo['email']}</td>
                                                <td>{$rowUserInfo['phoneNum']}</td>
                                                <td>{$rowUserInfo['city']}</td>
                                                <td>{$rowUserInfo['citycode']}</td>
                                                <td>{$rowUserInfo['user_type']}</td>
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
        } else {
            echo "User details not found.";
        }
   

// Close the database connection
$conn->close();
include 'footer.php';
?>
