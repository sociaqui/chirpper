<!DOCTYPE html>
<html lang="pl-PL">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Chirp</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
</head>
<body>

<a class="btn btn-info btn-xs" href="../">Back</a>
<div class="well" style="width: 750px; margin: 0 auto; margin-top: 20px;">

    <?php
    require_once("../src/includes.php");

    $user = new User();
    if (isset($_GET['userId'])) {
        $user->loadFromDb($conn, $_GET['userId']);
    } else {
        $user->loadFromDb($conn, $_SESSION['userId']);
    }

    $post = new Post();
    if (isset($_GET['postId'])) {
        $post->loadPost($conn, $_GET['postId']);
    }

    echo("<ul><li>
        <p>{$post->getDate()} {$user->getUsername()} chirpped:</p>
        <p>{$post->getPostText()}</p>
        <p><a href='add_comment.php?postId={$post->getPostId()}'>Comment on this chirp</a>   ");
    if ($user->getId() == $_SESSION['userId']) {
        echo(" / <a href='delete_post.php?postId={$post->getPostId()}'>DELETE</a>");
    }
    echo("</p>
    </li></ul>");
    ?>
</div>
<div class="well" style="width: 550px; margin: 0 auto; margin-top: 20px;">
    <ul>
        <li>TODO</li>
        <li>Comments</li>
        <li>will go</li>
        <li>here</li>
    </ul>
</div>