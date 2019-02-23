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
                        if(isset($_POST['update_user']) && !empty($_POST['password']))
                        {
                            $user_image_temp = $_FILES['user_image']['tmp_name'];
                            $user_image = $_FILES['user_image']['name'];
                            $username = escape($_POST['username']);
                            $password = escape($_POST['password']);
                            $firstname = escape($_POST['firstname']);
                            $lastname = escape($_POST['lastname']);
                            $role = escape($_POST['role']);
                            $email = escape($_POST['email']);
                            move_uploaded_file($user_image_temp, "../images/$user_image");
                            $user_image = escape($user_image);
                            $query = "update users set username='{$username}',  user_password='{$password}', user_firstname='{$firstname}', ";
                            $query .=  "user_lastname='{$lastname}', user_role='{$role}', user_email='{$email}', ";
                            $query .=  "user_image='{$user_image}' ";
                            $query .= "where user_id={$_SESSION['user_id']}";
                            $query_res = mysqli_query($connection, $query);
                            if(!$query_res)
                            {
                                die("QUERY FAILED: " . mysqli_error($connection));
                            }
                            $login_query = "select * from users where user_id={$_SESSION['user_id']}";
                            $login_query_res = mysqli_query($connection, $login_query);
                            if(!$login_query_res)
                            {
                                die("QUERY FAILED: " . mysqli_error($connection));
                            }
                            $user = mysqli_fetch_assoc($login_query_res);
                            $_SESSION['username'] = $user['username'];
                            $_SESSION['user_id'] = $user['user_id'];
                            $_SESSION['user_firstname'] = $user['user_firstname'];
                            $_SESSION['user_lastname'] = $user['user_lastname'];
                            $_SESSION['user_role'] = $user['user_role'];
                            if($_SESSION['user_role'] == "admin")
                            {header("location: ../admin");}
                            else
                            {header("location: ../index");}
                        }
                    ?>
                    <?php
                        $get_user_query = "select * from users where user_id = {$_SESSION['user_id']}";
                        $get_user_query_res = mysqli_query($connection, $get_user_query);
                        if(!$get_user_query_res)
                        {
                            die("QUERY FAILED: " . mysqli_error($connection));
                        }
                        $edit_user = mysqli_fetch_assoc($get_user_query_res);
                    ?>
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="username">User Name</label>
                            <input type="text" class="form-control" name="username" value="<?php echo $edit_user['username'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="role">User Role</label>
                            <select class="form-control" name="role">
                                <option value="admin">Admin</option>
                                <option value="subscriber">Subscriber</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="passowrd">New Password</label>
                            <input type="password" class="form-control" name="password">
                        </div>
                        <div class="form-group">
                            <label for="fname">First Name</label>
                            <input type="text" class="form-control" name="firstname" value="<?php echo $edit_user['user_firstname'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="lname">Last Name</label>
                            <input type="text" class="form-control" name="lastname" value="<?php echo $edit_user['user_lastname'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" class="form-control" name="email" value="<?php echo $edit_user['user_email'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="image">User Image</label>
                            <input type="file" name="user_image">
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" name="update_user" value="Update Profile">
                        </div>
                    </form>
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
