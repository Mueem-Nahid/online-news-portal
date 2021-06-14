<!DOCTYPE html>
<html lang="en">
<head>
  <title>News Portal</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../design/bootstrap/css/bootstrap.min.css">
  <style>
      .dropdown-menu > a:hover {
        background-color: DarkCyan;
      }
  </style>
</head>
<body>
<header>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="./index.php">News portal</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Category
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">

              <?php
              include "../config.php" ;
              session_start();
              $id = $_SESSION['user_id'];
              if(!empty($_SESSION["user_name"])){
                $name = $_SESSION["user_name"];
              } else{
                header("location: ../index.php");
              }

              $query = "SELECT * FROM category";
              $result = mysqli_query($conn, $query) or die("Category query failed.");
              while($data = mysqli_fetch_assoc($result)){

              ?>
              <a class="dropdown-item" <?php echo "href='./category.php?cid={$data['category_id']}'> {$data['category_name']}";?> </a>

              <?php } ?>

        </li>
        <li class="nav-item dropdown">
         <a class="nav-link dropdown-toggle" href="" data-toggle="dropdown"> <?php  echo $name;  ?> </a>
         <div class="dropdown-menu">
           <a class="dropdown-item" href="./user_profile.php">Profile</a>
           <a class="dropdown-item" href="logout.php">Logout</a>
         </div>
       </li>
      </ul>
      <form class="form-inline my-2 my-lg-0" method="get" action="./search.php">
        <input class="form-control mr-sm-2" type="search" name="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
      </form>
    </div>
  </nav>
</header>
</body>
</html>
