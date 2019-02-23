<?php include "includes/db.php" ?>
<?php include "includes/header.php" ?>
<body>

    <!-- Navigation -->
    <?php include "includes/navigation.php" ?>

    <!-- Page Content -->
    <div class="container">

        <!-- /.row -->
        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">
                <?php
                    if(isset($_GET['cat_id']))
                    {
                        $cat_id = $_GET['cat_id'];
                        $cat_posts_query = "select * from posts where post_category_id = {$cat_id}";
                        $cat_posts_query_res = mysqli_query($connection, $cat_posts_query);
                        if(!$cat_posts_query_res)
                        {
                            die("QUERY FAILED: " . mysqli_error($connection));
                        }
                        while($row = mysqli_fetch_assoc($cat_posts_query_res))
                        {
                            $post_title = $row['post_title'];
                            $post_author = $row['post_author'];
                            $post_date = $row['post_date'];
                            $post_image = $row['post_image'];
                            $post_content = substr($row['post_content'], 0, 50);
                        ?>
                            <h2>
                                <a href="post?post_id=<?php echo $row['post_id'] ?>"><?php echo $post_title ?></a>
                            </h2>
                            <p class="lead">
                                by <a href="index"><?php echo $post_author ?></a>
                            </p>
                            <p><span class="glyphicon glyphicon-time"></span><?php echo $post_date ?></p>
                            <hr>
                            <img class="img-responsive" src="images/<?php echo $post_image ?>" alt="">
                            <hr>
                            <p><?php echo $post_content ?></p>
                            <a class="btn btn-primary" href="post?post_id=<?php echo $row['post_id'] ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
                            <hr>
                            <br>
                <?php }}
                ?> 
                    <hr>

                <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1>

                <!-- Pager -->
                <ul class="pager">
                    <li class="previous">
                        <a href="#">&larr; Older</a>
                    </li>
                    <li class="next">
                        <a href="#">Newer &rarr;</a>
                    </li>
                </ul>

            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php" ?>

        </div>
        
        <hr>

        <!-- Footer -->
        <?php include "includes/footer.php" ?>