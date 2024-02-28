<?php

if (isset($_POST['create_user'])) {

    echo $user_firstname = $_POST['user_firstname'];
    $user_lastname = $_POST['user_lastname'];
    $user_role = $_POST['user_role'];

    $username = $_POST['username'];
    $user_email = $_POST['user_email'];
    $user_password = $_POST['user_password'];


    // move_uploaded_file($post_image_temp, "../images/$post_image");

    $query = "INSERT INTO users (user_id, user_firstname, user_lastname, username, user_email, user_role, user_password, ) ";
    $query .= "VALUES ('$post_category_id', '$user_firstname', '$user_lastname', '$username', '$user_email', '$user_role', '$user_password')";


    $create_post_query = mysqli_query($connection, $query);

    confirm($create_post_query);
}



?>


<form action="" method="post" enctype="multipart/form-data">



    <div class="form-group">
        <label for="title">Firstname</label>
        <input type="text" class="form-control" name="user_firstname">
    </div>

    <div class="form-group">
        <label for="post_status">Lastname</label>
        <input type="text" class="form-control" name="user_lastname">
    </div>

    <select name="user_role" id="">

        <option value="subscriber">Select Options</option>
        <option value="admin">Admin</option>
        <option value="subscriber">Subscriber</option>

    </select>


    <!-- <div class="form-group">
        <label for="post_image">Post Image</label>
        <input type="file" name="image">
    </div> -->


    <div class="form-group">
        <label for="post_tags">Username</label>
        <input type="text" class="form-control" name="username">
    </div>

    <div class="form-group">
        <label for="post_content">Email</label>
        <input type="text" class="form-control" name="user_email">
        </textarea>
    </div>
    <div class="form-group">
        <label for="post_content">Password</label>
        <input type="text" class="form-control" name="user_password">
        </textarea>
    </div>

    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="create_post" value="Add user">
    </div>



</form>