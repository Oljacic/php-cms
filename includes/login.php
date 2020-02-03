<?php
include 'db.php';
session_start();

if(isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $username = mysqli_real_escape_string($connection, $username);
    $password = mysqli_real_escape_string($connection, $password);

    $query = "SELECT * FROM users WHERE username = '$username'";
    $select_user_query = mysqli_query($connection, $query);
    
    if(!$select_user_query) {
        die('QUERY FAILED '. mysqli_error($connection));
    }

    while($row = mysqli_fetch_array($select_user_query)) {

        $db_id = $row['id'];
        $db_username = $row['username'];
        $db_password = $row['password'];
        $db_firstname = $row['firstname'];
        $db_lastname = $row['lastname'];
        $db_role = $row['role'];

    }

    if(password_verify($password, $db_password)) {
        $_SESSION['user_id'] = $db_id;
        $_SESSION['username'] = $db_username;
        $_SESSION['firstname'] = $db_firstname;
        $_SESSION['lastname'] = $db_lastname;
        $_SESSION['role'] = $db_role;

        header('Location: ../admin');
    } else {
        header('Location: ../index.php');
    }
}