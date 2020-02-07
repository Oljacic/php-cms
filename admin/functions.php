<?php

/**
 * Created by PhpStorm.
 * User: Stef
 * Date: 12/26/2019
 * Time: 11:53 PM
 */


function insertCategories()
{

    global $connection;

    if (isset($_POST['submit'])) {
        $category_title = $_POST['category_title'];

        if ($category_title == "" || empty($category_title)) {
            echo '<div class="alert alert-danger">This filed should not be empty</div>';
        } else {
            $query = "INSERT INTO categories(category_title)";
            $query .= " VALUE('$category_title')";

            $create_category_query = mysqli_query($connection, $query);

            if (!$create_category_query) {
                die('QUERY FAILED' . mysqli_error($connection));
            }
        }
    }
}

function findAllCategories()
{

    global $connection;

    $query = "SELECT * FROM categories";
    $select_categories = mysqli_query($connection, $query);

    while ($row = mysqli_fetch_assoc($select_categories)) {
        $category_id = $row['id'];
        $category_title = $row['category_title'];
        $table = "<tr>";
        $table .= "<td>{$category_id}</td>";
        $table .= "<td>{$category_title}</td>";
        $table .= "<td>
                    <a href='categories.php?delete={$category_id}'>Delete</a> --- 
                    <a href='categories.php?edit={$category_id}'>Edit</a>
                  </td>";
        $table .= "</tr>";
        echo $table;
    }
}

function deleteCategories()
{

    global $connection;

    if (isset($_GET['delete'])) {
        $id_ready_for_delete = $_GET['delete'];

        $query = "DELETE FROM categories ";
        $query .= "WHERE id = {$id_ready_for_delete}";

        mysqli_query($connection, $query);

        header('Location: ' . $_SERVER['PHP_SELF']);
    }
}

function handlingMySqlError($execute)
{

    global $connection;

    if (!$execute) {
        die('QUERY FAILED ' . mysqli_error($connection));
    }
}

function changeUserRoles($id, $new_role)
{

    global $connection;

    $query = "UPDATE users SET role = '{$new_role}' ";
    $query .= "WHERE id = {$id}";

    $change_role = mysqli_query($connection, $query);

    handlingMySqlError($change_role);

    header("Location: users.php");
}

function userOnline()
{

    if (isset($_GET['onlineusers'])) {


        global $connection;

        if (!$connection) {
            session_start();
            include "../includes/db.php";

            $session = session_id();
            $time = time();
            $time_out_in_seconds = 05;

            $time_out = $time - $time_out_in_seconds;

            $query = "SELECT * FROM users_online ";
            $query .= "WHERE session = '$session'";
            $send_query = mysqli_query($connection, $query);
            $count = mysqli_num_rows($send_query);

            if ($count == NULL) {
                mysqli_query($connection, "INSERT INTO users_online(session, time) VALUES ('$session', '$time')");
            } else {
                mysqli_query($connection, "UPDATE users_online SET time = '$time' WHERE session = '$session'");
            }

            $online_query = mysqli_query($connection, "SELECT * FROM users_online WHERE time > '$time_out'");
            $count_user = mysqli_num_rows($online_query);

            echo $count_user;
        }
    } // get request isset
}

userOnline();
