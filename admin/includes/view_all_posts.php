<?php 

    if(isset($_POST['checboxArray'])) {
        //checkbox array
        $ids = $_POST['checboxArray'];

        foreach($ids as $id) {
            $option = $_POST['bulk_options'];
            
            switch($option) {
                case 'published':
                    $query = "UPDATE posts  SET status = '$option' ";
                    $query.= "WHERE id = $id";
                    $update_publish_post = mysqli_query($connection, $query);
                    handlingMySqlError($update_publish_post);
                break;
                case 'draft':
                    $query = "UPDATE posts SET status = '$option' ";
                    $query.= "WHERE id = $id";
                    $update_draft_post = mysqli_query($connection, $query);
                    handlingMySqlError($update_draft_post);
                break;
                case 'delete':
                    $query = "DELETE FROM posts ";
                    $query.= "WHERE id = $id";
                    $delete_post = mysqli_query($connection, $query);
                    handlingMySqlError($delete_post);
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
                $table.= "<td><input class='checkboxes' type='checkbox' name='checboxArray[]' value='$post_id'></td>";
                $table.= "<td>{$post_id}</td>";
                $table.= "<td>{$post_author}</td>";
                $table.= "<td>{$post_title}</td>";
                $table.= "<td>{$post_content}</td>";

                $query = "SELECT * FROM categories ";
                $query.= "WHERE id = {$post_category_id}";

                $select_categories_id = mysqli_query($connection, $query);

                while ($row = mysqli_fetch_assoc($select_categories_id)) {
                    $category_id = $row['id'];
                    $category_title = $row['category_title'];

                    $table.= "<td>{$category_title}</td>";
                }

                $table.= "<td>{$post_status}</td>";
                $table.= "<td><img width='100' src='../images/{$post_image}'></td>";
                $table.= "<td>{$post_tags}</td>";
                $table.= "<td>{$post_comment_count}</td>";
                $table.= "<td>{$post_date}</td>";
                $table.= "<td><a href='../post.php?post_id={$post_id}'>View Front Page</a></td>";
                $table.= "<td><a href='posts.php?source=edit_post&p_id={$post_id}'>Edit</a></td>";
                $table.= "<td><a onclick=\"javascript: return window.confirm('Are you sure you want to delete post: {$post_title}?');\" href='posts.php?delete_post={$post_id}'>Delete</a></td>";
                $table.= "</tr>";

                echo $table;
            }
        ?>
        <?php
            if(isset($_GET['delete_post'])) {

                $id_ready_for_delete = $_GET['delete_post'];

                $query = "DELETE FROM posts ";
                $query.= "WHERE id = {$id_ready_for_delete}";

                mysqli_query($connection, $query);

                header("Location: posts.php");
            }
        ?>
        </tbody>
    </table>
</div>
</form>