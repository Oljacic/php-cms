<?php include "includes/admin_header.php" ?>


<?php
if (isset($_SESSION['username'])) {
    $username_ses = $_SESSION['username'];

    $query = "SELECT * FROM users WHERE username = '$username_ses'";
    $select_user = mysqli_query($connection, $query);
    handlingMySqlError($select_user);

    while($row = mysqli_fetch_array($select_user)) {
        $user_first_name = $row['firstname'];
        $user_last_name = $row['lastname'];
        $user_username = $row['username'];
        $user_password = $row['password'];
        $user_email = $row['email'];
        $user_role = $row['role'];
    }
}
?>

<div id="wrapper">

    <?php include "includes/admin_navigation.php" ?>

    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Welcome to Admin <small><?php echo $_SESSION['username']; ?></small></h1>
                    <?php

                    if (isset($_POST['edit_user'])) {
                        $first_name = $_POST['first_name'];
                        $last_name = $_POST['last_name'];
                        $username = $_POST['username'];
                        $email = $_POST['email'];

                        //        $image = $_FILES['image']['name'];
                        //        $image_tmp = $_FILES['image']['tmp_name'];

                        $password = $_POST['password'];
                        $role = $_POST['role'];

                        //        move_uploaded_file($image_tmp, "../images/$image");

                        $query = "UPDATE users SET ";
                        $query .= "username = '$username',";
                        $query .= "password = '$password',";
                        $query .= "firstname = '$first_name',";
                        $query .= "lastname = '$last_name',";
                        $query .= "email = '$email',";
                        $query .= "role = '$role' ";
                        $query .= "WHERE username = '$username_ses'";


                        $edit_user = mysqli_query($connection, $query);

                        handlingMySqlError($edit_user);

                        header("Location: profile.php");
                    }
                    ?>

                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="first_name">Edit First Name</label>
                            <input type="text" class="form-control" name="first_name" value="<?php echo $user_first_name; ?>">
                        </div>
                        <div class="form-group">
                            <label for="last_name">Edit Last Name</label>
                            <input type="text" class="form-control" name="last_name" value="<?php echo $user_last_name; ?>">
                        </div>
                        <div class="form-group">
                            <label for="username">Edit Username</label>
                            <input type="text" class="form-control" name="username" value="<?php echo $user_username; ?>">
                        </div>
                        <div class="form-group">
                            <label for="email">Edit Email</label>
                            <input type="text" class="form-control" name="email" value="<?php echo $user_email; ?>">
                        </div>
                        <!--    <div class="form-group">-->
                        <!--        <label for="user_image">Add Image</label>-->
                        <!--        <input type="file" name="user_image">-->
                        <!--    </div>-->
                        <div class="form-group">
                            <label for="password">Edit Password</label>
                            <input type="password" class="form-control" name="password" value="<?php echo $user_password; ?>">
                        </div>
                        <div class="form-group">
                            <label for="role">Chose Role</label>
                            <br>
                            <select name="role" id="role">
                                <option value="<?php echo $user_role; ?>"><?php echo ucfirst($user_role); ?></option>
                                <?php
                                if ($user_role == 'admin') {
                                    echo "<option value='subscriber'>Subscriber</option>";
                                } elseif ($user_role == 'subscriber') {
                                    echo "<option value='admin'>Admin</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <input class="btn btn-primary" type="submit" name="edit_user" value="Update Profile">
                        </div>
                    </form>
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