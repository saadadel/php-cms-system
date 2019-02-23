<?php include "includes/header.php"?>
<?php include "../includes/db.php"?>

    <div id="wrapper">

        <!-- Navigation -->
        <?php include "includes/navigation.php"?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome To Admin
                            <small>
                                <?php
                                    if(isset($_SESSION['username']) && $_SESSION['user_role'] == "admin")
                                    {
                                        echo $_SESSION['username'];
                                    }
                                ?>
                            </small>
                        </h1>
                    </div>
                </div>
                <!-- /.row -->
                <div class="row">
                <?php include "admin_widgets.php" ?>
                </div>
                <div class="row">
                <script type="text/javascript">
                    google.charts.load('current', {'packages':['bar']});
                    google.charts.setOnLoadCallback(drawChart);

                    function drawChart() {
                        var data = google.visualization.arrayToDataTable([
                        ['Data', 'Count'],
                        <?php
                            $element_text = ['Posts', 'Comments', 'Users', 'Categories'];
                            $element_count = [$posts_num[0], $comments_num[0], $users_num[0], $categories_num[0]];
                            for($i=0; $i<4; $i++)
                            {
                                echo "['{$element_text[$i]}', {$element_count[$i]}],";
                            }
                        ?>
                        ]);

                        var options = {
                        chart: {
                            title: '',
                            subtitle: '',
                        }
                        };

                        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

                        chart.draw(data, google.charts.Bar.convertOptions(options));
                    }
                </script>
                <div id="columnchart_material" style="width: auto; height: 500px;"></div>
            </div>
        </div>
            
            <!-- /.container-fluid -->
            
        </div>
        <!-- /#page-wrapper -->
        
    <!-- /#wrapper -->
<?php include "includes/footer.php"?>
