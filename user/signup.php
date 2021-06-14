<?php
    include_once "../config.php";
    session_start();

    if(isset($_POST['submit'])){
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
          $result = mysqli_query($conn, $sql);

          if(mysqli_num_rows($result)>0){

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

      //-------------check pass field-----------
      if(isset($_POST['user_pass']) && !empty($_POST['user_pass'])){
        if(strlen($_POST['user_pass'])>=5){
          $user_pass = $_POST['user_pass'];
        }else{
                $passwordError = '<div class="alert alert-danger" role="alert">
                                    Password should be consist of 5 characters or more.
                                  </div>';
        }

      }else{
              $passwordError = '<div class="alert alert-danger" role="alert">
                                  Please fill the password field.
                                </div>';
      } //end of pass if else ----------------

      //------- insert into db---------------
      if(isset($user_name) && isset($user_email) && isset($user_pass)){
        $password = md5($user_pass);
        $sql = "INSERT INTO user(user_name, user_email, user_pass)
                VALUES ('$user_name', '$user_email', '$password')";
        if(mysqli_query($conn, $sql)){
          header("Location: login.php");
        }else{
          $submitError = '<div class="alert alert-danger" role="alert">
                              Data not inserted, try again.
                            </div>';
        }
      } //end of insert into db------------
    } //end of submit if ------------

 ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>SignUp</title>
    <link rel="stylesheet" href="../design/bootstrap/css/bootstrap.min.css">
  </head>
  <body>

    <div class="container bg-light">
      <div class="col-sm-6 mx-auto mt-3">
        <button type="button" class="btn btn-link"><a href="../index.php">Home</a></button>
        <div class="alert alert-info text-center">
          <h3>SignUp</h3>
        </div>
        <form method="post" >
          <div class="form-group">
            <label for="name">User name:</label>
            <input type="text" name="user_name" class="form-control" required placeholder="Enter user name" id="username">
            <?php if(isset($username_error)) echo $username_error; ?>
          </div>
          <div class="form-group">
            <label for="email">Email address:</label>
            <input type="email" name="user_email" class="form-control" required placeholder="Enter email" id="email">
            <?php if(isset($emailError)) echo $emailError; ?>
          </div>
          <div class="form-group">
            <label for="pwd">Password:</label>
            <input type="password" name="user_pass" class="form-control" required placeholder="At least 5 characters or more..." id="pwd">
            <?php if(isset($passwordError)) echo $passwordError; ?>
          </div>
          <input type="submit" name="submit" class="btn btn-primary" value="Submit">
          <button type="button" class="btn btn-link"><a href="login.php">Already a member! Click to log in</a></button>
        </form>
      </div>

    </div>

  </body>
</html>
