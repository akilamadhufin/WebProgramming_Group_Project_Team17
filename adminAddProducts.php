<?php
$title = "Add Product";
@include 'db.php';

if(isset($_POST['add_product'])){
   $p_name = $_POST['p_name'];
   $p_price = $_POST['p_price'];
   $p_image = $_FILES['p_image']['name'];
   $p_category = $_POST['p_category'];
   $p_rating = $_POST['p_rating'];
   $p_description = $_POST['p_description'];
   $p_image_tmp_name = $_FILES['p_image']['tmp_name'];
   $p_image_folder = 'uploaded_img/'.$p_image;
   $insert_query = mysqli_query($conn, "INSERT INTO `products`(name, price, category, rating, description, image) VALUES('$p_name', '$p_price', '$p_category', '$p_rating', '$p_description','$p_image')") or die('query failed');
   if($insert_query){
      move_uploaded_file($p_image_tmp_name, $p_image_folder);
      $message[] = 'product add succesfully';
   }else{
      $message[] = 'could not add the product';
   }
};
if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   $delete_query = mysqli_query($conn, "DELETE FROM `products` WHERE id = $delete_id ") or die('query failed');
   if($delete_query){
      header('location:adminAddProducts.php');
      $message[] = 'product has been deleted';
   }else{
      header('location:adminAddProducts.php');
      $message[] = 'product could not be deleted';
   };
};
if(isset($_POST['update_product'])){
   $update_p_id = $_POST['update_p_id'];
   $update_p_name = $_POST['update_p_name'];
   $update_p_price = $_POST['update_p_price'];
   $update_p_image = $_FILES['update_p_image']['name'];
   $update_p_category = $_POST['update_p_category'];
   $update_p_rating = $_POST['update_p_rating'];
   $update_p_description = $_POST['update_p_description'];
   $update_p_image_tmp_name = $_FILES['update_p_image']['tmp_name'];
   $update_p_image_folder = 'uploaded_img/'.$update_p_image;
   $update_query = mysqli_query($conn, "UPDATE `products` SET name = '$update_p_name', price = '$update_p_price', category = '$update_p_category', rating='$update_p_rating', description='$update_p_description',image = '$update_p_image' WHERE id = '$update_p_id'");
   if($update_query){
      move_uploaded_file($update_p_image_tmp_name, $update_p_image_folder);
      $message[] = 'product updated succesfully';
      header('location:adminAddProducts.php');
   }else{
      $message[] = 'product could not be updated';
      header('location:adminAddProducts.php');
   }
}
?>
<?php
if(isset($message)){
   foreach($message as $message){
      echo '<div class="message"><span>'.$message.'</span> <i class="fas fa-times" onclick="this.parentElement.style.display = `none`;"></i> </div>';
   };
};
?>
<?php include 'adminHeader2.php'; ?>

<section id="addproduct" class="add-product-form text-center" style="margin-top:20px; margin-bottom:1px;">
   <div class="container">
            <div class="row">
<form action="" method="post" class="add-product-form" enctype="multipart/form-data">
   <h3 style="margin-top: 1px !important;">add a new product</h3>
   <input type="text" name="p_name" placeholder="enter the product name" style="margin-top:20px; margin-bottom:1px;" class="box" required >
   <input type="number" name="p_price" min="0" placeholder="enter the product price" style="margin-top:20px; margin-bottom:1px;" class="box" required>
   <select name="p_category" placeholder="enter the product category" style="margin-top:20px; margin-bottom:1px;" class="box" required>
                    <option value="" disabled selected>Select Meal Type</option>
                    <option value="breakfast">Breakfast</option>
                    <option value="lunch">Lunch</option>
                    <option value="dinner">Dinner</option>
                </select>
   <select name="p_rating" style="margin-top:20px; margin-bottom:1px;" class="box" required>
   <option value="" disabled selected>Select Rating</option>
                        <option value="☆☆☆☆☆">☆☆☆☆☆</option>
                        <option value="☆☆☆☆★">☆☆☆☆★</option>
                        <option value="☆☆☆★★">☆☆☆★★</option>
                        <option value="☆☆★★★">☆☆★★★</option>
                        <option value="☆★★★★">☆★★★★</option>
                        <option value="★★★★★">★★★★★</option>
   </select>
   <textarea name="p_description" placeholder="enter the product description" style="margin-top:20px; margin-bottom:1px;" class="box" required> </textarea>
   <input type="file" name="p_image" accept="image/png, image/jpg, image/jpeg" style="margin-top:20px; margin-bottom:1px;" class="box" required>
   <input type="submit" value="add the product" name="add_product" style="margin-top:20px; background-color:darkorange;" class="btn btn-brand">
</form>
</div>
</div>
</section>

