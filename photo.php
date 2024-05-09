<?php include("includes/header.php"); ?>



<?php 


    if (empty($_GET['id'])) {

    redirect("index.php");

    }


    $photo = Photo::find_by_id($_GET['id']);

    if (isset($_POST['submit'])) {

    $author = trim($_POST['author']);
    $body   = trim($_POST['body']);


    $new_comment = Comment::create_comment($photo->id, $author, $body); 

    if($new_comment && $new_comment->save()){

    redirect("photo.php?id={$photo->id}");

    }else{


    $message = "There was some problems saving";

    }


    }else{


    $author = "";
    $body   = "";

    }

    $comments = Comment::find_the_comments($photo->id);





 ?>




    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Post Content Column -->
            <div class="col-lg-12">

                <!-- Blog Post -->

                <!-- Title -->
                <h1><?php echo $photo->title; ?></h1>

                <!-- Author -->
                <p class="lead">
                    by <a href="#">Start Bootstrap</a>
                </p>

                <hr>

                <!-- Date/Time -->
                <p><span class="glyphicon glyphicon-time"></span> <?php echo $photo->date; ?></p>

                <hr>

                <!-- Preview Image -->
                <img class="img-responsive" width="400" src="admin/<?php echo $photo->picture_path(); ?>" style="border-radius: 10px;" alt="">

                <hr>

                <h6 class="lead"><?php echo $photo->caption; ?></h6>

                <!-- Post Content -->
                <p class="lead"><?php echo $photo->description; ?></p>
               </p>

                <hr>

                <!-- Blog Comments -->

                <!-- Comments Form -->
                <div class="well">
                    <h4>Leave a Comment:</h4>
                    <form role="form" method="post">
                        <div class="form-group">
                            <label for="author">Author</label>
                            <input type="text" class="form-control" name="author">
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" rows="3" name="body"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                    </form>
                </div>

                <hr>

                <!-- Posted Comments -->

                <?php foreach ($comments as $comment): ?>

                <!-- Comment -->
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading"><?php echo $comment->author; ?>
                            <small><?php echo $comment->date; ?></small>
                        </h4>
                         <?php echo $comment->body; ?>
                    </div>
                </div>

         <?php endforeach; ?>
            </div>

        </div>
        <!-- /.row -->

        <hr>



    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
