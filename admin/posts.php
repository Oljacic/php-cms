<?php include "includes/admin_header.php" ?>

    <div id="wrapper">

        <?php include "includes/admin_navigation.php" ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Welcome to Admin<small>Author</small></h1>
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Author</th>
                                    <th>Title</th>
                                    <th>Content</th>
                                    <th>Category</th>
                                    <th>Status</th>
                                    <th>Image</th>
                                    <th>Tags</th>
                                    <th>Comment Count</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $query = "SELECT * FROM posts";
                                    $select_all_posts = mysqli_query($connection, $query);

                                    while ($row = mysqli_fetch_assoc($select_all_posts)) {
                                        $post_id = $row['id'];
                                        $post_author = $row['author'];
                                        $post_title = $row['title'];
                                        $post_content = $row['content'];
                                        $post_category_id = $row['category_id'];
                                        $post_status = $row['status'];
                                        $post_image = $row['image'];
                                        $post_tags = $row['tags'];
                                        $post_comment_count = $row['comment_count'];
                                        $post_date = $row['date'];


                                        $table = "<tr>";
                                        $table.= "<td>{$post_id}</td>";
                                        $table.= "<td>{$post_author}</td>";
                                        $table.= "<td>{$post_title}</td>";
                                        $table.= "<td>{$post_content}</td>";
                                        $table.= "<td>{$post_category_id}</td>";
                                        $table.= "<td>{$post_status}</td>";
                                        $table.= "<td><img width='100' src='../images/{$post_image}'></td>";
                                        $table.= "<td>{$post_tags}</td>";
                                        $table.= "<td>{$post_comment_count}</td>";
                                        $table.= "<td>{$post_date}</td>";
                                        $table.= "</tr>";

                                        echo $table;
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

<?php include "includes/admin_footer.php" ?>