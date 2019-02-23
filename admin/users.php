<?php include "../includes/db.php"?>
<?php include "includes/header.php"?>
<?php include "functions.php"?>
<?php ob_start(); ?>



    <div id="wrapper">

        <!-- Navigation -->
        <?php include "includes/navigation.php"?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                    <h1 class="page-header">
                        Welcome To Admin
                        <small>
                            <?php
                                if(isset($_SESSION['username']) && $_SESSION['user_role'] == "admin")
                                {
                                    echo $_SESSION['username'];
                                }
                            ?>
                        </small>
                    </h1>
                    <?php
                        if(isset($_GET['source']))
                        {
                            if($_GET['source'] == "view_all_users")
                            {
                                include "includes/view_all_users.php";
                            }
                            elseif($_GET['source'] == "add_user")
                            {
                                include "includes/add_user.php";
                            }
                            elseif($_GET['source'] == "edit_user")
                            {
                                include "includes/edit_user.php";
                            }
                        }
                    ?>
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
<?php include "includes/footer.php"?>
