<?php
    if(isset($_POST['add_user']))
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

        /*$get_rand_Q = "select user_randSalt from users";
        $get_rand_Q_res = mysqli_query($connection, $get_rand_Q);
        if(!$get_rand_Q_res)
        {
            die("QUERY FAILED: " . mysqli_error($connection));
        }
        $rand_arr = mysqli_fetch_assoc($get_rand_Q_res);
        $password = crypt($password, $rand_arr['user_randSalt']);*/
        $password = password_hash($password, PASSWORD_BCRYPT, array('cost' => 12));

        $query = "insert into users(username, user_password, user_firstname, user_lastname, user_email, user_image, user_role) ";
        $query .= "value('{$username}', '{$password}', '{$firstname}', '{$lastname}', '{$email}', '{$user_image}', '{$role}')";
        $query_res = mysqli_query($connection, $query);
        if(!$query_res)
        {
            die("QUERY FAILED: " . mysqli_error($connection));
        }
        header("location: users?source=view_all_users");
    }
?>

<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="username">User Name</label>
        <input type="text" class="form-control" name="username">
    </div>
    <div class="form-group">
        <label for="role">User Role</label>
        <select class="form-control" name="role">
            <option value="subscriber">Subscriber</option>
            <option value="admin">Admin</option>
        </select>
    </div>
    <div class="form-group">
        <label for="passowrd">Password</label>
        <input type="password" class="form-control" name="password">
    </div>
    <div class="form-group">
        <label for="fname">First Name</label>
        <input type="text" class="form-control" name="firstname">
    </div>
    <div class="form-group">
        <label for="lname">Last Name</label>
        <input type="text" class="form-control" name="lastname">
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input type="text" class="form-control" name="email">
    </div>
    <div class="form-group">
        <label for="image">User Image</label>
        <input type="file" name="user_image">
    </div>
    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="add_user" value="Add User">
    </div>
</form>