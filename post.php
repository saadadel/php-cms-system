<?php include "includes/db.php"?>
<?php include "includes/header.php" ?>
<?php include "admin/functions.php"; ?>
<?php
    if(isset($_POST['create_comment']) && $_POST['content'] != "")
    {
        if(empty($_SESSION['username']) && !empty($_POST['author']) && !empty($_POST['email']))
        {
            $author = escape($_POST['author']);
            $email = escape($_POST['email']);
            $content = escape($_POST['content']);
            $add_com = "insert into comments(comment_post_id, comment_author, comment_email, comment_content, ";
            $add_com .= "comment_date, comment_status) value(";
            $add_com .= "{$_GET['post_id']}, '{$author}', '{$email}', '{$content}', ";
            $add_com .= "now(), 0)";
            $add_com_res = mysqli_query($connection, $add_com);
            if(!$add_com_res)
            {
                die("QUERY FAILED " . mysqli_error($connection));
            }
            /*$increase_com_count = "update posts set post_comment_count = post_comment_count + 1 where post_id = {$_GET['post_id']}";
            $inc_com_res = mysqli_query($connection, $increase_com_count);
            if(!$inc_com_res)
            {
                die("QUERY FAILED " . mysqli_error($connection));
            }*/
        }
    }
    if(isset($_GET['post_id']))
    {
        $increase_post_view_Q = "update posts set post_views = post_views + 1 where post_id = {$_GET['post_id']}";
        $increase_post_view_Q_res = mysqli_query($connection, $increase_post_view_Q);
        if(!$increase_post_view_Q)
        {
            die("QUERY FAILED " . mysqli_error($connection));
        }
    }
