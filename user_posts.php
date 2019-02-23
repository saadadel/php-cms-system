<?php include "includes/db.php" ?>
<?php include "includes/header.php" ?>
<body>

    <!-- Navigation -->
    <?php include "includes/navigation.php";
    ?>

    <!-- Page Content -->
    <div class="container">

        <!-- /.row -->
        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

                <h1 class="page-header">
                    Awesome
                    <small>Blog</small>
                </h1>

                <?php 

                    $posts_per_page = 5;
                    $posts_num_Q = "select count(post_id) from posts where post_author= '{$_GET['username']}'";
                    $posts_num_Q_res = mysqli_query($connection, $posts_num_Q);
                    if(!$posts_num_Q_res)
                    {
                        die("QUERY FAILED: " . mysqli_error($connection));
                    }
                    $posts_num = mysqli_fetch_array($posts_num_Q_res);
                    $posts_num = $posts_num[0];
                    $pages_num = ceil($posts_num / $posts_per_page);
                    $current_page = 1;
                    $starting_post = 0;
                    if(isset($_GET['page_num']))
                    {
                        $current_page = $_GET['page_num'];
                        $starting_post = ($current_page * $posts_per_page - $posts_per_page );
                    }

                    $query = "select * from posts where post_author= '{$_GET['username']}' limit {$starting_post}, {$posts_per_page}";
                    $res = mysqli_query($connection, $query);
                    if(!$res)
                    {
                        die("QUERY FAILED:" . mysqli_error($connection));
                    }
                    if(mysqli_num_rows($res) < 1)
                    {
                        echo "<h1 class='text-center'>No Posts</h1>";
                    }
                    while($row = mysqli_fetch_assoc($res))
                    {
                        $post_title = $row['post_title'];
                        $post_author = $row['post_author'];
                        $post_date = $row['post_date'];
                        $post_image = $row['post_image'];
                        $post_views = $row['post_views'];
                        $post_content = substr($row['post_content'], 0, 50);
                    ?>
                        <h2>
                            <a href="post?post_id=<?php echo $row['post_id'] ?>"><?php echo $post_title ?></a>
                        </h2>
                        <p class="lead">
                            by <a href="#"><?php echo $post_author ?></a>
                        </p>
                        <p><i class="far fa-eye"></i>  <?php echo $post_views ?> Times</p>
                        <p><span class="glyphicon glyphicon-time"></span><?php echo $post_date ?></p>
                        <hr>
                        <a href="post?post_id=<?php echo $row['post_id'] ?>">
                            <img class="img-responsive" src="images/<?php echo $post_image ?>" alt="">
                        </a>
                        <hr>
                        <p><?php echo $post_content ?></p>
                        <hr>
                        <br>
            <?php } ?> 
                <hr>
                <!-- Pager -->
                <ul class="pager">
                <?php
                    if($current_page > 1)
                    {
                        $prev_page = $current_page - 1;
                        echo "<li class='previous'>
                                <a href='user_posts?username={$_GET['username']}&page_num={$prev_page}'>&larr; Previous</a>
                            </li>";
                    }
                ?>
                
                <?php
                    
                    for($i=1; $i<=$pages_num; $i++)
                    {
                        if($i != $current_page)
                        {
                            echo "<li>
                                <a href='user_posts?username={$_GET['username']}&page_num={$i}'>{$i}</a>
                            </li>";
                        }
                        else
                        {
                            echo "<li>
                                <a style='background-color:#424242; color:#ffffff' >{$i}</a>
                            </li>";
                        }
                        
                    }                        
                ?>
                <?php
                    if($current_page < $pages_num)
                    {
                        $next_page = $current_page + 1;
                        echo "<li class='next'>
                                <a href='user_posts?username={$_GET['username']}&page_num={$next_page}'>Next &rarr;</a>
                            </li>";
                    }
                ?>
            </ul>

            </div>

            
            
            
            
            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php" ?>

        </div>
        
        <hr>

        <!-- Footer -->
        <?php include "includes/footer.php" ?>