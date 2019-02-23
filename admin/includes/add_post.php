<?php
    if(isset($_POST['create_post']))
    {
        $post_image_temp = $_FILES['post_image']['tmp_name'];
        $post_image = $_FILES['post_image']['name'];
        $post_cat_id = escape($_POST['category']);
        $post_title = escape($_POST['title']);
        $post_author = escape($_POST['author']);
        $post_content = escape($_POST['content']);
        $post_tags = escape($_POST['tags']);
        $post_status = escape($_POST['status']);
        move_uploaded_file($post_image_temp, "../images/$post_image");
        $post_image = escape($post_image);
        $query = "insert into posts(post_category_id, post_title, post_author, post_date, post_image, post_content, post_tags, post_status) ";
        $query .= "value({$post_cat_id}, '{$post_title}', '{$post_author}', now(), '{$post_image}', '{$post_content}', '{$post_tags}', '{$post_status}')";
        $query_res = mysqli_query($connection, $query);
        if(!$query_res)
        {
            die("QUERY FAILED: " . mysqli_error($connection));
        }
        header("location: posts?source=view_all_posts");
    }
?>

<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">Post Title</label>
        <input type="text" class="form-control" name="title">
    </div>
    <div class="form-group">
        <label for="post_category">Post Category</label>
        <select name="category" class="form-control">
    <?php
        $cat_query = "select * from categories";
        $cat_query_res = mysqli_query($connection, $cat_query);
        if(!$cat_query_res)
        {
            die("QUERY FAILED: " . mysqli_error($connection));
        }
        while($cat_row = mysqli_fetch_assoc($cat_query_res))
        {
            echo "
                <option value='{$cat_row['cat_id']}'>{$cat_row['cat_title']}</option>
            ";
        }
    ?>
        </select>
    </div>
    <div class="form-group">
        <label for="author">Post Author</label>
        <select name="author" class="form-control">
    <?php
        $user_query = "select * from users";
        $user_query_res = mysqli_query($connection, $user_query);
        if(!$user_query_res)
        {
            die("QUERY FAILED: " . mysqli_error($connection));
        }
        while($user_row = mysqli_fetch_assoc($user_query_res))
        {
            echo "
                <option value='{$user_row['username']}'>{$user_row['username']}</option>
            ";
        }
    ?>
        </select>
    </div>
    <div class="form-group">
        <label for="status">Post Status</label>
        <select name="status" class="form-control">
            <option value="published">Published</option>
            <option value="draft">Draft</option>
        </select>
    </div>
    <div class="form-group">
        <label for="title">Post Image</label>
        <input type="file" name="post_image">
    </div>
    <div class="form-group">
        <label for="tags">Post Tags</label>
        <input type="text" class="form-control" name="tags">
    </div>
    <div class="form-group">
        <label for="title">Post Content</label>
        <textarea id="textarea_ck" class="form-control" name="content" cols="30" rows="10"></textarea>
    </div>
    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="create_post" value="Create Post">
    </div>
</form>