<?php
  include_once "include/header.php";
  include_once "config.php";
 ?>

   <style>
      h5:hover {
          background-color: yellow;
        }
   </style>

 <div id="carouselExampleIndicators" class="carousel slide " data-ride="carousel">
   <ol class="carousel-indicators">
     <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
     <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
     <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
   </ol>
   <div class="carousel-inner">
     <div class="carousel-item active">
       <img class="d-block w-100" src="images/news_1.png" alt="First slide">
         <div class="carousel-caption d-none d-md-block">
            <h4 class="text-dark">News of every corner</h4>
            <p class="text-dark">We are fast</p>
        </div>
     </div>
     <div class="carousel-item">
       <img class="d-block w-100" src="images/news_2.png" alt="Second slide">
         <div class="carousel-caption d-none d-md-block">
            <h4 class="text-dark">Hot news</h4>
            <p class="text-dark">Stay with us</p>
        </div>
     </div>
     <div class="carousel-item">
       <img class="d-block w-100" src="images/news_3.png" alt="Third slide">
         <div class="carousel-caption d-none d-md-block">
            <h4 class="text-dark"> Online news is here</h4>
            <p class="text-dark">From early morning to late night</p>
        </div>
     </div>
   </div>
   <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
     <span class="carousel-control-prev-icon" aria-hidden="true"></span>
     <span class="sr-only">Previous</span>
   </a>
   <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
     <span class="carousel-control-next-icon" aria-hidden="true"></span>
     <span class="sr-only">Next</span>
   </a>
 </div>
 <div class="mt-3 text-center alert alert-primary" role="alert">
  <h3>Welcome to online news portal.</h3>
 </div>
      <!-- Card view -->
       <div class="container bg-light">
         <div class="row">
           <!-- Data collect -->
           <?php
               $result = mysqli_query($conn, "SELECT news.news_id, news.title, news.description, news.news_date, news.image, category.category_name FROM news
                         LEFT JOIN category ON news.category = category.category_id ORDER BY news.news_id DESC");
               while($data = mysqli_fetch_assoc($result)){
            ?>
           <div class="col-lg-4 mb-4">
             <div class="card" style="width: 18rem;">
              <img class="card-img-top" src="admin/upload/<?php echo $data['image']; ?>" alt="Card image cap">
              <div class="card-body">
                <h5 class="card-title effect-underline text-center"><b><?php echo $data['title']; ?></b></h5>
                <p class="card-text text-center"><?php echo substr($data['description'], 0, 170)." ..." ?></p>
                  <ul class="list-group list-group-flush">
                    <li class="list-group-item text-center"><?php echo $data['category_name']; ?></li>
                    <li class="list-group-item text-center"><?php echo "Uploaded on: " .$data['news_date']; ?></li>
                  </ul>
                <a href="single_view.php?id=<?php echo $data['news_id']; ?>" class="btn btn-primary">Read more...</a>
              </div>
            </div>
           </div>

             <?php } ?>
          </div>
        </div>




 <?php
   include_once "include/footer.php";
  ?>
