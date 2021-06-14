<?php

      include_once "../config.php";

      if(isset($_FILES['image'])){

        // Get image name
  	   $image = $_FILES['image']['name'];

        // image file directory
  	    $target = "upload/".basename($image);

      }

      $title = mysqli_real_escape_string($conn, $_POST['newstitle']);
      $description = mysqli_real_escape_string($conn, $_POST['newsdescription']);
      $category = mysqli_real_escape_string($conn, $_POST['category']);
      $date = date('Y-m-d');

      $sql = "INSERT INTO news(title, description, category, news_date, image)
              VALUES ('{$title}', '{$description}', '{$category}', '{$date}', '{$image}')";

              if(mysqli_query($conn, $sql)){

                if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
                    echo "Image uploaded successfully";
                  }else{
                    echo  "Failed to upload image";
                  }

                echo "<script> alert('News added');
                      window.location = 'add_news.php'
                      </script>";
              }else{
                echo "<script> alert('News not added');
                      window.location = 'add_news.php'
                      </script>";
              }

 ?>
