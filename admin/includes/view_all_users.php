<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>Id</th>
            <th>Username</th>
            <th>Firstname</th>
            <th>Lastname</th>
            <th>Email</th>
            <th>Role</th>


        </tr>
    </thead>
    <tbody>

        <?php

        global $connection;
        $query = "SELECT * FROM users";
        $select_users = mysqli_query($connection, $query);

        while ($row = mysqli_fetch_assoc($select_users)) {
            $user_id             = $row['user_id'];
            $username            = $row['username'];
            $user_password       = $row['user_password'];
            $user_firstname      = $row['user_firstname'];
            $user_lastname       = $row['user_lastname'];
            $user_email          = $row['user_email'];
            $user_image          = $row['user_image'];
            $user_role           = $row['user_role'];



            echo "<tr>";
            echo "<td>$user_id</td>";
            echo "<td>$username</td>";
            echo "<td>$user_firstname</td>";
            // Select category data based on cat_id
            /* $query = "SELECT * FROM comments";
            $select_comments = mysqli_query($connection, $query);

            // Check if data is fetched
            while ($row = mysqli_fetch_assoc($select_comments)) {
                $cat_id = $row['cat_id'];
                $cat_title = $row['cat_title'];


                echo "<td>{$cat_title}</td>";
            } */
            echo "<td>$user_lastname</td>";
            echo "<td>$user_email</td>";
            echo "<td>$user_role</td>";


            /*  $query = "SELECT * FROM posts WHERE post_id= $comment_post_id ";
            $select_post_id_query = mysqli_query($connection, $query);
            while ($row = mysqli_fetch_assoc($select_post_id_query)) {
                $post_id = $row['post_id'];
                $post_title = $row['post_title'];
                echo "<td><a href='../post.php?p_id=$post_id'>$post_title</a></td>";
            }

 */

            echo "<td><a href='users.php?change_to_admin={$user_id}'>Admin</a></td>";
            echo "<td><a href='users.php?change_to_sub={$user_id}'>Subscriber</a></td>";
            echo "<td><a href='users.php?source=edit_user&edit_user={$user_id}'>Edit</a></td>";
            echo "<td><a href='users.php?delete={$user_id}'>Delete</a></td>";
            echo "</tr>";
        }
        ?>
    </tbody>
</table>


<?php

if (isset($_GET['change_to_admin'])) {
    $the_user_id =  escape($_GET['change_to_admin']);
    $query = "UPDATE users SET user_role= ' admin' WHERE user_id= {$the_user_id} ";
    $change_to_admin_query = mysqli_query($connection, $query);
    header("Location: users.php");
}


if (isset($_GET['change_to_sub'])) {
    $the_user_id =  escape($_GET['change_to_sub']);
    $query = "UPDATE users SET user_role= ' subscriber' WHERE user_id= {$the_user_id} ";
    $change_to_sub_query = mysqli_query($connection, $query);
    header("Location: users.php");
}

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Debugging statements
var_dump($_SESSION['user_role']); // Check user role
var_dump($_GET['delete']); // Check delete parameter

if (isset($_GET['delete'])) {
    if (isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'admin') {
        // Check database connection
        global $connection;
        if (!$connection) {
            die("Database connection failed: " . mysqli_connect_error());
        }

        $the_user_id = mysqli_real_escape_string($connection, $_GET['delete']);
        $query = "DELETE FROM users WHERE user_id = {$the_user_id}";
        $delete_user_query = mysqli_query($connection, $query);
        if (!$delete_user_query) {
            die("Error deleting user: " . mysqli_error($connection));
        }
        header("Location: users.php");
        exit;
    } else {
        header("Location: index.php");
        exit;
    }
}
?>