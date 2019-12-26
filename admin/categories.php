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
                                insertCategories();
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
                            <?php // Update and include
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
                                        findAllCategories();
                                    ?>

                                    <?php // Delete query
                                        deleteCategories();
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