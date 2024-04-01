<?php
include "db.php";
include "header.php";
include "../admin/functions.php";

if (isset($_POST['login'])) {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    login_user($username, $password);
}

header("Location: ../index.php");
exit;
