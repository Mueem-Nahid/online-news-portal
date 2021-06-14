<?php
include_once "includes/admin_header.php";
include_once "../config.php";
?>

<div class="container">
  <div class="alert alert-info mt-3 text-center">
    <h4>Manage Category</h4>
  </div>
  <table class="table table-hover">
    <thead>
      <tr>
        <th class="text-center">Category name</th>
        <th class="text-center">Action</th>
      </tr>
    </thead>
    <tbody>
      <?php
          $result = mysqli_query($conn, "SELECT * FROM category ");
          while($data = mysqli_fetch_assoc($result)){
      ?>
            <tr>
              <td class="text-center"> <?php echo $data['category_name']; ?> </td>
              <td class="text-center">
                    <a href='update_category.php?cid=<?php echo $data['category_id']; ?>'> <button type="button" class="btn btn-info">Edit</button> </a>
                    <a onclick="return confirm('Are you sure to delete the category!')" href='delete_category.php?cid=<?php echo $data['category_id']; ?>'> <button type="button" class="btn btn-warning">delete</button> </a>
                  </td>
            </tr>
        <?php  } ?>

    </tbody>
  </table>

</div>
<?php
    include_once "includes/admin_footer.php";
 ?>
