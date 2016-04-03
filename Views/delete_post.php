<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2016-04-03
 * Time: 18:01
 */

require_once("../src/includes.php");

if(isset($_GET['postId'])){
    $post = new Post();
    if ($post->loadPost($conn, $_GET['postId']) === TRUE){
        $test=$post->deletePost($conn);
        header ("Location: show_all_posts.php");
    }
}
?>
<h1>If you can see this - good job! You made my server cry...</h1>