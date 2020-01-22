<?php include "includes/admin_header.php" ?>

<div id="wrapper">

    <?php include "includes/admin_navigation.php" ?>

    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Welcome to Admin
                        <small><?php echo $_SESSION['username']; ?></small>
                    </h1>
                </div>
            </div>


            <!-- /.row -->

            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-file-text fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">

                                    <?php
                                    $query = "SELECT * FROM posts";
                                    $select_posts = mysqli_query($connection, $query);
                                    $count_posts = mysqli_num_rows($select_posts);

                                    echo "<div class='huge'>$count_posts</div>";
                                    ?>

                                    <div>Posts</div>
                                </div>
                            </div>
                        </div>
                        <a href="posts.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-comments fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <?php
                                    $query = "SELECT * FROM comments";
                                    $select_comments = mysqli_query($connection, $query);
                                    $count_comments = mysqli_num_rows($select_comments);

                                    echo "<div class='huge'>$count_comments</div>";
                                    ?>
                                    <div>Comments</div>
                                </div>
                            </div>
                        </div>
                        <a href="comments.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-user fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <?php
                                    $query = "SELECT * FROM users";
                                    $select_users = mysqli_query($connection, $query);
                                    $count_users = mysqli_num_rows($select_users);

                                    echo "<div class='huge'>$count_users</div>"
                                    ?>
                                    <div> Users</div>
                                </div>
                            </div>
                        </div>
                        <a href="users.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-red">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-list fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <?php
                                    $query = "SELECT * FROM categories";
                                    $select_categories = mysqli_query($connection, $query);
                                    $count_categories = mysqli_num_rows($select_users);

                                    echo "<div class='huge'>$count_categories</div>";

                                    ?>
                                    <div>Categories</div>
                                </div>
                            </div>
                        </div>
                        <a href="categories.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <!-- /.row -->

            <?php
                $query = "SELECT * FROM posts WHERE status = 'draft'";
                $select_draft_posts = mysqli_query($connection, $query);
                $number_draft_posts = mysqli_num_rows($select_draft_posts);

                $query = "SELECT * FROM posts WHERE status = 'published'";
                $select_active_posts = mysqli_query($connection, $query);
                $number_active_posts = mysqli_num_rows($select_active_posts);

                $query = "SELECT * FROM comments WHERE status = 'unapproved'";
                $select_unapproved_comm = mysqli_query($connection, $query);
                $number_unapproved_comm = mysqli_num_rows($select_unapproved_comm);

                $query = "SELECT * FROM comments WHERE status = 'approved'";
                $select_approved_comm = mysqli_query($connection, $query);
                $number_approved_comm = mysqli_num_rows($select_approved_comm);

                $query = "SELECT * FROM users WHERE role = 'subscriber'";
                $select_sub_users = mysqli_query($connection, $query);
                $number_sub_users = mysqli_num_rows($select_sub_users);

                $query = "SELECT * FROM users WHERE role = 'admin'";
                $select_admin_users = mysqli_query($connection, $query);
                $number_admin_users = mysqli_num_rows($select_admin_users);
            ?>

            <div class="row">
                <script type="text/javascript">
                    google.charts.load('current', {
                        'packages': ['bar']
                    });
                    google.charts.setOnLoadCallback(drawChart);

                    function drawChart() {
                        var data = google.visualization.arrayToDataTable([
                            ['Data', 'Count'],
                            <?php 
                                $element_text = ['All Posts', 'Active Posts', 'Draft Posts','All Comments', 'Approved Comments', 'Unapproved Comments','All Users', 'Admin Users', 'Subscriber Users', 'Categories'];
                                $element_count = [$count_posts, $number_active_posts, $number_draft_posts, $count_comments, $number_approved_comm, $number_unapproved_comm, $count_users, $number_admin_users, $number_sub_users, $count_categories];

                                $num_condition = count($element_count);

                                for($i = 0; $i < $num_condition; $i++) {
                                    echo "['{$element_text[$i]}'" . "," . "{$element_count[$i]}],";
                                }
                            ?>
                        ]);

                        var options = {
                            chart: {
                                title: '',
                                subtitle: '',
                            }
                        };

                        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

                        chart.draw(data, google.charts.Bar.convertOptions(options));
                    }
                </script>

                <div id="columnchart_material" style="width: 'auto'; height: 500px;"></div>
            </div>

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

<?php include "includes/admin_footer.php" ?>