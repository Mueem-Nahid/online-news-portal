<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../design/bootstrap/css/bootstrap.min.css">
    <style media="screen">
    .topnav-right {
                    float: right;
                  }
    </style>
  </head>
  <body>
        <?php
        session_start();
        //getting admin name from session
        if(!empty($_SESSION["session_admin_name"])){
          $name = $_SESSION["session_admin_name"];
        } else{
          header("location: index.php");
        }
         ?>
        <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
          <!-- Brand -->
          <a class="navbar-brand" href="admin_dashboard.php">Admin dashboard</a>

          <!-- Links -->
          <ul class="navbar-nav">
            <!-- Dropdown -->
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                Category management
              </a>
              <div class="dropdown-menu">
                <a class="dropdown-item" href="category.php">Add Category</a>
                <a class="dropdown-item" href="manage_category.php">Manage Category</a>
              </div>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                News management
              </a>
              <div class="dropdown-menu">
                <a class="dropdown-item" href="add_news.php">Add News</a>
                <a class="dropdown-item" href="manage_news.php">Manage News</a>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="users.php">All users</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="all_comments.php">All comments</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                <?php echo $name; ?>
              </a>
              <div class="dropdown-menu">
                <a class="dropdown-item" href="logout.php">Logout</a>
              </div>
            </li>
          </ul>
        </nav>
