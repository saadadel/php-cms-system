<?php
include "includes/db.php";
session_start();
if(isset($_POST['like']))
{
    $postid = mysqli_real_escape_string($connection, trim($_POST['postid']));
    $userid = mysqli_real_escape_string($connection, trim($_POST['userid']));
    $get_user_likes_Q = "select count(like_id) from likes where post_id={$postid} and user_id = {$userid}";
    $get_user_likes_Q_res = mysqli_query($connection, $get_user_likes_Q);
    if(!$get_user_likes_Q_res)
    {
        die("QUERY FAILED: " . mysqli_error($connection));
    }
    $user_likes = mysqli_fetch_array($get_user_likes_Q_res);
    $user_likes = $user_likes[0];
    if($user_likes == 0)
    {
        global $likes_num;
        //echo $testlike;
        $increase_likes_Q = "insert into likes(post_id, user_id) value({$postid}, {$userid})";
        $increase_likes_Q_res = mysqli_query($connection, $increase_likes_Q);
        if(!$increase_likes_Q_res)
        {
            die('QUERY FAILED' . mysqli_error($connection));
        }
    }
    $get_post_likes_Q = "select count(like_id) from likes where post_id={$postid}";
    $get_post_likes_Q_res = mysqli_query($connection, $get_post_likes_Q);
    $likes_num = mysqli_fetch_array($get_post_likes_Q_res);
    if(!$get_post_likes_Q_res)
    {
        die("QUERY FAILED: " . mysqli_error($connection));
    }
    $likes_num = $likes_num[0];
    echo $likes_num;
}
if(isset($_POST['dislike']))
{
    $postid = mysqli_real_escape_string($connection, trim($_POST['postid']));
    $userid = mysqli_real_escape_string($connection, trim($_POST['userid']));
    $get_user_likes_Q = "select count(like_id) from likes where post_id={$postid} and user_id = {$userid}";
    $get_user_likes_Q_res = mysqli_query($connection, $get_user_likes_Q);
    if(!$get_user_likes_Q_res)
    {
        die("QUERY FAILED: " . mysqli_error($connection));
    }
    $user_likes = mysqli_fetch_array($get_user_likes_Q_res);
    $user_likes = $user_likes[0];
    if($user_likes != 0)
    {
        $decrease_likes_Q = "delete from likes where post_id = {$postid} and user_id = {$userid}";
        $decrease_likes_Q_res = mysqli_query($connection, $decrease_likes_Q);
        if(!$decrease_likes_Q_res)
        {
            die('QUERY FAILED' . mysqli_error($connection));
        }
    }
    $get_post_likes_Q = "select count(like_id) from likes where post_id={$postid}";
    $get_post_likes_Q_res = mysqli_query($connection, $get_post_likes_Q);
    $likes_num = mysqli_fetch_array($get_post_likes_Q_res);
    if(!$get_post_likes_Q_res)
    {
        die("QUERY FAILED: " . mysqli_error($connection));
    }
    $likes_num = $likes_num[0];
    echo $likes_num;
}

?>