<?php include "db.php" ?>
<?php session_start(); ?>

<?php
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password =  $_POST['password'];
}

$username =  mysqli_real_escape_string($connection, $username);



$query = "SELECT * FROM users WHERE username = '{$username}'";
$select_user_query = mysqli_query($connection, $query);


if (!$select_user_query) {

    die("query failed" . mysqli_error($connection));
}

$row = mysqli_fetch_assoc($select_user_query);
if ($row) {
    $db_user_password = $row['user_password'];


    if (password_verify($password, $db_user_password)) {
        $_SESSION['username'] = $row['username'];
        $_SESSION['firstname'] = $row['user_firstname'];
        $_SESSION['lastname'] = $row['user_lastname'];
        $_SESSION['user_role'] = $row['user_role'];
        header("Location: ../admin");
        exit;
    }
}
header("Location: ../index.php");
exit;


?>