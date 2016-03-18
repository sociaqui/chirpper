<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2016-03-18
 * Time: 14:47
 */

include_once '../Classes/User.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];
    if (empty($email) || empty($password) || empty($confirmPassword)) {
        $alert = 'Please fill all the mandatory fields!';
    } else if ($password != $confirmPassword) {
        $alert = 'Passwords do not match!';
    } else {
        $userObject = new User();
        $userAdd = $userObject->addUser($email, $password, $username);
        if ($userAdd === true) {
            $success = 'User added. You can now login at <a href ="login.php">Login</a>';
        } else if ($userAdd === false){
            $alert = 'User not added. Please contact the site administrator.';
        }else{
            $alert = $userAdd;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pl-PL">
<head>
    <meta charset="UTF-8">
    <title>Homework - Mini Portal</title>
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="bootstrap-select/dist/css/bootstrap-select.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="bootstrap-select/dist/js/bootstrap-select.js"></script>
</head>

<body>
<fieldset>
    <legend>Registration</legend>
    <?php if (isset($success)): ?>
        <div class="alert alert-success" role="alert">
            <?php echo $success; ?>
        </div>
    <?php endif ?>
    <?php if (isset($alert)): ?>
        <div class="alert alert-danger" role="alert">
            <?php echo $alert; ?>
        </div>
    <?php endif ?>
    <form method="POST">
        <div class="form-group">
            <label for="exampleInputEmail1">Email address:</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Email">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Username:</label>
            <input type="text" class="form-control" id="username" name="username" placeholder="username">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Password:</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Password">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Confirm Password:</label>
            <input type="password" class="form-control" id="confirmPassword" name="confirmPassword"
                   placeholder="Confirm Password">
        </div>
        <button type="submit" class="btn btn-default">Submit</button>
    </form>
</fieldset>
</body>
</html>