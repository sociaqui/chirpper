<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2016-03-18
 * Time: 12:58
 */

include_once 'Classes/DbConnection.php';
include_once 'Classes/User.php';

$conn = DbConnection::getConnection();

//$user = new User();
//$user->addUser('testlog','testpass',null);

//header('location: adres');

$conn->close();
$conn=null;

?>


