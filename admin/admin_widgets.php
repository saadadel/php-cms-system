       
                <!-- /.row -->
                
<div class="row">
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-file-text fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <?php
                            $count_posts_Q = "select count(post_id) from posts";
                            $count_posts_Q_res = mysqli_query($connection, $count_posts_Q);
                            if(!$count_posts_Q_res)
                            {
                                die("QUERY FAILED: " . $connection);
                            }
                            $posts_num = mysqli_fetch_row($count_posts_Q_res);
                            echo "<div class='huge'>{$posts_num[0]}</div>"
                        ?>
                        <div>Posts</div>
                    </div>
                </div>
            </div>
            <a href="posts?source=view_all_posts">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-green">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-comments fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <?php
                            $count_posts_Q = "select count(comment_id) from comments";
                            $count_posts_Q_res = mysqli_query($connection, $count_posts_Q);
                            if(!$count_posts_Q_res)
                            {
                                die("QUERY FAILED: " . $connection);
                            }
                            $comments_num = mysqli_fetch_row($count_posts_Q_res);
                            echo "<div class='huge'>{$comments_num[0]}</div>"
                        ?>
                        <div>Comments</div>
                    </div>
                </div>
            </div>
            <a href="comments?source=view_all_comments">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-yellow">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-user fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <?php
                            $count_posts_Q = "select count(user_id) from users";
                            $count_posts_Q_res = mysqli_query($connection, $count_posts_Q);
                            if(!$count_posts_Q_res)
                            {
                                die("QUERY FAILED: " . $connection);
                            }
                            $users_num = mysqli_fetch_row($count_posts_Q_res);
                            echo "<div class='huge'>{$users_num[0]}</div>"
                        ?>
                        <div>Users</div>
                    </div>
                </div>
            </div>
            <a href="users?source=view_all_users">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-red">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-list fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <?php
                            $count_posts_Q = "select count(cat_id) from categories";
                            $count_posts_Q_res = mysqli_query($connection, $count_posts_Q);
                            if(!$count_posts_Q_res)
                            {
                                die("QUERY FAILED: " . $connection);
                            }
                            $categories_num = mysqli_fetch_row($count_posts_Q_res);
                            echo "<div class='huge'>{$categories_num[0]}</div>"
                        ?>
                        <div>Categories</div>
                    </div>
                </div>
            </div>
            <a href="categories">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
</div>
                <!-- /.row -->