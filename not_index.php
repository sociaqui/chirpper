<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2016-03-18
 * Time: 12:58
 */

require_once ("./src/includes.php");

echo ("I'm here");
die;

$user = new User();
$user->setEmail('datetest@test.com');
$password = 'asd';

$getUserQuery = "SELECT * FROM users WHERE email='{$user->getEmail()}' AND deleted=0;";
$result = $conn->query($getUserQuery);
if ($result->num_rows == 0) {
    echo ('oops');
}
$row = $result->fetch_assoc();
$hash = $row['password'];
if (!password_verify($password, $hash)){
    echo ('wrong');
}else{
    echo ('OK');
}