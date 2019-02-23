<?php  include "includes/db.php"; ?>
<?php  include "includes/header.php"; ?>
<?php include "admin/functions.php"; ?>
<?php
    $login_error = "";
    if(isset($_POST['loginsubmit']))
    {

        $session = session_id();
        $time = time();
        $timeout = 05;
        $time_loged = $time - $timeout;

        $get_session_Q = "select count(useronline_id) from users_online where session = '$session'";
        $get_session_Q_res = mysqli_query($connection, $get_session_Q);
        $session_count = mysqli_fetch_array($get_session_Q_res);
        if($session_count[0] < 1)
        {
            $insert_session_Q = "insert into users_online(session, time) value('{$session}', '$time')";
            $insert_session_Q_res = mysqli_query($connection, $insert_session_Q);
        }
        else
        {
            $update_session_Q = "update users_online set time='{$time}' where session = '$session'";
            $update_session_Q_res = mysqli_query($connection, $update_session_Q);
            if(!$update_session_Q_res)
            {
                die("QUERY FAILED" . mysqli_error($connection));
            }
        }



        $email = $_POST['email'];
        $password = $_POST['password'];
        $email = mysqli_real_escape_string($connection, $email);
        $password = mysqli_real_escape_string($connection, $password);
        $login_query = "select * from users where user_email like '{$email}'";
        $login_query_res = mysqli_query($connection, $login_query);
        if(!$login_query_res)
        {
            $login_error = "Wrong Email";
            //header("location: ../index.php");
        }
        $user = mysqli_fetch_assoc($login_query_res);
        //$password = crypt($password, $user['user_password']);
        if(password_verify($password, $user['user_password']))
        {
            echo "<h1> Welcome {$user['username']}</h1>";
            $_SESSION['username'] = $user['username'];
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['user_firstname'] = $user['user_firstname'];
            $_SESSION['user_lastname'] = $user['user_lastname'];
            $_SESSION['user_role'] = $user['user_role'];
            if($_SESSION['user_role'] == "admin")
            {header("location: admin");}
            else
            {header("location: index");}
        }
        else
        {
            $login_error = "Wrong password";
            //header("location: ../index.php");
        }
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
                    
                    <h1>Login</h1>
                    <form role="form" action="mylogin" method="post" id="login-form">
                         <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com">
                        </div>
                         <div class="form-group">
                            <label for="password" class="sr-only">Password</label>
                            <input type="password" name="password" id="key" class="form-control" placeholder="Password">
                        </div>
                
                        <input type="submit" name="loginsubmit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Login">
                    </form>
                    <hr>
                    <span>Do not have an account <a href="registration">Register</a></span>
                    <h4 style="text-align:center"><?php echo $login_error; ?></h4>
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


        <hr>



<?php include "includes/footer.php";?>
