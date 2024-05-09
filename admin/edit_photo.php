<?php include("includes/header.php"); ?>
<?php if (!$session->is_signed_in()) {redirect("login.php");} ?>



<?php 



if (empty($_GET['id'])) {

  redirect("photos.php");

}else{

 $photo = Photo::find_by_id($_GET['id']);

 
 if (isset($_POST['update'])) {



 if($photo){
 
  $photo->title          = $_POST['title']; 
  $photo->caption        = $_POST['caption']; 
  $photo->alternate_text = $_POST['alternate-text']; 
  $photo->description    = $_POST['description'];


  if (empty($_FILES['upload_image'])) {
      
      $photo->save();

  }else{

     $photo->set_file($_FILES['upload_image']);
     
     $photo->update_photo();
     $photo->save();

  }

  // if($photos = new Photo()){
  // $photo->set_file($_FILES['upload_image']);
  // $photo->save_images();
  // $photo->delete_photo();


  // }




  // $photo->filename      =

  // if()
 

  $photo->save();

   } 
    
  }

}




 ?>

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <?php include("includes/top_nav.php"); ?>

            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <?php include("includes/side_nav.php"); ?>

            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">

             <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Update Photos
                        </h1>

                       <form action="" method="post" enctype="multipart/form-data" class="edit-form">
                       <div class="col-md-8">
                       

                        <div class="text-center form-group" style="width: 100%;">
                            <img src="<?php echo $photo->image_path_and_placeholder(); ?>" width="200" alt="" style="margin-bottom: 10px; border-radius: 5px;">

                            <div class="upload-image">
                          
                           <input type="file" name="upload_image" style="margin: 0 auto; width: 199px;">
                           </div>
                            <!-- value="<?php //echo $photo->picture_path(); ?>" -->
                         </div>
                           
                         <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" name="title" value="<?php echo $photo->title; ?>">
                         </div>

                         <div class="form-group">
                            <label for="">Caption</label>
                            <input type="text" class="form-control" name="caption" value="<?php echo $photo->caption; ?>">
                         </div>

                         <div class="form-group">
                            <label for="alternate-text">Alternate Text</label>
                            <input type="text" class="form-control" name="alternate-text" value="<?php echo $photo->alternate_text; ?>">
                         </div>

                         <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="description" id="" cols="30" class="form-control"><?php echo $photo->description; ?></textarea>
                         </div>

                        

                       </div>

                          <div class="col-md-4" >
                            <div  class="photo-info-box">
                                <div class="info-box-header">
                                   <h4>Save <span id="toggle" class="glyphicon glyphicon-menu-up pull-right"></span></h4>
                                </div>
                            <div class="inside">
                              <div class="box-inner">
                                 <p class="text">
                                   <span class="glyphicon glyphicon-calendar"></span> Uploaded on: <?php echo $photo->date; ?>
                                  </p>
                                  <p class="text ">
                                    Photo Id: <span class="data photo_id_box"><?php echo $photo->id; ?></span>
                                  </p>
                                  <p class="text">
                                    Filename: <span class="data"><?php echo $photo->filename; ?></span>
                                  </p>
                                 <p class="text">
                                  File Type: <span class="data"><?php echo $photo->type; ?></span>
                                 </p>
                                 <p class="text">
                                   File Size: <span class="data"><?php echo $photo->size; ?></span>
                                 </p>
                              </div>
                              <div class="info-box-footer clearfix">
                                <div class="info-box-delete pull-left">
                                    <a  href="delete_photo.php?id=<?php echo $photo->id; ?>" class="btn btn-danger btn-lg ">Delete</a>   
                                </div>
                                <div class="info-box-update pull-right ">
                                    <input type="submit" name="update" value="Update" class="btn btn-primary btn-lg ">
                                </div>   
                              </div>
                            </div>          
                        </div>
                    </div>

                    </form>

                    </div>

                   
                        


                    
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->


  <?php include("includes/footer.php"); ?>