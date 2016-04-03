<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2016-03-31
 * Time: 14:50
 */

require_once ("../Classes/DbConnection.php");
require_once ("../Classes/User.php");
require_once ("../Classes/Post.php");

if(session_status() != PHP_SESSION_ACTIVE){
    session_start();
}

$conn=DbConnection::GetConnection();