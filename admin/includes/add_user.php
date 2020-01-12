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

}
?>

<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="first_name">Add First Name</label>
        <input type="text" class="form-control" name="first_name">
    </div>
    <div class="form-group">
        <label for="last_name">Add Last Name</label>
        <input type="text" class="form-control" name="last_name">
    </div>
    <div class="form-group">
        <label for="username">Add Username</label>
        <input type="text" class="form-control" name="username">
    </div>
    <div class="form-group">
        <label for="email">Add Email</label>
        <input type="text" class="form-control" name="email">
    </div>
    <div class="form-group">
        <label for="user_image">Add Image</label>
        <input type="file" name="user_image">
    </div>
    <div class="form-group">
        <label for="tags">Post Tags</label>
        <input type="text" class="form-control" name="tags">
    </div>
    <div class="form-group">
        <label for="content">Post Content</label>
        <textarea class="form-control" name="content" id="" cols="30" rows="10"></textarea>
    </div>
    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="create_post" value="Publish Post">
    </div>
</form>