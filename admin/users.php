<?php include("includes/header.php"); ?>
<?php if (!$session->is_signed_in()) {redirect("login.php");} ?>



<?php 

 $users = User::find_all();

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
                            Users
                        </h1>

                            <p class="bg-success">
                            <?php echo $message; ?>
                        </p>

                       <div class="col-md-12 text-center align-content-center">
                        <div class="add_btn pull-left" style="margin-bottom: 15px;">
                        <a href="add_user.php" class="btn btn-primary">Add User</a>
                       </div>    
                          <table class="table table-hover">
                              <thead>
                                  <tr>
                                      <th class="text-center">Photo</th>
                                      <th class="text-center">Id</th>
                                      <th class="text-center">Username</th>
                                      <th class="text-center">Firstname</th>
                                      <th class="text-center">Lastname</th>
                                  </tr>
                              </thead>
                              <tbody class="align-items-center">

                             <?php foreach ($users as $user) : ?>


                                  <tr>
                                     <td><img class="admin-user-thumbnail user_image" src="<?php echo $user->image_path_and_placeholder(); ?>" width="100" style="border-radius: 5px;" alt=""></td>                                      
                                      <td><?php echo $user->id;?></td>                                   
                                      <td><?php echo $user->username; ?>
                                             <div class="u-d">
                                           <a href="edit_user.php?id=<?php echo $user->id; ?>">Edit</a> 
                                            <a href="delete_user.php?id=<?php echo $user->id; ?>">Delete</a>
                                        </div>
                                      </td>
                                      <td><?php echo $user->firstname; ?></td>
                                      <td><?php echo $user->lastname; ?></td>
                    

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