<?php 

include "includes/admin_header.php";
include "includes/function.php";

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
                        $password = $_POST['password'];

                        if(!empty($password)) {
                            $query_password = "SELECT password FROM users ";
                            $query_password .= "WHERE username = '$username_ses'";
                    
                            $get_user = mysqli_query($connection, $query_password);
                    
                            handlingMySqlError($get_user);
                    
                            $row = mysqli_fetch_array($get_user);
                    
                            $db_user_password = $row['password'];
                    
                    
                            if ($db_user_password != $password) {
                                $hashed_pass = password_hash($password, PASSWORD_BCRYPT, array(
                                    'cost' => 12
                                ));
                            }

                            $query = "UPDATE users SET ";
                            $query .= "username = '$username',";
                            $query .= "password = '$hashed_pass',";
                            $query .= "firstname = '$first_name',";
                            $query .= "lastname = '$last_name',";
                            $query .= "email = '$email' ";
                            $query .= "WHERE username = '$username_ses'";
    
    
                            $edit_user = mysqli_query($connection, $query);
    
                            handlingMySqlError($edit_user);

                            restartSes($username, $hashed_pass, $first_name, $last_name);
    
                            header("Location: profile.php");
                        }
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
                        <div class="form-group">
                            <label for="password">Edit Password</label>
                            <input type="password" class="form-control" name="password" autocomplete="off">
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