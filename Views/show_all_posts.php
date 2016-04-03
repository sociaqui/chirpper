<?php

require_once("../src/includes.php");

$user = new User();
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $user->loadFromDb($conn, $_GET['userId']);
}else{
    $user->loadFromDb($conn, $_SESSION['userId']);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $newPost = new Post();
    $newPost->setPostText($_POST['content']);
    $newPost->setAuthorId($_SESSION['userId']);
    $newPost->savePost($conn);
}
?>

<!DOCTYPE html>
<html lang="pl-PL">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Chirps</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
</head>
<body>

<?php
if ($user->getId() == $_SESSION['userId']) {
    echo('
    <div class="well" style="width: 750px; margin: 0 auto; margin-top: 20px;">
        <form class="form-horizontal" method="POST">
            <div class="form-group ">
                <div class="col-sm-offset-4 col-sm-8">
                    <strong>Post a new chirp</strong>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label" for="content">Content:</label>
                <input type="text" size="255" class="form-control" id="content" name="content" placeholder="Your thoughts...">
            </div>
            <div class="form-group">
                <div class="col-sm-offset-4 col-sm-8">
                    <button class="btn btn-info btn-xs" type="submit" name="post">Post</button>
                </div>
            </div>
        </form>
    </div>
    ');
}
?>


<div class="well" style="width: 750px; margin: 0 auto; margin-top: 20px;">
    <?php
    $allPosts = $user->getAllMyPosts($conn);

    if (count($allPosts) === 0) {
        echo("<p>Nothing to chirp...</p>");
    } else {
        echo("<ul>");
        foreach ($allPosts as $post) {
            echo("<li>
                  <p>{$post->getDate()} {$user->getUsername()} chirpped:</p>
                  <p>{$post->getPostText()}</p>
                  <p><a href='show_post.php?postId={$post->getPostId()}'>See comments</a>
                  <a href='add_comment.php?postId={$post->getPostId()}'>Comment on this chirp</a>   ");
                  if ($user->getId() == $_SESSION['userId']) {
                        echo("<a href='delete_post.php?postId={$post->getPostId()}'>DELETE</a>");
                  }
            echo("</p></li>");
        }
        echo("</ul>");
    }

    ?>
</div>
</body>
</html>