<!-- header -->
<?php
    include_once "../config.php";
    include_once "includes/admin_header.php";
 ?>
<!-- content -->
 <div class="container">
   <form method="post">
        <div class="alert alert-primary mt-3">
          <h3>Add category</h3>
        </div>
        <div class="form-group">
         <label for="category">Category Name:</label>
         <input type="text" name="categoryName" class="form-control" id="category">
        </div>
        <input type="submit" name="btnAddCategory"  class="btn btn-primary" value="Add">
    </form>
 </div>

<!-- footer -->
 <?php
     include_once "includes/admin_footer.php";

     if(!empty($_POST["btnAddCategory"])){
       if(isset($_POST['categoryName']) && !empty($_POST['categoryName'])){

           $categoryname = $_POST["categoryName"];
           $result = mysqli_query($conn, "INSERT INTO category(category_name) VALUES ('$categoryname')");
           if($result){
             echo "<script>alert('Category added');</script>";
         }else{
           echo "<script>alert('Category not added');</script>";
         }
       }else{
         echo "<div class='container alert alert-danger text-center mt-3'>Fill the category field</div>";
       }

     }
  ?>
