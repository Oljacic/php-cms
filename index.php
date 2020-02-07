<?php include "includes/db.php"; ?>
<?php include "includes/header.php"; ?>
<?php
    $session = session_id();
    $time = time();
    $time_out_in_seconds = 60;

    $time_out = $time - $time_out_in_seconds;

    $query = "SELECT * FROM users_online ";
    $query.= "WHERE session = '$session'";
    $send_query = mysqli_query($connection, $query);
    $count = mysqli_num_rows($send_query);

    // var_dump($count);

    if($count == NULL) {
        // exit();
        mysqli_query($connection, "INSERT INTO users_online(session, time) VALUES ('$session', '$time')");
        
    } 

?>
<!-- Navigation -->
<?php include "includes/navigation.php"; ?>
<!-- Page Content -->
<div class="container">
    <div class="row">
        <!-- Blog Entries Column -->
        <div class="col-md-8">
            <h1 class="page-header">Page Heading<small>Secondary Text</small></h1>
            <?php
                $per_page = 5;
                if(isset($_GET['page'])) {
                    $page = $_GET['page'];
                } else {
                    $page = "";
                }

                if($page == "" || $page == 1) {
                    $page_1 = 0;
                } else {
                    $page_1 = ($page * $per_page) - $per_page;
                }


                $query_count = "SELECT * FROM posts";
                $result_post = mysqli_query($connection, $query_count);
                $count = mysqli_num_rows($result_post);

                $count = ceil($count / $per_page);



                $query = "SELECT * FROM posts ";
                $query.= "ORDER BY date DESC ";
                $query.= "LIMIT $page_1, $per_page";
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
                    <p class="lead">by                       
                        <a href="related_post.php?user=<?php echo $post_author; ?>"><?php echo $post_author; ?></a>
                    </p>
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
    <ul class="pager">
        <?php
            for($i = 1; $i <= $count; $i++) {
                if($i == $page) {
                    echo "<li><a class='active_link' href='index.php?page={$i}'>{$i}</a></li>"; 
                } else {
                    echo "<li><a href='index.php?page={$i}'>{$i}</a></li>";
                }
            }
        ?>
    </ul>
<!-- Footer -->
<?php include "includes/footer.php"; ?>