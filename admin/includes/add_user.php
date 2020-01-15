<?php
    if(isset($_POST['create_user'])) {
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $username = $_POST['username'];
        $email = $_POST['email'];

//        $image = $_FILES['image']['name'];
//        $image_tmp = $_FILES['image']['tmp_name'];

        $password = $_POST['password'];
        $role = $_POST['role'];

//        move_uploaded_file($image_tmp, "../images/$image");

        $query = "INSERT INTO users (username, password, firstname, lastname, email, role) ";
        $query.= "VALUES('$username', '$password', '$first_name', '$last_name', '$email', '$role')";

        $add_user = mysqli_query($connection, $query);

        handlingMySqlError($add_user);

        // header("Location: users.php");
        echo "User Created " . " " . "<a href='users.php'>View Users</a>";

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
<!--    <div class="form-group">-->
<!--        <label for="user_image">Add Image</label>-->
<!--        <input type="file" name="user_image">-->
<!--    </div>-->
    <div class="form-group">
        <label for="password">Add Password</label>
        <input type="text" class="form-control" name="password">
    </div>
    <div class="form-group">
        <label for="role">Chose Role</label>
        <br>
        <select name="role" id="role">
            <option value="subscriber">Chose Option</option>
            <option value="admin">Admin</option>
            <option value="subscriber">Subscriber</option>
        </select>
    </div>
    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="create_user" value="Add User">
    </div>
</form>