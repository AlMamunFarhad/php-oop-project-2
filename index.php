<?php include("includes/header.php"); ?>



<?php 

$page = !empty($_GET['page']) ? (int)$_GET['page'] : 1;


$items_per_page = 16;


$total_items_count = Photo::count_all();


$paginate = new Paginate($page, $items_per_page, $total_items_count);


$sql  = "SELECT * FROM photos ";
$sql .= "LIMIT {$items_per_page} ";
$sql .= "OFFSET {$paginate->offset()}";

$photos = Photo::find_by_query($sql);



 ?>





    <div class="row">

    <!-- Blog Entries Column -->
      <div class="col-md-12">

       

        <div class="thumbnails row">

          <?php foreach ($photos as $photo): ?>
               
           <div class="col-xs-6 col-md-3">
               
              <a href="photo.php?id=<?php echo $photo->id; ?>" class="thumbnail">
              <img src="admin/<?php echo $photo->picture_path(); ?>" style="border-radius: 10px;" alt="" class="img-responsive">

              </a>

           </div>

           <?php endforeach; ?>

           </div>


          <div class="row">
              
              <ul class="pager">
                  <?php 

                   if ($paginate->page_total() > 1) {


                    if ($paginate->has_next()) {
                        
                      echo "<li class='next'><a href='index.php?page={$paginate->next()}'>Next</a></li>";

                    }
                       
                   

                   for($i = 1; $i <= $paginate->page_total(); $i++){

                   if ($i == $paginate->current_page) {
                       
                      echo "<li><a style='background: #f2f2f2' href='index.php?page={$i}'>{$i}</a></li>";
                   }else{
                     
                     echo "<li class='active'><a href='index.php?page={$i}'>{$i}</a></li>";

                   }

                   }

                   if($paginate->has_previous()) {

                    echo "<li class='previous'><a href='index.php?page={$paginate->previous()}'>Previous</a></li>";

                   }



                }


                  ?>
            

              </ul>


          </div>






            

            </div>







            <!-- Blog Sidebar Widgets Column -->
<!--             <div class="col-md-4">

            
                 <?php //include("includes/sidebar.php"); ?>



        </div> -->
        <!-- /.row -->

        <?php// include("includes/footer.php"); ?>
