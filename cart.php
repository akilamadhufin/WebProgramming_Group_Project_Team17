<?php
$title = "Your Cart";
include 'auth.php';
include_once 'regUserHeader.php';
include 'db.php';

if (isset($_SESSION['authenticated']) && $_SESSION['authenticated'] === true) {
    // If the user is authenticated, getting user details from the db
    if (isset($_SESSION['email'])) {
        $userEmail = $_SESSION['email'];

        $sql = "SELECT * FROM reginfo WHERE email = '$userEmail'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $customerId = $row['id'];
            $fname = $row['fname'];
            $lname = $row['lname'];
            $userEmail = $row['email'];
            $phoneNum = $row['phoneNum'];
            $city = $row['city'];
            $citycode = $row['citycode'];
            $user_type = $row['user_type'];

            if (isset($_POST['update_update_btn'])) {
                $update_value = $_POST['update_quantity'];
                $update_id = $_POST['update_quantity_id'];
                $update_quantity_query = mysqli_query($conn, "UPDATE `cart` SET quantity = '$update_value' WHERE id = '$update_id'");
                if ($update_quantity_query) {
                    //   header('location:cart.php');
                }
            }

            if (isset($_GET['remove'])) {
                $remove_id = $_GET['remove'];
                mysqli_query($conn, "DELETE FROM `cart` WHERE id = '$remove_id'");
                // header('location:cart.php');
            }

            if (isset($_GET['delete_all'])) {
                mysqli_query($conn, "DELETE FROM `cart`");
                //  header('location:cart.php');
            }
?>
            <div class="container">
                <h1>Shopping cart</h1>

                <table style="width: 100%; text-align: center;">

                    <thead style="background-color: darkorange; color: white; padding: 1.5rem; font-size: 16px; margin-bottom: 10px;">
                        <th>image</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total price</th>
                        <th>Action</th>
                    </thead>

                    <tbody>
                        <?php
                        $select_cart = mysqli_query($conn, "SELECT * FROM `cart` where email='$userEmail'");
                        $grand_total = 0;
                        if (mysqli_num_rows($select_cart) > 0) {
                            while ($fetch_cart = mysqli_fetch_assoc($select_cart)) {
                        ?>
                                <tr style="margin-bottom: 10px;">
                                    <td><img src="uploaded_img/<?php echo $fetch_cart['image']; ?>" height="100" alt="" style="max-width: 180px;"></td>
                                    <td><?php echo $fetch_cart['name']; ?></td>
                                    <td>$<?php echo number_format($fetch_cart['price']); ?>/-</td>
                                    <td>
                                        <form action="" method="post">
                                            <input type="hidden" name="update_quantity_id" value="<?php echo $fetch_cart['id']; ?>">
                                            <input type="number" name="update_quantity" style="width: 4rem;" min="1" value="<?php echo $fetch_cart['quantity']; ?>">
                                            <input type="submit" value="update" name="update_update_btn" class="btn btn-brand" style="padding:.5rem 1.5rem; cursor: pointer; font-size: 14px; background-color: darkgreen; color: white;">
                                        </form>
                                    </td>
                                    <td>$<?php echo $sub_total = number_format((float)$fetch_cart['price'] * (int)$fetch_cart['quantity'], 2, '.', ''); ?>/-</td>
                                    <td><a href="cart.php?remove=<?php echo $fetch_cart['id']; ?>" onclick="return confirm('remove item from cart?')" class="btn btn-brand" style="background-color: maroon;"> <i class="fas fa-trash"></i> remove</a></td>
                                </tr>
                        <?php
                                $grand_total += $sub_total;
                            };
                        };
                        ?>
                        <tr class="table-bottom" style="background-color: darkblue; margin-bottom:5px">
                            <td colspan="3" style="color:white">grand total</td>
                            <td style="color:white">$<?php echo number_format($grand_total, 2, '.', ''); ?>/-</td>
                            <td><a href="cart.php?delete_all" onclick="return confirm('are you sure you want to delete all?');" class="btn btn-brand" style="background-color: red; color:white"> <i class="fas fa-trash"></i> delete all </a></td>
                        </tr>
                    </tbody>
                </table>

                <div style="margin-top: 15px; text-align: center;">
                    <a href="checkout.php" class="btn <?= ($grand_total > 1) ? 'btn-brand' : 'disabled'; ?>" style="display: inline-block; padding: 14px 38px;">Proceed to Checkout</a>
                </div>

            </div>

<?php
        } else {
            echo "User details not found.";
        }
    } else {
        echo "User email not set.";
    }
} else {
    echo "User not authenticated.";
}
?>
<!-- custom js file link  -->
<script src="js/script.js"></script>

<?php include 'footer.php'; ?>
