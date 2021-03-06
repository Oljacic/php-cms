<?php include "includes/db.php"; ?>
<?php include "includes/header.php"; ?>

<?php 
    if(isset($_POST['submit'])) {
        $username = $_POST['username'];
        $email    = $_POST['email'];
        $pass     = $_POST['password'];

        if(!empty($username) && !empty($email) && !empty($pass)) {
            $username = mysqli_real_escape_string($connection, $username);
            $email    = mysqli_real_escape_string($connection, $email);
            $pass     = mysqli_real_escape_string($connection, $pass);
    
            $pass = password_hash($pass, PASSWORD_BCRYPT, array(
                'cost' => 12
            ));
    
            $query = "INSERT INTO users (username, email, password, role) ";
            $query.= "VALUES ('{$username}', '{$email}', '{$pass}', 'subscriber')";
            $register_user = mysqli_query($connection, $query);
    
            if(!$register_user) {
                die('QUERY FAILED '.mysqli_error($connection).' '.mysqli_errno($connection));
            }

            $message = "<span class='text-success'><strong>Your Registration has been submited</strong></span>";
        } else {
            $message = "<span class='text-warning'><strong>Fields can not be empty!</strong></span>";
        }

    }
?>

<!-- Navigation -->

<?php include "includes/navigation.php"; ?>


<!-- Page Content -->
<div class="container">
    <section id="login">
        <div class="container">
            <div class="row">
                <div class="col-xs-6 col-xs-offset-3">
                    <div class="form-wrap">
                        <h1>Register</h1>
                        <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
                            <h5 class="text-center"><?php echo isset($message) ? $message : '' ?></h6>
                            <div class="form-group">
                                <label for="username" class="sr-only">username</label>
                                <input type="text" name="username" id="username" class="form-control" placeholder="Enter Desired Username">
                            </div>
                            <div class="form-group">
                                <label for="email" class="sr-only">Email</label>
                                <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com">
                            </div>
                            <div class="form-group">
                                <label for="password" class="sr-only">Password</label>
                                <input type="password" name="password" id="key" class="form-control" placeholder="Password">
                            </div>

                            <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Register">
                        </form>

                    </div>
                </div> <!-- /.col-xs-12 -->
            </div> <!-- /.row -->
        </div> <!-- /.container -->
    </section>


    <hr>



    <?php include "includes/footer.php"; ?>