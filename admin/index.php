<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Admin Login</title>
    <link rel="stylesheet" href="../design/bootstrap/css/bootstrap.min.css">
  </head>
  <body>

    <div class="container bg-light">
      <div class="col-sm-6 mx-auto mt-3">
        <div class="alert alert-info text-center">
          <h3>Admin Login</h3>
        </div>
        <form action="check.php" method="post" >
          <div class="form-group">
            <label for="email">Email address:</label>
            <input type="email" name="admin_email" class="form-control" required placeholder="Enter email" id="email">
          </div>
          <div class="form-group">
            <label for="pwd">Password:</label>
            <input type="password" name="admin_pass" class="form-control" required placeholder="Enter password" id="pwd">
          </div>
          <div class="form-group form-check">
            <label class="form-check-label">
              <input class="form-check-input" name="rememberme" type="checkbox"> Remember me
            </label>
          </div>
          <input type="submit" name="btnLogin" class="btn btn-primary" value="Submit">
        </form>
      </div>

    </div>

    <?php
        if (isset($_COOKIE['admin_email']) and isset($_COOKIE['admin_pass'])) {
          $email = $_COOKIE['admin_email'];
          $pass = $_COOKIE['admin_pass'];
          echo "<script>document.getElementById('email').value = '$email';
                document.getElementById('pwd').value = '$pass';</script>";
        }
         ?>

  </body>
</html>
