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
                        <div class="col-xs-6">
                            <?php insertIntoCat(); ?>
                            <form action="" method="post">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="cat_title">
                                </div>
                                <div class="form-group">
                                    <input type="submit" class="btn btn-primary" name="add_cat_submit" value="Add Category">
                                </div>
                            </form>
                        
                        
                        <?php
                                    if(isset($_GET['edit']))
                                    {
                                        $cat_id_edit = $_GET['edit'];
                                        $query = "select * from categories where cat_id = '{$cat_id_edit}'";
                                        $query_res = mysqli_query($connection, $query);
                                        if(!$query_res)
                                        {
                                            die('QUERY FAILED' . mysqli_error($connection));
                                        }
                                        $edit_row = mysqli_fetch_assoc($query_res)
                                            ?>
                                        <form action="" method="post">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="edit_cat_title" value="<?php echo  $edit_row['cat_title']?>">
                                            </div>
                                            <div class="form-group">
                                                <input type="submit" class="btn btn-primary" name="edit_cat_submit" value="Edit Category">
                                            </div>
                                        </form>
                                        <?php
                                        if(isset($_POST['edit_cat_submit']))
                                        {
                                            $edit_cat_title = $_POST['edit_cat_title'];
                                            if(!$edit_cat_title)
                                            {
                                                echo "Name feiled can't be empty";
                                            }
                                            else
                                            {
                                                $query = "update categories set cat_title = '{$edit_cat_title}' where cat_id = '{$cat_id_edit}'";
                                                $query_res = mysqli_query($connection, $query);
                                                if(!$query_res)
                                                {
                                                    die('QUERY FAILED' . mysqli_error($connection));
                                                }
                                                header("location: categories");
                                            }
                                        
                                        }
                                        
                                    }
                                ?>
                            </div>
                        <div class="col-xs-6">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <th>ID</th>
                                    <th>Category Title</th>
                                    <th>Delete</th>
                                    <th>Edit</th>
                                </thead>
                                <?php
                                    selectAllCat();
                                ?>
                                <?php
                                    delCat();
                                ?>
                                
                            </table>
                        </div>
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
