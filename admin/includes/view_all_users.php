<?php
    if(isset($_GET['delete'])  && isset($_SESSION['user_role']) && $_SESSION['user_role'] == "admin")
    {
        $post_del_query = "delete from users where user_id = {$_GET['delete']}";
        $del_res = mysqli_query($connection, $post_del_query);
        if(!$del_res)
        {
            die("QUERY FAILED: " . mysqli_error($connection));
        }
        header("location: users?source=view_all_users");
    }
    if(isset($_GET['role']))
    {
        $post_del_query = "update users set user_role = '{$_GET['role']}' where user_id = {$_GET['user_id']}";
        $del_res = mysqli_query($connection, $post_del_query);
        if(!$del_res)
        {
            die("QUERY FAILED: " . mysqli_error($connection));
        }
        header("location: users?source=view_all_users");
    }
?>

<table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <td>ID</td>
                                    <td>Username</td>
                                    <td>First Name</td>
                                    <td>Last Name</td>
                                    <td>Email</td>
                                    <td>Image</td>
                                    <td>Role</td>
                                    <td>Change Role</td>
                                    <td>Delete</td>
                                    <td>Edit</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $query = "select * from users";
                                    $query_res = mysqli_query($connection, $query);
                                    while($row = mysqli_fetch_assoc($query_res))
                                    {
                                        echo "<tr>";
                                            echo "<td>{$row['user_id']}</td>";
                                            echo "<td>{$row['username']}</td>";
                                            echo "<td>{$row['user_firstname']}</td>";
                                            echo "<td>{$row['user_lastname']}</td>";
                                            echo "<td>{$row['user_email']}</td>";
                                            echo "<td><img class='img-responsive' src='../images/{$row['user_image']}'></td>";
                                            if($row['user_role'] == "admin")
                                            {
                                                echo "<td>{$row['user_role']}</td>";
                                                echo "<td><a href='users?source=view_all_users&role=subscriber&user_id={$row['user_id']}'>Subscriber</a></td>";
                                            }
                                            elseif($row['user_role'] == "subscriber")
                                            {
                                                echo "<td>{$row['user_role']}</td>";
                                                echo "<td><a href='users?source=view_all_users&role=admin&user_id={$row['user_id']}'>Admin</a></td>";
                                            }
                                            echo "<td><a onClick=\"javascript: return confirm('Arer you sure you want to DELETE?')\" href='users?source=view_all_users&delete={$row['user_id']}'>Delete</a></td>";
                                            echo "<td><a href='users?source=edit_user&edit_user_id={$row['user_id']}'>Edit</a></td>";
                                        echo "</tr>";
                                    }
                                ?>
                            </tbody>
                        </table>