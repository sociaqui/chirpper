<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2016-03-18
 * Time: 12:58
 */
if(session_status() != PHP_SESSION_ACTIVE){
    session_start();
}

if(!isset ($_SESSION['userId'])){
    header ("Location: ./Views/login.php");
}
?>

<!DOCTYPE html>
<html lang="pl-PL">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CHIRPPER (chirp, chirp)</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
</head>

<body>
    <h1>Welcome back!</h1>
    <ul>
        <li><a href="./Views/show_all_posts.php">See all your previous chirps</a> and maybe add a new one or two...</li>
        <li><a href="./Views/show_all_users.php">See all users</a> and maybe send someone a message or comment on their posts...</li>
        <li><a href="./Views/modify_user.php">Change your personal info</a></li>
        <li><a href="./Views/modify_password.php">Change your password</a></li>
        <li><a href="./Views/logout.php">LOGOUT</a></li>
        <li><a href="./Views/delete_user.php">DELETE ACCOUNT</a></li>
    </ul>
</body>
</html>
