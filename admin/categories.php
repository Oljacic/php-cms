<?php include "includes/admin_header.php" ?>

    <div id="wrapper">

        <?php include "includes/admin_navigation.php" ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome to Admin
                            <small>Author</small>
                        </h1>
                        <div class="col-xs-6">

                            <?php
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
                            ?>

                            <form action="" method="post">
                                <div class="form-group">
                                    <label for="category_title">Add Category</label>
                                    <input class="form-control" type="text" name="category_title">
                                </div>
                                <div class="form-group">
                                    <input class="btn btn-primary" type="submit" name="submit" value="Add Category">
                                </div>
                            </form>
                            <?php
                                if(isset($_GET['edit'])) {
                                    $id_ready_for_update = $_GET['edit'];

                                    include "includes/update_categories.php";
                                }
                            ?>
                        </div>
                        <div class="col-xs-6">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Category Title</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php // Find all categories
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
                                    ?>

                                    <?php // Delete query
                                        if(isset($_GET['delete'])) {
                                            $id_ready_for_delete = $_GET['delete'];

                                            $query = "DELETE FROM categories ";
                                            $query.= "WHERE id = {$id_ready_for_delete}";

                                            $delete_category = mysqli_query($connection, $query);

                                            header("Location: categories.php");
                                        }
                                    ?>

                                </tbody>
                            </table>
                        </div>
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