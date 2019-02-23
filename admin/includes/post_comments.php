<?php
    if(isset($_GET['delete']) && isset($_SESSION['user_role']) && $_SESSION['user_role'] == "admin")
    {
        $post_del_query = "delete from comments where comment_id = {$_GET['delete']}";
        $del_res = mysqli_query($connection, $post_del_query);
        if(!$del_res)
        {
            die("QUERY FAILED: " . mysqli_error($connection));
        }
        /*$decrease_com_count = "update posts set post_comment_count = post_comment_count - 1 where post_id = {$_GET['post']}";
        $dec_com_res = mysqli_query($connection, $decrease_com_count);
        if(!$dec_com_res)
        {
            die("QUERY FAILED " . mysqli_error($connection));
        }*/
        header("location: posts?post_comments={$_GET['post_comments']}");
        
    }
    if(isset($_GET['status']) && isset($_SESSION['user_role']) && $_SESSION['user_role'] == "admin")
    {
        $post_del_query = "update comments set comment_status = {$_GET['status']} where comment_id = {$_GET['comment_id']}";
        $del_res = mysqli_query($connection, $post_del_query);
        if(!$del_res)
        {
            die("QUERY FAILED: " . mysqli_error($connection));
        }
        header("location: posts?post_comments={$_GET['post_comments']}");
    }
?>

<table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <td>ID</td>
                                    <td>Author</td>
                                    <td>Post Title</td>
                                    <td>Email</td>
                                    <td>Date</td>
                                    <td>Content</td>
                                    <td>Status</td>
                                    <td>Change Status</td>
                                    <td>Delete</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $query = "select * from comments where comment_post_id={$_GET['post_comments']}";
                                    $query_res = mysqli_query($connection, $query);
                                    if(!$query_res)
                                    {
                                        die("QUERY FAILED " . mysqli_error($connection));
                                    }
                                    $post_q = "select * from posts where post_id = {$_GET['post_comments']}";
                                    $post_res = mysqli_query($connection, $post_q);
                                    if(!$post_res)
                                    {
                                        die("QUERY FAILED " . mysqli_error($connection));
                                    }
                                    $post = mysqli_fetch_assoc($post_res);
                                    while($row = mysqli_fetch_assoc($query_res))
                                    {
                                        
                                        echo "<tr>";
                                            echo "<td>{$row['comment_id']}</td>";
                                            echo "<td>{$row['comment_author']}</td>";
                                            echo "<td><a href='../post?post_id={$_GET['post_comments']}'>{$post['post_title']}</a></td>";
                                            echo "<td>{$row['comment_email']}</td>";
                                            echo "<td>{$row['comment_date']}</td>";
                                            echo "<td>{$row['comment_content']}</td>";
                                            if($row['comment_status'] == 1)
                                            {
                                                echo "<td>Approved</td>";
                                                echo "<td><a href='posts?post_comments={$_GET['post_comments']}&status=0&comment_id={$row['comment_id']}'>Unapprove</a></td>";
                                            }
                                            elseif($row['comment_status'] == 0)
                                            {
                                                echo "<td>Unapproved</td>";
                                                echo "<td><a href='posts?post_comments={$_GET['post_comments']}&status=1&comment_id={$row['comment_id']}'>Approve</a></td>";
                                            }
                                            echo "<td><a onClick=\"javascript: return confirm('Arer you sure you want to DELETE?')\" href='posts?post_comments={$_GET['post_comments']}&delete={$row['comment_id']}'>Delete</a></td>";
                                        echo "</tr>";
                                    }
                                ?>
                            </tbody>
                        </table>