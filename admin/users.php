<?php include 'includes/admin_header.php' ?>





<?php
if (!isset($_SESSION['user_role'])) {
    header("Location: ../index.php");
    die;
} else {
    if ($_SESSION['user_role'] == 'subscriber') {
        header("Location: ../index.php");
        die;
    }
}
?>



<div id="wrapper">
    <!-- navigation -->
    <?php include 'includes/admin_navigation.php' ?>
    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Blank Page
                        <small>Author</small>
                    </h1>
                    <?php
                    if (isset($_GET['source'])) {
                        $source = $_GET['source'];
                    } else {
                        $source = '';
                    }
                    switch ($source) {
                        case 'add_user';
                            include "includes/add_user.php";
                            break;
                        case 'edit_user';
                            include "includes/edit_user.php";
                            break;
                        case '200';
                            echo "NICE 200";
                            break;
                        default:
                            include "includes/view_all_users.php";
                            break;
                    }
                    ?>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->
    <?php include 'includes/admin_footer.php' ?>