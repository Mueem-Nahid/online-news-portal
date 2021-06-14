<?php
    include_once "../config.php";
    include_once "includes/admin_header.php";
 ?>

 <div class="container">
   <form action="save_news.php" method="post" enctype="multipart/form-data">
        <div class="alert alert-primary mt-3">
          <h3>Add news</h3>
        </div>
        <div class="form-group">
         <label for="newstitle">News title:</label>
         <input type="text" name="newstitle" class="form-control" required>
        </div>
        <div class="form-group">
          <label for="newsdescription">Description</label>
          <textarea name="newsdescription" class="form-control" rows="8" cols="80" required></textarea>
        </div>
        <div class="form-group">
          <label for="category">Category</label>
          <select class="form-control" name="category" required>
            <option value="">Select category</option>
            <?php
                $query = "SELECT * FROM category";
                $result = mysqli_query($conn, $query) or die("query failed.");
                if(mysqli_num_rows($result) > 0){
                  while ($row = mysqli_fetch_assoc($result)) {
                    echo "<option value='{$row['category_id']}'>{$row['category_name']}</option>";
                  }
                }
            ?>
          </select>
        </div>
        <div class="form-group">
          <label for="image">Post image</label>
          <input type="file" name="image" accept="image/*" value="" required>
        </div>
        <div class="form-group">
          <input type="submit" name="btnAddNews"  class="btn btn-primary" value="Add">
        </div>

    </form>
 </div>

 <?php
      include_once "includes/admin_footer.php";
  ?>
