<?php include("includes/header.php"); ?>
<?php if (!$session->is_signed_in()) {redirect("login.php");} ?>



<?php 

 $photos = Photo::find_all();

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
                            Photos
                        </h1>

                       <div class="col-md-12 text-center">
                           
                          <table class="table table-hover">
                              <thead>
                                  <tr>
                                      <th class="text-center">Photo</th>
                                      <th class="text-center">ID</th>
                                      <th class="text-center">Filename</th>
                                      <th class="text-center">size</th>
                                      <th class="text-center">Title</th>
                                      <th class="text-center">Date</th>
                                      <th class="text-center">Comments</th>
                                  </tr>
                            
                              </thead>
                              <tbody>

                             <?php foreach ($photos as $photo) : ?>

                                  <tr>
                                     
                                      <td><img src="<?php echo $photo->picture_path(); ?>" width="100" alt="" style="border-radius: 5px;">
                                        <div class="v-e-d">
                                            <a href="../photo.php?id=<?php echo $photo->id; ?>">View</a>
                                            <a href="edit_photo.php?id=<?php echo $photo->id; ?>">Edit</a>
                                            <a href="delete_photo.php?id=<?php echo $photo->id; ?>" class="delete_link">Delete</a>
                                        </div>
                                    </td>
                                      <td><?php echo $photo->id; ?></td>
                                      <td><?php echo $photo->filename; ?></td>
                                      <td><?php echo $photo->size; ?></td>
                                      <td><?php echo $photo->title; ?></td>
                                      <td><?php echo $photo->date; ?></td>
                                      <td>
                                       <a href="comment_photo.php?id=<?php echo $photo->id; ?>">
                                        <?php 
                                        
                                        $comments = Comment::find_the_comments($photo->id);

                                        echo count($comments);

                                         ?>
                                            
                                      </a>
                                     </td>

                                  </tr>

                              <?php endforeach; ?>

                              </tbody>
                          </table>
                      

                       </div>



                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

  <?php include("includes/footer.php"); ?>