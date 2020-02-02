<?php
    if(isset($_POST['create_post'])) {
        $title = $_POST['title'];
        $author = $_POST['author'];
        $category_id = $_POST['post_category'];
        $status = $_POST['status'];

        $image = $_FILES['image']['name'];
        $image_tmp = $_FILES['image']['tmp_name'];

        $tags = $_POST['tags'];
        $content = $_POST['content'];
        $date = date('d-m-y');

        move_uploaded_file($image_tmp, "../images/$image");

        $query = "INSERT INTO posts (category_id, title, author, date, image, content, tags, status) ";
        $query.= "VALUES({$category_id},'{$title}','{$author}',now(),'{$image}','{$content}','{$tags}','{$status}')";

        $add_post = mysqli_query($connection, $query);

        handlingMySqlError($add_post);

        $id = mysqli_insert_id($connection); // this will get from last created item an id

        echo "<p class='bg-success'>Post Created<a href='../post.php?post_id={$id}'> View Post</a> or<a href='posts.php'> View More Posts</a></p>";


    }
?>

<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">Post Title</label>
        <input type="text" class="form-control" name="title">
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
        <?php 
            var_dump($_SESSION);
            exit;
        ?>
        <input type="text" class="form-control" name="author" value="Mala">
    </div>
    <div class="form-group">
        <label for="status">Post Status</label>
        <br>
        <select name="status" id="post_status">
            <option value='draft'>Post Status</option>
            <option value="published">Published</option>
            <option value="draft">Draft</option>
        </select>
    </div>
    <div class="form-group">
        <label for="image">Post Image</label>
        <input type="file" name="image">
    </div>
    <div class="form-group">
        <label for="tags">Post Tags</label>
        <input type="text" class="form-control" name="tags">
    </div>
    <div class="form-group">
        <label for="content">Post Content</label>
        <textarea class="form-control" name="content" id="body" cols="30" rows="10"></textarea>
    </div>
    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="create_post" value="Publish Post">
    </div>
</form>