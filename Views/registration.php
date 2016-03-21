<?php
require_once '../Classes/User.php';
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2016-03-18
 * Time: 14:47
 */
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];
    $msgtype = 'danger';
    if (empty($email) || empty($password) || empty($confirmPassword)) {
        $message = 'Please fill all the mandatory fields!';
    } else if ($password != $confirmPassword) {
        $message = 'Passwords do not match!';
    } else {
        $userObject = new User();
        $userAdd = $userObject->addUser($email, $password, $username);
        if ($userAdd === true) {
            $message = 'User added. You can now login at <a href ="login.php">Login</a>';
            $msgtype = 'success';
        } else if ($userAdd === false) {
            $message = 'User not added. Please contact the site administrator.';
        } else {
            $message = $userAdd;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pl-PL">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registration</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
</head>

<body>
<div class="well" style="width: 750px; margin: 0 auto; margin-top: 20px;">
    <form class="form-horizontal" method="POST">
        <div class="form-group ">
            <div class="col-sm-offset-4 col-sm-8">  <!-- TODO properly align stuff (read on bootstrap CSS classes for labels) -->
                <strong>Registration</strong>
            </div>
        </div>
        <?php if (isset($message)) {
            echo '<div class="alert alert-' . $msgtype . '" role="alert">' .
                $message
                . '</div>';
        }
        ?>
        <div class="form-group">
            <label class="control-label" for="username">Username (optional):</label>
            <input type="text" class="form-control" id="username" name="username" placeholder="username">
        </div>
        <div class="form-group">
            <label class="control-label" for="email">Email address:</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Email">
        </div>
        <div class="form-group">
            <label class="control-label" for="password">Password:</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Password">
        </div>
        <div class="form-group">
            <label class="control-label" for="confirmPassword">Confirm Password:</label>
            <input type="password" class="form-control" id="confirmPassword" name="confirmPassword"
                   placeholder="Confirm Password">
        </div>
        <div class="form-group">
            <div class="col-sm-offset-4 col-sm-8">
                <button class="btn btn-info btn-xs" type="submit" name="register">Register</button>
                <a class="btn btn-info btn-xs" href="../">Cancel</a>
            </div>
        </div>
    </form>
</div>
</body>
</html>