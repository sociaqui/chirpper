<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2016-03-18
 * Time: 14:47
 */

require_once ("../src/includes.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $oldPassword = $_POST['oldpassword'];
    $newPassword = $_POST['newpassword'];
    $confirmNewPassword = $_POST['confirmNewPassword'];
    $msgtype = 'danger';
    if (empty($oldPassword) || empty($newPassword) || empty($confirmNewPassword)) {
        $message = 'Please fill all the fields!';
    } else if ($newPassword != $confirmNewPassword) {
        $message = "New password and it's confirmation do not match!";
    } else {
        $newUser = new User();
        $newUser->loadFromDb($conn, $_SESSION['userId']);
        $passConfirmation = $newUser->updateUserPassword($conn, $oldPassword, $newPassword);

        if ($passConfirmation === true) {
            $message = 'Password changed.';
            $msgtype = 'success';
        } else if ($passConfirmation === false) {
            $message = 'Password not changed. Please contact the site administrator.';
        } else {
            $message = $passConfirmation;
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
    <title>Change password</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
</head>

<body>
<div class="well" style="width: 750px; margin: 0 auto; margin-top: 20px;">
    <form class="form-horizontal" method="POST">
        <div class="form-group ">
            <div class="col-sm-offset-4 col-sm-8">  <!-- TODO properly align stuff (read on bootstrap CSS classes for labels) -->
                <strong>Change password</strong>
            </div>
        </div>
        <?php if (isset($message)) {
            echo '<div class="alert alert-' . $msgtype . '" role="alert">' .
                $message
                . '</div>';
        }
        ?>
        <div class="form-group">
            <label class="control-label" for="oldpassword">Old Password:</label>
            <input type="password" class="form-control" id="oldpassword" name="oldpassword" placeholder="Old Password">
        </div>
        <div class="form-group">
            <label class="control-label" for="newpassword">New Password:</label>
            <input type="password" class="form-control" id="newpassword" name="newpassword" placeholder="New Password">
        </div>
        <div class="form-group">
            <label class="control-label" for="confirmNewPassword">Confirm New Password:</label>
            <input type="password" class="form-control" id="confirmNewPassword" name="confirmNewPassword"
                   placeholder="Confirm New Password">
        </div>
        <div class="form-group">
            <div class="col-sm-offset-4 col-sm-8">
                <button class="btn btn-info btn-xs" type="submit" name="register">Change password</button>
                <a class="btn btn-info btn-xs" href="../">Cancel</a>
            </div>
        </div>
    </form>
</div>
</body>
</html>