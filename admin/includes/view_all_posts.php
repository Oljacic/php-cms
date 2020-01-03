<div class="table-responsive">
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
                $table.= "<td><a href='posts.php?source=edit_post&p_id={$post_id}'>Edit</a></td>";
                $table.= "<td><a href='posts.php?delete_post={$post_id}'>Delete</a></td>";
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