<div class="table-responsive">
    <table class="table table-bordered table-hover">
        <thead>
        <tr>
            <th>Id</th>
            <th>Author</th>
            <th>Comment</th>
            <th>Email</th>
            <th>Status</th>
            <th>In response to</th>
            <th>Date</th>
            <th>Approved</th>
            <th>Unapproved</th>
            <th>Delete</th>
        </tr>
        </thead>
        <tbody>
        <?php
            $query = "SELECT * FROM comments";
            $select_comments = mysqli_query($connection, $query);

            while ($row = mysqli_fetch_assoc($select_comments)) {
                $comment_id = $row['id'];
                $comment_post_id = $row['post_id'];
                $comment_author = $row['author'];
                $comment_email = $row['email'];
                $comment_content = $row['content'];
                $comment_status = $row['status'];
                // $comment_in_response = $row['in_response'];
                $comment_date = $row['date'];


                $table = "<tr>";
                $table.= "<td>{$comment_id}</td>";
                $table.= "<td>{$comment_author}</td>";
                $table.= "<td>{$comment_content}</td>";

                // $query = "SELECT * FROM categories ";
                // $query.= "WHERE id = {$comment_category_id}";

                // $select_categories_id = mysqli_query($connection, $query);

                // while ($row = mysqli_fetch_assoc($select_categories_id)) {
                //     $category_id = $row['id'];
                //     $category_title = $row['category_title'];

                //     $table.= "<td>{$category_title}</td>";
                // }

                $table.= "<td>{$comment_email}</td>";
                $table.= "<td>{$comment_status}</td>";
                
                $query_post = "SELECT * FROM posts ";
                $query_post.= "WHERE id = $comment_post_id";

                $select_post = mysqli_query($connection, $query_post);
                handlingMySqlError($select_post);
                
                $post_id = '';
                $post_title = '';

                while($row = mysqli_fetch_assoc($select_post)) {
                    $post_id = $row['id'];
                    $post_title = $row['title'];
                }

                $table.= "<td><a href='../post.php?post_id=$post_id'>{$post_title}<a></td>";
                $table.= "<td>{$comment_date}</td>";
                $table.= "<td><a href='posts.php?source=edit_post&p_id={$comment_id}'>Approved</a></td>";
                $table.= "<td><a href='posts.php?delete_post={$comment_id}'>Unapproved</a></td>";
                $table.= "<td><a href='comments.php?delete={$comment_id}'>Delete</a></td>";
                $table.= "</tr>";

                echo $table;
            }
        ?>
        <?php 
            if(isset($_GET['delete'])) {
                $id_comment = $_GET['delete'];

                $query = "DELETE FROM comments ";
                $query.= "WHERE id = $id_comment";

                $delete_comment = mysqli_query($connection, $query);
                
                // I have function for this but i wrote this here just to test my knowledge
                if(!$delete_comment) {
                    die ('QUERY FAILED: '.mysqli_error($connection));
                }

                header("Location: comments.php");
            }
        ?>
        </tbody>
    </table>
</div>