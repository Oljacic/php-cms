<?php include "includes/db.php"; ?>
<?php include "includes/header.php"; ?>
<!-- Navigation -->
<?php include "includes/navigation.php"; ?>
<!-- Page Content -->
<div class="container">
    <div class="row">
        <!-- Blog Entries Column -->
        <div class="col-md-8">
        <?php
            $username = '';  

            if(isset($_GET['user'])) {
                $username = $_GET['user'];
            }
        ?>
        <h1 class="page-header">Author related post <small><?php echo $username; ?></small></h1>
          <?php 
                $query = "SELECT * FROM posts ";
                $query.= "WHERE author = '$username' ";
                $query.= "ORDER BY date DESC";
                $select_all_posts = mysqli_query($connection, $query);

                while ($row = mysqli_fetch_assoc($select_all_posts)) :
                    $post_id = $row['id'];
                    $post_title = $row['title'];
                    $post_author = $row['author'];
                    $post_date =  date('d-M-Y H:i:s',$row['date']);
                    $post_image = $row['image'];
                    $post_content = substr($row['content'], 0, 100);
                    $post_status = $row['status'];
            ?>
                <?php if($post_status == 'published') : ?>
                    <!-- First Blog Post -->
                    <h2>
                        <a href="post.php?post_id=<?php echo $post_id; ?>">
                            <?php echo $post_title; ?>
                        </a>
                    </h2>
                    <p>
                        <span class="glyphicon glyphicon-time"></span>
                        <?php echo $post_date; // Posted on August 28, 2013 at 10:00 PM ?>
                    </p>
                    <hr>
                    <a href="post.php?post_id=<?php echo $post_id; ?>">
                        <img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="">
                    </a>
                    <hr>
                    <p><?php echo $post_content; ?></p>
                    <a class="btn btn-primary" href="post.php?post_id=<?php echo $post_id; ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
                    <hr>
                <?php endif; ?>
            <?php endwhile; ?>
        </div>
        <!-- Blog Sidebar Widgets Column -->
        <?php include "includes/sidebar.php"?>
    </div>
    <!-- /.row -->
    <hr>
<!-- Footer -->
<?php include "includes/footer.php"; ?>