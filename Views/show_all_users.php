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
<a class="btn btn-info btn-xs" href="../">Back</a>
<div class="well" style="width: 750px; margin: 0 auto; margin-top: 20px;">
    <?php

    require_once("../src/includes.php");

    $allUsers = User::GetAllUsers($conn);

    if (count($allUsers) === 0) {
        echo("<p>Sadly there are no registered users yet... <br/> (No idea how you got here without an account tho)</p>");
    } else {
        echo("<ul>");
        foreach ($allUsers as $user) {
            echo("<li>{$user->getEmail()} ({$user->getUsername()}):
                    <a href='show_all_posts.php?userId={$user->getId()}'>See chirps</a> /
                    <a href='../'>Send message</a> /
                    <a href='../'>Add as friend</a></li>");
        }
        echo("</ul>");
    }

    ?>
</div>
</body>
</html>