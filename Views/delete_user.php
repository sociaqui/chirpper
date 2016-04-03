<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2016-03-18
 * Time: 14:47
 */

require_once("../src/includes.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $deleteUser = new User();
    $deleteUser->loadFromDb($conn, $_SESSION['userId']);
    $deleteUser->deleteUser($conn);
    header("Location: ../index.php");

}
?>

<!DOCTYPE html>
<html lang="pl-PL">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>DELETE ACCOUNT</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
</head>

<body>
<div class="well" style="width: 333px; margin: 0 auto; margin-top: 20px;">
    <form class="form-horizontal" method="POST">
        <div class="form-group ">
            <div class="col-sm-offset-4 col-sm-8">
                <strong>DELETE ACCOUNT</strong>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label" for="email">Are you absolutely sure?</label>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-4 col-sm-8">
                <button class="btn btn-info btn-xs" type="submit" name="register">Yes</button>
                <a class="btn btn-info btn-xs" href="../">Cancel</a>
            </div>
        </div>
    </form>
</div>
</body>
</html>