?>
<body>

    <!-- Navigation -->
    <?php include "includes/navigation.php" ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Post Content Column -->
            <div class="col-md-8">

                <!-- Blog Post -->
                <?php
                    $testlike="";
                    if(isset($_GET['post_id']))
                    {
                        $get_post = "select * from posts where post_id={$_GET['post_id']}";
                        $get_post_res = mysqli_query($connection, $get_post);
                        if(!$get_post_res)
                        {
                            die("QUERY FAILED: " . mysqli_error($connection));
                        }
                        $post = mysqli_fetch_assoc($get_post_res);
                        echo "<h1>{$post['post_title']}</h1>";
                        echo "<h1>{$testlike}</h1>";
                        echo "<p class='lead'>
                        by <a href='user_posts?username={$post['post_author']}'>{$post['post_author']}</a>
                        </p><hr>";
                        echo "<p><i class='far fa-eye'></i> {$post['post_views']} Times</p>";
                        echo "<p><span class='glyphicon glyphicon-time'></span> Posted on {$post['post_date']}</p><hr>";
                        echo "<img class='img-responsive' src='images/{$post['post_image']}' alt=''><hr>";
                        echo "<p class='lead'>{$post['post_content']}</p><hr>";
                    }

                    $get_post_likes_Q = "select count(like_id) from likes where post_id='{$post['post_id']}'";
                    $get_post_likes_Q_res = mysqli_query($connection, $get_post_likes_Q);
                    
                    if(!$get_post_likes_Q_res)
                    {
                        die("QUERY FAILED: " . mysqli_error($connection));
                    }
                    $likes_num = mysqli_fetch_array($get_post_likes_Q_res);
                    $likes_num = $likes_num[0];
                    if($likes_num == 0)
                    {
                        echo "<h4 id='like_button' class='liked'><span class='like'><a><i class='far fa-thumbs-up fa-lg'></i></a>&nbsp;&nbsp; be the first to like </span></h4>";
                    }
                    else
                    {
                        
                        $get_user_likes_Q = "select count(like_id) from likes where post_id='{$post['post_id']}' and user_id = {$_SESSION['user_id']}";
                        $get_user_likes_Q_res = mysqli_query($connection, $get_user_likes_Q);
                        if(!$get_user_likes_Q_res)
                        {
                            die("QUERY FAILED: " . mysqli_error($connection));
                        }
                        $user_likes = mysqli_fetch_array($get_user_likes_Q_res);
                        $user_likes = $user_likes[0];
                        if($user_likes == 0)
                        {
                            echo "<h4 id='like_button' class='liked'><span class='like'><a><i class='far fa-thumbs-up fa-lg'></i></a>&nbsp;&nbsp; {$likes_num} </span></h4>";
                        }
                        else
                        {
                            echo "<h4 id='like_button' class='disliked'><span class='dislike'><a><i class='far fa-thumbs-down fa-lg'></i></a>&nbsp;&nbsp; {$likes_num} </span></h4>";

                        }
                    }
                ?>
                
            </div>
            <div class="">
                
            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php" ?>

        </div>
        <!-- /.row -->

        <hr>
        
        <!-- Blog Comments -->

        <!-- Comments Form -->
        <?php
            if(isset($_SESSION['username']))
            {
        ?>
                <div class="row well">
                    <h4>Leave a Comment:</h4>
                    <form method="post" action="" role="form">
                        <div class="form-group">
                            <textarea id="textarea_ck" class="form-control" rows="3" name="content"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary" name="create_comment">Submit</button>
                    </form>
                </div>
        <?php
            }
            else
            {
        ?>
            <div class="row well">
                <h4>Leave a Comment:</h4>
                <form method="post" action="" role="form">

                    <div class="form-group">
                        <label for="author">Author</label>
                        <input type="text" class="form-control" name="author">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" name="email">
                    </div>
                    <div class="form-group">
                        <label for="comment">Comment</label>
                        <textarea id="textarea_ck" class="form-control" rows="3" name="content"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary" name="create_comment">Submit</button>
                </form>
            </div>
        <?php
            }
        ?>
        
        <hr>

        <!-- Posted Comments -->

        <!-- Comment -->
        <?php
            $query = "select * from comments where comment_post_id = {$_GET['post_id']} and comment_status=1";
            $query_res = mysqli_query($connection, $query);
            if(!$query_res)
            {
                die("QUERY FAILED " . mysqli_error($connection));
            }
            while($row = mysqli_fetch_assoc($query_res))
            {
                
                echo "<div class='media'>";
                    echo "<a class='pull-left' href='#'>
                        <img class='media-object' src='http://placehold.it/64x64' alt=''>
                        </a>";
                    echo "<div class='media-body'>
                        <h4 class='media-heading'>{$row['comment_author']}
                            <small>{$row['comment_date']}</small>
                        </h4>
                        {$row['comment_content']}
                </div>";
                echo "</div>";
            }
        ?>
       <!-- <div class="media">
            <a class="pull-left" href="#">
                <img class="media-object" src="http://placehold.it/64x64" alt="">
            </a>
            <div class="media-body">
                <h4 class="media-heading">Start Bootstrap
                    <small>August 25, 2014 at 9:30 PM</small>
                </h4>
                Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
            </div>
        </div>
            -->
        <!-- Comment 
        <div class="media">
            <a class="pull-left" href="#">
                <img class="media-object" src="http://placehold.it/64x64" alt="">
            </a>
            <div class="media-body">
                <h4 class="media-heading">Start Bootstrap
                    <small>August 25, 2014 at 9:30 PM</small>
                </h4>
                Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                <!-- Nested Comment 
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading">Nested Start Bootstrap
                            <small>August 25, 2014 at 9:30 PM</small>
                        </h4>
                        Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                    </div>
                </div>
                <!-- End Nested Comment 
            </div>
        </div>
        -->
        <!-- Footer -->
        <?php include "includes/footer.php" ?>
        <?php
            if(isset($_POST['like']))
            {
                echo $testlike;
                $postid = mysqli_real_escape_string($connection, trim($_POST['postid']));
                $userid = mysqli_real_escape_string($connection, trim($_POST['userid']));
                $increase_likes_Q = "insert into likes(post_id, user_id) value({$postid}, {$userid})";
                $increase_likes_Q_res = mysqli_query($connection, $increase_likes_Q);
                if(!$increase_likes_Q_res)
                {
                    die('QUERY FAILED' . mysqli_error($connection));
                }
                $likes_num = $likes_num + 1;
                echo $likes_num;
            }
        ?>
        <script>
            $(document).ready(function () {
                $("#like_button").click(function (e) { 
                    e.preventDefault();
                    //window.alert("INN");
                    var post_id = <?php echo $_GET['post_id']?>;
                    var user_id = <?php echo $_SESSION['user_id']?>;
                    var likes_num = <?php echo $likes_num ?>;
                    if ( $( this ).hasClass("liked") )
                    {
                        //window.alert("LIKE");
                        $.post("functions.php", {
                                'like': 1,
                                'postid': post_id,
                                'userid': user_id
                            },
                            function (data) {
                                $("#like_button").toggleClass('liked disliked');
                                likes_num = String(data);
                                var newContent = "<span class='dislike'><a><i class='far fa-thumbs-down fa-lg'></i></a>&nbsp;&nbsp; " + likes_num + "</span>";
                                $(".like").replaceWith(newContent);
                            }
                        );
                    }
                    else if($( this ).hasClass("disliked"))
                    {
                        //window.alert("DISLIKE");
                        $.post("functions.php", {
                                'dislike': 1,
                                'postid': post_id,
                                'userid': user_id
                            },
                            function (data) {
                                $("#like_button").toggleClass('liked disliked');
                                likes_num = String(data);
                                var newContent = "<span class='like'><a><i class='far fa-thumbs-up fa-lg'></i></a>&nbsp;&nbsp; " + likes_num + "</span>";
                                $(".dislike").replaceWith(newContent);
                            }
                        );
                    }
                    
                    
                });
            });
            
        </script>