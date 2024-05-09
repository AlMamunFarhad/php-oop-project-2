<?php include("includes/header.php"); ?>
<?php if (!$session->is_signed_in()) {redirect("login.php");} ?>



<?php 



 $user = new User();
 
 if (isset($_POST['add_user'])) {


  if($user){
 

  $user->username    = $_POST['username']; 
  $user->firstname   = $_POST['firstname']; 
  
  $user->lastname    = $_POST['lastname']; 
  $user->password    = $_POST['password'];

  $user->set_file($_FILES['user_image']); 
  $user->update_photo();
  $user->save();

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
                            Add Users
                        </h1>

                       <form action="" method="post" enctype="multipart/form-data">
                       <div class="col-md-8 ">
                         <div class="form-group">         
                           <input type="file" name="user_image">
                         </div> 
                           
                         <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" name="username">
                         </div>

                         <div class="form-group">
                            <label for="firstname">First Name</label>
                            <input type="text" class="form-control" name="firstname">
                         </div>

                         <div class="form-group">
                            <label for="lastname">Last Name</label>
                            <input type="text" class="form-control" name="lastname">
                         </div>

                         <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" name="password">
                         </div>

                         <div class="add-user pull-right">

                         <input type="submit" class="btn btn-primary" name="add_user">
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