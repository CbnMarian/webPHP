<?php include 'includes/admin_header.php' ?>




<body>

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


                        <div class="col-xs-6">
                            <?php
                            insert_categories()
                            ?>


                            <form action="" method="post">
                                <div class="form-group">
                                    <label for="cat-title">Add Category</label>
                                    <input type="text" class="form-control" name="cat_title">
                                </div>
                                <div class="form-group">
                                    <input class="btn btn-primary" type="submit" name="submit" value="Add Category">
                                </div>
                            </form>

                            <!-- update include categ -->
                            <?php if (isset($_GET['edit'])) {
                                $cat_id = $_GET['edit'];

                                include "../admin/includes/update_categories.php";
                            } ?>
                        </div> <!-- add category form -->

                        <div class="col-xs-6">



                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Category Title</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- FIND ALL CATEGories -->
                                    <?php findAllcategories()  ?>

                                    <!-- Delete query -->

                                    <?php deleteCategories() ?>
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

        <?php include 'includes/admin_footer.php' ?>