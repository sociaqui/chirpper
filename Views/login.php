<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2016-03-18
 * Time: 14:47
 */

require_once ("../src/includes.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $msgtype = 'danger';
    if (empty($email) || empty($password)) {
        $message = 'Please enter your login information!';
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = 'Please double-check the entered email!';
    } else {
        if (User::Login($conn, $email, $password) === true) {
            // TODO what next?
            $message = 'O.K. here`s a <a href="../test/test.php">test</a>';
            $msgtype = 'success';
            // TODO what next?
            //header("Location: index.php");
        } else {
            $message = 'Login failed! Please try again.';
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
<body>
<div class="well" style="width: 500px; margin: 0 auto; margin-top: 20px;">
    <form class="form-horizontal" method="POST">
        <div class="form-group ">
            <div class="col-sm-offset-5 col-sm-7">
                <strong>Login</strong> <!-- TODO properly align stuff (read on bootstrap CSS classes for columns and offsets) -->
            </div>
        </div>
        <?php if (isset($message)) {
            echo '<div class="alert alert-' . $msgtype . '" role="alert">' .
                $message
                . '</div>';
        }
        ?>
        <div class="form-group">
            <label class="control-label" for="email">Email address:</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Email">
        </div>
        <div class="form-group">
            <label class="control-label" for="password">Password:</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Password">
        </div>
        <div class="form-group">
            <div class="col-sm-offset-4 col-sm-8">
                <button class="btn btn-info btn-xs" type="submit" name="login">Login</button>
                <a class="btn btn-info btn-xs" href="registration.php">Register</a>
            </div>
        </div>
    </form>
</div>
</body>
</html>