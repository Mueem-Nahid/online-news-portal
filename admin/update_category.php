<?php
    include_once "includes/admin_header.php";
    include_once "../config.php";
    $id = $_GET["cid"];

    //Update category--------
    if(!empty($_POST["btnUpdateCategory"])){
      $category_name = $_POST["categoryName"];
      $query2 = mysqli_query($conn, "UPDATE category SET category_name = '$category_name' WHERE category_id = '$id'");
      $row = mysqli_affected_rows($conn);
      if($row > 0){
        echo "<script> alert('Category updated.');
              window.location = 'manage_category.php'</script>";
      }else{
        echo "<script> alert('Category not updated.');
              window.location = 'manage_category.php'</script>";
      }
    }

    //select category
    $query = mysqli_query($conn, "SELECT * FROM category WHERE category_id = '$id'");
    $data = mysqli_fetch_assoc($query);
 ?>

 <!-- content -->
  <div class="container">
    <form method="post">
         <div class="alert alert-primary mt-3">
           <h3>Update category</h3>
         </div>
         <div class="form-group">
          <label for="category">Category Name:</label>
          <input type="text" name="categoryName" class="form-control" value="<?php echo $data['category_name'] ?>">
         </div>
         <input type="submit" name="btnUpdateCategory"  class="btn btn-primary" value="Update">
         <a href="manage_category.php"><button type="button" class="btn btn-warning">Cancel</button></a>
     </form>
  </div>

 <!-- footer -->
  <?php
      include_once "includes/admin_footer.php";
   ?>
