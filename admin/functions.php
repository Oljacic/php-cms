<?php
/**
 * Created by PhpStorm.
 * User: Stef
 * Date: 12/26/2019
 * Time: 11:53 PM
 */


function insertCategories() {

    global $connection;

    if(isset($_POST['submit'])) {
        $category_title = $_POST['category_title'];

        if($category_title == "" || empty($category_title)) {
            echo '<div class="alert alert-danger">This filed should not be empty</div>';
        } else {
            $query = "INSERT INTO categories(category_title)";
            $query.= " VALUE('$category_title')";

            $create_category_query = mysqli_query($connection, $query);

            if(!$create_category_query) {
                die('QUERY FAILED' . mysqli_error($connection));
            }
        }
    }

}

function findAllCategories() {

    global $connection;

    $query = "SELECT * FROM categories";
    $select_categories = mysqli_query($connection, $query);

    while ($row = mysqli_fetch_assoc($select_categories)) {
        $category_id = $row['id'];
        $category_title = $row['category_title'];
        $table = "<tr>";
        $table.= "<td>{$category_id}</td>";
        $table.= "<td>{$category_title}</td>";
        $table.= "<td>
                    <a href='categories.php?delete={$category_id}'>Delete</a> --- 
                    <a href='categories.php?edit={$category_id}'>Edit</a>
                  </td>";
        $table.= "</tr>";
        echo $table;
    }
}

function deleteCategories() {

    global $connection;

    if(isset($_GET['delete'])) {
        $id_ready_for_delete = $_GET['delete'];

        $query = "DELETE FROM categories ";
        $query.= "WHERE id = {$id_ready_for_delete}";

        mysqli_query($connection, $query);

        header("Location: categories.php");
    }
}