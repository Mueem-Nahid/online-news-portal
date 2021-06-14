<?php
include_once "includes/admin_header.php";
include_once "../config.php";
?>

<div class="container">
  <div class="alert alert-info mt-3">
    <h4>All users</h4>
  </div>
  <table class="table table-hover">
    <thead>
      <tr>
        <th>User name</th>
        <th>User email</th>
        <th>Remove user</th>
      </tr>
    </thead>
    <tbody>

      <?php
          $result = mysqli_query($conn, "SELECT * FROM user");
          while($data = mysqli_fetch_assoc($result)){
      ?>

      <tr>

        <td><?php echo $data['user_name']; ?></td>
        <td><?php echo $data['user_email']; ?></td>
        <td> <a onclick="return confirm('Are you sure to remove the user!')" href='remove_user.php?userid=<?php echo $data['user_id']; ?>'> <button type="button" class="btn btn-danger">Remove</button> </a> </td>
      </tr>

        <?php  } ?>

    </tbody>
  </table>

</div>

<?php
    include_once "includes/admin_footer.php";
 ?>
