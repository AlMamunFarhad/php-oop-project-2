<?php include("includes/header.php"); ?>
<?php if (!$session->is_signed_in()) {redirect("login.php");} ?>



<?php 

 $comments = Comment::find_all();

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
                            Comments
                        </h1>
                    
                       <p class="bg-success"><?php echo $message; ?></p>
                     
                       <div class="col-md-12 text-center align-content-center">
                          <table class="table table-hover">
                              <thead>
                                  <tr>
                                      <th class="text-center">Id</th>
                                      <th class="text-center">Author</th>
                                      <th class="text-center">Comments</th>
                                  </tr>
                              </thead>
                              <tbody class="align-items-center">

                             <?php foreach ($comments as $comment) : ?>

                                  <tr>
                                       
                                      <td><?php echo $comment->id;?></td>
                                    
                                      <td><?php echo $comment->author; ?>
                                             <div class="ct-page">
                                            <a href="delete_comment.php?id=<?php echo $comment->id; ?>">Delete</a>
                                        </div>
                                      </td>
                                      <td><?php echo $comment->body; ?></td>
                    

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