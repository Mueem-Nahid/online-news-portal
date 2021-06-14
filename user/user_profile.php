<?php
  include_once "include/user_header.php";
  include_once "../config.php";

        // Update profile
        if(isset($_POST['update'])){
          //-----check user name field-----------
          if(isset($_POST['user_name']) && !empty($_POST['user_name'])){
            if(preg_match('/^[A-Za-z\s]+$/', $_POST['user_name'])){
              $user_name = $_POST['user_name'];
            }else{
              $username_error = '<div class="alert alert-danger" role="alert">
                                  Only lower and upper case and space characters are allowed.
                                </div>';
            }
          }else{
            $username_error = '<div class="alert alert-danger" role="alert">
                                Please fill the username field.
                              </div>';
          } //end of user_name if else ----------------

          //--------check email field----------------
          if(isset($_POST['user_email']) && !empty($_POST['user_email'])){
            $pattern = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/';
            if(preg_match($pattern, $_POST['user_email'])){
              //---check for used email---------
              $check_email = $_POST['user_email'];
              $sql = "SELECT user_email FROM user WHERE user_email='$check_email'";
              $result2 = mysqli_query($conn, $sql);

              if(mysqli_num_rows($result2)>1){
                $emailError = '<div class="alert alert-danger" role="alert">
                                    Sorry this email is already exist.
                                  </div>';
              }else{
                $user_email = $_POST['user_email'];
              }

            }else{
              $emailError = '<div class="alert alert-danger" role="alert">
                                  Enter valid email address.
                                </div>';
            }
          }else{
            $emailError = '<div class="alert alert-danger" role="alert">
                                Please fill the email field.
                              </div>';
          } //end of email if else -------------------

          //---------update into db-------------
          if(isset($user_name) && isset($user_email)){
            $sql2 = "UPDATE user SET user_name = '$user_name', user_email = '$user_email' WHERE user_id = {$id}";
            if(mysqli_query($conn, $sql2)){
              echo "<script> alert('Profile updated');
                    window.location = 'user_profile.php'
                    </script>";
            }else{
              $updateError = '<div class="alert alert-danger" role="alert">
                                  Not updated.
                                </div>';
            }
          }
        } //---end of update if----------
     ?>
    <!-- Update profile -->
    <?php
        $id = $_SESSION['user_id'];
        $query = "SELECT * FROM user WHERE user_id = {$id} ";
        $result = mysqli_query($conn, $query) or die("Failed");
        while($row = mysqli_fetch_assoc($result)){
        $dbPassword = $row['user_pass'];
       ?>
     <div class="container bg-light">
       <div class="col-sm-6 mx-auto mt-3">
         <div class="alert alert-info text-center">
           <h3>Update profile</h3>
         </div>
         <form method="post" >
           <div class="form-group">
             <label for="name">User name:</label>
             <input type="text" name="user_name" class="form-control" required value="<?php echo $row['user_name']; ?>">
             <?php if(isset($username_error)) echo $username_error; ?>
           </div>
           <div class="form-group">
             <label for="email">Email address:</label>
             <input type="email" name="user_email" class="form-control" required value="<?php echo $row['user_email']; ?>">
             <?php if(isset($emailError)) echo $emailError; ?>
           </div>
           <input type="submit" name="update" class="btn btn-primary" value="Update">
           <?php if(isset($updateError)) echo $updateError; ?>
         </form>
       <?php } ?>
       </div>
       <br><br>
     </div>
     <!-- Update password -->
     <?php

          if(isset($_POST['update_pass'])){
            //check pass
  				if(isset($_POST['old_password']) && !empty($_POST['old_password']) && isset($_POST['c_password']) && !empty($_POST['c_password'])
  					&& isset($_POST['new_password']) && !empty($_POST['new_password']) ){

  						$oldpassword = md5($_POST['old_password']);

  							if($oldpassword == $dbPassword){

  								if(strlen($_POST['new_password'])>=5){

  									if($_POST['new_password'] == $_POST['c_password']){
  										$password = md5($_POST['new_password']);
                      //update password into db
              				if(isset($password)){

              					$update_pass = "UPDATE user SET user_pass='$password' WHERE user_id = '$id' ";

              					if(mysqli_query($conn,$update_pass)){
                          echo "<script> alert('Password updated');
                                window.location = 'user_profile.php'
                                </script>";
              					}else{

                          echo "<script> alert('Password not updated');
                                window.location = 'user_profile.php'
                                </script>";
              					}

              				}

  									}else{
  										$password_not_same_Error = '<div class="alert alert-danger" role="alert">
                                         Passwords are not same.
                                       </div>';
  									}

  								}else{
  												$password_short_Error = '<div class="alert alert-danger" role="alert">
                                              Password should be consist of 5 characters or more.
                                            </div>';
  								}

  							}else{

  								$wrong_password_Error = '<div class="alert alert-danger" role="alert">
                                     Please enter correct password.
                                   </div>';
  							}

  				}else{
  								$password_fill_Error = '<div class="alert alert-danger" role="alert">
                                      Please fill the password field.
                                    </div>';
  				}

          } //----------end of update pass if----------

      ?>
     <div class="container bg-light">
       <div class="col-sm-6 mx-auto mt-3">
         <div class="alert alert-info text-center">
           <h5>Update password</h5>
         </div>

         <form class=""  method="post">

              <div class="form-group">
								<label for="old_password">Current Password</label>
								<input type="password" required name="old_password" class="form-control">
                <?php if(isset($wrong_password_Error)) echo  $wrong_password_Error; ?>
							</div>
							<div class="form-group">
								<label for="new_password">New Password</label>
								<input type="password" required name="new_password" class="form-control" placeholder="Minimum 5 characters">
                <?php if(isset($password_short_Error)) echo $password_short_Error; ?>
							</div>
							<div class="form-group">
								<label for="c_password">Confirm Password</label>
								<input type="password" required name="c_password" class="form-control">
                <?php if(isset($password_not_same_Error)) echo  $password_not_same_Error; ?>
							</div>
              <?php if(isset($password_fill_Error)) echo  $password_fill_Error; ?>
              <button type="submit" class="btn btn-warning" name="update_pass">Update password</button>
         </form>
       </div>
     </div>
     <!-- Delete account -->
     <?php
     if(isset($_POST['delete'])){
         $delete_account = mysqli_query($conn, "DELETE FROM user WHERE user_id = '$id'");
         $delete_comment = mysqli_query($conn, "DELETE FROM comments WHERE user_id = '$id'");
         if($delete_account || $delete_comment){
           echo "<script> alert('Account deleted');
                 window.location = 'login.php'
                 </script>";
         }else{
           echo "<script> alert('Account not deleted');
                 window.location = 'login.php'
                 </script>";
         }
       }
      ?>

     <div class="container bg-light">
       <div class="col-sm-6 mx-auto mt-3">
         <div class="alert alert-info text-center">
           <h5>Delete account</h5>
         </div>
        <form class="text-center" action="" method="post">
          <input onclick="return confirm('Are you sure to delete your account!')" type="submit" name="delete" class="btn btn-danger " value="Delete account">
        </form>
       </div>
     </div>
     <br>

  <?php
    include_once "include/user_footer.php";
   ?>
