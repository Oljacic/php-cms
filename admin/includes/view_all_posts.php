<?php

if (isset($_POST['checboxArray'])) {
    //checkbox array
    $ids = $_POST['checboxArray'];

    foreach ($ids as $id) {
        $option = $_POST['bulk_options'];

        switch ($option) {
            case 'published':
                $query = "UPDATE posts  SET status = '$option' ";
                $query .= "WHERE id = $id";
                $update_publish_post = mysqli_query($connection, $query);
                handlingMySqlError($update_publish_post);
                break;
            case 'draft':
                $query = "UPDATE posts SET status = '$option' ";
                $query .= "WHERE id = $id";
                $update_draft_post = mysqli_query($connection, $query);
                handlingMySqlError($update_draft_post);
                break;
            case 'delete':
                $query = "DELETE FROM posts ";
                $query .= "WHERE id = $id";
                $delete_post = mysqli_query($connection, $query);
                handlingMySqlError($delete_post);
                break;
            case 'clone':
                $query = "SELECT * FROM posts ";
                $query .= "WHERE id = $id";
                $clone_post = mysqli_query($connection, $query);
                handlingMySqlError($clone_post);

                while ($row = mysqli_fetch_array($clone_post)) {
                    $post_category_id = $row['category_id'];
                    $post_title = $row['title'];
                    $post_author = $row['author'];
                    $post_date =   $row['date'];
                    $post_image = $row['image'];
                    $post_content = $row['content'];
                    $post_tags = $row['tags'];
                    $post_status = $row['status'];
                }

                $query = "INSERT INTO posts (category_id, title, author, date, image, content, tags, status) ";
                $query .= "VALUES({$post_category_id},'{$post_title}','{$post_author}','{$post_date}','{$post_image}','{$post_content}','{$post_tags}','{$post_status}')";

                $clone_query = mysqli_query($connection, $query);

                if (!$clone_query) {
                    die('MYSQL FAILED' . mysqli_error($connection));
                }

                header('Location:' . $_SERVER['PHP_SELF']);

                break;
        }
    }
}

?>

<form action="" method='post'>
    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <div id="bulkOptionsContainer" class="col-xs-4">
                <select class="form-control" name="bulk_options" id="">
                    <option value="">Select Options</option>
                    <option value="published">Publish</option>
                    <option value="draft">Draft</option>
                    <option value="delete">Delete</option>
                    <option value="clone">Clone</option>
                </select>
            </div>
            <div class="col-xs-4">
                <input type="submit" name="submit" class="btn btn-success" value="Apply">
                <a class="btn btn-primary" href="posts.php?source=add_post">Add New</a>
            </div>
            <thead>
                <tr>
                    <th><input id="selectAllBoxes" type="checkbox"></th>
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
                    <th>Front Page</th>
                    <th>Edit</th>
                    <th>Delete</th>
                    <th>View Numbers</th>
                </tr>
            </thead>
            <tbody>
                <?php

                $per_page = 5;

                if (isset($_GET['page'])) {
                    $page = $_GET['page'];
                } else {
                    $page = "";
                }

                if ($page == "" || $page == 1) {
                    $page_1 = 0;
                } else {
                    $page_1 = ($page * $per_page) - $per_page;
                }


                $query_count = "SELECT * FROM posts";
                $result_post = mysqli_query($connection, $query_count);
                $count = mysqli_num_rows($result_post);

                $count = ceil($count / $per_page);

                $query = "SELECT * FROM posts ";
                $query .= "ORDER BY id DESC ";
                $query .= "LIMIT $page_1, $per_page";
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
                    $post_date =  date('d-M-Y H:i:s', $row['date']);
                    $post_view_count = $row['view_count'];


                    $table = "<tr>";
                    $table .= "<td><input class='checkboxes' type='checkbox' name='checboxArray[]' value='$post_id'></td>";
                    $table .= "<td>{$post_id}</td>";
                    $table .= "<td>{$post_author}</td>";
                    $table .= "<td>{$post_title}</td>";
                    $table .= "<td>{$post_content}</td>";

                    $query = "SELECT * FROM categories ";
                    $query .= "WHERE id = {$post_category_id}";

                    $select_categories_id = mysqli_query($connection, $query);

                    while ($row = mysqli_fetch_assoc($select_categories_id)) {
                        $category_id = $row['id'];
                        $category_title = $row['category_title'];

                        $table .= "<td>{$category_title}</td>";
                    }

                    $table .= "<td>{$post_status}</td>";
                    $table .= "<td><img width='100' src='../images/{$post_image}'></td>";
                    $table .= "<td>{$post_tags}</td>";

                    $query = "SELECT * FROM comments ";
                    $query.= "WHERE post_id = {$post_id}";
                    $exec_query_comments = mysqli_query($connection, $query);
                    $count_comm = mysqli_num_rows($exec_query_comments);

                    $table .= "<td><a href='comments.php?comm_post_id={$post_id}'>{$count_comm}<a></td>";

                    $table .= "<td>{$post_date}</td>";
                    $table .= "<td><a href='../post.php?post_id={$post_id}'>View Front Page</a></td>";
                    $table .= "<td><a href='posts.php?source=edit_post&p_id={$post_id}'>Edit</a></td>";
                    $table .= "<td><a onclick=\"javascript: return window.confirm('Are you sure you want to delete post: {$post_title}?');\" href='posts.php?delete_post={$post_id}'>Delete</a></td>";
                    $table .= "<td><a href='posts.php?reset={$post_id}'>{$post_view_count}</a></td>";
                    $table .= "</tr>";

                    echo $table;
                }
                ?>
                <?php
                if (isset($_GET['delete_post'])) {

                    $id_ready_for_delete = $_GET['delete_post'];

                    $query = "DELETE FROM posts ";
                    $query .= "WHERE id = {$id_ready_for_delete}";

                    mysqli_query($connection, $query);

                    header("Location: posts.php");
                }

                if (isset($_GET['reset'])) {

                    $reset = $_GET['reset'];

                    $query = "UPDATE posts SET view_count = 0 ";
                    $query .= "WHERE id =" . mysqli_real_escape_string($connection, $reset) . "";

                    mysqli_query($connection, $query);

                    header("Location: posts.php");
                }
                ?>
            </tbody>
        </table>
    </div>
</form>

<ul class="pager">
    <?php
    for ($i = 1; $i <= $count; $i++) {
        if ($i == $page) {
            echo "<li><a class='active_link' href='posts.php?page={$i}'>{$i}</a></li>";
        } else {
            echo "<li><a href='posts.php?page={$i}'>{$i}</a></li>";
        }
    }
    ?>
</ul>