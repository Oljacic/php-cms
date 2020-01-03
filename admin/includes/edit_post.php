<form action="" method="post" enctype="multipart/form-data">
    <?php

        $id = '';

        if(isset($_GET['p_id'])) {
            $id = $_GET['p_id'];
        }

        $query = "SELECT * FROM posts ";
        $query.= "WHERE id = {$id}";

        $select_data_post = mysqli_query($connection, $query);

        while ($row = mysqli_fetch_assoc($select_data_post)) {
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
        }



        if(isset($_POST['submit'])) {

            $title = $_POST['title'];
            $author = $_POST['author'];
            $category_id = $_POST['post_category'];

            $status = $_POST['status'];

            $image = $_FILES['image']['name'];
            $image_tmp = $_FILES['image']['tmp_name'];

            $tags = $_POST['tags'];
            $content = $_POST['content'];

            move_uploaded_file($image_tmp, "../images/$image");

            if(empty($image)) {
                $query = "SELECT * FROM posts WHERE id = $id ";
                $select_image = mysqli_query($connection, $query);

                while ($row = mysqli_fetch_array($select_image)) {
                    $image = $row['image'];
                }
            }

            $query = "UPDATE posts SET ";
            $query.= "title = '{$title}', ";
            $query.= "category_id = {$category_id}, ";
            $query.= "date = now(), ";
            $query.= "author = '{$author}', ";
            $query.= "status = '{$status}', ";
            $query.= "tags = '{$tags}', ";
            $query.= "content = '{$content}', ";
            $query.= "image = '{$image}' ";
            $query.= "WHERE id = {$id}";

            $edit_post = mysqli_query($connection, $query);

            handlingMySqlError($edit_post);

            header('Location:'.$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING']);
            die;

        }
    ?>
    <div class="form-group">
        <label for="title">Post Title</label>
        <input type="text" class="form-control" name="title" value="<?php echo $post_title; ?>">
    </div>
    <div class="form-group">
        <label for="category_id">Post Category Id</label>
        <br>
        <select name="post_category" id="post_category">
            <?php
                $query = "SELECT * FROM categories";

                $select_categories = mysqli_query($connection, $query);

                handlingMySqlError($select_categories);

                while ($row = mysqli_fetch_assoc($select_categories)) {
                    $category_id = $row['id'];
                    $category_title = $row['category_title'];

                    echo "<option value=\"$category_id\">$category_title</option>";

                }
            ?>
        </select>
    </div>
    <div class="form-group">
        <label for="author">Post Author</label>
        <input type="text" class="form-control" name="author" value="<?php echo $post_author; ?>">
    </div>
    <div class="form-group">
        <label for="status">Post Status</label>
        <input type="text" class="form-control" name="status" value="<?php echo $post_status; ?>">
    </div>
    <div class="form-group">
        <label for="image">Post Image</label>
        <br>
        <img width="100" src="../images/<?php echo $post_image; ?>" alt="">
        <input type="file" name="image">
    </div>
    <div class="form-group">
        <label for="tags">Post Tags</label>
        <input type="text" class="form-control" name="tags" value="<?php echo $post_tags; ?>">
    </div>
    <div class="form-group">
        <label for="content">Post Content</label>
        <textarea class="form-control" name="content" id="" cols="30" rows="10"><?php echo $post_content; ?></textarea>
    </div>
    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="submit" value="Edit Post">
    </div>
</form>