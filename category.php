<style>
   h5:hover {
       background-color: yellow;
     }
</style>

<?php
  include "include/header.php";
  include "config.php";

  $cat_id = $_GET['cid'];
  $result = mysqli_query($conn, "SELECT * FROM category WHERE category.category_id = {$cat_id}");
  while($data = mysqli_fetch_assoc($result)){
?>

<div class="mt-3 text-center alert alert-primary" role="alert">
 <h3><?php echo $data['category_name']; ?></h3>
</div>

<?php  } ?>


       <div class="container bg-light">
         <div class="row">
           <!-- Data collect -->
           <?php
               $result2 = mysqli_query($conn, "SELECT news.news_id, news.title, news.description, news.news_date, news.image, category.category_name FROM news
                         LEFT JOIN category ON news.category = category.category_id WHERE news.category={$cat_id} ORDER BY news.news_id DESC");
               $count = mysqli_num_rows($result2);
               if($count > 0){

                 while($data2 = mysqli_fetch_assoc($result2)){
              ?>
             <div class="col-lg-4 mb-4">
               <div class="card" style="width: 18rem;">
                <img class="card-img-top" src="admin/upload/<?php echo $data2['image']; ?>" alt="Card image cap">
                <div class="card-body">
                  <h5 class="card-title effect-underline text-center"><b><?php echo $data2['title']; ?></b></h5>
                  <p class="card-text text-center"><?php echo substr($data2['description'], 0, 170)." ..." ?></p>
                    <ul class="list-group list-group-flush">
                      <li class="list-group-item text-center"><?php echo $data2['category_name']; ?></li>
                      <li class="list-group-item text-center"><?php echo "Uploaded on: " .$data2['news_date']; ?></li>
                    </ul>
                  <a href="single_view.php?id=<?php echo $data2['news_id']; ?>" class="btn btn-primary">Read more...</a>
                </div>
              </div>
             </div>

              <?php } ?>

            <?php }else{
                echo "<div class='text-center alert alert-warning' role='alert'>
                 <h4>No news on this category.</h4>
                </div>";
            }?>


          </div>
        </div>








<?php
  include "include/footer.php";
 ?>
