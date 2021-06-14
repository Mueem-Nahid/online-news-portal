<?php
    include_once "../config.php";
    session_start();

    if(isset($_POST['login'])){
      //------check email field----------
      if(isset($_POST['user_email']) && !empty($_POST['user_email'])){
          $user_email = $_POST['user_email'];
      }else{
        $emailError = '<div class="alert alert-danger" role="alert">
                          Please fill the email field.
                      </div>';
      }
      //--------check pass field---------
      if(isset($_POST['user_pass']) && !empty($_POST['user_pass'])){
        $user_pass = $_POST['user_pass'];
        $password = md5($user_pass);
      }else{
        $passwordError = '<div class="alert alert-danger" role="alert">
                            Please fill the password field.
                          </div>';
      }
      //-----LogIn query----------
      if(isset($user_email) && isset($password)){

			$sql = "SELECT * FROM user WHERE user_pass='$password' AND user_email='$user_email'";
			$result = mysqli_query($conn, $sql);

			if(mysqli_num_rows($result)>0){

				while($row = mysqli_fetch_assoc($result)){

          if(isset($_POST['rememberme'])){
            setcookie('user_email', $user_email, time()+3600);
            setcookie('user_pass', $user_pass, time()+3600);
          }

					$_SESSION['user_id'] = $row['user_id'];
					$_SESSION['user_name'] = $row['user_name'];

					header('Location: index.php');

				} //end while

			}else{
        $loginError = '<div class="alert alert-danger" role="alert">
                          No reccord found. Enter valid email and password.
                      </div>';
      }
    } //end of login query---------

    } //end of login if----------
 ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Login</title>
    <link rel="stylesheet" href="../design/bootstrap/css/bootstrap.min.css">
  </head>
  <body>

    <div class="container bg-light">
      <div class="col-sm-6 mx-auto mt-3">
        <button type="button" class="btn btn-link"><a href="../index.php">Home</a></button>
        <div class="alert alert-info text-center">
          <h3>Login</h3>
        </div>
        <form method="post" >
          <?php if(isset($loginError)) echo $loginError; ?>
          <div class="form-group">
            <label for="email">Email address:</label>
            <input type="email" name="user_email" class="form-control" required placeholder="Enter email" id="email">
            <?php if(isset($emailError)) echo $emailError; ?>
          </div>
          <div class="form-group">
            <label for="pwd">Password:</label>
            <input type="password" name="user_pass" class="form-control" required placeholder="Enter password" id="pwd">
            <?php if(isset($passwordError)) echo $passwordError; ?>
          </div>
          <div class="form-group form-check">
            <label class="form-check-label">
              <input class="form-check-input" type="checkbox" name="rememberme"> Remember me
            </label>
          </div>
          <input type="submit" name="login" class="btn btn-primary" value="Submit">
          <button type="button" class="btn btn-link"><a href="signup.php">Click to sign up</a></button>
        </form>

      </div>

    </div>

  </body>
</html>

      <?php
        if (isset($_COOKIE['user_email']) and isset($_COOKIE['user_pass'])) {
          $email = $_COOKIE['user_email'];
          $pass = $_COOKIE['user_pass'];
          echo "<script>document.getElementById('email').value = '$email';
                document.getElementById('pwd').value = '$pass';</script>";
        }
         ?>
