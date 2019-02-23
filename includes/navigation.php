<nav class="navbar navbar-dark bg-dark navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index">CMS</a>
            </div>
            
            <?php
                    if(isset($_SESSION['username']))
                    {
                ?>
                        <ul class="nav navbar-right top-nav">
                        <li class="dropdown"  style="color: #999;">
                            <a style="padding-top: 15px; padding-bottom: 15px; line-height: 20px; font-size:1.3em; color: #999;" href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $_SESSION['username'] ?> <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="user_posts?username=<?php echo $_SESSION['username'] ?>"><i class="fa fa-fw fa-user"></i> Profile</a>
                                </li>
                                <li class="divider"></li>
                                <li>
                                    <a href="admin/includes/logout.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                                </li>
                            </ul>
                        </li>
                        </ul>
                <?php
                    }
            ?>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    
                    <?php
                        $query = "select * from categories";
                        $res = mysqli_query($connection, $query);
                        while($row = mysqli_fetch_assoc($res))
                        {
                            $cat_title = $row['cat_title'];
                            $cat_id = $row['cat_id'];
                            echo "<li>
                            <a href='category?cat_id={$cat_id}'>{$cat_title}</a>
                                </li>";
                        }
                        if(isset($_SESSION['username']) && $_SESSION['user_role'] == "admin")
                        {
                            echo "<li><a href='admin'>Admin</a></li>";
                            if(isset($_GET['post_id']))
                            {echo "<li><a href='admin/posts?source=edit_post&edit_post_id={$_GET['post_id']}'>Edit Post</a></li>";}
                        }
                        
                    ?>
                    
                </ul>
                
                <?php
                    if(empty($_SESSION['username']))
                    {
                ?>
                        <form method="post" action="mylogin" class="form-inline my-2 my-lg-0" style="float:right; padding-top:1%">
                            <button class="btn btn-info" type="submit" name="registersubmit">Login</button>
                            <br>
                        </form>
                        <form method="post" action="registration" class="form-inline my-2 my-lg-0" style="float:right; padding-top:1%">
                            <button class="btn btn-primary" type="submit" name="loginsubmit">Register</button>
                            <br>
                        </form>
                <?php
                    }
                ?>
                
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>