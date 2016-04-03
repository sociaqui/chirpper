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
    $username = $_POST['username'];
    $msgtype = 'danger';
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = 'Please check the e-mail you entered.';
    } else {
        $newUser = new User();
        $newUser->loadFromDb($conn, $_SESSION['userId']);
        $newUser->setEmail($email);
        $newUser->setUsername($username);
        $userAdd = $newUser->saveToDb($conn);

        if ($userAdd === true) {
            $message = 'Information updated.';
            $msgtype = 'success';
        } else if ($userAdd === false) {
            $message = 'Information not updated. Please contact the site administrator.';
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
    <title>Modify profile</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
</head>

<body>
<div class="well" style="width: 750px; margin: 0 auto; margin-top: 20px;">
    <form class="form-horizontal" method="POST">
        <div class="form-group ">
            <div class="col-sm-offset-4 col-sm-8">
                <strong>Modify profile</strong>
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
            <div class="col-sm-offset-4 col-sm-8">
                <button class="btn btn-info btn-xs" type="submit" name="register">Update info</button>
                <a class="btn btn-info btn-xs" href="../">Cancel</a>
            </div>
        </div>
    </form>
</div>
</body>
</html>