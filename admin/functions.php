<?php
    function escape($string)
    {
        global $connection;
        return mysqli_real_escape_string($connection, trim($string));
    }
    
    function selectAllCat()
    {
        global $connection;
        $query = "select * from categories";
        $query_res = mysqli_query($connection, $query);
        while($row = mysqli_fetch_assoc($query_res))
        {
            $id = $row['cat_id'];
            $title = $row['cat_title'];
            echo "
            <tr>
                    <td>{$id}</td>
                    <td>{$title}</td>
                    <td><a href='categories?delete={$id}'>D</a></td>
                    <td><a href='categories?edit={$id}'>E</a></td>
            </tr>
            ";
        }
    }
    function insertIntoCat()
    {
        global $connection;
        if(isset($_POST['add_cat_submit']))
        {
            $title = $_POST['cat_title'];
            if($title != "")
            {
                $query = "insert into categories(cat_title) value('{$title}')";
                $query_res = mysqli_query($connection, $query);
                if(!$query_res)
                {
                    die('QUERY FAILED' . mysqli_error($connection));
                }
            }
            else
            {
                echo "Thie field can't be empty";
            }
        }
    }
    function delCat()
    {
        global $connection;
        if(isset($_GET['delete']))
        {
            $cat_id_del = $_GET['delete'];
            $query = "delete from categories where cat_id = '{$cat_id_del}'";
            $query_res = mysqli_query($connection, $query);
            if(!$query_res)
            {
                die('QUERY FAILED' . mysqli_error($connection));
            }
            header("location: categories");
        }
    }
    function usersOnline()
    {
        if(isset($_GET['users_online']))
        {
            global $connection;
            if(!$connection)
            {
                session_start();
                include "../includes/db.php";

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

            $get_all_sessions_Q = "select count(useronline_id) from users_online where time > '$time_loged'";
            $get_all_sessions_Q_res = mysqli_query($connection, $get_all_sessions_Q);
            $sessions_online = mysqli_fetch_array($get_all_sessions_Q_res);
            $sessions_online = $sessions_online[0];
            echo $sessions_online;
            }
        }
    }
    usersOnline();
?>