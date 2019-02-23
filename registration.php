<?php  include "includes/db.php"; ?>
<?php  include "includes/header.php"; ?>
<?php include "admin/functions.php"; ?>
<?php
    if(isset($_POST['submit']) && !empty($_POST['username']) && !empty($_POST['firstname']) && !empty($_POST['lastname']) && !empty($_POST['email']) && !empty($_POST['password']))
    {
        $username = escape($_POST['username']);
        $firstname = escape($_POST['firstname']);
        $lastname = escape($_POST['lastname']);
        $email = escape($_POST['email']);
        $password = escape($_POST['password']);
        $username = mysqli_real_escape_string($connection, $username);
        $firstname = mysqli_real_escape_string($connection, $firstname);
        $lastname = mysqli_real_escape_string($connection, $lastname);
        $email = mysqli_real_escape_string($connection, $email);
        $password = mysqli_real_escape_string($connection, $password);
        $password = password_hash($password, PASSWORD_BCRYPT, array('cost' => 12));
        
        /*$get_rand_Q = "select user_randSalt from users";
        $get_rand_Q_res = mysqli_query($connection, $get_rand_Q);
        if(!$get_rand_Q_res)
        {
            die("QUERY FAILED: " . mysqli_error($connection));
        }
        $rand_arr = mysqli_fetch_assoc($get_rand_Q_res);
        $password = crypt($password, $rand_arr['user_randSalt']);*/

        $add_user = "insert into users(username, user_password, user_firstname, user_lastname, user_email, user_role) ";
        $add_user .= "value('{$username}', '{$password}', '{$firstname}', '{$lastname}', '{$email}', 'subscriber')";
        $add_user_res = mysqli_query($connection, $add_user);
        if(!$add_user_res)
        {
            die("QUERY FAILED: " . mysqli_error($connection));
        }
        header("location: index.php");
    }
?>

    <!-- Navigation -->
    
    <nav class="navbar navbar-dark bg-dark navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
               
                <a class="navbar-brand" href="index">Home</a>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
    
 
    <!-- Page Content -->
    <div class="container">
    
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1>Register</h1>
                    <form role="form" action="registration" method="post" id="login-form" autocomplete="off">
                        <div class="form-group">
                            <label for="username" class="sr-only">username</label>
                            <input type="text" name="username" id="username" class="form-control" placeholder="Username">
                        </div>
                        <div class="form-group">
                            <label for="firstname" class="sr-only">firstname</label>
                            <input type="text" name="firstname" id="firstname" class="form-control" placeholder="First Name">
                        </div>
                        <div class="form-group">
                            <label for="lastname" class="sr-only">lastname</label>
                            <input type="text" name="lastname" id="lastname" class="form-control" placeholder="Last Name">
                        </div>
                         <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com">
                        </div>
                         <div class="form-group">
                            <label for="password" class="sr-only">Password</label>
                            <input type="password" name="password" id="key" class="form-control" placeholder="Password">
                        </div>
                
                        <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Register">
                    </form>
                    <hr>
                    <span>Already have an account <a href="mylogin">Login</a></span>
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


        <hr>



<?php include "includes/footer.php";?>
