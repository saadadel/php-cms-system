<div class="col-md-4">

    <!-- Blog Search Well -->
    <div class="well">
        <h4>Blog Search</h4>
        <form action="./search.php" method="post">
            <div class="input-group">
                <input name="searchfor" type="text" class="form-control">
                <span class="input-group-btn">
                    <button name="searchsubmit" class="btn btn-default" type="submit">
                        <span class="glyphicon glyphicon-search"></span>
                </button>
                </span>
            </div>
        </form>
    </div>

    <!-- Blog Categories Well -->
    <div class="well">
        <h4>Blog Categories</h4>
        <div class="row">
            <div class="col-lg-6">
                <ul class="list-unstyled">
                    <?php
                        $query = "select * from categories";
                        $query_res = mysqli_query($connection, $query);
                        while($row = mysqli_fetch_assoc($query_res))
                        {
                            $cat_title = $row['cat_title'];
                            $cat_id = $row['cat_id'];
                            echo "<li>
                            <a href='category.php?cat_id={$cat_id}'>{$cat_title}</a>
                                </li>";
                        }
                    ?>
                </ul>
            </div>
        </div>
    </div>


    <!-- Side Widget Well -->
    <div class="well">
        <h4>Side Widget Well</h4>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore, perspiciatis adipisci accusamus laudantium odit aliquam repellat tempore quos aspernatur vero.</p>
    </div>

</div>