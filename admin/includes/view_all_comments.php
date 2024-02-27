<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>Id</th>
            <th>Author</th>
            <th>Comment</th>
            <th>Email</th>
            <th>Status</th>
            <th>In Response to</th>
            <th>Date</th>
            <th>Approved</th>
            <th>Unapproved</th>

            <th>Delete</th>
        </tr>
    </thead>
    <tbody>

        <?php

        global $connection;
        $query = "SELECT * FROM comments";
        $select_comments = mysqli_query($connection, $query);

        while ($row = mysqli_fetch_assoc($select_comments)) {
            $comment_id = $row['comment_id'];
            $comment_post_id = $row['comment_post_id'];
            $comment_post_author = $row['comment_post_author'];
            $comment_content = $row['comment_content'];
            $comment_email = $row['comment_email'];
            $comment_status = $row['comment_status'];
            $comment_date = $row['comment_date'];


            echo "<tr>";
            echo "<td>$comment_id</td>";
            echo "<td>$comment_post_author</td>";
            echo "<td>$comment_content</td>";



            // Select category data based on cat_id
            /* $query = "SELECT * FROM comments";
            $select_comments = mysqli_query($connection, $query);

            // Check if data is fetched
            while ($row = mysqli_fetch_assoc($select_comments)) {
                $cat_id = $row['cat_id'];
                $cat_title = $row['cat_title'];


                echo "<td>{$cat_title}</td>";
            } */



            echo "<td>$comment_email</td>";
            echo "<td>$comment_status</td>";
            echo "<td>Some title</td>";
            echo "<td>$comment_date</td>";

            echo "<td><a href='post.php?source=edit_post&p_id= '>Approve</a></td>";
            echo "<td><a href='post.php?delete='>Unapprove</a></td>";
            echo "<td><a href='post.php?delete='>Delete</a></td>";


            echo "</tr>";
        }

        ?>




    </tbody>
</table>


<?php

if (isset($_GET['delete'])) {
    $the_post_id = $_GET['delete'];
    $query = "DELETE FROM posts WHERE post_id = {$the_post_id}";
    $delete_query = mysqli_query($connection, $query);
}

?>