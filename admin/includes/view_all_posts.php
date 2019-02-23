<?php
    if(isset($_GET['delete']) && isset($_SESSION['user_role']) && $_SESSION['user_role'] == "admin")
    {
        $post_del_query = "delete from posts where post_id = {$_GET['delete']}";
        $del_res = mysqli_query($connection, $post_del_query);
        if(!$del_res)
        {
            die("QUERY FAILED: " . mysqli_error($connection));
        }
        header("location: posts?source=view_all_posts");
    }
?>

<table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <td>ID</td>
                                    <td>Author</td>
                                    <td>Title</td>
                                    <td>Category</td>
                                    <td>Status</td>
                                    <td>Image</td>
                                    <td>Tags</td>
                                    <td>Comments</td>
                                    <td>Date</td>
                                    <td>Post Views</td>
                                    <td>Delete</td>
                                    <td>Edit</td>
                                </tr>
                            </thead>
                            <tbody>
                                
                                <?php
                                    $query = "select * from posts";
                                    $query_res = mysqli_query($connection, $query);
                                    while($row = mysqli_fetch_assoc($query_res))
                                    {
                                        $cat_q = "select * from categories where cat_id = {$row['post_category_id']}";
                                        $cat_res = mysqli_query($connection, $cat_q);
                                        if(!$cat_res)
                                        {
                                            die("QUERY FAILED " . mysqli_error($connection));
                                        }
                                        $cat = mysqli_fetch_assoc($cat_res);
                                        $comments_num_Q = "select count(comment_id) from comments where comment_post_id = {$row['post_id']}";
                                        $comments_num_Q_res = mysqli_query($connection, $comments_num_Q);
                                        if(!$comments_num_Q_res)
                                        {
                                            die("QUERY FAILED " . mysqli_error($connection));
                                        }
                                        $comments_num = mysqli_fetch_array($comments_num_Q_res);
                                        $comments_num = $comments_num[0];
                                        echo "<tr class='clickable-row' data-href='../post?post_id={$row['post_id']}'>";
                                            echo "<td>{$row['post_id']}</td>";
                                            echo "<td>{$row['post_author']}</td>";
                                            echo "<td>{$row['post_title']}</td>";
                                            echo "<td>{$cat['cat_title']}</td>";
                                            echo "<td>{$row['post_status']}</td>";
                                            echo "<td><img class='img-responsive' src='../images/{$row['post_image']}'></td>";
                                            echo "<td>{$row['post_tags']}</td>";
                                            echo "<td><a href='posts?post_comments={$row['post_id']}'>{$comments_num}</a></td>";
                                            echo "<td>{$row['post_date']}</td>";
                                            echo "<td>{$row['post_views']}</td>";
                                            echo "<td><a onClick=\"javascript: return confirm('Arer you sure you want to DELETE?')\" href='posts?source=view_all_posts&delete={$row['post_id']}'>Delete</a></td>";
                                            echo "<td><a href='posts?source=edit_post&edit_post_id={$row['post_id']}'>Edit</a></td>";
                                        echo "</tr>";
                                    }
                                ?>
                            </tbody>
                        </table>