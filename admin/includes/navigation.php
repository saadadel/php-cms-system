
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">CMS Admin</a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
                <li><a >Users Online: <span class="users_online"></span></a></li>
                <li><a class="navbar-brand" href="../index">Home</a></li>
                <?php
                    if(isset($_SESSION['username']) && $_SESSION['username'] != null)
                    { ?>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $_SESSION['username'] ?> <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="../user_posts?username=<?php echo $_SESSION['username'] ?>"><i class="fa fa-fw fa-user"></i> Profile</a>
                                </li>
                                <li class="divider"></li>
                                <li>
                                    <a href="includes/logout"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                                </li>
                            </ul>
                        </li>
                    <?php }
                ?>
            </ul>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li>
                        <a href="index"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
                    </li>
                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#posts"><i class="fa fa-file-text fa-fw"></i> Posts <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="posts" class="collapse">
                            <li>
                                <a href="posts?source=view_all_posts">View All Posts</a>
                            </li>
                            <li>
                                <a href="posts?source=add_post">Add Post</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="categories"><i class="fa fa-list fa-fw"></i> Categories</a>
                    </li>
                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#users"><i class="fa fa-user fa-fw"></i> Users <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="users" class="collapse">
                            <li>
                                <a href="users?source=view_all_users">View All Users</a>
                            </li>
                            <li>
                                <a href="users?source=add_user">Add User</a>
                            </li>
                        </ul>
                    </li>
                    
                    <li>
                        <a href="comments?source=view_all_comments"><i class="fa fa-comments fa-fw"></i> Comments</a>
                    </li>
                    <li>
                        <a href="profile"><i class="fa fa-fw fa-file"></i> Profile</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>