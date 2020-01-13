<div class="table-responsive">
    <table class="table table-bordered table-hover">
        <thead>
        <tr>
            <th>Id</th>
            <th>Username</th>
            <th>Email</th>
            <th>First Name</th>
            <th>Last Name</th>
<!--            <th>Image</th>-->
            <th>Role</th>
            <th>Change Role to:</th>
            <th>Change Role to:</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $query = "SELECT * FROM users";
        $select_users = mysqli_query($connection, $query);

        while ($row = mysqli_fetch_assoc($select_users)) {
            $user_id = $row['id'];
            $user_username = $row['username'];
            $user_password = $row['password'];
            $user_email = $row['email'];
            $user_first_name = $row['firstname'];
            $user_last_name = $row['lastname'];
            $user_image = $row['user_image'];
            $user_role = $row['role'];

            $table = "<tr>";
            $table.= "<td>{$user_id}</td>";
            $table.= "<td>{$user_username}</td>";
            $table.= "<td>{$user_email}</td>";
            $table.= "<td>{$user_first_name}</td>";
            $table.= "<td>{$user_last_name}</td>";
            $table.= "<td>{$user_role}</td>";

//            $query_post = "SELECT * FROM posts ";
//            $query_post.= "WHERE id = $comment_post_id";
//
//            $select_post = mysqli_query($connection, $query_post);
//            handlingMySqlError($select_post);
//
//            $post_id = '';
//            $post_title = '';
//
//            while($row = mysqli_fetch_assoc($select_post)) {
//                $post_id = $row['id'];
//                $post_title = $row['title'];
//            }
//
//            $table.= "<td><a href='../post.php?post_id=$post_id'>{$post_title}<a></td>";
//            $table.= "<td>{$comment_date}</td>";
//            $table.= "<td><a href='comments.php?approve={$comment_id}'>Approve</a></td>";
//            $table.= "<td><a href='comments.php?unapprove={$comment_id}'>Unapprove</a></td>";

            $table.= "<td><a href='users.php?change_role_admin={$user_id}&role=admin'>Admin</a></td>";
            $table.= "<td><a href='users.php?change_role_sub={$user_id}&role=subscriber'>Subscriber</a></td>";
            $table.= "<td><a href='users.php?source=edit_user&user_id={$user_id}'>Edit</a></td>";
            $table.= "<td><a href='users.php?delete={$user_id}'>Delete</a></td>";
            $table.= "</tr>";

            echo $table;
        }
        ?>
        <?php
            if(isset($_GET['delete'])) {
                $id_user = $_GET['delete'];

                $query = "DELETE FROM users ";
                $query.= "WHERE id = {$id_user}";

                $delete_user = mysqli_query($connection, $query);

                handlingMySqlError($delete_user);

                header('Location: users.php');
            }
        ?>

        <?php
            if(isset($_GET['change_role_admin'])) {
                $user_id = $_GET['change_role_admin'];
                $role = $_GET['role'];
                changeUserRoles($user_id, $role);
            }
            if (isset($_GET['change_role_sub'])) {
                $user_id = $_GET['change_role_sub'];
                $role = $_GET['role'];
                changeUserRoles($user_id, $role);
            }
        ?>
        </tbody>
    </table>
</div>