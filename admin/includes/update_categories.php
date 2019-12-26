<form action="" method="post">
    <div class="form-group">
        <label for="edit_category_title">Update Category</label>
        <?php // Edit  categories

        if(isset($_GET['edit'])) {
            $id_for_edit = $_GET['edit'];

            $query = "SELECT * FROM categories ";
            $query.= "WHERE id = {$id_for_edit}";

            $select_categories_id = mysqli_query($connection, $query);

            while ($row = mysqli_fetch_assoc($select_categories_id)) {
                $category_id = $row['id'];
                $category_title = $row['category_title'];
                ?>

                <input value="<?php echo isset($category_title) ? $category_title : '' ?>" class="form-control" type="text" name="edit_category_title">

                <?php
            }
        }
        ?>

        <?php // Update  Category
        if(isset($_POST['edit_category_title'])) {
            $title_ready_for_update = $_POST['edit_category_title'];

            $query = "UPDATE categories ";
            $query.= "SET category_title = '{$title_ready_for_update}' ";
            $query.= "WHERE id = {$id_ready_for_update}";

            $update_category = mysqli_query($connection, $query);

            if(!$update_category) {
                die('QUERY FAILED' . mysqli_error($connection));
            }
        }
        ?>
    </div>
    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="edit" value="Update Category">
    </div>
</form>