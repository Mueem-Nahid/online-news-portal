<?php
  include_once "includes/admin_header.php";
  include_once "../config.php";

        // Update profile
        if(isset($_POST['update'])){
          //-----check user name field-----------
          if(isset($_POST['admin_name']) && !empty($_POST['admin_name'])){
            if(preg_match('/^[A-Za-z\s]+$/', $_POST['admin_name'])){
              $admin_name = $_POST['admin_name'];
            }else{
              $adminname_error = '<div class="alert alert-danger" role="alert">
                                  Only lower and upper case and space characters are allowed.
                                </div>';
            }
          }else{
            $adminname_error = '<div class="alert alert-danger" role="alert">
                                Please fill the username field.
                              </div>';
          } //end of user_name if else ----------------

          //--------check email field----------------
          if(isset($_POST['admin_email']) && !empty($_POST['admin_email'])){
            $pattern = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/';
            if(preg_match($pattern, $_POST['admin_email'])){

                $admin_email = $_POST['admin_email'];

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
          if(isset($admin_name) && isset($admin_email)){
            $sql2 = "UPDATE admin_login SET name = '$admin_name', eid = '$admin_email' ";
            if(mysqli_query($conn, $sql2)){
              echo "<script> alert('Profile updated');
                    window.location = 'admin_dashboard.php'
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
        $query = "SELECT * FROM admin_login ";
        $result = mysqli_query($conn, $query) or die("Failed");
        while($row = mysqli_fetch_assoc($result)){
        $dbPassword = $row['password'];
       ?>
     <div class="container bg-light">
       <div class="col-sm-6 mx-auto mt-3">
         <div class="alert alert-info text-center">
           <h3>Welcome Admin</h3>
         </div>
         <form method="post" >
           <div class="form-group">
             <label for="name">Admin name:</label>
             <input type="text" name="admin_name" class="form-control" required value="<?php echo $row['name']; ?>">
             <?php if(isset($adminname_error)) echo $adminname_error; ?>
           </div>
           <div class="form-group">
             <label for="email">Email address:</label>
             <input type="email" name="admin_email" class="form-control" required value="<?php echo $row['eid']; ?>">
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

              					$update_pass = "UPDATE admin_login SET password='$password' ";

              					if(mysqli_query($conn,$update_pass)){
                          echo "<script> alert('Password updated');
                                window.location = 'admin_dashboard.php'
                                </script>";
              					}else{

                          echo "<script> alert('Password not updated');
                                window.location = 'admin_dashboard.php'
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
     <br>

  <?php
    include_once "includes/admin_footer.php";
   ?>