<section id="displayproduct" class="display-product-table text-center" style="margin-top:1px; margin-bottom: 10px;">
   
   <table>
      <thead>
         <th>product image</th>
         <th>product name</th>
         <th>product price</th>
         <th>product Category</th>
         <th>product rating</th>
         <th>product description</th>
         <th>action</th>
      </thead>
      <tbody>
         <?php       
            $select_products = mysqli_query($conn, "SELECT * FROM `products`");
            if(mysqli_num_rows($select_products) > 0){
               while($row = mysqli_fetch_assoc($select_products)){
         ?>
         <tr style="margin-top: 10px;">
            <td><img src="uploaded_img/<?php echo $row['image']; ?>" width="80" height="70" alt=""></td>
            <td><?php echo $row['name']; ?></td>
            <td>$<?php echo $row['price']; ?>/-</td>
            <td><?php echo $row['category']; ?></td>
            <td><?php echo $row['rating']; ?></td>
            <td><?php echo $row['description']; ?></td>
            <td>
               <a href="adminAddProducts.php?delete=<?php echo $row['id']; ?>" class="delete-btn" onclick="return confirm('are your sure you want to delete this?');"> <i class="fas fa-trash"></i> delete </a>
               <a href="adminAddProducts.php?edit=<?php echo $row['id']; ?>" class="option-btn"> <i class="fas fa-edit"></i> update </a>
            </td>
         </tr>
         <?php
            };    
            }else{
               echo "<div class='empty'>no product added</div>";
            };
         ?>
      </tbody>
   </table>
        
</section>
<section class="edit-form-container">
   <?php
   if(isset($_GET['edit'])){
      $edit_id = $_GET['edit'];
      $edit_query = mysqli_query($conn, "SELECT * FROM `products` WHERE id = $edit_id");
      if(mysqli_num_rows($edit_query) > 0){
         while($fetch_edit = mysqli_fetch_assoc($edit_query)){
   ?>
   <form action="" method="post" enctype="multipart/form-data">
    <img src="uploaded_img/<?php echo $fetch_edit['image']; ?>" height="100" alt="">
    <input type="hidden" name="update_p_id" value="<?php echo $fetch_edit['id']; ?>">
    <input type="text" class="box" required name="update_p_name" value="<?php echo $fetch_edit['name']; ?>">
    <input type="number" min="0" class="box" required name="update_p_price" value="<?php echo $fetch_edit['price']; ?>">
    <select class="box" required name="update_p_category">
        <option value="" disabled>Select Meal Type</option>
        <option value="breakfast" <?php if ($fetch_edit['category'] == 'breakfast') echo 'selected'; ?>>Breakfast</option>
        <option value="lunch" <?php if ($fetch_edit['category'] == 'lunch') echo 'selected'; ?>>Lunch</option>
        <option value="dinner" <?php if ($fetch_edit['category'] == 'dinner') echo 'selected'; ?>>Dinner</option>
    </select>
    <select name="update_p_rating" class="box" required>
        <option value="" disabled>Select Rating</option>
        <option value="☆☆☆☆☆" <?php if ($fetch_edit['rating'] == '☆☆☆☆☆') echo 'selected'; ?>>☆☆☆☆☆</option>
        <option value="☆☆☆☆★" <?php if ($fetch_edit['rating'] == '☆☆☆☆★') echo 'selected'; ?>>☆☆☆☆★</option>
        <option value="☆☆☆★★" <?php if ($fetch_edit['rating'] == '☆☆☆★★') echo 'selected'; ?>>☆☆☆★★</option>
        <option value="☆☆★★★" <?php if ($fetch_edit['rating'] == '☆☆★★★') echo 'selected'; ?>>☆☆★★★</option>
        <option value="☆★★★★" <?php if ($fetch_edit['rating'] == '☆★★★★') echo 'selected'; ?>>☆★★★★</option>
        <option value="★★★★★" <?php if ($fetch_edit['rating'] == '★★★★★') echo 'selected'; ?>>★★★★★</option>
    </select>
    <textarea class="box" required name="update_p_description"><?php echo $fetch_edit['description']; ?></textarea>
    <input type="file" class="box" required name="update_p_image" accept="image/png, image/jpg, image/jpeg">
    <input type="submit" value="update the product" name="update_product" class="btn">
    <input type="reset" value="cancel" id="close-edit" class="option-btn">
</form>

   <?php
            };
         };
         echo "<script>
         document.querySelector('#close-edit').onclick = () =>{
         document.querySelector('.edit-form-container').style.display = 'none';
         window.location.href = 'adminAddProducts.php'; };
         document.querySelector('.edit-form-container').style.display = 'flex';
         </script>";
      };
   ?>
</section>
</div>
<script src="js/script.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>