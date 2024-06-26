<?php
include("delete_modal.php");

if (isset($_POST['checkBoxArray'])) {

    foreach ($_POST['checkBoxArray'] as $postValueId) {

        $bulk_options = $_POST['bulk_options'];

        switch ($bulk_options) {
            case 'published':
            case 'draft':
                $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = {$postValueId}";
                $update_status_query = mysqli_query($connection, $query);
                confirm($update_status_query);
                break;


            case 'delete':
                $query = "DELETE FROM posts WHERE post_id = {$postValueId}";
                $update_to_delete_status = mysqli_query($connection, $query);
                confirm($update_to_delete_status);
                break;



            case 'clone':
                $query = "SELECT * FROM posts WHERE post_id = '{$postValueId}'";
                $select_post_query = mysqli_query($connection, $query);

                while ($row = mysqli_fetch_assoc($select_post_query)) {
                    $post_title       = $row['post_title'];
                    $post_category_id = $row['post_category_id'];
                    $post_date        = $row['post_date'];
                    $post_author      = $row['post_author'];
                    $post_user        = $row['post_user'];
                    $post_status      = $row['post_status'];
                    $post_image       = $row['post_image'];
                    $post_tags        = $row['post_tags'];
                    $post_content     = $row['post_content'];

                    if (empty($post_status)) {
                        $post_status = "No status";
                    }
                }

                $query = "INSERT INTO posts(post_category_id, post_title, post_author,post_user, post_date, post_status, post_image, post_tags, post_content) ";
                $query .= "VALUES('{$post_category_id}', '{$post_title}', '{$post_author}','{$post_user}',  '{$post_date}', '{$post_status}', '{$post_image}', '{$post_tags}', '{$post_content}')";

                $insert_post_query = mysqli_query($connection, $query);

                if (!$insert_post_query) {
                    die("Failed to clone post: " . mysqli_error($connection));
                }
                break;
        }
    }
}

?>


<form action="" method="post">
    <table class="table table-bordered table-hover">
        <div id="bulkOptionsContainer" class="col-xs-4">
            <select class="form-control" name="bulk_options" id="">
                <option value="">Select Options</option>
                <option value="published">Publish</option>
                <option value="draft">Draft</option>
                <option value="delete">Delete</option>
                <option value="clone">Clone</option>
            </select>
        </div>
        <div class="col-xs-4">
            <input type="submit" name="submit" class="btn btn-success" value="Apply">
            <a class="btn btn-primary" href="post.php?source=add_post">Add New</a>
        </div>

        <thead>
            <tr>
                <th><input id="selectAllBoxes" type="checkbox"></th>
                <th>Id</th>
                <th>User</th>
                <th>Title</th>
                <th>Category</th>
                <th>Status</th>
                <th>Image</th>
                <th>Tags</th>
                <th>Comments</th>
                <th>Date</th>
                <th>View Post</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            <?php
            global $connection;
            // $query = "SELECT * FROM posts ORDER BY post_id DESC";
            $query = "SELECT * FROM posts ORDER BY post_id DESC";
            $select_posts = mysqli_query($connection, $query);

            while ($row = mysqli_fetch_assoc($select_posts)) {
                $post_id = $row['post_id'];
                $post_author = $row['post_author'];
                $post_user = $row['post_user'];
                $post_title = $row['post_title'];
                $post_category_id = $row['post_category_id'];
                $post_status = $row['post_status'];
                $post_image = $row['post_image'];
                $post_tags = $row['post_tags'];
                $post_comment_count = $row['post_comment_count'];
                $post_date = $row['post_date'];
                $post_views_count = $row['post_views_count'];

                echo "<tr>";
            ?>
                <td><input class='checkBoxes' type='checkbox' name='checkBoxArray[]' value='<?php echo $post_id; ?>'></td>
                <?php
                echo "<td>$post_id</td>";
                if (!empty($post_author)) {
                    echo "<td>$post_author</td>";
                } else if (!empty($post_user)) {
                    echo "<td>$post_user</td>";
                }



                echo "<td>$post_title</td>";
                $query = "SELECT * FROM categories WHERE cat_id = {$post_category_id}";
                $select_categories_id = mysqli_query($connection, $query);
                while ($row = mysqli_fetch_assoc($select_categories_id)) {
                    $cat_title = $row['cat_title'];
                    echo "<td>{$cat_title}</td>";
                }
                echo "<td>$post_status</td>";
                echo "<td><img width='100' src='../images/$post_image' alt='img'></td>";
                echo "<td>$post_tags</td>";
                echo "<td>$post_comment_count</td>";
                echo "<td>$post_date</td>";
                echo "<td><a class='btn btn-primary' href='../post.php?p_id={$post_id}'>View Post</a></td>";
                echo "<td><a class=' btn btn-info' href='post.php?source=edit_post&p_id={$post_id}'>Edit</a></td>";

                ?>

                <form method="post">
                    <input type="hidden" name="post_id" value="<?php echo $post_id ?>">
                    <?php
                    echo ' <td><input class="btn-danger" type="submit" name="delete" value="Delete"></td>';
                    ?>

                </form>

            <?php



                // echo "<td><a onClick=\"return confirm('Are you sure you want to delete');\" href='post.php?delete={$post_id}'>Delete</a></td>";
                echo "<td><a href='post.php?reset={$post_id}'>{$post_views_count}</a></td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</form>


<?php

if (isset($_POST['delete'])) {
    $the_post_id = escape($_POST['post_id']);
    $query = "DELETE FROM posts WHERE post_id = {$the_post_id}";
    $delete_query = mysqli_query($connection, $query);
    header("Location: post.php");
}

if (isset($_GET['reset'])) {
    $the_post_id = escape($_GET['reset']);
    $query = "UPDATE posts SET post_views_count = 0 WHERE post_id =" . mysqli_real_escape_string($connection, $_GET['reset']) . ' ';
    $delete_query = mysqli_query($connection, $query);
    header("Location: post.php");
}

?>

<script>
    $(document).ready(function() {

        $(".delete_link").on('click', function() {


            var id = $(this).attr("rel");

            var delete_url = "posts.php?delete=" + id + " ";

            $(".modal_delete_link").attr("href", delete_url);

            $("#myModal").modal("show");

        });

    });
</script>