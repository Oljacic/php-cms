<?php include "includes/db.php"; ?>
<?php include "includes/header.php"; ?>
<!-- Navigation -->
<?php include "includes/navigation.php"; ?>
<!-- Page Content -->
<div class="container">
    <div class="row">
        <!-- Blog Entries Column -->
        <div class="col-md-8">
            <h1 class="page-header">Page Heading<small>Secondary Text</small></h1>
            <?php
                $post_id = '';
                if(isset($_GET['post_id'])) {
                    $post_id = $_GET['post_id'];
                }

                $query = "SELECT * FROM posts ";
                $query.= "WHERE id = $post_id";

                $select_post = mysqli_query($connection, $query);
                handlingMySqlError($select_post);

                while ($row = mysqli_fetch_assoc($select_post)) :
                    $post_title = $row['title'];
                    $post_author = $row['author'];
                    $post_date = $row['date'];
                    $post_image = $row['image'];
                    $post_content = $row['content'];
            ?>
                 <!-- First Blog Post -->
                <h2><a href="#"><?php echo $post_title; ?></a></h2>
                <p class="lead">by <a href="index.php"><?php echo $post_author; ?></a></p>
                <p><span class="glyphicon glyphicon-time"></span><?php echo $post_date; // Posted on August 28, 2013 at 10:00 PM ?></p>
                <hr>
                <img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="">
                <hr>
                <p><?php echo $post_content; ?></p>
                <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
                <hr>
            <?php endwhile; ?>
            
            
                <!-- Blog Comments -->
                <?php 
                    if(isset($_POST['create_comment'])) {
                        $author = $_POST['author'];
                        $email = $_POST['email'];
                        $comment = $_POST['comment'];
                        $status = 'approved';
                        
                        $query = "INSERT INTO comments (post_id, author, email, content, status, date) ";
                        $query.= "VALUES($post_id, '$author', '$email', '$comment', '$status', now())";

                        $add_comment = mysqli_query($connection, $query);

                        handlingMySqlError($add_comment);
                    }
                ?>

                <!-- Comments Form -->
                <div class="well">
                    <h4>Leave a Comment:</h4>
                    <form role="form" method="post">
                        <div class="form-group">
                            <label for="author">Author</label>
                            <input type="text" class="form-control" name="author">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" name="email">
                        </div>
                        <div class="form-group">
                            <label for="comment">Your Comment</label>
                            <textarea class="form-control" rows="3" name="comment"></textarea>
                        </div>
                        <button type="submit" name="create_comment" class="btn btn-primary">Submit</button>
                    </form>
                </div>

                <hr>

                <!-- Posted Comments -->

                <!-- Comment -->
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading">Start Bootstrap
                            <small>August 25, 2014 at 9:30 PM</small>
                        </h4>
                        Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                    </div>
                </div>

                <!-- Comment -->
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading">Start Bootstrap
                            <small>August 25, 2014 at 9:30 PM</small>
                        </h4>
                        Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                        <!-- Nested Comment -->
                        <div class="media">
                            <a class="pull-left" href="#">
                                <img class="media-object" src="http://placehold.it/64x64" alt="">
                            </a>
                            <div class="media-body">
                                <h4 class="media-heading">Nested Start Bootstrap
                                    <small>August 25, 2014 at 9:30 PM</small>
                                </h4>
                                Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                            </div>
                        </div>
                        <!-- End Nested Comment -->
                    </div>
                </div>

        </div>
        <!-- Blog Sidebar Widgets Column -->
        <?php include "includes/sidebar.php"?>
    </div>
    <!-- /.row -->
    <hr>
<!-- Footer -->
<?php include "includes/footer.php"; ?>