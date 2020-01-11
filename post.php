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
                        $post_id = $_GET['post_id'];
                        $author = $_POST['author'];
                        $email = $_POST['email'];
                        $comment = $_POST['comment'];
                        
                        $query = "INSERT INTO comments (post_id, author, email, content, date) ";
                        $query.= "VALUES($post_id, '$author', '$email', '$comment', now())";

                        $add_comment = mysqli_query($connection, $query);

                        handlingMySqlError($add_comment);

                        $query_count_comment = "UPDATE posts SET comment_count = comment_count + 1 ";
                        $query_count_comment.= "WHERE id = $post_id";

                        $count_comments = mysqli_query($connection, $query_count_comment);

                        header('Location:'.$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING']);
                    }
                ?>

                <!-- Comments Form -->
                <div class="well">
                    <h4>Leave a Comment:</h4>
                    <form role="form" action="" method="post">
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
                <?php

                    $query = "SELECT * FROM comments ";
                    $query.= "WHERE post_id = $post_id ";
                    $query.= "AND status = 'approved' ";
                    $query.= "ORDER BY id DESC";

                    $select_approved_comments = mysqli_query($connection, $query);

                    if(!$select_approved_comments) {
                        die('QUERY FAILED '.mysqli_error($connection));
                    }

                    while ($row = mysqli_fetch_array($select_approved_comments)) {
                        $comment_date = date_create($row['date']);
                        $comment_content = $row['content'];
                        $comment_author = $row['author'];
                ?>
                    <div class="media">
                        <a class="pull-left" href="#">
                            <img class="media-object" src="http://placehold.it/64x64" alt="">
                        </a>
                        <div class="media-body">
                            <h4 class="media-heading"><?php echo $comment_author; ?>
                                <small><?php echo date_format($comment_date,"M d, Y"); ?></small>
                            </h4>
                            <?php echo '<p>'.$comment_content.'</p>'; ?>
                        </div>
                    </div>
                <?php } ?>
        </div>
        <!-- Blog Sidebar Widgets Column -->
        <?php include "includes/sidebar.php"?>
    </div>
    <!-- /.row -->
    <hr>
<!-- Footer -->
<?php include "includes/footer.php"; ?>