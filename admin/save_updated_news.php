<?php

      include_once "../config.php";

      if(empty($_FILES['new-image']['name'])){
        $image_name = $_POST['old-image'];
      }else{
        // Get image name
  	   $image_name = $_FILES['new-image']['name'];
       // image file directory
       $target = "upload/".basename($image_name);
       move_uploaded_file($_FILES['new-image']['tmp_name'], $target);
      }

      $title = mysqli_real_escape_string($conn, $_POST['newstitle']);
      $description = mysqli_real_escape_string($conn, $_POST['newsdescription']);
      $query = "UPDATE news SET
                title = '$title',
                description = '$description',
                category = {$_POST["select_category"]},
                image = '{$image_name}'
                WHERE news_id = {$_POST["news_id"]}";

                $result = mysqli_query($conn, $query);

                if ($result) {
                    echo "<script> alert(' News updated. ');
                            window.location = 'manage_news.php'
                          </script>";
                  }else{

                    echo "<script> alert('News not updated.');
                            window.location = 'manage_news.php'
                          </script>";
                  }
 ?>
